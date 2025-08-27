@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                {{-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Add Customer</h6>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card-body px-4 pb-2">
                    <h5>Give Customer Informarion...</h5>
                    <form role="form" method="POST" action="{{ route('customer-management.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 p-3">
                                <label>Name*</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Name Here..." name="customer_name" required  value="{{ old('customer_name') }}"/>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Customer Phone*</label>
                                <input type="tel" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Phone: +92(XXX) XXXXXXX" name="phone" required  value="{{ old('phone') }}"/>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Town*</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Town Here..." name="town" required  value="{{ old('town') }}"/>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Sub Town*</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Sub Town Here..." name="sub_town" required  value="{{ old('sub_town') }}"/>
                            </div>
                            <div class="form-group col-12 p-3">
                                <label>Address*</label>
                                <input type="text" class="form-control border-bottom border-1 border-dark"
                                placeholder="Enter Address Here..." name="address" required  value="{{ old('address') }}"/>
                            </div>
                            <div class="form-group col-12 p-3">

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary btn-lg w-20 mt-4 mb-0">Create</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
