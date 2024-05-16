@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <h5>Edit Customer Information</h5>
                <form role="form" method="POST" action="{{ route('customer-management.update', $customer->id) }}">
                    @csrf
                    @method('PUT') <!-- Use method spoofing for PUT request -->
                    <div class="row">
                        <div class="form-group col-12 p-3">
                            <label>Name*</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Name Here..." name="customer_name" required
                                value="{{ $customer->customer_name }}">
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Customer Phone*</label>
                            <input type="tel" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Phone Number Here..." name="phone" required
                                value="{{ $customer->phone }}">
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Town*</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Town Here..." name="town" required value="{{ $customer->town }}">
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Sub Town*</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Sub Town Here..." name="sub_town" required
                                value="{{ $customer->sub_town }}">
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Address*</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Address Here..." name="address" required
                                value="{{ $customer->address }}">
                        </div>
                        <div class="form-group col-12 p-3">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-lg w-20 mt-4 mb-0">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
