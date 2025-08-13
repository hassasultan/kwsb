<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\ComplaintType;
use App\Models\Complaints;
use App\Models\User;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::paginate(10);
        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ct = ComplaintType::orderBy('title', 'asc')->get();
        return view('pages.departments.create', compact('ct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'comp_type_id' => 'required|integer|exists:complaint_types,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|boolean',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $ct = ComplaintType::orderBy('title', 'asc')->get();
        return view('pages.departments.edit', compact('department', 'ct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'comp_type_id' => 'required|integer|exists:complaint_types,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|boolean',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }
    public function detail($id)
    {
        $depart = User::with('assignedComplaints')->find($id);

        $complaints = Complaints::whereIn('id', function ($q) use ($depart) {
            $q->select('complaint_id')
                ->from('complaint_assign_department')
                ->where('user_id', $depart->id);
        })->paginate(20);
        // dd($complaints->toArray());
        return view('pages.departments.details', compact('depart','complaints'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
