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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ old('title') }}"
                                            required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id"  class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select UC/Mohalla*</label>
                                        <select name="sub_town_id"
                                            class="select2 form-control fs-14  h-50px">
                                            @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }} </option>
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Priority</label>
                                        <select name="prio_id" id="prio_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($prio as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Source</label>
                                        <select name="source" id="source"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            <option value="all">All</option>
                                            @foreach ($source as $key => $row)
                                                <option value="{{ $key }}">{{ $key }}</option>
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
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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



                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports2') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaints Turn Around Time Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports4') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaints Turn Around Time Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id"  class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports3') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaints Aging Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports5') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaints Aging Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id"  class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports6') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Turn Around Time Summary Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports8') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Turn Around Time Summary Filter Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id" class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports7') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Aging Summary Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports9') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Aging Summary Filter Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id"  class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports10') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Executive Engineer Performance Overall</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports11') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Executive Engineer Performance Department Wise</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id"
                                            class="select2-multiple form-control fs-14  h-50px">
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports12') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Executive Engineer Performance Town Wise</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id"  class="select2 form-control fs-14  h-50px">
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports13') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaint SubType Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town*</label>
                                        <select name="town_id" id="town-id" class=" form-control fs-14  h-50px">
                                            <option disabled selected> -- Select Town --</option>
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select SubTown*</label>
                                        <select name="sub_town_id" id="sub_town_id" class="select2 form-control fs-14  h-50px" >
                                            <option disabled selected> -- Select SubTown --</option>
                                            @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Type*</label>
                                        <select name="type_id" id="type_id" class=" form-control fs-14  h-50px" >
                                            <option disabled selected> -- Select Complaint Type --</option>
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Sub Type*</label>
                                        <select name="subtype_id" id="subtype_id"
                                            class="select2 form-control fs-14  h-50px" >
                                            <option disabled selected> -- Select SubType --</option>
                                            @foreach ($subtype as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports14') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Complaints Type Summary Report</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ old('title') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date"
                                            value="{{ old('title') }}" required />
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
                            <form role="form" method="get" action="{{ route('compaints-reports.reports15') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Detailed Report with Advanced Filters</h6>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter From Date..." name="from_date"
                                            value="{{ old('from_date') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter To Date..." name="to_date"
                                            value="{{ old('to_date') }}" required />
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Town</label>
                                        <select name="town_id" id="town-id-15" class="form-control fs-14 h-50px">
                                            <option value="">All Towns</option>
                                            @foreach ($town as $row)
                                                <option value="{{ $row->id }}">{{ $row->town }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select SubTown</label>
                                        <select name="sub_town_id" id="sub_town_id_15" class="form-control fs-14 h-50px">
                                            <option value="">All SubTowns</option>
                                            @foreach ($subtown as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Complaint Type</label>
                                        <select name="type_id" id="type_id_15" class="form-control fs-14 h-50px">
                                            <option value="">All Types</option>
                                            @foreach ($type as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Sub Type</label>
                                        <select name="subtype_id" id="subtype_id_15" class="form-control fs-14 h-50px">
                                            <option value="">All SubTypes</option>
                                            @foreach ($subtype as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Source</label>
                                        <select name="source" class="form-control fs-14 h-50px">
                                            <option value="all">All Sources</option>
                                            @foreach ($source as $key => $row)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Executive Engineer</label>
                                        <select name="executive_engineer" class="form-control fs-14 h-50px">
                                            <option value="">All Engineers</option>
                                            @foreach ($executive_engineers ?? [] as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Select Department</label>
                                        <select name="department" class="form-control fs-14 h-50px">
                                            <option value="">All Departments</option>
                                            @foreach ($departments ?? [] as $row)
                                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form role="form" method="get" action="{{ route('compaints-reports.reports16') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h6>Billing Report</h6>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Consumer No</label>
                                        <input type="text" class="form-control border-bottom"
                                            placeholder="Enter Consumer No..." name="consumer_no"
                                            value="{{ old('consumer_no') }}" required />
                                    </div>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-primary text-white btn-lg w-100">Get Bill</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>




            </div>
        </div> <!-- /. card-body -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#town-id").change( function() {
            var town_id = $(this).val();
            // console.log(town_id);
            $.ajax({
                type: "get",
                url: "{{ route('subtown.by.town') }}",
                data: {
                    'town_id': town_id,
                },
                success: function(data) {
                    $("#sub_town_id").html("");
                    var your_html = "";
                    your_html += "<option disabled selected> -- Select SubTown --</option>";
                    $.each(data, function(key, val) {
                        console.log(val);
                        your_html += "<option value=" + val['id'] + ">" + val['title'] +
                            "</option>"
                    });
                    $("#sub_town_id").append(your_html); //// For Append
                },
                error: function() {
                    console.log(data);
                }
            });
        });
        $("#type_id").on("change", function() {
            var type_id = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('subtype.by.type') }}",
                data: {
                    'type_id': type_id,
                },
                success: function(data) {
                    $("#subtype_id").html("");
                    var your_html = "";
                    your_html += "<option disabled selected> -- Select SubType --</option>";
                    $.each(data, function(key, val) {
                        console.log(val);
                        your_html += "<option value=" + val['id'] + ">" + val['title'] +
                            "</option>"
                    });
                    $("#subtype_id").append(your_html); //// For Append
                },
                error: function() {
                    console.log(data);
                }
            });
        });
        $("#town-id-15").change(function() {
        var town_id = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ route('subtown.by.town') }}",
            data: {
                'town_id': town_id,
            },
            success: function(data) {
                $("#sub_town_id_15").html("");
                var your_html = "";
                your_html += "<option value=''>All SubTowns</option>";
                $.each(data, function(key, val) {
                    your_html += "<option value=" + val['id'] + ">" + val['title'] + "</option>"
                });
                $("#sub_town_id_15").append(your_html);
            },
            error: function() {
                console.log("Error fetching subtowns");
            }
        });
    });

    $("#type_id_15").on("change", function() {
        var type_id = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ route('subtype.by.type') }}",
            data: {
                'type_id': type_id,
            },
            success: function(data) {
                $("#subtype_id_15").html("");
                var your_html = "";
                your_html += "<option value=''>All SubTypes</option>";
                $.each(data, function(key, val) {
                    your_html += "<option value=" + val['id'] + ">" + val['title'] + "</option>"
                });
                $("#subtype_id_15").append(your_html);
            },
            error: function() {
                console.log("Error fetching subtypes");
            }
        });
    });
    </script>
@endsection
