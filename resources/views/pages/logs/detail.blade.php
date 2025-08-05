@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">Log Detail</h2>
                    <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Logs
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-info-circle text-primary"></i>
                                    Log Entry #{{ $log->id }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Basic Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td class="font-weight-bold">Log ID:</td>
                                                        <td>{{ $log->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Action:</td>
                                                        <td>
                                                            <span class="badge badge-sm bg-gradient-{{ $log->action == 'Complaint' ? 'primary' : ($log->action == 'User' ? 'success' : ($log->action == 'System' ? 'warning' : 'info')) }}">
                                                                {{ $log->action }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Action ID:</td>
                                                        <td>{{ $log->action_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Created At:</td>
                                                        <td>{{ $log->created_at->format('F d, Y \a\t H:i:s') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Updated At:</td>
                                                        <td>{{ $log->updated_at->format('F d, Y \a\t H:i:s') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- User Information -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">User Information</h6>
                                            </div>
                                            <div class="card-body">
                                                @if($log->user)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="avatar avatar-sm bg-gradient-primary rounded-circle">
                                                            <i class="fa fa-user text-white"></i>
                                                        </div>
                                                        <div class="ml-3">
                                                            <h6 class="mb-0">{{ $log->user->name }}</h6>
                                                            <p class="text-sm text-secondary mb-0">{{ $log->user->email }}</p>
                                                        </div>
                                                    </div>
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td class="font-weight-bold">User ID:</td>
                                                            <td>{{ $log->user->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">Email:</td>
                                                            <td>{{ $log->user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">Status:</td>
                                                            <td>
                                                                <span class="badge badge-sm bg-gradient-{{ $log->user->status ? 'success' : 'danger' }}">
                                                                    {{ $log->user->status ? 'Active' : 'Inactive' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        @if($log->user->department)
                                                            <tr>
                                                                <td class="font-weight-bold">Department:</td>
                                                                <td>{{ $log->user->department->name }}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                @else
                                                    <div class="text-center text-secondary">
                                                        <i class="fa fa-user-times mb-2" style="font-size: 2rem;"></i>
                                                        <p>User information not available</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Details -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Action Details</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Action Detail:</label>
                                                    <div class="bg-light p-3 rounded">
                                                        <pre class="mb-0" style="white-space: pre-wrap; font-family: inherit;">{{ $log->action_detail }}</pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Related Complaint Information -->
                                @if($log->action == 'Complaint' && $log->complaint)
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fa fa-exclamation-triangle text-warning"></i>
                                                        Related Complaint Information
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <td class="font-weight-bold">Complaint Number:</td>
                                                                    <td>
                                                                        <a href="{{ route('compaints-management.details', $log->complaint->id) }}" class="text-primary font-weight-bold">
                                                                            {{ $log->complaint->comp_num }}
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Customer Name:</td>
                                                                    <td>{{ $log->complaint->customer_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Phone:</td>
                                                                    <td>{{ $log->complaint->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Email:</td>
                                                                    <td>{{ $log->complaint->email }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <td class="font-weight-bold">Title:</td>
                                                                    <td>{{ $log->complaint->title }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Status:</td>
                                                                    <td>
                                                                        <span class="badge badge-sm bg-gradient-{{ $log->complaint->status == 0 ? 'warning' : ($log->complaint->status == 1 ? 'success' : 'info') }}">
                                                                            {{ $log->complaint->status == 0 ? 'Pending' : ($log->complaint->status == 1 ? 'Completed' : 'In Progress') }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Created At:</td>
                                                                    <td>{{ $log->complaint->created_at->format('F d, Y \a\t H:i:s') }}</td>
                                                                </tr>
                                                                @if($log->complaint->town)
                                                                    <tr>
                                                                        <td class="font-weight-bold">Town:</td>
                                                                        <td>{{ $log->complaint->town->town }}</td>
                                                                    </tr>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>

                                                    @if($log->complaint->description)
                                                        <div class="mt-3">
                                                            <label class="font-weight-bold">Description:</label>
                                                            <div class="bg-light p-3 rounded">
                                                                <p class="mb-0">{{ $log->complaint->description }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">
                                                <i class="fa fa-arrow-left"></i> Back to Logs
                                            </a>
                                            @if($log->action == 'Complaint' && $log->complaint)
                                                <a href="{{ route('compaints-management.details', $log->complaint->id) }}" class="btn btn-primary">
                                                    <i class="fa fa-exclamation-triangle"></i> View Complaint Details
                                                </a>
                                            @endif
                                        </div>
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
