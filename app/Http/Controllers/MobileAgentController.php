<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use App\Models\MobileAgent;
use App\Models\SubTown;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Hash;


class MobileAgentController extends Controller
{
    use SaveImage;
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            'type_id' => [
                'required',
                'numeric',
                'exists:complaint_types,id',
                function ($attribute, $value, $fail) use ($data) {
                    $existingAgent = MobileAgent::where('town_id', $data['town_id'])
                        ->where('type_id', $value)
                        ->exists();

                    if ($existingAgent) {
                        $fail('The selected type for this town is already assigned to an agent.');
                    }
                }
            ],
            'address' => ['required', 'string'],
        ]);
    }
    public function index()
    {
        // dd("check");
        $agent = MobileAgent::all();
        return view('pages.agent.index', compact('agent'));
    }
    public function create()
    {
        $user = User::where('role', 3)->get();
        $town = Town::all();
        $subtown = SubTown::all();
        $type = ComplaintType::all();
        return view('pages.agent.create', compact('user', 'town', 'subtown', 'type'));
    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            $data = $request->all();
            if ($request->has('avatar') && $request->avatar != NULL) {
                $data['avatar'] = $this->MobileAgentImage($request->avatar);
            }
            MobileAgent::create($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function edit($id)
    {
        $agent = MobileAgent::find($id);
        $user = User::where('role', 3)->get();
        $town = Town::all();
        $subtown = SubTown::all();
        $type = ComplaintType::all();

        return view('pages.agent.edit', compact('user', 'agent', 'town', 'subtown', 'type'));
    }
    public function update(Request $request, $id)
    {
        $valid = Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            'type_id' => [
                'required',
                'numeric',
                'exists:complaint_types,id',
                function ($attribute, $value, $fail) use ($data, $id) {
                    $existingAgent = MobileAgent::where('town_id', $data['town_id'])
                        ->where('type_id', $value)
                        ->where('id', '!=', $id)
                        ->exists();

                    if ($existingAgent) {
                        $fail('The selected type for this town is already assigned to another agent.');
                    }
                }
            ],
            'address' => ['required', 'string'],
        ]);
        if ($valid->valid()) {
            $data = $request->except(['_method', '_token']);
            if ($request->has('avatar') && $request->avatar != NULL) {
                $data['avatar'] = $this->MobileAgentImage($request->avatar);
            }
            MobileAgent::where('id', $id)->update($data);
            return redirect()->route('agent-management.index')->with('success', 'Record created successfully.');
        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function detail($id)
    {
        $agent = MobileAgent::with('assignedComplaints', 'assignedComplaints.complaints', 'assignedComplaints.complaints.town')->find($id);
        // dd($agent->toArray());
        return view('pages.agent.details', compact('agent'));
    }
    public function reset_password(Request $request)
    {
        $data = $request->all();
        $id = $request->id;
        if ($request->has('change_password' && $request->change_password == '1')) {
            $valid = Validator::make($data, [
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::with('agent')->whereHas('agent', function ($query) use ($id) {
                $query->where('id',$id);
            })->first();
            if ($valid->valid()) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json(['success', 'Record created successfully.'],200);
                }
            } else {
                return response()->json(['error', $valid->errors()],400);
            }
        }
    }
}
