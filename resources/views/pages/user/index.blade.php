@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">User List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('user-management.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                  {{-- <th class="text-secondary opacity-7">Action</th> --}}
                </tr>
              </thead>
              <tbody>
                {{-- @if(count($user) > 0) --}}
                    @foreach ($user as $key => $row)
                        <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->name }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs text-secondary mb-0">{{ $row->email }}</p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0"> @if($row->role == 2) System User @else Mobile Agent @endif </p>
                            </td>
                            {{-- <td class="align-middle text-center text-sm">
                                <p class="text-xs text-secondary mb-0">{{ count($row->hydrant->vehicles) }}</p>
                            </td> --}}
                            {{-- <td class="align-middle">
                                <a href="{{ route('user-management.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
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
