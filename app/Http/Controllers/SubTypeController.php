<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use App\Models\SubType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubTypeController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
            'type_id' => ['required', 'numeric'],
        ]);
    }
    public function index()
    {
        $subtype = SubType::with('type')->get();
        return view('pages.subtype.index',compact('subtype'));
    }
    public function create()
    {
        $type = ComplaintType::all();
        return view('pages.subtype.create',compact('type'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            SubType::create($data);
            return redirect()->route('subtype-management.index')->with('success', 'Record created successfully.');
        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $subtype = SubType::with('type')->find($id);
        $type = ComplaintType::all();
        return view('pages.subtype.edit',compact('subtype','type'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            SubType::where('id',$id)->update($data);
            return redirect()->route('subtype-management.index')->with('success', 'Record updated successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
    public function destroy($id)
    {

    }
}
