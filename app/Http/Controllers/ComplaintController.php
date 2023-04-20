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
use DB;


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
    public function index()
    {
        $complaint = Complaints::OrderBy('id','DESC')->get();
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
        $complaint = Complaints::with('town','customer','type','prio')->where('town_id', $town_id)->get();
        return $complaint;
    }
    public function agent_wise_complaints_count()
    {
        $typeCount = array();
        $town_id = auth('api')->user()->agent->town_id;
        $data['total_complaint'] = Complaints::with('town','customer','type','prio')->where('town_id', $town_id)->count();
        $data['total_complaint_pending'] = Complaints::where('status',0)->where('town_id', $town_id)->count();
        $data['total_complaint_complete'] = Complaints::where('status',1)->where('town_id', $town_id)->count();
        $type = ComplaintType::with('complaints')->whereHas('complaints',function($query)use($town_id){
            $query->where('town_id', $town_id);
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
    public function generate_report(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        // $comp = Complaints::with('type')->whereDate('created_at','>=',$dateS)->whereDate('created_at','<=',$dateE)->orderBy('created_at')
        // ->get()->groupBy('type_id');
        $comp = Complaints::with('type')
            ->whereDate('created_at','>=',$dateS)
            ->whereDate('created_at','<=',$dateE)
            ->orderBy('type_id','ASC')
            ->get()
            ->groupBy([ function ($post) {
                return $post->created_at->format('Y-m-d');
            },'type_id']);

        $type = ComplaintType::get();
        //     ->groupBy([function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     }, '']);

        // dd($comp);
        // dd($comp->toArray());
        return view('pages.complaints.report',compact('comp','type'));
    }
}
