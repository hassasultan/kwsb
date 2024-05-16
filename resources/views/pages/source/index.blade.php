@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-12">
          {{-- @include('layouts.include.toolbar') --}}
          <h2 class="page-title">Source Management</h2>
          <p> All Sources are available here... </p>
          <div class="col-12 text-right">
              <a class="btn btn-primary" href="{{ route('source-management.create') }}">add</i>&nbsp;&nbsp;<i
                      class="fa fa-user"></i></a>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card my-4">
                  {{-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                      <div class="row">
                          <div class="col-6">
                              <h6 class="text-white text-capitalize ps-3">Source List</h6>
                          </div>
                          <div class="col-6 text-end">
                              <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('source-management.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                          </div>
                      </div>
                    </div>
                  </div> --}}
                  <div class="card-body px-0 pb-2">
                    <div class="p-0">
                      <table class="table table-borderless table-hover">
                        <thead>
                          <tr>
                            <th class="text-uppercase">Source</th>
                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Town</th> --}}
                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                            <th class="opacity-7">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- @if(count($user) > 0) --}}
                              @foreach ($source as $key => $row)
                                  <tr>
                                      <td>
                                          <p class="text-xs font-weight-bold mb-0">{{ $row->title }}</p>
                                      </td>
                                      {{-- <td class="align-middle text-center text-sm">
                                          <p class="text-xs text-secondary mb-0">{{ $row->subtown }}</p>
                                      </td> --}}
                                      <td class="align-middle">
                                          <a href="{{ route('source-management.edit',$row->id) }}" class="font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                          Edit
                                          </a>
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
  </div>
</div>

@endsection
