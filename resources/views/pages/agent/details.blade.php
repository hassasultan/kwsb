@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">{{ $agent->user->name }}'s' Complaint List</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
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

@endsection
