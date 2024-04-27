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
            'title' => ['required', 'string'],
            'source' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }
    public function index(Request $request)
    {
        $complaint = Complaints::with('customer','town','subtown','type','prio','assignedComplaints')->OrderBy('id','DESC');
        if($request->has('search') && $request->search != null && $request->search != '')
        {
            $complaint = $complaint->where('title','LIKE','%'.$request->search.'%')->orWhere('comp_num',$request->search);
        }
        $complaint = $complaint->paginate(10);
        // dd($complaint->toArray());
        if($request->has('type'))
        {
            return $complaint;
        }
        // dd($complaint->toArray());
        return view('pages.complaints.index',compact('complaint'));
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
        if($request->has('search'))
        {
            $customer = Customer::where('customer_id',$request->search)->first();
            if($customer == null)
            {
                return redirect()->back()->with('error', "Customer Not Found...");
            }
        }

        return view('pages.complaints.create',compact('customer','town','type','prio','subtown','subtype','source'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            $prefix = "COMPLAINT-";
            $CompNum = IdGenerator::generate(['table' => 'complaint','field' => 'comp_num', 'length' => 14, 'prefix' =>$prefix]);
            $data['comp_num'] = $CompNum;
            if($request->has('image') && $request->image != NULL)
            {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::create($data);
            return redirect()->route('compaints-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $complaint = Complaints::find($id);
        $town = Town::all();
        $type = ComplaintType::all();
        $subtown = SubTown::all();
        return view('pages.complaints.edit',compact('complaint','town','type','subtown'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            if($request->has('image') && $request->image != NULL)
            {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::where('id',$id)->update($data);
            return redirect()->route('compaints-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
    public function agent_wise_complaints()
    {
        $town_id = auth('api')->user()->agent->town_id;
        $type_id = auth('api')->user()->agent->type_id;
        $complaint = Complaints::with('town','customer','type','subtype','prio')->where('town_id', $town_id)->where('type_id', $type_id)->get();
        return $complaint;
    }
    public function customer_wise_complaints()
    {
        $customer_id = auth('api')->user()->customer->id;
        // $type_id = auth('api')->user()->agent->type_id;
        $complaint = Complaints::with('town','customer','type','subtype','prio')->where('customer_id', $customer_id)->get();
        return $complaint;
    }
    public function type_wise_complaints()
    {
        $type_id = auth('api')->user()->agent->type_id;
        $town_id = auth('api')->user()->agent->town_id;
        $typesWithComplaintsCount = ComplaintType::withCount([
            'complaints' => function (Builder $query) use ($town_id,$type_id) {
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
            'complaints' => function (Builder $query) use ($town_id,$type_id) {
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

        $data['agent'] = MobileAgent::with('assignedComplaints','assignedComplaints.complaints','assignedComplaints.complaints.town')->find(auth('api')->user()->agent->id);
        $data['total_complaint'] = Complaints::with('town','customer','type','prio')->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $data['total_complaint_pending'] = Complaints::where('status',0)->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $data['total_complaint_complete'] = Complaints::where('status',1)->where('town_id', $town_id)->where('type_id', $type_id)->count();
        $type = ComplaintType::with('complaints')->whereHas('complaints',function($query)use($town_id, $type_id){
            $query->where('town_id', $town_id)->where('type_id', $type_id);
        })->get();
        foreach($type as $key => $row)
        {
            $result[++$key] = [$row->title, (int)count($row->complaints)];
        }
        $data['type_count'] = $result;
        return $data;
    }
    public function agent_complaints_update(Request $request)
    {
        $complaint = Complaints::with('town','customer','type')->find($request->id);
        $complaint->status = $request->status;
        if($request->has('before_image'))
        {
            $complaint->before_image = $this->before($request->before_image);
        }
        if($request->has('after_image'))
        {
            $complaint->after_image = $this->after($request->after_image);
        }
        if($request->has('agent_description'))
        {
            $complaint->agent_description = $request->agent_description;
        }
        $complaint->save();
        return response()->json(["message"=>"Your Given Information Addedd Successfully..."]);
    }
    public function detail($id)
    {
        $complaint = Complaints::with('town','town.agents')->find($id);
        return view('pages.complaints.details',compact('complaint'));

    }
    public function assign_complaint($agentId,$complaintId)
    {
        $check = ComplaintAssignAgent::where('complaint_id',$complaintId)->where('agent_id',$agentId)->first();
        if($check == null)
        {
            $check = ComplaintAssignAgent::create([
                'complaint_id' => $complaintId,
                'agent_id' => $agentId,
            ]);
        }
        else
        {
            return redirect()->back()->with('error',"Already Assigned this Complaint...!");
        }
        return redirect()->route('agent-management.details',$agentId);
    }
    public function report()
    {
        $town = Town::all();
        $type = ComplaintType::get();
        $prio = Priorities::get();
        $source = Complaints::get()->groupBy('source');
        return view('pages.reports.index',compact('town','type','prio','source'));

    }
    public function generate_report(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $town = null;
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
        $complaints = Complaints::with('type','customer')
        ->select('type_id', DB::raw('date(created_at) as date'), DB::raw('count(*) as num_complaints'))
        ->whereBetween('created_at', [$dateS, $dateE]);
        if($request->has('town_id'))
        {
            $complaints = $complaints->where('town_id',$request->town_id);
            $town = Town::find($request->town_id);
            // dd($town->toArray());
        }
        if($request->has('type_id'))
        {
            $complaints = $complaints->where('type_id',$request->type_id);
            $type = ComplaintType::find($request->type_id);
            // dd($town->toArray());
        }
        if($request->has('prio_id'))
        {
            $complaints = $complaints->where('prio_id',$request->prio_id);
            $prio = Priorities::find($request->prio_id);
            // dd($town->toArray());
        }
        if($request->has('customer_id'))
        {
            $cust = $request->customer_id;
            $complaints = $complaints->WhereHas('customer',function($query)use($cust){
                $query->where('customer_id',$cust);
            })->orwhere('customer_num',$request->customer_id);
            $consumer = $cust;
            // dd($town->toArray());
        }
        if($request->has('source'))
        {
            if($request->source != "all")
            {
                $complaints = $complaints->where('source',$request->source);
            }
            $source = $request->source;
            // dd($town->toArray());
        }
        $complaints = $complaints->groupBy('type_id', 'date')
        ->orderBy('date','ASC')
        ->get();

        // $type = ComplaintType::get();
        //     ->groupBy([function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     }, '']);

        // dd($comp);
        // dd($complaints->toArray());
        return view('pages.reports.report',compact('complaints','type','dateS','dateE','town','consumer','source','prio'));
    }
}
