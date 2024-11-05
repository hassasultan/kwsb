@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Agent Management</h2>
        {{-- <p> Tables with built-in bootstrap styles </p> --}}
        {{-- <div class="col-12 text-right">
        <a class="btn btn-primary" href="{{ route('compaints-management.create') }}">add</i>&nbsp;&nbsp;<i
                class="fa fa-user"></i></a>
        </div> --}}
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">
                            @if ($agent->avatar != NULL)
                                    <img src="{{ asset('storage/'.$agent->avatar) }}" class="img-fluid" style="width: 70px; height: 70px;"/>
                                @endif
                            <h5>
                              {{ $agent->user->name }}
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Town :</strong> <span id="comp_num">{{ $agent->town->town }}</span>
                                </p>
                                <p><strong>Department :</strong> <span id="landmark">{{ $agent->complaint_type?->title }}</span></p>
                                <p><strong>Description :</strong> <span id="description">{{ $agent->description }}</span></p>
                                <p><strong>Address :</strong> <span id="customer_name">{{ $agent->address }}</span></p>
                                <p><strong>Phone :</strong> <span id="phone">{{ $agent->user->phone }}</span></p>
                                <p><strong>Email :</strong> <span id="email">{{ $agent->user->email }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                          <table id="example1" class="table table-bordered align-items-center mb-0">
                            <thead>
                              <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint #</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Town</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title Description</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Picture</th>
                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                {{-- <th class="text-secondary opacity-7">Action</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                              {{-- @if(count($user) > 0) --}}
                                  @foreach ($agent->assignedComplaints as $key => $row)
                                      <tr>
                                          <td>
                                              <p class="text-xs font-weight-bold mb-0">{{ $row->complaints->comp_num }}</p>
                                          </td>
                                          <td>
                                              <p class="text-xs font-weight-bold mb-0">{{ $row->complaints->town->town }} {{ $row->complaints->town->subtown }}</p>
                                          </td>
                                          <td>
                                              <p class="text-xs font-weight-bold mb-0">{{ $row->complaints->type?->title }} </p>
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <p class="text-xs text-secondary mb-0">{{ $row->complaints->title }}</p>
                                              <p class="text-xs text-secondary mb-0">{{ $row->complaints->description }}</p>

                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              @if ($row->image != NULL)
                                                  <img src="{{ asset('public/storage/'.$row->complaints->image) }}" class="img-fluid" style="width: 70px; height: 70px;"/>
                                              @else
                                                  Not Available
                                              @endif
                                          </td>
                                          {{-- <td class="align-middle">
                                              <a href="{{ route('compaints-management.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                              Edit
                                              </a>
                                              <a href="{{ route('compaints-management.details',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">
                                                  Assigned
                                                  </a>

                                          </td> --}}
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
  </div>
</div>
@endsection
