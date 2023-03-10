<?php

namespace App\Http\Controllers;

use App\Models\MobileAgent;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImage;



class MobileAgentController extends Controller
{
    use SaveImage;
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'address' => ['required', 'string'],
        ]);
    }
    public function index()
    {
        // dd("check");
        $agent = MobileAgent::all();
        return view('pages.agent.index',compact('agent'));
    }
    public function create()
    {
        $user = User::where('role', 3)->get();
        $town = Town::all();
        return view('pages.agent.create',compact('user','town'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            if($request->has('avatar') && $request->avatar != NULL)
            {
                $data['avatar'] = $this->MobileAgentImage($request->avatar);
            }
            MobileAgent::create($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $agent = MobileAgent::find($id);
        $user = User::where('role', 3)->get();
        $town = Town::all();
        return view('pages.agent.edit',compact('user','agent','town'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            if($request->has('avatar') && $request->avatar != NULL)
            {
                $data['avatar'] = $this->MobileAgentImage($request->MobileAgentImage);
            }
            MobileAgent::where('id',$id)->update($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
    public function detail($id)
    {
        $agent = MobileAgent::with('town','town.complaints')->find($id);
        // dd($agent->toArray());
        return view('pages.agent.details',compact('agent'));
    }
}
