<?php

namespace App\Http\Controllers;

use App\Models\MobileAgent;
use App\Models\Town;
use App\Models\User;
use App\Models\Complaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImage;

class ComplaintController extends Controller
{
    //
    use SaveImage;
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }
    public function index()
    {
        $complaint = Complaints::all();
        return view('pages.complaints.index',compact('complaint'));
    }
    public function create()
    {
        $town = Town::all();
        return view('pages.complaints.create',compact('town'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            if($request->has('image') && $request->image != NULL)
            {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::create($data);
            return redirect()->route('compaints-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $complaint = Complaints::find($id);
        $town = Town::all();
        return view('pages.complaints.edit',compact('complaint','town'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            if($request->has('image') && $request->image != NULL)
            {
                $data['image'] = $this->complaintImage($request->image);
            }
            Complaints::where('id',$id)->update($data);
            return redirect()->route('compaints-management.index')->with('success', 'Record created successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
    public function agent_wise_complaints()
    {
        $town_id = auth('api')->user()->agent->town_id;
        $complaint = Complaints::with('town')->where('town_id', $town_id)->get();
        return $complaint;
    }
    public function destroy($id)
    {

    }
}
