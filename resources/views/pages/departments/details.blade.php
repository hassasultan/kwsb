@extends('layouts.app')
@section('content')
<style>
    nav[role="navigation"] svg {
  width: 14px;
  height: 14px;
}
</style>
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Department Management</h2>
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
                            <h5>
                              {{ $depart->name }}
                            </h5>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <p><strong>Town :</strong> <span id="comp_num">{{ $depart->town->town }}</span>
                                </p>
                                <p><strong>Department :</strong> <span id="landmark">{{ $depart->complaint_type?->title }}</span></p>
                                <p><strong>Description :</strong> <span id="description">{{ $depart->description }}</span></p>
                                <p><strong>Address :</strong> <span id="customer_name">{{ $depart->address }}</span></p>
                                <p><strong>Phone :</strong> <span id="phone">{{ $depart->user->phone }}</span></p>
                                <p><strong>Email :</strong> <span id="email">{{ $depart->user->email }}</span>
                                </p>
                            </div>
                        </div> --}}
                        <div class="row">
                          <table id="example1" class="table table-bordered align-items-center mb-0">
                            <thead>
                              <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint #</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Town</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Picture</th>
                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                <th class="text-secondary opacity-7">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              {{-- @if(count($user) > 0) --}}
                                  @foreach ($complaints as $key => $row)
                                    {{-- @if ($row->complaints != null) --}}
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->comp_num }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->town->town }} {{ $row->town->subtown }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->type?->title }} </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($row->image != NULL)
                                                    <img src="{{ asset('public/storage/'.$row->image) }}" class="img-fluid" style="width: 70px; height: 70px;"/>
                                                @else
                                                    Not Available
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{-- <a href="{{ route('compaints-management.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                                </a> --}}
                                                <a href="{{ route('compaints-management.details',$row->id) }}" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">
                                                    Details
                                                    </a>

                                            </td>
                                        </tr>
                                    {{-- @endif --}}
                                  @endforeach
                              {{-- @else
                                  No Record Find...
                              @endif --}}
                            </tbody>
                          </table>
                          <div class="pagination">
                            {{ $complaints->links() }}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection
