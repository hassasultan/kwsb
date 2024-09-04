@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Complaint Management</h2>
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
                                        {{ $complaint->title }}'s Agent List
                                    </h5>
                                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p> --}}

                                    <table id="example1" class="table table-bordered align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Agent</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Town</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Address</th>
                                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                                <th class="text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @if (count($user) > 0) --}}
                                            @foreach ($complaint->town->agents as $key => $row)
                                                @if ($row->type_id == $complaint->type_id)
                                                    <tr>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $row->user->name }}
                                                            </p>
                                                            @if ($row->avatar != null)
                                                                <img src="{{ asset('public/storage/' . $row->avatar) }}"
                                                                    class="img-fluid" style="width: 70px; height: 70px;" />
                                                            @endif
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-xs text-secondary mb-0">{{ $row->town->town }}
                                                            </p>
                                                            <p class="text-xs text-secondary mb-0">{{ $row->town->subtown }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                                {{ $row->address }}
                                                            </p>
                                                        </td>
                                                        {{-- <td class="align-middle text-center text-sm">
                                                            <p class="text-xs text-secondary mb-0">{{ count($row->hydrant->vehicles) }}</p>
                                                        </td> --}}
                                                        <td class="align-middle">
                                                            <a href="{{ route('complaints.assign', [$row->id, $complaint->id]) }}"
                                                                class="text-secondary font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-original-title="Edit user">
                                                                Assign Complaint
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            {{-- @else
                                                No Record Find...
                                            @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="toolbar">
                                <form class="form">
                                    <div class="form-row">
                                        <div class="form-group col-auto mr-auto">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Search</label>
                                            <input type="text" class="form-control" id="search1" value=""
                                                placeholder="Search">
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
