@extends('layouts.app')

@section('content')
<style>
    .agent-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
    }
    .agent-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .agent-info-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .info-item {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 0 8px 8px 0;
    }
    .info-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        color: #212529;
        font-size: 1rem;
        margin-top: 5px;
    }
    .complaints-table {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0;
        margin: -25px -25px 20px -25px;
    }
    .table-header h5 {
        color: white !important;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending {
        background: #ff6b6b;
        color: white;
    }
    .status-progress {
        background: #4ecdc4;
        color: white;
    }
    .status-completed {
        background: #45b7d1;
        color: white;
    }
    .complaint-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .table th {
        background: #f8f9fa;
        border: none;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .table td {
        border: none;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }
    
    .table tbody tr:hover {
        background: #f8f9fa;
    }
</style>

<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-12">
            <!-- Agent Header -->
            <div class="agent-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                            @if ($agent->avatar != NULL)
                            <img src="{{ asset('storage/'.$agent->avatar) }}" class="agent-avatar">
                        @else
                            <div class="agent-avatar bg-white d-flex align-items-center justify-content-center">
                                <i class="fas fa-user text-primary" style="font-size: 3rem;"></i>
                            </div>
                                @endif
                        </div>
                    <div class="col-md-6">
                        <h2 class="mb-2">{{ $agent->user->name }}</h2>
                        <p class="mb-1 opacity-75">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $agent->town->town }}
                        </p>
                        <p class="mb-1 opacity-75">
                            <i class="fas fa-building me-2"></i>{{ $agent->complaint_type?->title ?? 'N/A' }}
                        </p>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-envelope me-2"></i>{{ $agent->user->email }}
                                </p>
                            </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('agent-management.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                        </div>
            </div>

                        <div class="row">
                <!-- Agent Information Card -->
                <div class="col-lg-4 mb-4">
                    <div class="agent-info-card">
                        <h5 class="mb-3">
                            <i class="fas fa-info-circle me-2"></i>Agent Information
                        </h5>
                        <div class="info-item">
                            <div class="info-label">Town</div>
                            <div class="info-value">{{ $agent->town->town }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Department</div>
                            <div class="info-value">{{ $agent->complaint_type?->title ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $agent->address }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value">
                                <a href="tel:{{ $agent->user->phone }}" class="text-decoration-none">
                                    <i class="fas fa-phone me-1"></i>{{ $agent->user->phone }}
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <a href="mailto:{{ $agent->user->email }}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-1"></i>{{ $agent->user->email }}
                                </a>
                            </div>
                        </div>
                        @if($agent->description)
                        <div class="info-item">
                            <div class="info-label">Description</div>
                            <div class="info-value">{{ $agent->description }}</div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Complaints Table -->
                <div class="col-lg-8 mb-4">
                    <div class="complaints-table">
                        <div class="table-header">
                            <h5 class="mb-0">
                                <i class="fas fa-list me-2"></i>Assigned Complaints
                            </h5>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                              <tr>
                                        <th>Complaint #</th>
                                        <th>Town</th>
                                        <th>Sub Type</th>
                                        <th>Description</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Image</th>
                              </tr>
                            </thead>
                            <tbody id="complaints-table-body">
                                @forelse ($assignedComplaints as $key => $row)
                                    @if ($row->complaints != null)
                                        <tr>
                                            <td>
                                                <p class="mb-0 fw-bold text-primary">{{ $row->complaints->comp_num }}</p>
                                            </td>
                                            <td>
                                                    <p class="mb-0 fw-bold">{{ $row->complaints->town->town }}</p>
                                                    @if($row->complaints->subtown)
                                                        <small class="text-muted">{{ $row->complaints->subtown->title }}</small>
                                                    @endif
                                            </td>
                                                <td>
                                                    <span class="badge bg-info text-dark">{{ $row->complaints->subtype?->title ?? 'N/A' }}</span>
                                                </td>
                                            <td>
                                                    <p class="mb-0 text-truncate" style="max-width: 200px;" title="{{ $row->complaints->description }}">
                                                        {{ $row->complaints->description }}
                                                    </p>
                                            </td>
                                            <td class="text-center">
                                                <span class="status-badge
                                                    @if($row->complaints->status == 0) status-pending
                                                    @elseif($row->complaints->status == 1) status-completed
                                                    @else status-progress @endif">
                                                    @if ($row->complaints->status == 1)
                                                        <i class="fas fa-check-circle me-1"></i>Completed
                                                    @elseif($row->complaints->status == 0)
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                    @else
                                                        <i class="fas fa-spinner me-1"></i>WIP
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($row->complaints->image != NULL)
                                                    <img src="{{ asset('storage/'.$row->complaints->image) }}"
                                                         class="complaint-image"
                                                         data-bs-toggle="modal"
                                                         data-bs-target="#imageModal"
                                                         data-src="{{ asset('storage/'.$row->complaints->image) }}">
                                                @else
                                                    <div class="complaint-image bg-light d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p class="mb-0">No complaints assigned to this agent</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Table Paging" class="mb-0 text-muted">
                            <ul class="pagination justify-content-center mb-0" id="complaints-pagination">
                                <!-- Pagination will be generated here -->
                            </ul>
                        </nav>
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
                <h5 class="modal-title" id="imageModalLabel">Complaint Image</h5>
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
        // Image modal functionality
        $('.complaint-image').click(function() {
            const imageSrc = $(this).data('src');
            if (imageSrc) {
                $('#modalImage').attr('src', imageSrc);
            }
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Generate initial pagination
        generateInitialPagination();
    });

    // Pagination functions
    function fetchComplaintsOnClick(page) {
        $.ajax({
            url: "{{ route('agent-management.details', $agent->id) }}",
            type: "GET",
            data: {
                type: 'ajax',
                page: page
            },
            success: function(response) {
                generateComplaintsTableRows(response.data);
                generateComplaintsPagination(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching complaints:", error);
            }
        });
    }

    function generateComplaintsTableRows(response) {
        var html = '';
        $.each(response, function(index, row) {
            if (row.complaints != null) {
                html += '<tr>';
                html += '<td>';
                html += '<p class="mb-0 fw-bold text-primary">' + row.complaints.comp_num + '</p>';
                html += '</td>';
                html += '<td>';
                html += '<p class="mb-0 fw-bold">' + (row.complaints.town ? row.complaints.town.town : 'N/A') + '</p>';
                if (row.complaints.subtown) {
                    html += '<small class="text-muted">' + row.complaints.subtown.title + '</small>';
                }
                html += '</td>';
                html += '<td>';
                html += '<span class="badge bg-info text-dark">' + (row.complaints.subtype ? row.complaints.subtype.title : 'N/A') + '</span>';
                html += '</td>';
                html += '<td>';
                html += '<p class="mb-0 text-truncate" style="max-width: 200px;" title="' + row.complaints.description + '">';
                html += row.complaints.description;
                html += '</p>';
                html += '</td>';
                html += '<td class="text-center">';
                var statusClass = '';
                var statusText = '';
                var statusIcon = '';
                if (row.complaints.status == 1) {
                    statusClass = 'status-completed';
                    statusText = 'Completed';
                    statusIcon = '<i class="fas fa-check-circle me-1"></i>';
                } else if (row.complaints.status == 0) {
                    statusClass = 'status-pending';
                    statusText = 'Pending';
                    statusIcon = '<i class="fas fa-clock me-1"></i>';
                } else {
                    statusClass = 'status-progress';
                    statusText = 'WIP';
                    statusIcon = '<i class="fas fa-spinner me-1"></i>';
                }
                html += '<span class="status-badge ' + statusClass + '">' + statusIcon + statusText + '</span>';
                html += '</td>';
                html += '<td class="text-center">';
                if (row.complaints.image != null) {
                    html += '<img src="{{ asset("storage/") }}/' + row.complaints.image + '" class="complaint-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="{{ asset("storage/") }}/' + row.complaints.image + '">';
                } else {
                    html += '<div class="complaint-image bg-light d-flex align-items-center justify-content-center"><i class="fas fa-image text-muted"></i></div>';
                }
                html += '</td>';
                html += '</tr>';
            }
        });

        if (html === '') {
            html = '<tr><td colspan="6" class="text-center py-4"><div class="text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><p class="mb-0">No complaints assigned to this agent</p></div></td></tr>';
        }

        $('#complaints-table-body').html(html);
    }

    function generateComplaintsPagination(response) {
        var html = '';
        var totalPages = response.last_page;
        var currentPage = response.current_page;

        var startPages = 2;
        var endPages = 2;
        var middlePages = 2;

        if (response.prev_page_url) {
            var pre = currentPage - 1;
            html += '<li class="page-item"><a onclick="fetchComplaintsOnClick(\'' + pre + '\')" href="javascript:void(0);" class="page-link">Previous</a></li>';
        }

        for (var i = 1; i <= startPages && i <= totalPages; i++) {
            html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
        }

        if (currentPage > startPages + middlePages + 1) {
            html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
        }

        var start = Math.max(startPages + 1, currentPage - middlePages);
        var end = Math.min(totalPages - endPages, currentPage + middlePages);

        for (var i = start; i <= end; i++) {
            html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
        }

        if (currentPage < totalPages - endPages - middlePages) {
            html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
        }

        for (var i = totalPages - endPages + 1; i <= totalPages; i++) {
            if (i > startPages) {
                html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
            }
        }

        if (response.next_page_url) {
            var nxt = currentPage + 1;
            html += '<li class="page-item"><a class="page-link" onclick="fetchComplaintsOnClick(\'' + nxt + '\')" href="javascript:void(0);">Next</a></li>';
        }

        $('#complaints-pagination').html(html);
    }

    function generateInitialPagination() {
        // Get pagination data from the initial page load
        var totalPages = {{ $assignedComplaints->lastPage() }};
        var currentPage = {{ $assignedComplaints->currentPage() }};
        var hasNextPage = {{ $assignedComplaints->hasMorePages() ? 'true' : 'false' }};
        var hasPrevPage = {{ $assignedComplaints->currentPage() > 1 ? 'true' : 'false' }};

        var html = '';
        var startPages = 2;
        var endPages = 2;
        var middlePages = 2;

        if (hasPrevPage) {
            var pre = currentPage - 1;
            html += '<li class="page-item"><a onclick="fetchComplaintsOnClick(\'' + pre + '\')" href="javascript:void(0);" class="page-link">Previous</a></li>';
        }

        for (var i = 1; i <= startPages && i <= totalPages; i++) {
            html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
        }

        if (currentPage > startPages + middlePages + 1) {
            html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
        }

        var start = Math.max(startPages + 1, currentPage - middlePages);
        var end = Math.min(totalPages - endPages, currentPage + middlePages);

        for (var i = start; i <= end; i++) {
            html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
        }

        if (currentPage < totalPages - endPages - middlePages) {
            html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
        }

        for (var i = totalPages - endPages + 1; i <= totalPages; i++) {
            if (i > startPages) {
                html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchComplaintsOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
            }
        }

        if (hasNextPage) {
            var nxt = currentPage + 1;
            html += '<li class="page-item"><a class="page-link" onclick="fetchComplaintsOnClick(\'' + nxt + '\')" href="javascript:void(0);">Next</a></li>';
        }

        $('#complaints-pagination').html(html);
    }
</script>
@endsection

