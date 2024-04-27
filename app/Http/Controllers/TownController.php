<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TownController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'town' => ['required', 'string'],
            'subtown' => ['required', 'string'],
        ]);
    }
    public function index(Request $request)
    {
        $town = new Town();
        if($request->has('search') && $request->search != null && $request->search != '')
        {
            $town = $town->where('town','LIKE','%'.$request->search.'%');
        }
        $town = $town->paginate(10);
        if($request->has('type'))
        {
            return $town;
        }
        return view('pages.town.index',compact('town'));
    }
    public function alltown()
    {
        $town = Town::all();
        return $town;
    }
    public function create()
    {
        return view('pages.town.create');

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->all();
            Town::create($data);
            return redirect()->route('town-management.index')->with('success', 'Record created successfully.');
        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $town = Town::find($id);
        return view('pages.town.edit',compact('town'));

    }
    public function update(Request $request,$id)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $data = $request->except(['_method','_token']);
            Town::where('id',$id)->update($data);
            return redirect()->route('town-management.index')->with('success', 'Record updated successfully.');

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
