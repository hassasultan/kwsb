@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Complaint Type List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('compaints-type-management.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="p-4">
                <h5>Generate Report</h5>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-4">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-4">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-4">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-3">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>Select Town*</label>
                                <select name="town_id" id="town_id" class="select2-multiple form-control fs-14  h-50px" >
                                    @foreach ($town as $row)
                                        <option value="{{ $row->id }}">{{ $row->town }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-3">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>Select Complaint Type</label>
                                <select name="type_id" id="type_id" class="select2-multiple form-control fs-14  h-50px" >
                                    @foreach ($type as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-3">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>Select Priority</label>
                                <select name="prio_id" id="prio_id" class="select2-multiple form-control fs-14  h-50px" >
                                    @foreach ($prio as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-3">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>Select Source</label>
                                <select name="source" id="source" class="select2-multiple form-control fs-14  h-50px" >
                                    <option value="all">All</option>
                                    @foreach ($source as $key => $row)
                                        <option value="{{ $key }}">{{ $key }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="p-3">
                    <form role="form" method="get" action="{{ route('compaints-reports.reports') }}" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-3">
                                <label>From Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>To Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <label>Consumer Number</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter Customer Number..." name="customer_id" value="{{ old('customer_id') }}" required/>
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" class="btn bg-gradient-primary btn-lg ">Create</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>
@endsection
