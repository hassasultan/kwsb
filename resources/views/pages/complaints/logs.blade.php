@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title mb-1">Complaint Timeline & Logs</h2>
                    <p class="text-muted mb-0">Complete audit trail for complaint #{{ $complaint->comp_num }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('compaints-management.details', $complaint->id) }}" class="btn btn-info">
                        <i class="fe fe-eye fe-16 mr-2"></i>View Complaint
                    </a>
                    <a href="{{ request()->get('from_request') == '1' ? route('compaints-management.index', ['comp_type_id' => [1,2,5]]) : route('compaints-management.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>

            <!-- Complaint Summary Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="complaint-status-badge me-3">
                                            @if($complaint->status == 1)
                                                <span class="badge bg-success fs-6 px-3 py-2">
                                                    <i class="fe fe-check-circle fe-16 mr-2"></i>Resolved
                                                </span>
                                            @else
                                                <span class="badge bg-warning fs-6 px-3 py-2">
                                                    <i class="fe fe-clock fe-16 mr-2"></i>Pending
                                                </span>
                                            @endif
                                        </div>
                                        <h4 class="mb-0 text-primary">#{{ $complaint->comp_num }}</h4>
                                    </div>
                                    <h5 class="mb-2">
                                        @if($complaint->customer_id != 0 && $complaint->customer)
                                            {{ $complaint->customer->customer_name }}
                                        @else
                                            {{ $complaint->customer_name }}
                                        @endif
                                    </h5>
                                    <p class="text-muted mb-2">
                                        <i class="fe fe-map-pin fe-14 mr-2"></i>
                                        {{ $complaint->town->town ?? 'N/A' }}
                                        @if($complaint->subtown)
                                            - {{ $complaint->subtown->title }}
                                        @endif
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="fe fe-tag fe-14 mr-2"></i>
                                        {{ $complaint->type->title ?? 'N/A' }}
                                        @if($complaint->subtype)
                                            > {{ $complaint->subtype->title }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <div class="text-muted mb-2">
                                        <small>Created</small><br>
                                        <strong>{{ $complaint->created_at->format('M d, Y \a\t h:i A') }}</strong>
                                    </div>
                                    @if($complaint->status == 1)
                                        <div class="text-success">
                                            <small>Resolved</small><br>
                                            <strong>{{ $complaint->updated_at->format('M d, Y \a\t h:i A') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fe fe-activity fe-16 mr-2 text-primary"></i>
                                Complete Activity Timeline
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <!-- Timeline Container -->
                            <div class="timeline-container p-4">
                                @if($logs && count($logs) > 0)
                                    @foreach($logs as $index => $log)
                                        <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                                            <div class="timeline-marker">
                                                @switch($log->log_type)
                                                    @case('Complaint')
                                                        <div class="marker-icon complaint-marker">
                                                            <i class="fe fe-file-text fe-16"></i>
                                                        </div>
                                                        @break
                                                    @case('BounceBack')
                                                        <div class="marker-icon bounceback-marker">
                                                            <i class="fe fe-rotate-ccw fe-16"></i>
                                                        </div>
                                                        @break
                                                    @case('User')
                                                        <div class="marker-icon user-marker">
                                                            <i class="fe fe-user fe-16"></i>
                                                        </div>
                                                        @break
                                                    @case('Agent')
                                                        <div class="marker-icon agent-marker">
                                                            <i class="fe fe-users fe-16"></i>
                                                        </div>
                                                        @break
                                                    @default
                                                        <div class="marker-icon default-marker">
                                                            <i class="fe fe-activity fe-16"></i>
                                                        </div>
                                                @endswitch
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-header">
                                                    <h6 class="mb-1">{{ $log->log_type }}</h6>
                                                    <span class="timeline-time">
                                                        {{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y \a\t h:i A') }}
                                                    </span>
                                                </div>
                                                <div class="timeline-body">
                                                    <p class="mb-2">{{ $log->action_detail }}</p>
                                                    @if($log->user)
                                                        <div class="timeline-user">
                                                            <small class="text-muted">
                                                                <i class="fe fe-user fe-12 mr-1"></i>
                                                                {{ $log->user->name }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fe fe-activity fe-48 text-muted mb-3"></i>
                                            <h5 class="text-muted">No Activity Logs Found</h5>
                                            <p class="text-muted">This complaint doesn't have any activity logs yet.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-gradient-primary text-white">
                        <div class="card-body text-center">
                            <i class="fe fe-activity fe-32 mb-3"></i>
                            <h4 class="mb-1">{{ $logs ? count($logs) : 0 }}</h4>
                            <p class="mb-0">Total Activities</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-gradient-success text-white">
                        <div class="card-body text-center">
                            <i class="fe fe-calendar fe-32 mb-3"></i>
                            <h4 class="mb-1">{{ $complaint->created_at->diffForHumans() }}</h4>
                            <p class="mb-0">Age</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-gradient-info text-white">
                        <div class="card-body text-center">
                            <i class="fe fe-clock fe-32 mb-3"></i>
                            <h4 class="mb-1">
                                @if($complaint->status == 1)
                                    {{ $complaint->created_at->diffInHours($complaint->updated_at) }}h
                                @else
                                    {{ $complaint->created_at->diffInHours(now()) }}h
                                @endif
                            </h4>
                            <p class="mb-0">Duration</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-gradient-warning text-white">
                        <div class="card-body text-center">
                            <i class="fe fe-rotate-ccw fe-32 mb-3"></i>
                            <h4 class="mb-1">{{ $bounceBacks ? count($bounceBacks) : 0 }}</h4>
                            <p class="mb-0">Bounce Backs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Timeline Styles */
.timeline-container {
    position: relative;
    padding: 20px 0;
}

.timeline-container::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(180deg, #e3f2fd 0%, #2196f3 50%, #e3f2fd 100%);
    transform: translateX(-50%);
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
    width: 100%;
}

.timeline-item.left {
    padding-right: 50%;
}

.timeline-item.right {
    padding-left: 50%;
}

.timeline-marker {
    position: absolute;
    left: 50%;
    top: 0;
    transform: translateX(-50%);
    z-index: 2;
}

.marker-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border: 4px solid white;
}

.complaint-marker {
    background: linear-gradient(135deg, #4caf50, #66bb6a);
}

.bounceback-marker {
    background: linear-gradient(135deg, #ff9800, #ffb74d);
}

.user-marker {
    background: linear-gradient(135deg, #2196f3, #64b5f6);
}

.agent-marker {
    background: linear-gradient(135deg, #9c27b0, #ba68c8);
}

.default-marker {
    background: linear-gradient(135deg, #607d8b, #90a4ae);
}

.timeline-content {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    position: relative;
    transition: all 0.3s ease;
}

.timeline-content:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.timeline-item.left .timeline-content {
    margin-right: 20px;
}

.timeline-item.right .timeline-content {
    margin-left: 20px;
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.timeline-header h6 {
    color: #333;
    font-weight: 600;
    margin: 0;
}

.timeline-time {
    font-size: 12px;
    color: #666;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 6px;
}

.timeline-body p {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

.timeline-user {
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid #f0f0f0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .timeline-container::before {
        left: 30px;
    }

    .timeline-item.left,
    .timeline-item.right {
        padding-left: 60px;
        padding-right: 0;
    }

    .timeline-marker {
        left: 30px;
    }

    .timeline-content {
        margin: 0 0 0 20px !important;
    }
}

/* Card Enhancements */
.card {
    border-radius: 16px;
    overflow: hidden;
}

.card-header {
    border-bottom: 1px solid #f0f0f0;
}

/* Gradient Backgrounds */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

/* Empty State */
.empty-state {
    padding: 40px 20px;
}

.empty-state i {
    opacity: 0.5;
}

/* Animation */
.timeline-item {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.timeline-item:nth-child(1) { animation-delay: 0.1s; }
.timeline-item:nth-child(2) { animation-delay: 0.2s; }
.timeline-item:nth-child(3) { animation-delay: 0.3s; }
.timeline-item:nth-child(4) { animation-delay: 0.4s; }
.timeline-item:nth-child(5) { animation-delay: 0.5s; }

/* Hover Effects */
.timeline-content:hover .timeline-header h6 {
    color: #2196f3;
}

.marker-icon:hover {
    transform: translateX(-50%) scale(1.1);
    transition: transform 0.3s ease;
}

/* Status Badge Enhancements */
.complaint-status-badge .badge {
    border-radius: 20px;
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Statistics Cards */
.card.bg-gradient-primary,
.card.bg-gradient-success,
.card.bg-gradient-info,
.card.bg-gradient-warning {
    transition: all 0.3s ease;
}

.card.bg-gradient-primary:hover,
.card.bg-gradient-success:hover,
.card.bg-gradient-info:hover,
.card.bg-gradient-warning:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all timeline items
    document.querySelectorAll('.timeline-item').forEach(item => {
        observer.observe(item);
    });

    // Add click effects to timeline items
    document.querySelectorAll('.timeline-content').forEach(content => {
        content.addEventListener('click', function() {
            this.style.transform = 'scale(1.02)';
            setTimeout(() => {
                this.style.transform = 'translateY(-2px)';
            }, 150);
        });
    });
});
</script>
@endsection
