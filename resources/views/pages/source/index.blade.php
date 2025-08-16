@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1>Source Management</h1>
                            <a href="{{ route('source-management.create') }}" class="btn btn-primary">Add Source</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Source</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Town</th> --}}
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (count($user) > 0) --}}
                                @foreach ($source as $key => $row)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $row->title }}</p>
                                        </td>
                                        {{-- <td class="align-middle text-center text-sm">
                                          <p class="text-xs text-secondary mb-0">{{ $row->subtown }}</p>
                                      </td> --}}
                                        <td>
                                            @if (auth()->user()->role == 1)
                                                <a href="{{ url('admin/source-management/' . $row->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            @else
                                                <a href="{{ url('system/source-management/' . $row->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
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
@endsection
