<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = new ComplaintType();
        if($request->has('search') && $request->search != null && $request->search != '')
        {
            $type = $type->where('title','LIKE','%'.$request->search.'%');
        }
        $type = $type->paginate(10);
        if($request->has('type'))
        {
            return $type;
        }
        return view('pages.complaintTypes.index',compact('type'));
    }
    public function create()
    {
        return view('pages.complaintTypes.create');

    }
    public function allTypes()
    {
        $type = ComplaintType::orderBy('title', 'asc')->get();
        return $type;

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
