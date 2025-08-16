@extends('layouts.app')

@section('content')
<style>
    /* Dark mode compatibility */
    [data-bs-theme="dark"] .text-dark {
        color: #fff !important;
    }
    
    [data-bs-theme="dark"] .table {
        color: #fff !important;
    }
    
    [data-bs-theme="dark"] .table tbody tr {
        color: #fff !important;
    }
    
    [data-bs-theme="dark"] .card-header {
        color: #fff !important;
    }
    
    [data-bs-theme="dark"] .fw-semibold {
        color: #fff !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0 text-white">
                                <i class="fas fa-layer-group me-2"></i>
                                Priorities Management
                            </h4>
                            <p class="mb-0 text-white-50 small">Manage complaint priority levels</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a class="btn btn-light btn-sm shadow-sm" href="{{ route('priorities-management.create') }}">
                                <i class="fas fa-plus me-1"></i>
                                Add New Priority
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-tag text-primary me-2"></i>
                                            <span class="fw-semibold">Priority Title</span>
                                        </div>
                                    </th>
                                    <th class="border-0 px-4 py-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-cogs text-primary me-2"></i>
                                            <span class="fw-semibold">Actions</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($prio) > 0)
                                    @foreach ($prio as $key => $row)
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">{{ $row->title }}</h6>
                                                        <small class="text-muted">Priority Level</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if (auth()->user()->role == 1)
                                                    <a href="{{ url('admin/priorities-management/' . $row->id . '/edit') }}"
                                                        class="btn btn-outline-primary btn-sm me-2"
                                                        data-toggle="tooltip" data-original-title="Edit Priority">
                                                        <i class="fas fa-edit me-1"></i>
                                                        Edit
                                                    </a>
                                                @else
                                                    <a href="{{ url('system/priorities-management/' . $row->id . '/edit') }}"
                                                        class="btn btn-outline-primary btn-sm me-2"
                                                        data-toggle="tooltip" data-original-title="Edit Priority">
                                                        <i class="fas fa-edit me-1"></i>
                                                        Edit
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <h6 class="mb-2">No Priorities Found</h6>
                                                <p class="mb-0">Start by adding your first priority level</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if (count($prio) > 0)
                    <div class="card-footer bg-light border-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Showing {{ count($prio) }} priority level(s)
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Last updated: {{ now()->format('M d, Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
