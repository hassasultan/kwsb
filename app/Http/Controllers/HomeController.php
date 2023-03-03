<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\MobileAgent;
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
        $totalComplaints = Complaints::count();
        $totalAgents = MobileAgent::count();
        $complaintsPending = Complaints::where('status',0)->count();
        $complaintsComplete = Complaints::where('status',1)->count();
        $result[0] = ['Clicks','Viewers'];
        $result[1] = ['Pending',$complaintsPending];
        $result[2] = ['Complete',$complaintsComplete];
        // foreach ($complaints as $key => $value) {
        //     $result[++$key] = ['Pending', (int)count($value)];
        // }
        if($request->has('status') && $request->status == "api")
        {
            $data['result'] = $result;
            return $data;
        }

        return view('home',compact('totalComplaints','totalAgents'));
    }
}
