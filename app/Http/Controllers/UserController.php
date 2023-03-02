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
    public function index()
    {
        if(auth()->user()->role == 2)
        {
            $user = User::where('role',3)->get();
        }
        else
        {
            $user = User::where('id','!=', auth()->user()->id)->get();
        }
        return view('pages.user.index',compact('user'));
    }
    public function create()
    {
        return view('pages.user.create');
    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->valid())
        {
            $user = User::create(['name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),]);
            return redirect()->route('user-management.index')->with('success', 'Record created successfully.');
        }
        else
        {
            return back()->with('error', $valid->errors());
        }
    }
}
