<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logs;
use App\Models\User;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the logs with advanced filtering
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getLogsData($request);
        }

        $users = User::where('status', 1)->orderBy('name', 'asc')->get();
        $complaints = Complaints::select('id', 'comp_num')->orderBy('comp_num', 'asc')->get();

        return view('pages.logs.index', compact('users', 'complaints'));
    }

    /**
     * Display the specified log entry
     */
    public function detail($id)
    {
        $log = logs::with(['user', 'complaint'])->findOrFail($id);
        return view('pages.logs.detail', compact('log'));
    }

    /**
     * Get logs data for AJAX requests
     */
    private function getLogsData(Request $request)
    {
        $query = logs::with(['user', 'complaint']);

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by complaint number
        if ($request->filled('complaint_number')) {
            $query->whereHas('complaint', function($q) use ($request) {
                $q->where('comp_num', 'LIKE', '%' . $request->complaint_number . '%');
            });
        }

        // Filter by user email
        if ($request->filled('user_email')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('email', 'LIKE', '%' . $request->user_email . '%');
            });
        }

        // Filter by user name
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->user_name . '%');
            });
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(15);

        $html = view('pages.logs.partials.logs-table', compact('logs'))->render();

        return response()->json([
            'html' => $html,
            'pagination' => $logs->links()->toHtml()
        ]);
    }
}
