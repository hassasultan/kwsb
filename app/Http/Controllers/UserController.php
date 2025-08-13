<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'numeric', 'In:1,2,3,4'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function index(Request $request)
    {
        $user = new User();
        if (auth()->user()->role == 2) {
            $user = $user->where('role', 3);
        } else {
            $user = User::where('id', '!=', auth()->user()->id);
        }
        if ($request->has('search') && $request->search != null && $request->search != '') {
            $user = $user->where('name', 'LIKE', '%' . $request->search . '%')->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }
        $user = $user->paginate(10);
        if ($request->has('type')) {
            return $user;
        }
        return view('pages.user.index', compact('user'));
    }
    public function create()
    {
        $department = Department::orderBy('name', 'asc')->get();
        return view('pages.user.create', compact('department'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $department = Department::orderBy('name', 'asc')->get();

        return view('pages.user.edit', compact('user','department'));
    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->validate()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
            $user->role = $request->role;
            if ($request->has('department_id') && $request->department_id != null && $request->department_id != '') {
                $user->department_id = $request->department_id;
            }
            else
            {
                $user->department_id = 0;
            }
            $user->save();
            return redirect()->route('user-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // 'role' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Password is optional for update
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($request->has('department_id') && $request->department_id != null && $request->department_id != '') {
            $user->department_id = $request->department_id;
        }
        $user->save();
        return redirect()->route('user-management.index')->with('success', 'Record updated successfully.');
    }
    public function get_role_assign($id)
    {
        $role = Role::where('id', $id)->first();
        $user = User::whereDoesntHave('roles')->where('role', 1)->get();
        return view('pages.roles.assignRole', compact('role', 'user'));
    }
    public function role_assign(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        foreach ($request->user_id as $row) {
            $user = User::where('id', $row)->first();
            $user->assignRole([$role->id]);
        }
        return redirect()->back()->with('success', 'Assigned Role successfully...');
    }
    public function show()
    {
        $user = auth()->user();
        return view('pages.user.profile', compact('user'));
    }
    public function profile()
    {
        $user = auth()->user();
        return view('pages.user.profile', compact('user'));
    }
    public function reset_password(Request $request)
    {
        $data = $request->all();
        $id = auth()->user()->id;
        if ($request->has('change_password') && $request->change_password == "1") {
            $valid = Validator::make($data, [
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::find($id);
            if ($valid->valid()) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return redirect()->back()->with('success', 'Password Updated successfully.');
                }
            } else {
                return redirect()->back()->with('error', $valid->errors());
            }
        }
    }
}
