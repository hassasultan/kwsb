<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $customer = new Customer();
        if($request->has('search') && $request->search != null && $request->search != '')
        {
            $customer = $customer->where('customer_id','LIKE','%'.$request->search.'%')->orwhere('customer_name','LIKE','%'.$request->search.'%')->orWhere('phone','LIKE','%'.$request->search.'%');
        }
        $customer = $customer->paginate(10);
        if($request->has('type'))
        {
            return $customer;
        }
        return view('pages.customer.index',compact('customer'));
    }
    public function create()
    {
        return view('pages.customer.create');

    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data["customer_id"] = random_int(1, 9999999);
        Customer::create($data);
        return redirect()->route('customer-management.index')->with('success', 'Record created successfully.');

    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.edit',compact('customer'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_method','_token']);
        Customer::where('id',$id)->update($data);
        return redirect()->route('customer-management.index')->with('success', 'Record updated successfully.');


    }
}
