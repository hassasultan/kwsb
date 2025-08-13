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
    public function index(Request $request)
    {
        $subtype = SubType::with('type');
        if($request->has('search') && $request->search != null && $request->search != '')
        {
            $subtype = $subtype->where('title','LIKE','%'.$request->search.'%');
        }
        $subtype = $subtype->paginate(10);
        if($request->has('type'))
        {
            return $subtype;
        }
        return view('pages.subtype.index',compact('subtype'));
    }
    public function create()
    {
        $type = ComplaintType::orderBy('title', 'asc')->get();
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
        $type = ComplaintType::orderBy('title', 'asc')->get();
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
    public function get_subtype(Request $request)
    {
        $subtype = SubType::where('type_id',$request->type_id)->orderBy('title', 'asc')->get();
        return $subtype;

    }
    public function destroy($id)
    {

    }
}
