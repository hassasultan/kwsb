<?php

namespace App\Http\Controllers;

use App\Models\ComplaintAssignDepartment;
use App\Models\Complaints;
use Illuminate\Http\Request;
class DepartmentHomeController extends Controller
{
    //
    public function home()
    {
        $complaint = Complaints::with('assignedComplaintsDepartment')->whereHas('assignedComplaintsDepartment',function($query){
            $query->where('user_id',auth()->user()->id);
        });
        $totalComplaints = $complaint->count();
        $complaintsPending = Complaints::with('assignedComplaintsDepartment')->whereHas('assignedComplaintsDepartment',function($query){
            $query->where('user_id',auth()->user()->id);
        })->where('status',0)->count();
        // dd($complaint->get()->toArray());
        $complaintsComplete = Complaints::with('assignedComplaintsDepartment')->whereHas('assignedComplaintsDepartment',function($query){
            $query->where('user_id',auth()->user()->id);
        })->where('status',1)->count();
        return view('department.home',compact('totalComplaints','complaintsPending','complaintsComplete'));
    }
}
