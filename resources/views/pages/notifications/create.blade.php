@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title">Send New Notification</h2>
                <a href="{{ route('admin.notification.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Notifications
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Notification Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.notification.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Notification Title *</label>
                                            <input type="text"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   id="title"
                                                   name="title"
                                                   value="{{ old('title') }}"
                                                   required
                                                   maxlength="255">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="type" class="form-label">Notification Type *</label>
                                            <select class="form-control @error('type') is-invalid @enderror"
                                                    id="type"
                                                    name="type"
                                                    required>
                                                <option value="">Select Type</option>
                                                <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>General</option>
                                                <option value="urgent" {{ old('type') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                                <option value="reminder" {{ old('type') == 'reminder' ? 'selected' : '' }}>Reminder</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="body" class="form-label">Notification Message *</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror"
                                              id="body"
                                              name="body"
                                              rows="4"
                                              required>{{ old('body') }}</textarea>
                                    @error('body')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="recipient_type" class="form-label">Recipient Type *</label>
                                            <select class="form-control @error('recipient_type') is-invalid @enderror"
                                                    id="recipient_type"
                                                    name="recipient_type"
                                                    required>
                                                <option value="">Select Recipient Type</option>
                                                <option value="all" {{ old('recipient_type') == 'all' ? 'selected' : '' }}>All Agents</option>
                                                <option value="agent" {{ old('recipient_type') == 'agent' ? 'selected' : '' }}>Specific Agent</option>
                                                <option value="town" {{ old('recipient_type') == 'town' ? 'selected' : '' }}>Town Based</option>
                                                <option value="type" {{ old('recipient_type') == 'type' ? 'selected' : '' }}>Type Based</option>
                                            </select>
                                            @error('recipient_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3" id="recipient_id_group" style="display: none;">
                                            <label for="recipient_id" class="form-label">Recipient *</label>
                                            <select class="form-control @error('recipient_id') is-invalid @enderror"
                                                    id="recipient_id"
                                                    name="recipient_id">
                                                <option value="">Select Recipient</option>
                                            </select>
                                            @error('recipient_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="data" class="form-label">Additional Data (Optional)</label>
                                    <textarea class="form-control @error('data') is-invalid @enderror"
                                              id="data"
                                              name="data"
                                              rows="3"
                                              placeholder='{"key": "value"}'>{{ old('data') }}</textarea>
                                    <small class="form-text text-muted">Enter valid JSON data (optional)</small>
                                    @error('data')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-info" id="test-notification">
                                        <i class="fa fa-paper-plane"></i> Send Test
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-send"></i> Send Notification
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Stats</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="text-primary mb-1">{{ $agents->count() }}</h4>
                                        <small class="text-muted">Total Agents</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="text-success mb-1">{{ $towns->count() }}</h4>
                                        <small class="text-muted">Total Towns</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="text-info mb-1">{{ $types->count() }}</h4>
                                        <small class="text-muted">Agent Types</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="text-warning mb-1">{{ $agents->where('user.device_token', '!=', null)->count() }}</h4>
                                        <small class="text-muted">Active Tokens</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Help</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>All Agents:</strong> Sends to all registered agents
                                </li>
                                <li class="mb-2">
                                    <strong>Specific Agent:</strong> Sends to a single agent
                                </li>
                                <li class="mb-2">
                                    <strong>Town Based:</strong> Sends to all agents in a specific town
                                </li>
                                <li class="mb-2">
                                    <strong>Type Based:</strong> Sends to all agents of a specific type
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Notification Modal -->
<div class="modal fade" id="testNotificationModal" tabindex="-1" aria-labelledby="testNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testNotificationModalLabel">Test Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="test-result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('bottom_script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipientTypeSelect = document.getElementById('recipient_type');
    const recipientIdGroup = document.getElementById('recipient_id_group');
    const recipientIdSelect = document.getElementById('recipient_id');
    const testButton = document.getElementById('test-notification');

    // Show/hide recipient ID field based on recipient type
    recipientTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;

        if (selectedType === 'all') {
            recipientIdGroup.style.display = 'none';
            recipientIdSelect.value = '';
        } else {
            recipientIdGroup.style.display = 'block';
            updateRecipientOptions(selectedType);
        }
    });

    function updateRecipientOptions(type) {
        recipientIdSelect.innerHTML = '<option value="">Select Recipient</option>';

        if (type === 'agent') {
            @foreach($agents as $agent)
                recipientIdSelect.innerHTML += '<option value="{{ $agent->id }}">{{ $agent->user->name }} ({{ $agent->town->town }})</option>';
            @endforeach
        } else if (type === 'town') {
            @foreach($towns as $town)
                recipientIdSelect.innerHTML += '<option value="{{ $town->id }}">{{ $town->town }}</option>';
            @endforeach
        } else if (type === 'type') {
            @foreach($types as $type)
                recipientIdSelect.innerHTML += '<option value="{{ $type->id }}">{{ $type->title }}</option>';
            @endforeach
        }
    }

    // Test notification functionality
    testButton.addEventListener('click', function() {
        const title = document.getElementById('title').value;
        const body = document.getElementById('body').value;
        const recipientType = document.getElementById('recipient_type').value;
        const recipientId = document.getElementById('recipient_id').value;

        if (!title || !body || !recipientType) {
            alert('Please fill in all required fields before testing');
            return;
        }

        if (recipientType !== 'all' && !recipientId) {
            alert('Please select a recipient before testing');
            return;
        }

        // Show loading state
        testButton.disabled = true;
        testButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending...';

        // Send test notification
        fetch('{{ route("admin.notification.send-test") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                title: title,
                body: body,
                recipient_type: recipientType,
                recipient_id: recipientId
            })
        })
        .then(response => response.json())
        .then(data => {
            const modal = new bootstrap.Modal(document.getElementById('testNotificationModal'));
            const resultDiv = document.getElementById('test-result');

            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="alert alert-success">
                        <h6><i class="fa fa-check-circle"></i> Test Successful!</h6>
                        <p>${data.message}</p>
                        <small>Recipients: ${data.result.success_count}</small>
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <h6><i class="fa fa-exclamation-circle"></i> Test Failed</h6>
                        <p>${data.message}</p>
                    </div>
                `;
            }

            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the test notification');
        })
        .finally(() => {
            // Reset button state
            testButton.disabled = false;
            testButton.innerHTML = '<i class="fa fa-paper-plane"></i> Send Test';
        });
    });

    // Initialize recipient options if there's a pre-selected value
    if (recipientTypeSelect.value && recipientTypeSelect.value !== 'all') {
        updateRecipientOptions(recipientTypeSelect.value);
        recipientIdGroup.style.display = 'block';
    }
});
</script>
@endsection
