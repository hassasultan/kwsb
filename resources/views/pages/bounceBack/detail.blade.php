@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <h2 class="page-title mb-0">Bounce Back Complaint Details</h2>
            </div>

            @if($complaint)
            <div class="row">
                <!-- Complaint Information -->
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Complaint Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Complaint Number:</strong> {{ $complaint->comp_num }}</p>
                                    <p><strong>Consumer Number:</strong>
                                        @if($complaint->customer_id != 0)
                                            {{ $complaint->customer->customer_id ?? 'N/A' }}
                                        @else
                                            {{ $complaint->customer_num }}
                                        @endif
                                    </p>
                                    <p><strong>Consumer Name:</strong>
                                        @if($complaint->customer_id != 0)
                                            {{ $complaint->customer->customer_name ?? 'N/A' }}
                                        @else
                                            {{ $complaint->customer_name }}
                                        @endif
                                    </p>
                                    <p><strong>Phone:</strong> {{ $complaint->phone ?? 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $complaint->email ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Town:</strong> {{ $complaint->town->town ?? 'N/A' }}</p>
                                    <p><strong>Sub Town:</strong> {{ $complaint->subtown->title ?? 'N/A' }}</p>
                                    <p><strong>Complaint Type:</strong> {{ $complaint->type->title ?? 'N/A' }}</p>
                                    <p><strong>Sub Type:</strong> {{ $complaint->subtype->title ?? 'N/A' }}</p>
                                    <p><strong>Priority:</strong> {{ $complaint->prio->title ?? 'N/A' }}</p>
                                    <p><strong>Source:</strong> {{ $complaint->source }}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <p><strong>Address:</strong> {{ $complaint->address ?? 'N/A' }}</p>
                                    <p><strong>Landmark:</strong> {{ $complaint->landmark ?? 'N/A' }}</p>
                                    <p><strong>Description:</strong> {{ $complaint->description }}</p>
                                </div>
                            </div>
                            @if($complaint->image)
                            <div class="row mt-3">
                                <div class="col-12">
                                    <p><strong>Image:</strong></p>
                                    <img src="{{ asset('storage/' . $complaint->image) }}" class="img-fluid" style="max-width: 300px;">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Current Assignment -->
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Current Assignment</h5>
                        </div>
                        <div class="card-body">
                            @if($complaint->assignedComplaints)
                                <p><strong>Assigned Agent:</strong></p>
                                <p>{{ $complaint->assignedComplaints->agents->first()->user->name ?? 'N/A' }}</p>
                                <p><strong>Assignment Date:</strong> {{ $complaint->assignedComplaints->created_at->format('d/m/Y H:i:s') ?? 'N/A' }}</p>
                            @elseif($complaint->assignedComplaintsDepartment)
                                <p><strong>Assigned Department:</strong></p>
                                <p>{{ $complaint->assignedComplaintsDepartment->user->name ?? 'N/A' }}</p>
                                <p><strong>Assignment Date:</strong> {{ $complaint->assignedComplaintsDepartment->created_at->format('d/m/Y H:i:s') ?? 'N/A' }}</p>
                            @else
                                <p class="text-muted">No current assignment</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bounce Back History -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Bounce Back History</h5>
                        </div>
                        <div class="card-body">
                            @if($bounceBacks && count($bounceBacks) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Bounced By</th>
                                                <th>Reason</th>
                                                <th>Bounced At</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bounceBacks as $index => $bounceBack)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($bounceBack->type === 'agent')
                                                        <span class="badge bg-info">Mobile Agent</span>
                                                    @else
                                                        <span class="badge bg-primary">Department</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($bounceBack->type === 'agent')
                                                        {{ $bounceBack->mobileAgent->user->name ?? 'N/A' }}
                                                    @else
                                                        {{ $bounceBack->departmentUser->name ?? 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>{{ $bounceBack->reason }}</td>
                                                <td>{{ $bounceBack->bounced_at->format('d/m/Y H:i:s') }}</td>
                                                <td>
                                                    @if($bounceBack->status === 'active')
                                                        <span class="badge bg-warning">Active</span>
                                                    @else
                                                        <span class="badge bg-success">Resolved</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No bounce back history found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                Complaint not found.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
