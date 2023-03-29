<?php

namespace App\Http\Controllers;

use App\Models\SubTown;
use App\Models\Town;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class SubTownController extends Controller
{
     //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
        ]);
    }
    public function index()
    {
        $subtown = SubTown::with('town')->get();
        return view('pages.subtown.index',compact('subtown'));
    }
    public function create()
    {
        $town = Town::all();
        return view('pages.subtown.create',compact('town'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            SubTown::create($data);
            return redirect()->route('subtown-management.index')->with('success', 'Record created successfully.');
        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $subtown = SubTown::with('town')->find($id);
        $town = Town::all();
        return view('pages.subtown.edit',compact('subtown','town'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            SubTown::where('id',$id)->update($data);
            return redirect()->route('subtown-management.index')->with('success', 'Record updated successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
    public function get_subtown(Request $request)
    {
        $subtown = SubTown::where('town_id',$request->town_id)->get();
        return $subtown;

    }
    public function destroy($id)
    {

    }
}
