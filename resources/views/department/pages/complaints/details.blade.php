@extends('department.layouts.app')

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
                                    <h3 class="card-title text-center">Complaint Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <p><strong>Complaint Number:</strong> <span
                                                    id="comp_num">{{ $complaint->comp_num }}</span>
                                            </p>
                                            <p><strong>Title:</strong> <span
                                                    id="title">{{ $complaint->type->title }}</span></p>
                                            <p><strong>Description:</strong> <span
                                                    id="description">{{ $complaint->description }}</span></p>
                                            <p><strong>Customer Name:</strong> <span
                                                    id="customer_name">{{ $complaint->customer_name }}</span></p>
                                            <p><strong>Phone:</strong> <span id="phone">{{ $complaint->phone }}</span>
                                            </p>
                                            <p><strong>Email:</strong> <span id="email">{{ $complaint->email }}</span>
                                            </p>
                                            <p><strong>Address:</strong> <span
                                                    id="address">{{ $complaint->address }}</span></p>
                                            <p><strong>Landmark:</strong> <span
                                                    id="landmark">{{ $complaint->landmark }}</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($complaint->image != null)
                                                <img src="{{ asset('storage/' . $complaint->image) }}"
                                                    style="width:250px;" />
                                                <br />
                                            @endif
                                            @if ($complaint->before_image != null)
                                                <img src="{{ asset('storage/' . $complaint->before_image) }}"
                                                    style="width:250px;" />
                                                <br />
                                            @endif
                                            @if ($complaint->after_image != null)
                                                <img src="{{ asset('storage/' . $complaint->after_image) }}"
                                                    style="width:250px;" />
                                                <br />
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="text-center status" id="status">
                                                @if ($complaint->status == 1)
                                                    COMPLETED
                                                @elseif($complaint->status == 0)
                                                    PENDING
                                                @else
                                                    IN PROCESS
                                                @endif
                                            </h3>
                                            <div class="text-center status">
                                                @if ($complaint->status == 0)
                                                    <img src="{{ asset('assets/images/pending.jpg') }}"
                                                        style="width: 200px;" />
                                                @endif
                                                @if ($complaint->status == 2)
                                                    <img src="{{ asset('assets/images/progress.jpeg') }}"
                                                        style="width: 200px;" />
                                                @endif
                                                @if ($complaint->status == 1)
                                                    <img src="{{ asset('assets/images/completed.png') }}"
                                                        style="width: 200px;" />
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3">
                                                <label>Select Assignee</label>
                                                <select id="assignee" class="form-control">
                                                    <option value="agents">Agents</option>
                                                    <option value="departments">Departments</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="agents" id="agents">
                                    <h5>
                                        {{ $complaint->comp_num }}'s Agent List
                                    </h5>

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
                                                <th class="text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $row->town->subtown }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs text-center font-weight-bold mb-0">
                                                                {{ $row->address }}
                                                            </p>
                                                        </td>

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
                                        </tbody>
                                    </table>
                                </div> --}}
                                {{-- <div class="department " id="department">
                                    <h5>
                                        Department List
                                    </h5>
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($department_user as $key => $row)
                                                <tr>
                                                    <th scope="row">{{ ++$key }}</th>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->department->name }}</td>
                                                    <td><a href="{{ route('complaints.assign.department', [$row->id, $complaint->id]) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Assign Complaint
                                                    </a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> --}}
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
@section('bottom_script')
    <script>
        $(document).ready(function() {
            $('#assignee').change(function() {
                const val = $(this).val();
                if (val == "agents") {
                    $('#department').addClass('d-none');
                    $('#agents').removeClass('d-none');
                } else {
                    $('#department').removeClass('d-none');
                    $('#agents').addClass('d-none');
                }
            });
        });
    </script>
@endsection