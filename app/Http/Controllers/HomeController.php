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
        $allTown = array();
        $totalComplaints = Complaints::count();
        $totalAgents = MobileAgent::count();
        $complaintsPending = Complaints::where('status', 0)->count();
        $complaintsComplete = Complaints::where('status', 1)->count();
        $total_customer = Customer::count();
        $result[0] = ['Clicks', 'Viewers'];
        $result[1] = ['Pending', $complaintsPending];
        $result[2] = ['Complete', $complaintsComplete];
        $type = ComplaintType::with('town', 'town.complaints', 'complaints')->get();
        $new_town = Town::with('comp_type', 'comp_type.complaints', 'complaints')->get();
        $resultNew[0] = ['Clicks', 'Viewers'];
        $town = Town::get('town');
        foreach ($town as $row) {
            array_push($allTown, $row->town);
        }
        // dd($allTown);
        foreach ($type as $key => $row) {
            $resultNew[++$key] = [$row->title, (int)count($row->complaints)];
        }
        if ($request->has('status') && $request->status == "api") {
            $data['type_count'] = $resultNew;
            $data['result'] = $result;
            return $data;
        }
        $typeComp = null;
        $typeComp_town = array();;
        $total_comp = array();
        $new_complaints = Complaints::get()->groupBy(['town_id', 'type_id']);

        $all_types = ComplaintType::where('status', 1)->get();

        $new_key = 0;
        foreach ($new_complaints as $key => $row) {
            $total_num = array();
            $feed_town = Town::find($key);
            // print_r($row->toArray());

            foreach ($all_types as $index => $item) {
                // $feed_type = ComplaintType::find($index);
                // array_push($total_comp,$feed_type->title);
                $c_comp = Complaints::where('type_id', $item->id)->where('town_id', $key)->count();
                array_push($total_num, $c_comp);
                $typeComp[$index]['name'] = $item->title;
            }
            $typeComp[$new_key]['data'] = $total_num;
            $new_key++;
            // $total_num = array();
            // dd($typeComp[$index]['data']);
            // foreach()
            // {

            // }
            // $comId = $row->complaints->id;
            // $newTown = Town::with('complaints',function($query) use($comId){
            //     $query->where('id',$comId);
            // })->get();
            // dd($newTown->toArray());
            array_push($typeComp_town, $feed_town->town);
        }
        // dd($typeComp[$index]['data']);
        // $allTown = array();
        // $totalComplaints = Complaints::count();
        // $totalAgents = MobileAgent::count();
        // $complaintsPending = Complaints::where('status',0)->count();
        // $complaintsComplete = Complaints::where('status',1)->count();
        // $total_customer = Customer::count();
        // $result[0] = ['Clicks','Viewers'];
        // $result[1] = ['Pending',$complaintsPending];
        // $result[2] = ['Complete',$complaintsComplete];
        // $type = ComplaintType::with('complaints')->get();
        // $resultNew[0] = ['Clicks','Viewers'];
        // $town = Town::get('town');
        // foreach($town as $row)
        // {
        //     array_push($allTown,$row->town);
        // }
        // // dd($allTown);
        // foreach($type as $key => $row)
        // {
        //     $resultNew[++$key] = [$row->title, (int)count($row->complaints)];
        // }
        // if($request->has('status') && $request->status == "api")
        // {
        //     $data['type_count'] = $resultNew;
        //     $data['result'] = $result;
        //     return $data;
        // }
        // foreach($type as $key => $row)
        // {
        //     // $comId = $row->complaints->id;
        //     // $newTown = Town::with('complaints',function($query) use($comId){
        //     //     $query->where('id',$comId);
        //     // })->get();
        //     // dd($newTown->toArray());
        //     $typeComp[$key]['name'] = $row->title;
        //     $typeComp[$key]['data'] = [(int)count($row->complaints)];
        // }
        // dd($typeComp);
        // $tat_summary = DB::table('complaint as c')
        // ->leftJoin('priorities as p', 'c.prio_id', '=', 'p.id')
        // ->selectRaw("
        //     COUNT(c.id) AS TotalResolvedComplaints,
        //     CONCAT(
        //         FLOOR(AVG(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) / 24), ' days and ',
        //         MOD(AVG(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)), 24), ' hours'
        //     ) AS AverageResolutionTime,
        //     MAX(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) AS MaxResolutionTimeInHours,
        //     MIN(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) AS MinResolutionTimeInHours,
        //     DATE_FORMAT(STR_TO_DATE(MONTH(c.created_at), '%m'), '%M') AS MonthName
        // ")
        // ->whereNotNull('c.updated_at')
        // ->where('c.status', '=', 1)
        // ->whereRaw('c.created_at != c.updated_at')
        // ->whereMonth('c.created_at', '=', 10) // Change month if needed
        // ->whereYear('c.created_at', '=', 2024) // Change year if needed
        // ->first();
        $month = date('m'); // Current month as a numeric value (e.g., "10" for October)
        $year = date('Y');
        $tat_summary_complete = DB::select("
        SELECT
            ResolutionDetails,
            TotalComplaints,
            CONCAT(
                ROUND(
                    (TotalComplaints * 100 /
                    (SELECT COUNT(*)
                    FROM complaint c
                    WHERE c.status = 1
                    AND c.updated_at IS NOT NULL
                    AND c.created_at != c.updated_at
                    )), 2), '%'
            ) AS Percentage
        FROM (
            SELECT
                CASE
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, c.updated_at) <= 0 THEN 'Complaints solved within TAT (Immediate)'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, c.updated_at) <= 15 THEN 'Complaint Solved within TAT (15 days)'
                    ELSE 'Complaint Solved out of TAT (after 15 days)'
                END AS ResolutionDetails,
                COUNT(*) AS TotalComplaints
            FROM
                complaint c
            WHERE
                c.status = 1
                AND c.updated_at IS NOT NULL
                AND c.created_at != c.updated_at
            GROUP BY
                ResolutionDetails
            WITH ROLLUP
            ) AS subquery
    ");
        $tat_summary_pending = DB::select("
            SELECT
                CASE
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) BETWEEN 0 AND 15 THEN 'Pending since 1-15 days'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) BETWEEN 15 AND 30 THEN 'Pending since 15-30 days'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) BETWEEN 31 AND 60 THEN 'Pending since 31-60 days'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) BETWEEN 61 AND 90 THEN 'Pending since 61-90 days'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) BETWEEN 91 AND 120 THEN 'Pending since 91-120 days'
                    WHEN TIMESTAMPDIFF(DAY, c.created_at, CURRENT_TIMESTAMP) > 120 THEN 'Pending more than 121 days'
                END AS Pendingdays,
                COUNT(*) AS TotalPendingComplaints,
                CONCAT(ROUND(COUNT(*) * 100.0 /
                    (SELECT COUNT(*) FROM complaint WHERE status = 0), 2), '%') AS Percentage
            FROM
                complaint c
            WHERE
                c.status = 0
            GROUP BY
                Pendingdays WITH ROLLUP
        ");

        $top3water =  DB::select("
        SELECT
            u.name AS Executive_Engineer,
            t.town AS Town,
            st.title AS Department,
            COUNT(CASE WHEN c.status = 1 THEN 1 END) AS Solved,
            COUNT(CASE WHEN c.status = 0 THEN 1 END) AS Pending,
            COUNT(c.id) AS Total_Complaints,
            ROUND((COUNT(CASE WHEN c.status = 1 THEN 1 END) * 100.0 / COUNT(c.id)), 2) AS Percentage_Solved
        FROM complaint c
        JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
        JOIN mobile_agent m ON ca.agent_id = m.id
        JOIN users u ON m.user_id = u.id
        JOIN towns t ON c.town_id = t.id
        JOIN complaint_types st ON c.type_id = st.id
        WHERE c.type_id = 2 AND u.name NOT LIKE 'north agent'
            AND u.name NOT LIKE 'north nazimabad agent'
            AND u.name NOT LIKE 'south water'
            AND u.name NOT LIKE 'Mobile Agent'
            AND u.name NOT LIKE 'raghib'
        GROUP BY
            u.name, t.town, st.title
        ORDER BY
            Solved DESC
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
            JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            JOIN mobile_agent m ON ca.agent_id = m.id
            JOIN users u ON m.user_id = u.id
            JOIN towns t ON c.town_id = t.id
            JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 1 AND u.name NOT LIKE 'north agent'
                AND u.name NOT LIKE 'north nazimabad agent'
                AND u.name NOT LIKE 'south water'
                AND u.name NOT LIKE 'Mobile Agent'
                AND u.name NOT LIKE 'raghib'
            GROUP BY
                u.name, t.town, st.title
            ORDER BY
                Solved DESC
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
            JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
            JOIN mobile_agent m ON ca.agent_id = m.id
            JOIN users u ON m.user_id = u.id
            JOIN towns t ON c.town_id = t.id
            JOIN complaint_types st ON c.type_id = st.id
            WHERE c.type_id = 2 AND u.name NOT LIKE 'north agent'
                AND u.name NOT LIKE 'north nazimabad agent'
                AND u.name NOT LIKE 'south water'
                AND u.name NOT LIKE 'Mobile Agent'
                AND u.name NOT LIKE 'raghib'
            GROUP BY
                u.name, t.town, st.title
            ORDER BY
                Pending DESC
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
    JOIN complaint_assign_agent ca ON c.id = ca.complaint_id
    JOIN mobile_agent m ON ca.agent_id = m.id
    JOIN users u ON m.user_id = u.id
    JOIN towns t ON c.town_id = t.id
    JOIN complaint_types st ON c.type_id = st.id
    WHERE c.type_id = 1 AND u.name NOT LIKE 'north agent'
        AND u.name NOT LIKE 'north nazimabad agent'
        AND u.name NOT LIKE 'south water'
        AND u.name NOT LIKE 'Mobile Agent'
        AND u.name NOT LIKE 'raghib'
    GROUP BY
        u.name, t.town, st.title
    ORDER BY
        Pending DESC
    LIMIT 3
    ");
        // dd($tat_summary);

        return view('home', compact('complaintsComplete', 'top3water', 'top3sewe', 'wor3water', 'wor3sewe', 'tat_summary_pending', 'tat_summary_complete', 'totalComplaints', 'totalAgents', 'allTown', 'typeComp_town', 'typeComp', 'total_customer', 'complaintsPending'));
    }
}
