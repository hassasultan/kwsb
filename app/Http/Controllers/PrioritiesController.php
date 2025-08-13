<?php

namespace App\Http\Controllers;

use App\Models\Priorities;
use Illuminate\Http\Request;
class PrioritiesController extends Controller
{
    //
    public function index()
    {
        $prio = Priorities::orderBy('title', 'asc')->get();
        return view('pages.priorities.index',compact('prio'));
    }
    public function create()
    {
        return view('pages.priorities.create');

    }
    public function store(Request $request)
    {
        Priorities::create($request->all());
        return redirect()->route('priorities-management.index')->with('success', 'Record created successfully.');

    }
    public function edit($id)
    {
        $prio = Priorities::find($id);
        return view('pages.priorities.edit',compact('prio'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_method','_token']);
        Priorities::where('id',$id)->update($data);
        return redirect()->route('priorities-management.index')->with('success', 'Record created successfully.');


    }
}
