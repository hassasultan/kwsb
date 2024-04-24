<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Models\ComplaintType;
use App\Models\SubType;
use App\Models\User;
use App\Models\Complaints;
use App\Models\Priorities;
use App\Models\SubTown;
use App\Models\Source;
use App\Models\Customer;


class FrontendController extends Controller
{
    //
    public function create_compalint(Request $request)
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

        return view('welcome',compact('customer','town','type','prio','subtown','subtype','source'));

    }
}
