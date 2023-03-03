<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    //
    public function index()
    {
        $type = ComplaintType::all();
        return view('pages.complaintTypes.index',compact('type'));
    }
    public function create()
    {
        return view('pages.complaintTypes.create');

    }
    public function store(Request $request)
    {
        ComplaintType::create($request->all());
        return redirect()->route('compaints-type-management.index')->with('success', 'Record created successfully.');

    }
    public function edit($id)
    {
        $type = ComplaintType::find($id);
        return view('pages.complaintTypes.edit',compact('type'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_method','_token']);
        ComplaintType::where('id',$id)->update($data);
        return redirect()->route('compaints-type-management.index')->with('success', 'Record created successfully.');


    }
}
