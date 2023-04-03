<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\ComplaintType;
use App\Models\MobileAgent;
use App\Models\Town;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $allTown = array();
        $totalComplaints = Complaints::count();
        $totalAgents = MobileAgent::count();
        $complaintsPending = Complaints::where('status',0)->count();
        $complaintsComplete = Complaints::where('status',1)->count();
        $result[0] = ['Clicks','Viewers'];
        $result[1] = ['Pending',$complaintsPending];
        $result[2] = ['Complete',$complaintsComplete];
        $type = ComplaintType::with('complaints')->get();
        $resultNew[0] = ['Clicks','Viewers'];
        $town = Town::get('town');
        foreach($town as $row)
        {
            array_push($allTown,$row->town);
        }
        // dd($allTown);
        foreach($type as $key => $row)
        {
            $resultNew[++$key] = [$row->title, (int)count($row->complaints)];
        }
        if($request->has('status') && $request->status == "api")
        {
            $data['type_count'] = $resultNew;
            $data['result'] = $result;
            return $data;
        }
        foreach($type as $key => $row)
        {
            $typeComp[$key]['name'] = $row->title;
            $typeComp[$key]['data'] = [(int)count($row->complaints)];
        }
        // dd($typeComp);
        return view('home',compact('totalComplaints','totalAgents','allTown','typeComp'));
    }
}
