<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\BounceBackComplaint;
use App\Models\MobileAgent;
use App\Models\Department;
use App\Models\ComplaintAssignAgent;
use App\Models\ComplaintAssignDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Services\LogService;

class BounceBackController extends Controller
{
    public function detail($complaintId)
    {
        $complaint = Complaints::with([
            'town',
            'subtown',
            'customer',
            'type',
            'subtype',
            'prio',
            'assignedComplaints.agents.user',
            'assignedComplaintsDepartment.user'
        ])->findOrFail($complaintId);

        $bounceBacks = BounceBackComplaint::with([
            'mobileAgent.user',
            'departmentUser',
            'bouncedByUser'
        ])->where('complaint_id', $complaintId)
          ->orderBy('bounced_at', 'desc')
          ->get();

        // Log the admin action
        if (auth()->check()) {
            LogService::create('BounceBack', $complaintId,
                auth()->user()->name . ' viewed bounce back complaint details for complaint #' . $complaint->comp_num
            );
        }

        return view('pages.bounceBack.detail', compact('complaint', 'bounceBacks'));
    }

    public function index(Request $request)
    {
        if ($request->type === 'ajax') {
            $query = BounceBackComplaint::with([
                'complaint.town',
                'complaint.customer',
                'complaint.type',
                'complaint.subtype',
                'complaint.prio',
                'complaint.assignedComplaints.agents.user',
                'complaint.assignedComplaintsDepartment.user',
                'mobileAgent.user.town',
                'departmentUser'
            ]);

            // Apply search filter
            if ($request->has('search') && $request->search != null && $request->search != '') {
                $query->whereHas('complaint', function ($q) use ($request) {
                    $q->where('comp_num', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('customer_name', 'LIKE', '%' . $request->search . '%');
                });
            }

            // Apply type filter
            if ($request->has('type_filter') && $request->type_filter != null && $request->type_filter != '') {
                $query->where('type', $request->type_filter);
            }

            // Apply status filter
            if ($request->has('status_filter') && $request->status_filter != null && $request->status_filter != '') {
                $query->where('status', $request->status_filter);
            }

            $bounceBacks = $query->orderBy('bounced_at', 'desc')->paginate(15);

            // Log the admin action
            if (auth()->check()) {
                LogService::create('BounceBack', 0,
                    auth()->user()->name . ' viewed bounce back complaints list (Admin Panel)'
                );
            }

            return response()->json($bounceBacks);
        }

        return view('pages.bounceBack.index');
    }

    public function getAgents()
    {
        $agents = MobileAgent::with(['user', 'town'])
            ->where('status', 1)
            ->get();

        // Log the action
        if (auth()->check()) {
            LogService::create('BounceBack', 0,
                auth()->user()->name . ' loaded mobile agents list for bounce back assignment'
            );
        }

        return response()->json($agents);
    }

    public function getDepartments()
    {
        $departments = Department::where('status', 1)->get();

        // Log the action
        if (auth()->check()) {
            LogService::create('BounceBack', 0,
                auth()->user()->name . ' loaded departments list for bounce back assignment'
            );
        }

        return response()->json($departments);
    }

    public function assign(Request $request)
    {
        try {
            $request->validate([
                'complaint_id' => 'required|exists:complaint,id',
                'assignment_type' => 'required|in:agent,department',
                'agent_id' => 'required_if:assignment_type,agent|exists:mobile_agent,id',
                'department_id' => 'required_if:assignment_type,department|exists:departments,id'
            ]);

            $complaintId = $request->complaint_id;
            $assignmentType = $request->assignment_type;

            // Check if complaint is already assigned
            $existingAssignment = null;
            if ($assignmentType === 'agent') {
                $existingAssignment = ComplaintAssignAgent::where('complaint_id', $complaintId)->first();
            } else {
                $existingAssignment = ComplaintAssignDepartment::where('complaint_id', $complaintId)->first();
            }

            if ($existingAssignment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Complaint is already assigned to ' . $assignmentType
                ], 400);
            }

            // Create new assignment
            if ($assignmentType === 'agent') {
                ComplaintAssignAgent::create([
                    'complaint_id' => $complaintId,
                    'agent_id' => $request->agent_id,
                    'status' => 0
                ]);
            } else {
                ComplaintAssignDepartment::create([
                    'complaint_id' => $complaintId,
                    'user_id' => $request->department_id,
                    'status' => 0
                ]);
            }

            // Update bounce back status to resolved
            BounceBackComplaint::where('complaint_id', $complaintId)
                ->where('status', 'active')
                ->update(['status' => 'resolved']);

            // Log the assignment action
            $assignmentType = $assignmentType === 'agent' ? 'Mobile Agent' : 'Department';
            $assignedTo = '';

            if ($assignmentType === 'Mobile Agent') {
                $agent = MobileAgent::with('user')->find($request->agent_id);
                $assignedTo = $agent ? $agent->user->name : 'Unknown Agent';
            } else {
                $department = Department::find($request->department_id);
                $assignedTo = $department ? $department->name : 'Unknown Department';
            }

            LogService::create('Complaint', $complaintId,
                "Bounce back complaint reassigned to {$assignmentType}: {$assignedTo} by " . auth()->user()->name
            );

            return response()->json([
                'success' => true,
                'message' => 'Complaint assigned successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
