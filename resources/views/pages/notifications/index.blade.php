@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title">Notification Management</h2>
                <div>
                    <a href="{{ route('admin.notification.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Send New Notification
                    </a>
                    <a href="{{ route('admin.notification.statistics') }}" class="btn btn-info">
                        <i class="fa fa-chart-bar"></i> Statistics
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Notifications History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Type</th>
                                    <th>Recipient</th>
                                    <th>Status</th>
                                    <th>Sent By</th>
                                    <th>Sent At</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    <tr>
                                        <td>
                                            <strong>{{ $notification->title }}</strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ Str::limit($notification->body, 50) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $notification->type === 'urgent' ? 'danger' : ($notification->type === 'reminder' ? 'warning' : 'primary') }}">
                                                {{ ucfirst($notification->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($notification->recipient_type === 'all')
                                                <span class="badge bg-success">All Agents</span>
                                            @elseif($notification->recipient_type === 'agent')
                                                <span class="badge bg-info">Specific Agent</span>
                                            @elseif($notification->recipient_type === 'town')
                                                <span class="badge bg-warning">Town Based</span>
                                            @elseif($notification->recipient_type === 'type')
                                                <span class="badge bg-secondary">Type Based</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $notification->status === 'delivered' ? 'success' : ($notification->status === 'failed' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($notification->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $notification->sender ? $notification->sender->name : 'System' }}
                                        </td>
                                        <td>
                                            {{ $notification->created_at->format('M d, Y H:i') }}
                                        </td>
                                        {{-- <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.notification.show', $notification->id) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                    View Details
                                                </a>
                                                <a href="{{ route('admin.notification.edit', $notification->id) }}"
                                                   class="btn btn-sm btn-outline-secondary"
                                                   title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.notification.destroy', $notification->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fa fa-bell fa-3x mb-3"></i>
                                            <p>No notifications found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($notifications->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
