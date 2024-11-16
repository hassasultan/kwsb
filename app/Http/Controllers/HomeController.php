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
        $month = 10;
        $year = 2024;
        $tat_summary_complete = DB::select("
        SELECT
            MONTHNAME(c.created_at) AS MonthName,
            COUNT(c.id) AS TotalResolvedComplaints,
            CONCAT(
                FLOOR(AVG(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) / 24), ' days and ',
                MOD(AVG(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)), 24), ' hours'
            ) AS AverageResolutionTime,
            MAX(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) AS MaxResolutionTimeInHours,
            MIN(TIMESTAMPDIFF(HOUR, c.created_at, c.updated_at)) AS MinResolutionTimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 1
            AND c.created_at != c.updated_at
            AND MONTH(c.created_at) = :month
            AND YEAR(c.created_at) = :year
        GROUP BY
            MonthName
    ", ['month' => $month, 'year' => $year]);
        $tat_summary_pending = DB::select("
        SELECT
            MONTHNAME(c.created_at) AS MonthName,
            COUNT(c.id) AS TotalPendingComplaints,
             CONCAT(
                FLOOR(AVG(TIMESTAMPDIFF(HOUR, c.created_at, NOW())) / 24), ' days and ',
                MOD(AVG(TIMESTAMPDIFF(HOUR, c.created_at, NOW())), 24), ' hours'
            ) AS AveragePendingTime,
            MAX(TIMESTAMPDIFF(HOUR, c.created_at, NOW())) AS MaxPendingTimeInHours,
            MIN(TIMESTAMPDIFF(HOUR, c.created_at, NOW())) AS MinPendingTimeInHours
        FROM
            complaint c
        LEFT JOIN
            priorities p ON c.prio_id = p.id
        WHERE
            c.updated_at IS NOT NULL
            AND c.status = 0
            AND MONTH(c.created_at) = :month
            AND YEAR(c.created_at) = :year
        GROUP BY
            MonthName
    ", ['month' => $month, 'year' => $year]);
        // dd($tat_summary);

        return view('home', compact('complaintsComplete', 'tat_summary_pending', 'tat_summary_complete', 'totalComplaints', 'totalAgents', 'allTown', 'typeComp_town', 'typeComp', 'total_customer', 'complaintsPending'));
    }
}
