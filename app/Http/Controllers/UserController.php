<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'numeric', 'In:2,3'],
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
        return view('pages.user.create');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit',compact('user'));
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
        // $user->role = $request->input('role');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return redirect()->route('user-management.index')->with('success', 'Record updated successfully.');
    }
}
