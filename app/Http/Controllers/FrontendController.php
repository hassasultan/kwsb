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
use App\Traits\SaveImage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use Illuminate\Support\Facades\Validator;



class FrontendController extends Controller
{
    //
    use SaveImage;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            // 'title' => ['required', 'string'],
            'source' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }
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
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->fails()) {
            // dd($valid->errors());
            return redirect()->back()->with('errors', $valid->errors());
        }
        if($valid->valid())
        {
            $data = $request->all();
            $prefix = "COMPLAINT-";
            $CompNum = IdGenerator::generate(['table' => 'complaint','field' => 'comp_num', 'length' => 14, 'prefix' =>$prefix]);
            $data['comp_num'] = $CompNum;
            if($request->has('image') && $request->image != NULL)
            {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::create($data);
            return redirect()->back()->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
}
