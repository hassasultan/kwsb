<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SourceController extends Controller
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
        $source = Source::orderBy('title', 'asc')->get();
        return view('pages.source.index',compact('source'));
    }
    public function create()
    {
        return view('pages.source.create');

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            Source::create($data);
            return redirect()->route('source-management.index')->with('success', 'Record created successfully.');
        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $source = Source::find($id);
        return view('pages.source.edit',compact('source'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            Source::where('id',$id)->update($data);
            return redirect()->route('source-management.index')->with('success', 'Record updated successfully.');

        }
        else
        {
            return back()->with('error', $valid->errors());
        }

    }
}
