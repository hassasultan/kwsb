<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use App\Models\MobileAgent;
use App\Models\SubTown;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class MobileAgentController extends Controller
{
    use SaveImage;
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            'type_id' => [
                'required',
                'numeric',
                'exists:complaint_types,id',
                function ($attribute, $value, $fail) use ($data) {
                    $existingAgent = MobileAgent::where('town_id', $data['town_id'])
                        ->where('type_id', $value)
                        ->exists();

                    if ($existingAgent) {
                        $fail('The selected type for this town is already assigned to an agent.');
                    }
                }
            ],
            'address' => ['required', 'string'],
        ]);
    }
    public function index(Request $request)
    {
        if ($request->type === 'ajax') {
            $query = MobileAgent::with(['user', 'town', 'complaint_type']);

            // Search by agent name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }

            // Filter by town
            if ($request->filled('town')) {
                $query->where('town_id', $request->town);
            }

            // Filter by complaint type
            if ($request->filled('type_id')) {
                $query->where('type_id', $request->type_id);
            }

            $agents = $query->paginate(10);

            return response()->json($agents);
        }

        // For initial page load, get all data for filters
        $agent = MobileAgent::with(['user', 'town', 'complaint_type'])->get();
        $towns = Town::all();
        $types = ComplaintType::all();

        return view('pages.agent.index', compact('agent', 'towns', 'types'));
    }
    public function create()
    {
        $user = User::where('role', 3)->get();
        $town = Town::all();
        $subtown = SubTown::all();
        $type = ComplaintType::all();
        return view('pages.agent.create', compact('user', 'town', 'subtown', 'type'));
    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            $data = $request->all();
            if ($request->has('avatar') && $request->avatar != NULL) {
                $data['avatar'] = $this->MobileAgentImage($request->avatar);
            }
            MobileAgent::create($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $agent = MobileAgent::find($id);
        $user = User::where('role', 3)->get();
        $town = Town::all();
        $subtown = SubTown::all();
        $type = ComplaintType::all();

        return view('pages.agent.edit', compact('user', 'agent', 'town', 'subtown', 'type'));
    }
    public function update(Request $request, $id)
    {
        $valid = Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            'type_id' => [
                'required',
                'numeric',
                'exists:complaint_types,id',
                function ($attribute, $value, $fail) use ($data, $id) {
                    $existingAgent = MobileAgent::where('town_id', $data['town_id'])
                        ->where('type_id', $value)
                        ->where('id', '!=', $id)
                        ->exists();

                    if ($existingAgent) {
                        $fail('The selected type for this town is already assigned to another agent.');
                    }
                }
            ],
            'address' => ['required', 'string'],
        ]);
        if ($valid->valid()) {
            $data = $request->except(['_method', '_token']);
            if ($request->has('avatar') && $request->avatar != NULL) {
                $data['avatar'] = $this->MobileAgentImage($request->avatar);
            }
            MobileAgent::where('id', $id)->update($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function detail($id)
    {
        $agent = MobileAgent::with('assignedComplaints', 'assignedComplaints.complaints', 'assignedComplaints.complaints.town')->find($id);
        // dd($agent->toArray());
        return view('pages.agent.details', compact('agent'));
    }
    public function reset_password(Request $request)
    {
        $data = $request->all();
        $id = $request->id;
        if ($request->has('change_password' && $request->change_password == '1')) {
            $valid = Validator::make($data, [
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::with('agent')->whereHas('agent', function ($query) use ($id) {
                $query->where('id', $id);
            })->first();
            if ($valid->valid()) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json(['success', 'Record created successfully.'], 200);
                }
            } else {
                return response()->json(['error', $valid->errors()], 400);
            }
        }
    }
    public function report(Request $request, $id)
    {
        $agent = MobileAgent::with('user', 'town', 'assignedComplaints.complaints')->findOrFail($id);

        $useDateRange = $request->has('use_date_range');

        if ($useDateRange) {
            $request->validate([
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
            ]);

            $dateS = $request->from_date;
            $dateE = $request->to_date;
        } else {
            $dateS = null;
            $dateE = null;
        }

        $complaintsQuery = $agent->assignedComplaints;

        if ($useDateRange) {
            $complaintsQuery = $complaintsQuery->filter(
                fn($assignedComplaint) =>
                $assignedComplaint->complaints->created_at >= $dateS &&
                    $assignedComplaint->complaints->created_at <= $dateE
            );
        }

        $complaintTypeTitle = $complaintsQuery
            ->map(fn($assignedComplaint) => $assignedComplaint->complaints->type)
            ->filter()
            ->unique('id') // To avoid duplicates
            ->pluck('title') // Extract titles
            ->join(', '); // Combine titles into a single string if multiple

        $totalComplaints = $complaintsQuery->count();

        // Total resolved and pending complaints
        $resolvedComplaints = $complaintsQuery
            ->filter(fn($assignedComplaint) => $assignedComplaint->complaints->status == '1')
            ->count();
        $pendingComplaints = $complaintsQuery
            ->filter(fn($assignedComplaint) => $assignedComplaint->complaints->status == '0')
            ->count();

        $subtypeCounts = $complaintsQuery
            ->groupBy(fn($assignedComplaint) => $assignedComplaint->complaints->subtype->id)
            ->map(fn($group) => [
                'title' => $group->first()->complaints->subtype->title, // Subtype title
                'count' => $group->count(), // Total complaints for this subtype
                'resolved_count' => $group->filter(fn($assignedComplaint) => $assignedComplaint->complaints->status == '1')->count(), // Count of resolved complaints
            ]);
        // Complaints by subtypes
        $subtypeCountsQuery = DB::table('mobile_agent as ma')
            ->join('users as u', 'u.id', '=', 'ma.user_id')
            ->join('complaint_assign_agent as caa', 'caa.agent_id', '=', 'ma.id')
            ->join('complaint as c', 'c.id', '=', 'caa.complaint_id')
            ->join('sub_types as st', 'st.id', '=', 'c.subtype_id')
            ->selectRaw("
            st.title AS subtype_name,
            COUNT(c.id) AS total_complaints,
            COUNT(CASE WHEN c.status = 1 THEN 1 ELSE NULL END) AS resolved_complaints
        ")
            ->where('ma.id', $agent->id); // Bind agent ID here

        if ($useDateRange) {
            $subtypeCountsQuery->whereBetween('c.created_at', [$dateS, $dateE]);
        }

        // Add grouping for the final query
        $subtypeCounts1 = $subtypeCountsQuery
            ->groupBy('st.title')
            ->get();


        // Complaints by subtown
        $subtownCounts = $complaintsQuery
            ->map(fn($assignedComplaint) => $assignedComplaint->complaints->subtown)
            ->filter()
            ->groupBy('id')
            ->map(fn($group, $id) => [
                'title' => $group->first()->title,
                'count' => $group->count(),
            ]);
        // Turnaround time data
        $turnaroundTimesQuery = DB::table('complaint as c')
            ->join('complaint_assign_agent as caa', 'c.id', '=', 'caa.complaint_id')
            ->join('mobile_agent as ma', 'ma.id', '=', 'caa.agent_id')
            ->join('users as u', 'u.id', '=', 'ma.user_id')
            ->selectRaw("
            CASE
                WHEN TIMESTAMPDIFF(DAY, c.created_at, c.updated_at) <= 0 THEN 'Resolved Immediately'
                WHEN TIMESTAMPDIFF(DAY, c.created_at, c.updated_at) <= 15 THEN 'Resolved within 15 days'
                ELSE 'After 15 days'
            END AS ResolutionDetails,
            COUNT(*) AS TotalComplaints,
            CONCAT(ROUND((COUNT(*) * 100 / (
                SELECT COUNT(*)
                FROM complaint c
                JOIN complaint_assign_agent caa ON c.id = caa.complaint_id
                JOIN mobile_agent ma ON ma.id = caa.agent_id
                JOIN users u ON u.id = ma.user_id
                WHERE
                    c.status = 1
                    AND c.updated_at IS NOT NULL
                    AND c.created_at != c.updated_at
                    AND ma.id = ?
            )), 2), '%') AS Percentage
        ", [$agent->id])
            ->where('c.status', 1)
            ->whereNotNull('c.updated_at')
            ->whereColumn('c.created_at', '!=', 'c.updated_at')
            ->where('ma.id', $agent->id);

        if ($useDateRange) {
            $turnaroundTimesQuery = $turnaroundTimesQuery
                ->whereBetween('c.created_at', [$dateS, $dateE]);
        }

        $turnaroundTimes = $turnaroundTimesQuery->groupBy('ResolutionDetails')->get();
        // Pass data to the view
        return view('pages.agent.report', compact(
            'agent',
            'totalComplaints',
            'resolvedComplaints',
            'complaintTypeTitle',
            'pendingComplaints',
            'subtypeCounts',
            'subtypeCounts1',
            'subtownCounts',
            'turnaroundTimes',
            'useDateRange',
            'dateS',
            'dateE'
        ));
    }
}
