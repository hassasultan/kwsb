@if(count($logs) > 0)
    @foreach($logs as $log)
        <tr>
            <td>
                <span class="text-secondary text-xs font-weight-bold">{{ $log->id }}</span>
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $log->user ? $log->user->name : 'N/A' }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $log->user ? $log->user->email : 'N/A' }}</p>
                    </div>
                </div>
            </td>
            <td>
                <span class="badge badge-sm bg-gradient-{{ $log->action == 'Complaint' ? 'primary' : ($log->action == 'User' ? 'success' : ($log->action == 'System' ? 'warning' : 'info')) }}">
                    {{ $log->action }}
                </span>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">
                    @if($log->action == 'Complaint' && $log->complaint)
                        <a href="{{ route('compaints-management.details', $log->action_id) }}" class="text-primary">
                            {{ $log->complaint->comp_num }}
                        </a>
                    @else
                        {{ $log->action_id }}
                    @endif
                </span>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    {{ Str::limit($log->action_detail, 50) }}
                </p>
                @if(strlen($log->action_detail) > 50)
                    <p class="text-xs text-secondary mb-0">
                        <a href="#" class="text-primary" onclick="showFullDetail({{ $log->id }})">View Full</a>
                    </p>
                @endif
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">
                    {{ $log->created_at->format('M d, Y H:i') }}
                </span>
            </td>
            <td class="align-middle">
                <a href="{{ route('admin.logs.detail', $log->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">
            <div class="d-flex flex-column align-items-center py-4">
                <i class="fa fa-info-circle text-secondary mb-2" style="font-size: 2rem;"></i>
                <p class="text-secondary mb-0">No logs found matching your criteria</p>
            </div>
        </td>
    </tr>
@endif

<!-- Pagination links for AJAX -->
<div id="pagination-container" class="mt-3">
    {!! $logs->links() !!}
</div>

<!-- Modal for full detail view -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Log Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function showFullDetail(logId) {
    // Load the full detail via AJAX
    $.ajax({
        url: '{{ route("admin.logs.detail", ":id") }}'.replace(':id', logId),
        type: 'GET',
        success: function(response) {
            $('#detailModalBody').html(response);
            $('#detailModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error loading detail:', error);
            $('#detailModalBody').html('<div class="text-center text-danger">Error loading detail. Please try again.</div>');
            $('#detailModal').modal('show');
        }
    });
}
</script>
