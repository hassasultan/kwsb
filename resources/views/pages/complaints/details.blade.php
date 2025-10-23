@extends('layouts.app')

@section('content')
<style>
    .status-badge {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .status-pending {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
    }
    .status-progress {
        background: linear-gradient(135deg, #4ecdc4, #44a08d);
        color: white;
    }
    .status-completed {
        background: linear-gradient(135deg, #45b7d1, #96c93d);
        color: white;
    }
    .info-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .info-card h4 {
        color: white !important;
    }
    .detail-item {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 0 8px 8px 0;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .detail-value {
        color: #212529;
        font-size: 1rem;
        margin-top: 5px;
    }
    .image-gallery {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .gallery-image {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    .gallery-image:hover {
        transform: scale(1.05);
    }
    .assignment-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    .section-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0;
        margin: -25px -25px 20px -25px;
    }
    .section-header h5 {
        color: white !important;
    }
    .btn-assign {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-assign:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        color: white;
    }
    .btn-assigned {
        background: #6c757d;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title mb-1">Complaint Details</h2>
                    <p class="text-muted mb-0">Complaint ID: {{ $complaint->comp_num }}</p>
                </div>
                <div class="text-right d-flex align-items-center gap-3">
                    <a href="{{ request()->get('from_request') == '1' ? route('compaints-management.index', ['comp_type_id' => [1,2,5]]) : route('compaints-management.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <span class="status-badge 
                        @if($complaint->status == 0) status-pending
                        @elseif($complaint->status == 1) status-completed
                        @else status-progress @endif">
                        @if ($complaint->status == 1)
                            <i class="fas fa-check-circle me-2"></i>Completed
                        @elseif($complaint->status == 0)
                            <i class="fas fa-clock me-2"></i>Pending
                        @else
                            <i class="fas fa-spinner me-2"></i>In Progress
                        @endif
                    </span>
                </div>
            </div>

            <div class="row">
                <!-- Complaint Information Card -->
                <div class="col-lg-8 mb-4">
                    <div class="info-card">
                        <h4 class="mb-3">
                            <i class="fas fa-info-circle me-2"></i>Complaint Information
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Complaint Type</div>
                                    <div class="detail-value">{{ $complaint->type->title }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Sub Type</div>
                                    <div class="detail-value">{{ $complaint->subtype->title ?? 'N/A' }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Priority</div>
                                    <div class="detail-value">{{ $complaint->prio->title ?? 'N/A' }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Source</div>
                                    <div class="detail-value">{{ $complaint->source }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Town</div>
                                    <div class="detail-value">{{ $complaint->town->town }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Sub Town</div>
                                    <div class="detail-value">{{ $complaint->subtown->title ?? 'N/A' }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Created Date</div>
                                    <div class="detail-value">{{ $complaint->created_at->format('d M Y, h:i A') }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Last Updated</div>
                                    <div class="detail-value">{{ $complaint->updated_at->format('d M Y, h:i A') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">
                                <i class="fas fa-file-alt me-2"></i>Description
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">{{ $complaint->description }}</p>
                            @if($complaint->agent_description)
                                <div class="mt-3 p-3 bg-light rounded">
                                    <strong>Agent Notes:</strong>
                                    <p class="mb-0 mt-2">{{ $complaint->agent_description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Customer Information Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white">
                                <i class="fas fa-user me-2"></i>Customer Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="detail-item">
                                <div class="detail-label">Customer Name</div>
                                <div class="detail-value">{{ $complaint->customer_name }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Phone Number</div>
                                <div class="detail-value">
                                    <a href="tel:{{ $complaint->phone }}" class="text-decoration-none">
                                        <i class="fas fa-phone me-1"></i>{{ $complaint->phone }}
                                    </a>
                                </div>
                            </div>
                            @if($complaint->email)
                            <div class="detail-item">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">
                                    <a href="mailto:{{ $complaint->email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope me-1"></i>{{ $complaint->email }}
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="detail-item">
                                <div class="detail-label">Address</div>
                                <div class="detail-value">{{ $complaint->address }}</div>
                            </div>
                            @if($complaint->landmark)
                            <div class="detail-item">
                                <div class="detail-label">Landmark</div>
                                <div class="detail-value">{{ $complaint->landmark }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Gallery -->
            @if($complaint->image || $complaint->before_image || $complaint->after_image)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="image-gallery">
                        <h5 class="mb-3 text-dark">
                            <i class="fas fa-images me-2"></i>Image Gallery
                        </h5>
                        <div class="row">
                            @if($complaint->image)
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $complaint->image) }}" 
                                         class="img-fluid gallery-image" 
                                         style="max-height: 200px; width: 100%; object-fit: cover;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         data-src="{{ asset('storage/' . $complaint->image) }}">
                                    <p class="mt-2 mb-0 text-muted">Main Image</p>
                                </div>
                            </div>
                            @endif
                            @if($complaint->before_image)
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $complaint->before_image) }}" 
                                         class="img-fluid gallery-image" 
                                         style="max-height: 200px; width: 100%; object-fit: cover;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         data-src="{{ asset('storage/' . $complaint->before_image) }}">
                                    <p class="mt-2 mb-0 text-muted">Before Image</p>
                                </div>
                            </div>
                            @endif
                            @if($complaint->after_image)
                            <div class="col-md-4 mb-3">
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $complaint->after_image) }}" 
                                         class="img-fluid gallery-image" 
                                         style="max-height: 200px; width: 100%; object-fit: cover;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         data-src="{{ asset('storage/' . $complaint->after_image) }}">
                                    <p class="mt-2 mb-0 text-muted">After Image</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Assignment Section -->
            <div class="assignment-section">
                <div class="section-header">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>Assignment Management
                    </h5>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Select Assignee Type</label>
                        <select id="assignee" class="form-select">
                            <option value="agents">Field Agents</option>
                            <option value="departments">Departments</option>
                        </select>
                    </div>
                </div>

                <!-- Agents Section -->
                <div class="agents" id="agents">
                    <h6 class="mb-3">
                        <i class="fas fa-user-tie me-2"></i>Available Field Agents
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Agent</th>
                                    <th class="text-center">Town</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaint->town->agents as $key => $row)
                                    @if ($row->type_id == $complaint->type_id)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($row->avatar != null)
                                                        <img src="{{ asset('public/storage/' . $row->avatar) }}"
                                                            class="rounded-circle me-3" 
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                            style="width: 50px; height: 50px;">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p class="mb-0 fw-bold">{{ $row->user->name }}</p>
                                                        <small class="text-muted">{{ $row->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info text-dark">{{ $row->town->town }}</span>
                                                @if($row->town->subtown)
                                                    <br><small class="text-dark">{{ $row->town->subtown }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <small>{{ $row->address }}</small>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('complaints.assign', [$row->id, $complaint->id]) }}"
                                                    class="btn btn-assign btn-sm">
                                                    <i class="fas fa-user-plus me-1"></i>Assign
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Department Section -->
                <div class="department d-none" id="department">
                    <h6 class="mb-3">
                        <i class="fas fa-building me-2"></i>Available Departments
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($department_user as $key => $row)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-bold">{{ $row->name }}</p>
                                                    <small class="text-muted">{{ $row->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $row->department->name }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($row->check_assignment($row->id, $complaint->id) > 0)
                                                <span class="btn btn-assigned btn-sm">
                                                    <i class="fas fa-check me-1"></i>Assigned
                                                </span>
                                            @else
                                                <a href="{{ route('complaints.assign.department', [$row->id, $complaint->id]) }}"
                                                    class="btn btn-assign btn-sm">
                                                    <i class="fas fa-user-plus me-1"></i>Assign
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" style="max-height: 70vh;">
            </div>
        </div>
    </div>
</div>
@endsection
@section('bottom_script')
    <script>
        $(document).ready(function() {
            // Assignment type toggle
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

            // Image modal functionality
            $('.gallery-image').click(function() {
                const imageSrc = $(this).data('src');
                $('#modalImage').attr('src', imageSrc);
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
