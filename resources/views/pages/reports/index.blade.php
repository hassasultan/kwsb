@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <strong class="card-title">Reports</strong>
                <h5>Generate Reports</h5>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                    <h6>Overall Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Town Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id" id="town_id" class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}
        
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>UC Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select UC/Mohalla*</label>
                                        <select name="sub_town_id" id="sub_town_id" class="select2 form-control fs-14  h-50px">
                                            @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}
        
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Type Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id" id="type_id" class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}
        
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Priority Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Priority</label>
                                        <select name="prio_id" id="prio_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($prio as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}
        
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Source Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Source</label>
                                        <select name="source" id="source"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            <option value="all">All</option>
                                            @foreach ($source as $key => $row)
                                                <option value="{{ $key }}">{{ $key }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Customer Wise Reports</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Consumer Number</label>
                                        <input type="text" class="form-control border-bottom"
                                            placeholder="Enter Customer Number..." name="customer_id"
                                            value="{{ old('customer_id') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg ">Create</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /. card-body -->
    </div>
@endsection
