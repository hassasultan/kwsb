<?php

namespace App\Http\Controllers;

use App\Models\CustomerFeedback;
use Illuminate\Http\Request;

class CustomerFeedbackController extends Controller
{
    //
    public function index()
    {
        $data = CustomerFeedback::orderBy('id','DESC')->get();
        return view('pages.feedback.index', compact('data'));
    }
    public function store(Request $request)
    {
        try
        {
            $request->validate([
                'rating' => ['required', 'numeric','between:0,5'],
                'message' => ['required', 'string'],
            ]);
            $user = auth('api')->user();
            if (!$user || $user->role != 5) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $data = $request->all();
            $data['user_id'] = $user->id;
            CustomerFeedback::create($data);
            return response()->json(['success'=>'data has been successfully store...'],200);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function api_index()
    {
        $user = auth('api')->user();
        if (!$user || $user->role != 5) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $data = CustomerFeedback::where('user_id',$user->id)->orderBy('id','DESC')->get();
        return response()->json(['data'=>$data],200);
    }
}
