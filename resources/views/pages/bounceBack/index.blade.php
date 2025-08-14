@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title">Bounce Back Complaints Management</h2>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 my-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Bounce Back Complaints List</h5>
                            </div>

                            <!-- Filters -->
                            <div class="toolbar mb-3">
                                <div class="form-row">
                                    <div class="form-group col-auto mr-auto">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search" value="" placeholder="Search by complaint number, customer name...">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="type-filter" class="sr-only">Type</label>
                                        <select class="form-control select2" id="type-filter">
                                            <option value="">All Types</option>
                                            <option value="agent">Mobile Agent</option>
                                            <option value="department">Department</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="status-filter" class="sr-only">Status</label>
                                        <select class="form-control select2" id="status-filter">
                                            <option value="">All Status</option>
                                            <option value="active">Active</option>
                                            <option value="resolved">Resolved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Complaint Number</th>
                                                    <th>Customer Name</th>
                                                    <th>Agent/Department</th>
                                                    <th>Mobile/Contact</th>
                                                    <th>Bounce Back Time</th>
                                                    <th>Complaint Status</th>
                                                    <th>Assignment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bounce-back-table-body">
                                                <!-- Data will be loaded via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <nav aria-label="Table Paging" class="mb-0 text-muted">
                                        <ul class="pagination justify-content-center mb-0" id="bounce-back-pagination">
                                            <!-- Pagination will be generated via JavaScript -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="assignmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmentModalLabel">Assign Complaint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignmentForm">
                    <input type="hidden" id="complaint_id" name="complaint_id">
                    <div class="form-group">
                        <label for="assignment_type">Assignment Type</label>
                        <select class="form-control" id="assignment_type" name="assignment_type" required>
                            <option value="">Select Assignment Type</option>
                            <option value="agent">Mobile Agent</option>
                            <option value="department">Department</option>
                        </select>
                    </div>
                    <div class="form-group" id="agent_selection" style="display: none;">
                        <label for="agent_id">Select Mobile Agent</label>
                        <select class="form-control select2" id="agent_id" name="agent_id">
                            <option value="">Select Agent</option>
                        </select>
                    </div>
                    <div class="form-group" id="department_selection" style="display: none;">
                        <label for="department_id">Select Department</label>
                        <select class="form-control select2" id="department_id" name="department_id">
                            <option value="">Select Department</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="assignComplaint">Assign Complaint</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script>
    var search = null;
    var type_filter = null;
    var status_filter = null;

    $(document).ready(function() {
        fetchDataOnReady();

        // Search functionality
        $("#search").on("keyup", function() {
            search = $(this).val();
            fetchDataOnReady();
        });

        // Type filter
        $("#type-filter").on("change", function() {
            type_filter = $(this).val();
            fetchDataOnReady();
        });

        // Status filter
        $("#status-filter").on("change", function() {
            status_filter = $(this).val();
            fetchDataOnReady();
        });

        // Assignment type change
        $("#assignment_type").on("change", function() {
            var type = $(this).val();
            if (type === 'agent') {
                $("#agent_selection").show();
                $("#department_selection").hide();
                loadAgents();
            } else if (type === 'department') {
                $("#agent_selection").hide();
                $("#department_selection").show();
                loadDepartments();
            } else {
                $("#agent_selection").hide();
                $("#department_selection").hide();
            }
        });

        // Assign complaint
        $("#assignComplaint").on("click", function() {
            assignComplaint();
        });
    });

    function fetchDataOnReady() {
        $.ajax({
            url: "{{ route('bounce-back.index') }}",
            type: "GET",
            data: {
                type: 'ajax',
                search: search,
                type_filter: type_filter,
                status_filter: status_filter
            },
            success: function(response) {
                generateTableRows(response.data);
                generatePagination(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    function fetchDataOnClick(page) {
        $.ajax({
            url: "{{ route('bounce-back.index') }}",
            type: "GET",
            data: {
                type: 'ajax',
                search: search,
                type_filter: type_filter,
                status_filter: status_filter,
                page: page
            },
            success: function(response) {
                generateTableRows(response.data);
                generatePagination(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    function generateTableRows(response) {
        var html = '';
        $.each(response, function(index, row) {
            html += '<tr>';
            html += '<td><strong>' + row.complaint.comp_num + '</strong></td>';
            html += '<td>';
            if (row.complaint.customer_id != 0 && row.complaint.customer) {
                html += row.complaint.customer.customer_name;
            } else {
                html += row.complaint.customer_name;
            }
            html += '</td>';
            html += '<td>';
            if (row.type === 'agent') {
                html += '<span class="badge bg-info">Mobile Agent</span><br>';
                html += '<small>' + (row.mobile_agent ? row.mobile_agent.user.name : 'N/A') + '</small>';
            } else {
                html += '<span class="badge bg-primary">Department</span><br>';
                html += '<small>' + (row.department_user ? row.department_user.name : 'N/A') + '</small>';
            }
            html += '</td>';
            html += '<td>';
            if (row.type === 'agent' && row.mobile_agent && row.mobile_agent.user) {
                html += row.mobile_agent.user.phone || 'N/A';
            } else if (row.type === 'department' && row.department_user) {
                html += row.department_user.phone || 'N/A';
            } else {
                html += 'N/A';
            }
            html += '</td>';
            html += '<td>' + moment(row.bounced_at).format('DD/MM/YYYY HH:mm:ss') + '</td>';
            html += '<td>';
            if (row.complaint.status == 1) {
                html += '<span class="badge bg-success">Completed</span>';
            } else {
                html += '<span class="badge bg-danger">Pending</span>';
            }
            html += '</td>';
            html += '<td>';
            if (row.complaint.assigned_complaints || row.complaint.assigned_complaints_department) {
                html += '<span class="badge bg-warning">Already Assigned</span>';
            } else {
                html += '<span class="badge bg-secondary">Not Assigned</span>';
            }
            html += '</td>';
            html += '<td>';
            if (!row.complaint.assigned_complaints && !row.complaint.assigned_complaints_department) {
                html += '<button class="btn btn-sm btn-primary" onclick="openAssignmentModal(' + row.complaint.id + ')">Assign</button>';
            } else {
                html += '<span class="text-muted">-</span>';
            }
            html += ' <a href="' + "{{ route('bounce-back.detail', '') }}/" + row.complaint.id + '" class="btn btn-sm btn-info">View</a>';
            html += '</td>';
            html += '</tr>';
        });

        $('#bounce-back-table-body').html(html);
    }

    function generatePagination(response) {
        var html = '';
        var totalPages = response.last_page;
        var currentPage = response.current_page;

        if (response.prev_page_url) {
            html += '<li class="page-item"><a onclick="fetchDataOnClick(' + (currentPage - 1) + ')" href="javascript:void(0);" class="page-link">Previous</a></li>';
        }

        for (var i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 2 && i <= currentPage + 2)) {
                html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '">';
                html += '<a class="page-link" onclick="fetchDataOnClick(' + i + ')" href="javascript:void(0);">' + i + '</a>';
                html += '</li>';
            } else if (i === currentPage - 3 || i === currentPage + 3) {
                html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
        }

        if (response.next_page_url) {
            html += '<li class="page-item"><a class="page-link" onclick="fetchDataOnClick(' + (currentPage + 1) + ')" href="javascript:void(0);">Next</a></li>';
        }

        $('#bounce-back-pagination').html(html);
    }

    function openAssignmentModal(complaintId) {
        $('#complaint_id').val(complaintId);
        $('#assignment_type').val('');
        $('#agent_selection').hide();
        $('#department_selection').hide();
        $('#assignmentModal').modal('show');
    }

    function loadAgents() {
        $.ajax({
            url: "{{ route('bounce-back.get-agents') }}",
            type: "GET",
            success: function(response) {
                var html = '<option value="">Select Agent</option>';
                $.each(response, function(index, agent) {
                    html += '<option value="' + agent.id + '">' + agent.user.name + ' - ' + agent.town.town + '</option>';
                });
                $('#agent_id').html(html);
            },
            error: function() {
                console.log('Error loading agents');
            }
        });
    }

    function loadDepartments() {
        $.ajax({
            url: "{{ route('bounce-back.get-departments') }}",
            type: "GET",
            success: function(response) {
                var html = '<option value="">Select Department</option>';
                $.each(response, function(index, department) {
                    html += '<option value="' + department.id + '">' + department.name + '</option>';
                });
                $('#department_id').html(html);
            },
            error: function() {
                console.log('Error loading departments');
            }
        });
    }

    function assignComplaint() {
        var complaintId = $('#complaint_id').val();
        var assignmentType = $('#assignment_type').val();
        var agentId = $('#agent_id').val();
        var departmentId = $('#department_id').val();

        if (!assignmentType) {
            alert('Please select assignment type');
            return;
        }

        if (assignmentType === 'agent' && !agentId) {
            alert('Please select an agent');
            return;
        }

        if (assignmentType === 'department' && !departmentId) {
            alert('Please select a department');
            return;
        }

        $.ajax({
            url: "{{ route('bounce-back.assign') }}",
            type: "POST",
            data: {
                complaint_id: complaintId,
                assignment_type: assignmentType,
                agent_id: agentId,
                department_id: departmentId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('Complaint assigned successfully!');
                    $('#assignmentModal').modal('hide');
                    fetchDataOnReady(); // Refresh the table
                } else {
                    alert('Failed to assign complaint: ' + response.message);
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                if (response && response.message) {
                    alert('Error: ' + response.message);
                } else {
                    alert('An error occurred while assigning the complaint.');
                }
            }
        });
    }
</script>
@endsection
