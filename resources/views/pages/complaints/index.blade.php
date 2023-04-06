@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Complaint List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('compaints-management.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">Compaint ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">Consumer Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">Consumer Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-20">Town</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint Type / Priority</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title Description</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Picture</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Resolve Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Source</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                      <th class="text-secondary opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @if(count($user) > 0) --}}
                        @foreach ($complaint as $key => $row)
                            <tr>
                                <td class="w-20">
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->comp_num }}</p>
                                </td>
                                <td class="w-20">
                                    @if ($row->customer_id != 0)
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->customer->customer_id }}</p>
                                    @else
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->customer_num }}</p>
                                    @endif
                                </td>
                                <td class="w-20">
                                    @if ($row->customer_id != 0)
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->customer->customer_name }}</p>
                                    @else
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->customer_name }}</p>
                                    @endif
                                </td>
                                <td class="w-20">
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->town->town }} ({{ $row->subtown?->title }})</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->type?->title }} </p>
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->prio?->title }} </p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs text-secondary mb-0">{{ $row->title }}</p>
                                    {{-- <p class="text-xs text-secondary mb-0">{{ $row->description }}</p> --}}

                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ($row->image != NULL)
                                        <img src="{{ asset('public/storage/'.$row->image) }}" class="img-fluid" style="width: 70px; height: 70px;"/>
                                    @else
                                        Not Available
                                    @endif
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y h:i:s')}}</p>
                                </td>
                                <td class="text-center">
                                    @if ($row->status == 1)
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y h:i:s')}}</p>
                                    @else
                                        <span class="bg-danger">Yet Not Reslove</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->source }}</p>
                                </td>
                                <td class="text-center">
                                    @if ($row->status == 1)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{-- <a href="{{ route('compaints-management.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    Edit
                                    </a> --}}
                                    @if ($row->assignedComplaints == null)
                                        <a href="{{ route('compaints-management.details',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">
                                            Assign
                                            </a>

                                    @else
                                        <a href="{{ route('agent-management.details',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">
                                            Already Assigned
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    {{-- @else
                        No Record Find...
                    @endif --}}
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
