<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\Customer;
use App\Models\ComplaintType;
use App\Models\MobileAgent;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function redirect_page()
    {
        if(auth()->user()->role == 1)
        {
            return redirect('/admin/home');
        }
        if(auth()->user()->role == 2)
        {
            return redirect('/system/home');
        }
        if(auth()->user()->role == 4)
        {
            return redirect('/department/home');
        }
    }
    public function index(Request $request)
    {
        // Basic counts - use simple queries instead of loading all data
        $totalComplaints = Complaints::count();
        $totalAgents = MobileAgent::count();
        $complaintsPending = Complaints::where('status', 0)->count();
        $complaintsComplete = Complaints::where('status', 1)->count();
        $total_customer = Customer::count();

        // Chart data for pending vs complete
        $result = [
            ['Clicks', 'Viewers'],
            ['Pending', $complaintsPending],
            ['Complete', $complaintsComplete]
        ];

        // Get towns for chart data - only get what we need
        $allTown = Town::pluck('town')->toArray();

        // Optimize complaint type data - avoid heavy eager loading
        $typeData = ComplaintType::select('id', 'title')
            ->withCount('complaints')
            ->get();

        $resultNew = [['Clicks', 'Viewers']];
        foreach ($typeData as $row) {
            $resultNew[] = [$row->title, (int)$row->complaints_count];
        }

        // Return early for API requests
        if ($request->has('status') && $request->status == "api") {
            return [
                'type_count' => $resultNew,
                'result' => $result
            ];
        }

        // Optimize town-based complaint data
        $towns = Town::select('id', 'town')->get();
        $typeComp = [];
        $typeComp_town = [];

        $all_types = ComplaintType::where('status', 1)->select('id', 'title')->get();

        foreach ($towns as $town) {
            $total_num = [];

            foreach ($all_types as $item) {
                $c_comp = Complaints::where('type_id', $item->id)
                    ->where('town_id', $town->id)
                    ->count();
                $total_num[] = $c_comp;
            }

            $typeComp[] = [
                'name' => $town->town,
                'data' => $total_num
            ];

            $typeComp_town[] = $town->town;
        }

        // Optimize TAT summary queries - use more efficient SQL
        $tat_summary_complete = DB::select("
            SELECT
                ResolutionDetails,
                TotalComplaints,
                CONCAT(
                    ROUND(
                        (TotalComplaints * 100.0 /
                        (SELECT COUNT(*) FROM complaint
                         WHERE status = 1 AND updated_at IS NOT NULL
                         AND created_at != updated_at)), 2), '%'
                ) AS Percentage
            FROM (
                SELECT
                    CASE
                        WHEN TIMESTAMPDIFF(DAY, created_at, updated_at) <= 0 THEN 'Complaints solved within TAT (Immediate)'
                        WHEN TIMESTAMPDIFF(DAY, created_at, updated_at) <= 15 THEN 'Complaint Solved within TAT (15 days)'
                        ELSE 'Complaint Solved out of TAT (after 15 days)'
                    END AS ResolutionDetails,
                    COUNT(*) AS TotalComplaints
                FROM complaint
                WHERE status = 1
                    AND updated_at IS NOT NULL
                    AND created_at != updated_at
                GROUP BY ResolutionDetails
                WITH ROLLUP
            ) AS subquery
        ");

        $tat_summary_pending = DB::select("
            SELECT
                CASE
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) BETWEEN 0 AND 15 THEN 'Pending since 1-15 days'
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) BETWEEN 15 AND 30 THEN 'Pending since 15-30 days'
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) BETWEEN 31 AND 60 THEN 'Pending since 31-60 days'
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) BETWEEN 61 AND 90 THEN 'Pending since 61-90 days'
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) BETWEEN 91 AND 120 THEN 'Pending since 91-120 days'
                    WHEN TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) > 120 THEN 'Pending more than 121 days'
                END AS Pendingdays,
                COUNT(*) AS TotalPendingComplaints,
                CONCAT(ROUND(COUNT(*) * 100.0 /
                    (SELECT COUNT(*) FROM complaint WHERE status = 0), 2), '%') AS Percentage
            FROM complaint
            WHERE status = 0
            GROUP BY Pendingdays WITH ROLLUP
        ");

        // Optimize top performer queries - use more efficient joins
        $top3water = DB::select("
            SELECT
                u.name AS Executive_Engineer,
                t.town AS Town,
                st.title AS Department,
                COUNT(CASE WHEN c.status = 1 THEN 1 END) AS Solved,
                COUNT(CASE WHEN c.status = 0 THEN 1 END) AS Pending,
                COUNT(c.id) AS Total_Complaints,
                ROUND((COUNT(CASE WHEN c.status = 1 THEN 1 END) * 100.0 / COUNT(c.id)), 2) AS Percentage_Solved
            FROM complaint c
            INNER JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            INNER JOIN mobile_agent m ON ca.agent_id = m.id
            INNER JOIN users u ON m.user_id = u.id
            INNER JOIN towns t ON c.town_id = t.id
            INNER JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 2
                AND u.name NOT IN ('north agent', 'north nazimabad agent', 'south water', 'Mobile Agent', 'raghib')
            GROUP BY u.name, t.town, st.title
            ORDER BY Solved DESC
            LIMIT 3
        ");

        $top3sewe = DB::select("
            SELECT
                u.name AS Executive_Engineer,
                t.town AS Town,
                st.title AS Department,
                COUNT(CASE WHEN c.status = 1 THEN 1 END) AS Solved,
                COUNT(CASE WHEN c.status = 0 THEN 1 END) AS Pending,
                COUNT(c.id) AS Total_Complaints,
                ROUND((COUNT(CASE WHEN c.status = 1 THEN 1 END) * 100.0 / COUNT(c.id)), 2) AS Percentage_Solved
            FROM complaint c
            INNER JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            INNER JOIN mobile_agent m ON ca.agent_id = m.id
            INNER JOIN users u ON m.user_id = u.id
            INNER JOIN towns t ON c.town_id = t.id
            INNER JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 1
                AND u.name NOT IN ('north agent', 'north nazimabad agent', 'south water', 'Mobile Agent', 'raghib')
            GROUP BY u.name, t.town, st.title
            ORDER BY Solved DESC
            LIMIT 3
        ");

        $wor3water = DB::select("
            SELECT
                u.name AS Executive_Engineer,
                t.town AS Town,
                st.title AS Department,
                COUNT(CASE WHEN c.status = 1 THEN 1 END) AS Solved,
                COUNT(CASE WHEN c.status = 0 THEN 1 END) AS Pending,
                COUNT(c.id) AS Total_Complaints,
                ROUND((COUNT(CASE WHEN c.status = 1 THEN 1 END) * 100.0 / COUNT(c.id)), 2) AS Percentage_Solved
            FROM complaint c
            INNER JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            INNER JOIN mobile_agent m ON ca.agent_id = m.id
            INNER JOIN users u ON m.user_id = u.id
            INNER JOIN towns t ON c.town_id = t.id
            INNER JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 2
                AND u.name NOT IN ('north agent', 'north nazimabad agent', 'south water', 'Mobile Agent', 'raghib')
            GROUP BY u.name, t.town, st.title
            ORDER BY Pending DESC
            LIMIT 3
        ");

        $wor3sewe = DB::select("
            SELECT
                u.name AS Executive_Engineer,
                t.town AS Town,
                st.title AS Department,
                COUNT(CASE WHEN c.status = 1 THEN 1 END) AS Solved,
                COUNT(CASE WHEN c.status = 0 THEN 1 END) AS Pending,
                COUNT(c.id) AS Total_Complaints,
                ROUND((COUNT(CASE WHEN c.status = 1 THEN 1 END) * 100.0 / COUNT(c.id)), 2) AS Percentage_Solved
            FROM complaint c
            INNER JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            INNER JOIN mobile_agent m ON ca.agent_id = m.id
            INNER JOIN users u ON m.user_id = u.id
            INNER JOIN towns t ON c.town_id = t.id
            INNER JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 1
                AND u.name NOT IN ('north agent', 'north nazimabad agent', 'south water', 'Mobile Agent', 'raghib')
            GROUP BY u.name, t.town, st.title
            ORDER BY Pending DESC
            LIMIT 3
        ");

        return view('home', compact(
            'complaintsComplete',
            'top3water',
            'top3sewe',
            'wor3water',
            'wor3sewe',
            'tat_summary_pending',
            'tat_summary_complete',
            'totalComplaints',
            'totalAgents',
            'allTown',
            'typeComp_town',
            'typeComp',
            'total_customer',
            'complaintsPending'
        ));
    }
}
