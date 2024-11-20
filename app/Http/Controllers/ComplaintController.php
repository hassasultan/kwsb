<?php

namespace App\Http\Controllers;

use App\Models\ComplaintAssignAgent;
use App\Models\MobileAgent;
use App\Models\Town;
use App\Models\ComplaintType;
use App\Models\SubType;
use App\Models\User;
use App\Models\Complaints;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Priorities;
use App\Models\SubTown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Exception;

class ComplaintController extends Controller
{
    //
    use SaveImage;
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            // 'title' => ['required', 'string'],
            'source' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }
    public function index(Request $request)
    {
        // dd($request->all());
        $complaint = Complaints::with('customer', 'town', 'subtown', 'type', 'prio', 'assignedComplaints')->OrderBy('id', 'DESC');
        if ($request->has('search') && $request->search != null && $request->search != '') {
            $complaint = $complaint->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('comp_num', 'LIKE', '%' . $request->search . '%')
                ->orWhere('customer_num', 'LIKE', '%' . $request->search . '%')
                ->orWhere('customer_name', 'LIKE', '%' . $request->search . '%');
            if (count($complaint->get()) < 1) {
                $customer = Customer::where('customer_id', $request->search)
                    ->orwhere('customer_name', $request->search)->first();
                if ($customer != null) {
                    $complaint = $complaint->where('customer_id', $customer->id);
                }
            }
            // ->orWhereHas('customer',function($query) use($request){
            //     $query->where('customer_id',$request->search);
            // });
        }
        if ($request->has('town') && $request->town != null && $request->town != '') {
            $complaint = $complaint->where('town_id', $request->town);
        }
        if ($request->has('type_id') && $request->type_id != null && $request->type_id != '') {
            $complaint = $complaint->where('type_id', $request->type_id);
        }
        $complaint = $complaint->paginate(10)->appends([
            'type_id' => request()->get('type_id'),
            'town' => request()->get('town'),
            'search' => request()->get('search'),
        ]);
        // dd($complaint->toArray());
        if ($request->has('type')) {
            return $complaint;
        }
        $town = Town::all();
        $comptype = ComplaintType::all();
        // dd($complaint->toArray());
        return view('pages.complaints.index', compact('complaint', 'town', 'comptype'));
    }

    public function updateStatus(Request $request)
    {
        $complaint = Complaints::find($request->complaint_id);

        if ($complaint) {
            $complaint->status = $request->status;
            $complaint->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function create(Request $request)
    {
        $town = Town::all();
        $type = ComplaintType::all();
        $subtype = SubType::all();
        $prio = Priorities::all();
        $subtown = SubTown::all();
        $source = Source::all();
        $customer = NULL;
        if ($request->has('search')) {
            $customer = Customer::where('customer_id', $request->search)->first();
            if ($customer == null) {
                return redirect()->back()->with('error', "Customer Not Found...");
            }
        }

        return view('pages.complaints.create', compact('customer', 'town', 'type', 'prio', 'subtown', 'subtype', 'source'));
    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            $data = $request->all();
            $prefix = "COMPLAINT-";
            $CompNum = IdGenerator::generate(['table' => 'complaint', 'field' => 'comp_num', 'length' => 14, 'prefix' => $prefix]);
            $data['comp_num'] = $CompNum;
            if ($request->has('image') && $request->image != NULL) {
                $data['image'] = $this->complaintImage($request->image);
            }
            $cmp = Complaints::create($data);
            if ($cmp->customer_id != 0) {
                $phone = $cmp->customer->phone;
            } else {
                $phone = $cmp->phone;
            }
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'http://uti.bizintel.co:8003/ComplaintAPI.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => '{
                    "MobileNumber":"' . $phone . '",
                    "Type":"ComplaintLaunch",
                    "ComplaintNumber":"' . $cmp->comp_num . '"

                }
                ',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);
            return redirect()->route('compaints-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $complaint = Complaints::find($id);
        $town = Town::all();
        $type = ComplaintType::all();
        $subtype = SubType::all();
        $subtown = SubTown::all();
        $prio = Priorities::all();
        $source = Source::all();

        return view('pages.complaints.edit', compact('complaint', 'prio', 'source', 'town', 'type', 'subtype', 'subtown'));
    }
    public function update(Request $request, $id)
    {
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            $data = $request->except(['_method', '_token']);
            if ($request->has('image') && $request->image != NULL) {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::where('id', $id)->update($data);
            return redirect()->route('compaints-management.index')->with('success', 'Record Updated successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function agent_wise_complaints()
    {
        $town_id = auth('api')->user()->agent->town_id;
        $type_id = auth('api')->user()->agent->type_id;
        // dd(auth()->user()->id);
        $complaint = Complaints::with('town', 'customer', 'type', 'subtype', 'prio', 'assignedComplaints')->whereHas('assignedComplaints', function ($query) {
            $query->where('agent_id', auth('api')->user()->agent->id);
        })->where('town_id', $town_id)->where('type_id', $type_id)->get();
        return $complaint;
    }
    public function customer_wise_complaints()
    {
        try {
            $user = auth('api')->user();

            if (!$user || $user->role != 5) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $customer_id = auth('api')->user()->customer->id;
            if (auth('api')->user()->status == 0) {
                return response()->json(['success' => 'No Record Found...'], 500);
            }
            // $type_id = auth('api')->user()->agent->type_id;
            $complaint = Complaints::with('town', 'customer', 'type', 'subtype', 'prio')->where('customer_id', $customer_id)->get();
            return $complaint;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function type_wise_complaints()
    {
        $type_id = auth('api')->user()->agent->type_id;
        $town_id = auth('api')->user()->agent->town_id;
        $typesWithComplaintsCount = ComplaintType::withCount([
            'complaints' => function (Builder $query) use ($town_id, $type_id) {
                $query->where('town_id', $town_id)->where('type_id', $type_id);
            }
        ])
            ->get(['id', 'title']);
        return $typesWithComplaintsCount;
    }
    public function subtype_wise_complaints()
    {
        $town_id = auth('api')->user()->agent->town_id;
        $type_id = auth('api')->user()->agent->type_id;
        $subtypesWithComplaintsCount = SubType::withCount([
            'complaints' => function (Builder $query) use ($town_id, $type_id) {
                $query->where('town_id', $town_id)->where('type_id', $type_id);
            }
        ])
            ->get(['id', 'title']);
        return $subtypesWithComplaintsCount;
    }
    public function agent_wise_complaints_count()
    {
        $typeCount = array();
        $town_id = auth('api')->user()->agent->town_id;
        $type_id = auth('api')->user()->agent->type_id;

        $data['agent'] = MobileAgent::with('assignedComplaints', 'assignedComplaints.complaints', 'assignedComplaints.complaints.town')->find(auth('api')->user()->agent->id);
        $data['total_complaint'] = Complaints::with('town', 'customer', 'type', 'prio')->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $data['total_complaint_pending'] = Complaints::where('status', 0)->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $data['total_complaint_complete'] = Complaints::where('status', 1)->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $type = ComplaintType::with('complaints')->whereHas('complaints', function ($query) use ($town_id, $type_id) {
            $query->where('town_id', $town_id)->where('type_id', $type_id);
        })->get();
        foreach ($type as $key => $row) {
            $result[++$key] = [$row->title, (int) count($row->complaints)];
        }
        $data['type_count'] = $result;
        return $data;
    }
    public function agent_complaints_update(Request $request)
    {
        $complaint = Complaints::with('town', 'customer', 'type')->find($request->id);
        $complaint->status = $request->status;
        if ($request->has('before_image')) {
            $complaint->before_image = $this->before($request->before_image);
        }
        if ($request->has('after_image')) {
            $complaint->after_image = $this->after($request->after_image);
        }
        if ($request->has('agent_description')) {
            $complaint->agent_description = $request->agent_description;
        }
        $complaint->save();
        if ($complaint->phone != NULL) {
            $phone = $complaint->phone;
        } else {
            $phone = $complaint->customer->phone;
        }
        if ($request->status == "1") {

            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'http://uti.bizintel.co:8003/ComplaintAPI.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => '{
                        "MobileNumber":"' . $phone . '",
                        "Type":"ComplaintSolve",
                        "ComplaintNumber":"' . $complaint->comp_num . '"

                    }
                    ',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);


            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://bsms.ufone.com/bsms_v8_api/sendapi-0.3.jsp?id=03348970362&message=le chal gay sms&shortcode=KWSC&lang=urdu&mobilenum=' . $phone . '&password=Smskwsc%402024',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Cookie: cookiesession1=678B2883C43F88D5E4F3BA5C946B0899'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);
        }

        return response()->json(["message" => "Your Given Information Addedd Successfully..."]);
    }
    public function detail($id)
    {
        $complaint = Complaints::with('town', 'town.agents')->find($id);
        return view('pages.complaints.details', compact('complaint'));
    }
    public function assign_complaint($agentId, $complaintId)
    {
        $check = ComplaintAssignAgent::where('complaint_id', $complaintId)->where('agent_id', $agentId)->first();
        if ($check == null) {
            $alreadyAssign = ComplaintAssignAgent::where('complaint_id', $complaintId)->get();
            if (count($alreadyAssign) > 0) {
                foreach ($alreadyAssign as $row) {
                    $row->delete();
                }
            }
            $check = ComplaintAssignAgent::create([
                'complaint_id' => $complaintId,
                'agent_id' => $agentId,
            ]);
        } else {
            return redirect()->back()->with('error', "Already Assigned this Complaint...!");
        }
        return redirect()->route('agent-management.details', $agentId);
    }
    public function report()
    {
        $town = Town::all();
        $subtown = SubTown::all();
        $type = ComplaintType::get();
        $prio = Priorities::get();
        $source = Complaints::get()->groupBy('source');
        return view('pages.reports.index', compact('town', 'subtown', 'type', 'prio', 'source'));
    }
    public function generate_report(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $town = null;
        $subtown = null;
        $type = null;
        $prio = null;
        $source = null;
        $consumer = null;
        // $comp = Complaints::with('type')->whereDate('created_at','>=',$dateS)->whereDate('created_at','<=',$dateE)->orderBy('created_at')
        // ->get()->groupBy('type_id');
        // $comp = Complaints::with('type')
        //     ->whereDate('created_at','>=',$dateS)
        //     ->whereDate('created_at','<=',$dateE)
        //     ->orderBy('type_id','ASC')
        //     ->get()
        //     ->groupBy([ function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     },'type_id']);
        $complaints = Complaints::with('type', 'customer')
            ->select('type_id', DB::raw('date(created_at) as date'), DB::raw('count(*) as num_complaints'))
            ->whereBetween('created_at', [$dateS, $dateE]);
        if ($request->has('town_id')) {
            $complaints = $complaints->where('town_id', $request->town_id);
            $town = Town::find($request->town_id);
            // dd($town->toArray());
        }
        if ($request->has('sub_town_id')) {
            $complaints = $complaints->where('sub_town_id', $request->sub_town_id);
            $subtown = SubTown::find($request->sub_town_id);
            // dd($town->toArray());
        }
        if ($request->has('type_id')) {
            $complaints = $complaints->where('type_id', $request->type_id);
            $type = ComplaintType::find($request->type_id);
            // dd($town->toArray());
        }
        if ($request->has('prio_id')) {
            $complaints = $complaints->where('prio_id', $request->prio_id);
            $prio = Priorities::find($request->prio_id);
            // dd($town->toArray());
        }
        if ($request->has('customer_id')) {
            $cust = $request->customer_id;
            $complaints = $complaints->WhereHas('customer', function ($query) use ($cust) {
                $query->where('customer_id', $cust);
            })->orwhere('customer_num', $request->customer_id);
            $consumer = $cust;
            // dd($town->toArray());
        }
        if ($request->has('source')) {
            if ($request->source != "all") {
                $complaints = $complaints->where('source', $request->source);
            }
            $source = $request->source;
            // dd($town->toArray());
        }
        $complaints = $complaints->groupBy('type_id', 'date')
            ->orderBy('date', 'ASC')
            ->get();

        // $type = ComplaintType::get();
        //     ->groupBy([function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     }, '']);

        // dd($comp);
        // dd($complaints->toArray());
        return view('pages.reports.report', compact('complaints', 'subtown', 'type', 'dateS', 'dateE', 'town', 'consumer', 'source', 'prio'));
    }
    public function generate_report4(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $town = $request->town;
        $type = $request->type;

        // SQL query to fetch data with parameter binding
        $TATcompleteddetails = DB::select("
        SELECT
            c.comp_num AS Complaint,
            ct.title AS COMPLAIN_TYPE,
            st.title AS GRIEVANCE_TYPE,
            c.customer_name,
            c.phone,
            u.name AS Executive_Engineer,
            c.created_at AS CreatedDate,
            c.updated_at AS ResolvedDate,
            p.title AS PRIORITY,
            CONCAT(
                FLOOR(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at) / 24), ' days and ',
                MOD(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at), 24), ' hours'
            ) AS TurnaroundTime,
            TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at) AS TimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        JOIN complaint_types ct ON ct.id = c.type_id
        JOIN sub_types st ON st.id = c.subtype_id
        JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
        JOIN mobile_agent m ON ca.agent_id = m.id
        JOIN users u ON m.user_id = u.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 1
            AND c.created_at != c.updated_at
            AND c.town_id = :town
            And c.type_id = :type
            AND c.created_at BETWEEN :from_date AND :to_date
    ", [
            'from_date' => $dateS,
            'to_date' => $dateE,
            'town' => $town,
            'type' => $type,
        ]);
        // Return results to the view
        return view('pages.reports.report4', compact('TATcompleteddetails', 'dateS', 'dateE', 'type', 'town'));
    }

    public function generate_report2(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $dateS = $request->from_date;
        $dateE = $request->to_date;

        // SQL query to fetch data with parameter binding
        $TATcompleted = DB::select("
        SELECT
            c.comp_num AS Complaint,
            ct.title AS COMPLAIN_TYPE,
            st.title AS GRIEVANCE_TYPE,
            c.customer_name,
            c.phone,
            u.name AS Executive_Engineer,
            c.created_at AS CreatedDate,
            c.updated_at AS ResolvedDate,
            p.title AS PRIORITY,
            CONCAT(
                FLOOR(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at) / 24), ' days and ',
                MOD(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at), 24), ' hours'
            ) AS TurnaroundTime,
            TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at) AS TimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        JOIN complaint_types ct ON ct.id = c.type_id
        JOIN sub_types st ON st.id = c.subtype_id
        JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
        JOIN mobile_agent m ON ca.agent_id = m.id
        JOIN users u ON m.user_id = u.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 1
            AND c.created_at != c.updated_at
            AND c.created_at BETWEEN :from_date AND :to_date
    ", [
            'from_date' => $dateS,
            'to_date' => $dateE,
        ]);
        // Return results to the view
        return view('pages.reports.report2', compact('TATcompleted', 'dateS', 'dateE'));
    }

    public function generate_report3(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $dateS = $request->from_date;
        $dateE = $request->to_date;


        // SQL query to fetch data with parameter binding
        $TATpending = DB::select("
        SELECT
            c.comp_num AS Complaint,
            ct.title AS COMPLAIN_TYPE,
            st.title AS GRIEVANCE_TYPE,
            c.customer_name,
            c.phone,
            u.name AS Executive_Engineer,
            c.created_at AS CreatedDate,
            c.updated_at AS ResolvedDate,
            p.title AS PRIORITY,
            CONCAT(
                FLOOR(TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP) / 24), ' days and ',
                MOD(TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP), 24), ' hours'
            ) AS AgingTime,
            TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP) AS TimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        JOIN complaint_types ct ON ct.id = c.type_id
        JOIN sub_types st ON st.id = c.subtype_id
        JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
        JOIN mobile_agent m ON ca.agent_id = m.id
        JOIN users u ON m.user_id = u.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 0
            AND c.created_at BETWEEN :from_date AND :to_date
    ", [
            'from_date' => $dateS,
            'to_date' => $dateE,
        ]);
        // Return results to the view
        return view('pages.reports.report3', compact('TATpending', 'dateS', 'dateE',));
    }

    public function generate_report5(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $town = $request->town;
        $type = $request->type;

        // SQL query to fetch data with parameter binding
        $TATpendingdetail = DB::select("
        SELECT
            c.comp_num AS Complaint,
            ct.title AS COMPLAIN_TYPE,
            st.title AS GRIEVANCE_TYPE,
            c.customer_name,
            c.phone,
            u.name AS Executive_Engineer,
            c.created_at AS CreatedDate,
            c.updated_at AS ResolvedDate,
            p.title AS PRIORITY,
            CONCAT(
                FLOOR(TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP) / 24), ' days and ',
                MOD(TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP), 24), ' hours'
            ) AS AgingTime,
            TIMESTAMPDIFF(HOUR, c.created_at, CURRENT_TIMESTAMP) AS TimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        JOIN complaint_types ct ON ct.id = c.type_id
        JOIN sub_types st ON st.id = c.subtype_id
        JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
        JOIN mobile_agent m ON ca.agent_id = m.id
        JOIN users u ON m.user_id = u.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 0
            AND c.town_id = :town
            And c.type_id = :type
            AND c.created_at BETWEEN :from_date AND :to_date
    ", [
            'from_date' => $dateS,
            'to_date' => $dateE,
            'town' => $town,
            'type' => $type,
        ]);
        // Return results to the view
        return view('pages.reports.report5', compact('TATpendingdetail', 'dateS', 'dateE', 'type', 'town'));
    }
}
