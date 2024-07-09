<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Models\ComplaintType;
use App\Models\SubType;
use App\Models\User;
use App\Models\Complaints;
use App\Models\Priorities;
use App\Models\SubTown;
use App\Models\Source;
use App\Models\Customer;
use App\Traits\SaveImage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use Illuminate\Support\Facades\Validator;
use Exception;


class FrontendController extends Controller
{
    //
    use SaveImage;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'town_id' => ['required', 'numeric', 'exists:towns,id'],
            'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
            'g-recaptcha-response' => ['required','captcha'],
            // 'title' => ['required', 'string'],
            // 'source' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }
    public function create_compalint(Request $request)
    {
        $town = Town::all();
        $type = ComplaintType::all();
        $subtype = SubType::all();
        $prio = Priorities::all();
        $subtown = SubTown::all();
        $source = Source::all();
        $customer = NULL;
        if ($request->has('search')) {
            $customer = Customer::where('customer_id', $request->search)->first();
            if ($customer == null) {
                return redirect()->back()->with('error', "Customer Not Found...");
            }
        }

        return view('welcome', compact('customer', 'town', 'type', 'prio', 'subtown', 'subtype', 'source'));

    }
    public function create_connection_request(Request $request)
    {
        $town = Town::all();
        $type = ComplaintType::all();
        $subtype = SubType::all();
        $prio = Priorities::all();
        $subtown = SubTown::all();
        $source = Source::all();
        $customer = NULL;
        if ($request->has('search')) {
            $customer = Customer::where('customer_id', $request->search)->first();
            if ($customer == null) {
                return redirect()->back()->with('error', "Customer Not Found...");
            }
        }

        return view('connection', compact('customer', 'town', 'type', 'prio', 'subtown', 'subtype', 'source'));

    }
    public function update_connection_request(Request $request)
    {
        $town = Town::all();
        $type = ComplaintType::all();
        $subtype = SubType::all();
        $prio = Priorities::all();
        $subtown = SubTown::all();
        $source = Source::all();
        $customer = NULL;
        if ($request->has('search')) {
            $customer = Customer::where('customer_id', $request->search)->first();
            if ($customer == null) {
                return redirect()->back()->with('error', "Customer Not Found...");
            }
        }

        return view('consumer-data', compact('customer', 'town', 'type', 'prio', 'subtown', 'subtype', 'source'));

    }
    public function store(Request $request)
    {
        $valid = $this->validator($request->all());
        if ($valid->fails()) {
            // dd($valid->errors());
            return redirect()->back()->with('errors', $valid->errors());
        }
        if ($valid->valid()) {
            $data = $request->all();
            $prefix = "COMPLAINT-";
            $CompNum = IdGenerator::generate(['table' => 'complaint', 'field' => 'comp_num', 'length' => 14, 'prefix' => $prefix]);
            $data['comp_num'] = $CompNum;
            $data['source'] = "webpage";
            if ($request->has('image') && $request->image != NULL) {
                $data['image'] = $this->complaintImage($request->image);
            }
            $complaint = Complaints::create($data);
            if ($complaint->customer_id != 0) {
                $phone = $complaint->customer->phone;
            } else {
                $phone = $complaint->phone;
            }
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'http://uti.bizintel.co:8003/ComplaintAPI.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => '{
                    "MobileNumber":"' . $phone . '",
                    "Type":"ComplaintLaunch",
                    "ComplaintNumber":"' . $complaint->comp_num . '"

                }
                ',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);
            curl_close($curl);

            $curl1 = curl_init();

            curl_setopt_array($curl1, array(
                CURLOPT_URL => 'https://bsms.ufone.com/bsms_v8_api/sendapi-0.3.jsp?id=03348970362&message=check phone number&shortcode=KWSC&lang=English&mobilenum='.$phone.'&password=Smskwsc@2024',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
            );

            $response1 = curl_exec($curl1);

            curl_close($curl1);

            return redirect()->back()->with('success', $complaint->comp_num);

        } else {
            return back()->with('error', $valid->errors());
        }
    }
    public function api_store(Request $request)
    {
        try {
            $user = auth('api')->user();

            if (!$user || $user->role != 5) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $data = $request->all();
            $request->validate([
                'town_id' => ['required', 'numeric', 'exists:towns,id'],
                'sub_town_id' => ['required', 'numeric', 'exists:subtown,id'],
                'type_id' => ['required', 'numeric', 'exists:complaint_types,id'],
                'subtype_id' => ['required', 'numeric', 'exists:sub_types,id'],
                // 'title' => ['required', 'string'],
                'description' => ['required', 'string'],
            ]);

            $prefix = "COMPLAINT-";
            $CompNum = IdGenerator::generate(['table' => 'complaint', 'field' => 'comp_num', 'length' => 14, 'prefix' => $prefix]);
            $data['comp_num'] = $CompNum;
            $data['source'] = 'Mobile App';

            if ($request->has('image') && $request->image != NULL) {
                $data['image'] = $this->complaintImage($request->image);
            }
            if ($request->has('image_two') && $request->image_two != NULL) {
                $data['image_two'] = $this->complaintImage($request->image_two);
            }
            if ($request->has('image_three') && $request->image_three != NULL) {
                $data['image_three'] = $this->complaintImage($request->image_three);
            }

            $data['customer_id'] = $user->customer->id;
            // dd($data);
            $complaint = Complaints::create($data);
            if ($complaint->phone != NULL) {
                $phone = $complaint->phone;
            } else {
                $phone = $complaint->customer->phone;

            }
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'http://uti.bizintel.co:8003/ComplaintAPI.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => '{
                    "MobileNumber":"' . $phone . '",
                    "Type":"ComplaintLaunch",
                    "ComplaintNumber":"' . $complaint->comp_num . '"

                }
                ',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://bsms.ufone.com/bsms_v8_api/sendapi-0.3.jsp?id=03348970362&message=le chal gay sms&shortcode=KWSC&lang=urdu&mobilenum=' . $phone . '&password=Smskwsc%402024',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Cookie: cookiesession1=678B2883C43F88D5E4F3BA5C946B0899'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            return response()->json(['success' => $complaint->comp_num], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function track_complaint(Request $request)
    {
        $comp = Complaints::where('comp_num',$request->comp_num);
        $auth = $comp->where('phone',$request->phone)->first();
        // dd($auth->toArray());
        if($auth == null)
        {
            $auth = $comp->with('customer')->whereHas('customer',function($q) use ($request){
                $q->where('phone',$request->phone);
            })->first();
        }
        if($auth == null)
        {
            return redirect()->back()->with('error', 'Sorry You are not Authenticate to view this Complaint...');
        }
        $comp = $comp->first();
        // dd($comp->toArray());
        return view('complaint-detail',compact('comp'));
    }

}
