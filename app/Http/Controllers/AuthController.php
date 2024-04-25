<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'town' => ['required', 'string'],
            'sub_town' => ['required', 'string'],
            'address' => ['required', 'string'],
            'customer_number' => ['required', 'string', 'customer_id', 'max:255', 'unique:customers'],
            'role' => ['required', 'numeric', 'In:4'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // dd($token);
        return $this->createNewToken($token);
    }
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth('api')->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        $user = User::with('agent','agent.town')->find(auth('api')->user()->id);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 999999,
            'user' => $user
        ]);
    }
    public function customer_register(Request $request)
    {
        $valid = $this->validator($request->all());
        if($valid->validate())
        {
            $user = User::create(['name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),]);
            $user->role = $request->role;
            $user->save();
            $customer = new Customer();
            $customer->customer_id = $request->customer_number;
            $customer->user_id = $user->id;
            $customer->customer_name = $request->name; 
            $customer->phone = $request->phone;
            $customer->town = $request->town;
            $customer->sub_town = $request->sub_town;
            $customer->address = $request->address;
            $customer->save();
            return response()->jsone(['success'=> 'Record created successfully.']);
        }
        else
        {
            return response()->jsone(['error'=> $valid->errors()]);
        }
    }
}
