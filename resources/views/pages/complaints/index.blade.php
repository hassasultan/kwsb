@extends('layouts.app')

@section('content')
    <style>
        .skeleton-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .skeleton-table {
            width: 100%;
            border-collapse: collapse;
        }

        .skeleton-table th,
        .skeleton-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .skeleton-item {
            background-color: #f0f0f0;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .skeleton-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .skeleton-content {
            padding: 20px;
        }

        .skeleton-line {
            height: 12px;
            margin-bottom: 10px;
            background-color: #ddd;
            border-radius: 5px;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title" id="page-title">Complaint Management</h2>
                {{-- <p> Tables with built-in bootstrap styles </p> --}}
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('compaints-management.create') }}">add</i>&nbsp;&nbsp;<i
                            class="fa fa-user"></i></a>
                </div>
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 id="list-title">
                                        Complaints List
                                    </h5>
                                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p> --}}
                                </div>
                                <div class="toolbar">
                                    {{-- <form class="form"> --}}
                                    <div class="form-row">
                                        <div class="form-group col-auto mr-auto">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Town</label>
                                            <select class="form-control select2" id="town-id">
                                                <option value=""> ALL TOWNS</option>
                                                @foreach ($town as $row)
                                                    <option value="{{ $row->id }}"> {{ $row->town }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Complaint Type</label>
                                            <select class="form-control select2" id="type-id">
                                            <option value="">Complaint Type</option>
                                                @foreach ($comptype as $row)
                                                    <option value="{{ $row->id }}"> {{ $row->title }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Status</label>
                                            <select class="form-control select2" id="status-id">
                                            <option value="">Assigned Status</option>   
                                                <option value="1"> Assigned</option>
                                                <option value="0">Not Assigned Yet</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Status Pending/Solve</label>
                                            <select class="form-control select2" id="comp-status-id">
                                            <option value="">Complaint Status</option>
                                                <option value="1"> Completed</option>
                                                <option value="2"> Work In Progress</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Search</label>
                                            <input type="text" class="form-control" id="search1" value=""
                                                placeholder="Search">
                                        </div>
                                    </div>
                                    
                                    <!-- New Filters Row -->
                                    <div class="form-row mt-3 justify-content-end">
                                        <div class="form-group col-auto">
                                            <label for="source" class="sr-only">Source</label>
                                            <select class="form-control select2" id="source">
                                                <option value="">All Sources</option>
                                                @foreach ($sources as $row)
                                                    <option value="{{ $row->title }}">{{ $row->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="consumer_number" class="sr-only">Consumer Number</label>
                                            <input type="text" class="form-control" id="consumer_number" value=""
                                                placeholder="Consumer Number">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="bounce_back" class="sr-only">Bounce Back Status</label>
                                            <select class="form-control select2" id="bounce_back">
                                                <option value="">All</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="from_date" class="sr-only">From Date</label>
                                            <input type="date" class="form-control" id="from_date">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="to_date" class="sr-only">To Date</label>
                                            <input type="date" class="form-control" id="to_date">
                                        </div>
                                        <div class="form-group col-auto">
                                            <button type="button" class="btn btn-primary" id="search-btn">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                        <div class="form-group col-auto">
                                            <button type="button" class="btn btn-secondary" id="reset-btn">
                                                <i class="fa fa-refresh"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                    {{-- </form> --}}
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 skeleton-container">
                                        <table class="skeleton-table table table-borderless table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Compaint ID</th>
                                                    <th>
                                                        Consumer Number</th>
                                                    <th>
                                                        Consumer Name</th>
                                                    <th>
                                                        Town</th>
                                                    <th>
                                                        Complaint Type / Priority</th>
                                                    {{-- <th>
                                                        Title Description</th> --}}
                                                    <th>
                                                        Picture</th>
                                                    <th>
                                                        Created At</th>
                                                    <th>
                                                        Resolve Date</th>
                                                    <th>
                                                        Source</th>
                                                    <th>
                                                        Status</th>
                                                    <th>
                                                        Re-assigned</th>
                                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                                    <th class="text-secondary opacity-7">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="user-table-body">
                                                {{-- @if (count($user) > 0) --}}
                                                @foreach ($complaint as $key => $row)
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <tr>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                            <td class="skeleton-item">
                                                                <div class="skeleton-content">
                                                                    <div class="skeleton-line" style="width: 100%;"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <nav aria-label="Table Paging" class="mb-0 text-muted">
                                            <ul class="pagination justify-content-center mb-0" id="user-pagination">
                                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            var search = null;
            var town = null;
            var type = null;
            var type_ids = [];
            var change_status = null;
            var comp_status = null;
            var source = null;
            var consumer_number = null;
            var bounce_back_status = null;
            var from_date = null;
            var to_date = null;

            function updateStatus(id, element) {
                console.log($(element).val());
                if ($(element).val() == 0 || $(element).val() == 2) {
                    const complaintId = id;

                    // AJAX request
                    $.ajax({
                        url: '/admin/complaints/update-status', // Laravel route URL
                        method: 'POST',
                        data: {
                            complaint_id: complaintId,
                            status: $(element).val(),
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Complaint status updated successfully!');
                            } else {
                                alert('Failed to update complaint status.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while updating the status.');
                        }
                    });
                }

            }
            $(document).ready(function() {

                // Initialize types from URL param `comp_type_id[]` or repeated `comp_type_id`
                try {
                    var urlParams = new URLSearchParams(window.location.search);
                    var arrA = urlParams.getAll('comp_type_id[]');
                    var arrB = urlParams.getAll('comp_type_id');
                    var collected = arrA.length ? arrA : arrB;
                    if (collected.length === 1 && String(collected[0]).indexOf(',') !== -1) {
                        collected = String(collected[0]).split(',');
                    }
                    type_ids = collected.filter(function(v){ return v !== null && v !== ''; }).map(function(v){ return v.trim(); });
                    if (type_ids.length > 0) {
                        type = type_ids[0];
                        $('#type-id').val(type).trigger('change');
                        // Update headings to Requests if comp_type_id is present
                        $('#page-title').text('Requests Management');
                        $('#list-title').text('Requests List');
                    } else {
                        $('#page-title').text('Complaint Management');
                        $('#list-title').text('Complaints List');
                    }
                } catch (e) {}

                $("input").keyup(function() {
                    search = $(this).val();
                });
                $("#town-id").change(function() {
                    town = $(this).val();
                });
                $("#type-id").change(function() {
                    type = $(this).val();
                    type_ids = [];
                    if (type !== null && type !== '') { type_ids.push(type); }
                });
                $("#status-id").change(function() {
                    change_status = $(this).val();
                });
                $("#comp-status-id").change(function() {
                    comp_status = $(this).val();
                });
                
                // New filter event handlers
                $("#source").change(function() {
                    source = $(this).val();
                    console.log("Source changed to:", source);
                });
                
                $("#consumer_number").on('input', function() {
                    consumer_number = $(this).val();
                    console.log("Consumer number changed to:", consumer_number);
                });
                
                $("#bounce_back").change(function() {
                    bounce_back_status = $(this).val();
                    console.log("Bounce back changed to:", bounce_back_status);
                });
                
                $("#from_date").change(function() {
                    from_date = $(this).val();
                    console.log("From date changed to:", from_date);
                });
                
                $("#to_date").change(function() {
                    to_date = $(this).val();
                    console.log("To date changed to:", to_date);
                });
                
                // Search button click handler
                $("#search-btn").click(function() {
                    fetchDataOnReady();
                });
                
                // Reset button click handler
                $("#reset-btn").click(function() {
                    // Reset all filter values
                    search = null;
                    town = null;
                    type = null;
                    type_ids = [];
                    change_status = null;
                    comp_status = null;
                    source = null;
                    consumer_number = null;
                    bounce_back_status = null;
                    from_date = null;
                    to_date = null;
                    
                    // Reset form fields
                    $("#search1").val('');
                    $("#town-id").val('').trigger('change');
                    $("#type-id").val('').trigger('change');
                    $("#status-id").val('').trigger('change');
                    $("#comp-status-id").val('').trigger('change');
                    $("#source").val('').trigger('change');
                    $("#consumer_number").val('');
                    $("#bounce_back").val('').trigger('change');
                    $("#from_date").val('');
                    $("#to_date").val('');
                    
                    // Fetch data with reset filters
                    fetchDataOnReady();
                });
                
                // Call the function on document ready - moved here
                fetchDataOnReady();

            });

            function fetchDataOnClick(page) {
                console.log("Fetching data on click with filters:", {
                    search: search,
                    town: town,
                    type_id: type,
                    comp_type_id: type_ids,
                    status: change_status,
                    comp_status: comp_status,
                    source: source,
                    consumer_number: consumer_number,
                    bounce_back: bounce_back_status,
                    from_date: from_date,
                    to_date: to_date,
                    page: page
                });
                
                // Only send comp_type_id if we're actually on request management page
                var ajaxData = {
                        type: 'ajax',
                        search: search,
                        town: town,
                        type_id: type,
                        status: change_status,
                        comp_status: comp_status,
                        source: source,
                        consumer_number: consumer_number,
                        bounce_back: bounce_back_status,
                        from_date: from_date,
                        to_date: to_date,
                        page: page
                };
                
                // Only add comp_type_id if we're on request management page (URL has comp_type_id)
                if (window.location.search.includes('comp_type_id')) {
                    ajaxData.comp_type_id = type_ids;
                }
                
                $.ajax({
                    url: "{{ route('compaints-management.index') }}",
                    type: "GET",
                    data: ajaxData,
                    success: function(response) {
                        console.log("Data fetched successfully on click:", response);
                        generateTableRows(response
                            .data); // Assuming data is returned as 'data' property in the response
                        generatePagination(response); // Pass the entire response to generate pagination
                        // Process the response data as needed
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data on click:", error);
                    }
                });
            }
            // Function to send AJAX request on document ready
            function fetchDataOnReady() {
                console.log("Fetching data with filters:", {
                    search: search,
                    status: change_status,
                    town: town,
                    type_id: type,
                    comp_type_id: type_ids,
                    comp_status: comp_status,
                    source: source,
                    consumer_number: consumer_number,
                    bounce_back: bounce_back_status,
                    from_date: from_date,
                    to_date: to_date
                });
                
                // Only send comp_type_id if we're actually on request management page
                var ajaxData = {
                        type: 'ajax',
                        search: search,
                        status: change_status,
                        town: town,
                        type_id: type,
                        comp_status: comp_status,
                        source: source,
                        consumer_number: consumer_number,
                        bounce_back: bounce_back_status,
                        from_date: from_date,
                        to_date: to_date
                };
                
                // Only add comp_type_id if we're on request management page (URL has comp_type_id)
                if (window.location.search.includes('comp_type_id')) {
                    ajaxData.comp_type_id = type_ids;
                }
                
                $.ajax({
                    url: "{{ route('compaints-management.index') }}",
                    type: "GET",
                    data: ajaxData,
                    success: function(response) {
                        console.log("Data fetched successfully on document ready:", response);
                        $('#user-table-body').empty(); // Clear existing content
                        generateTableRows(response
                            .data); // Assuming data is returned as 'data' property in the response
                        generatePagination(response);
                        // Process the response data as needed
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data on document ready:", error);
                    }
                });
            }

            // Function to generate table rows
            function generateTableRows(response) {
                var html = '';
                const currentUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                $.each(response, function(index, row) {
                    html += '<tr>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + row.comp_num + '</p>';
                    html += '</td>';
                    html += '<td class="w-20">';
                    if (row.customer_id != 0) {
                        html += '<p class="text-xs font-weight-bold mb-0">' + row.customer.customer_id + '</p>';
                    } else {
                        html += '<p class="text-xs font-weight-bold mb-0">' + row.customer_num + '</p>';
                    }
                    html += '</td>';
                    html += '<td class="w-20">';
                    if (row.customer_id != 0) {
                        html += '<p class="text-xs font-weight-bold mb-0">' + row.customer.customer_name + '</p>';
                    } else {
                        html += '<p class="text-xs font-weight-bold mb-0">' + row.customer_name + '</p>';
                    }
                    html += '</td>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + row.town.town + ' (' + (row.subtown ? row
                        .subtown.title : '') + ')</p>';
                    html += '</td>';
                    html += '<td>';
                    html += '<p class="text-xs font-weight-bold mb-0">' + (row.type ? row.type.title : '') + '</p>';
                    html += '<p class="text-xs font-weight-bold mb-0">' + (row.prio ? row.prio.title : '') + '</p>';
                    html += '</td>';
                    // html += '<td class="align-middle text-center text-sm">';
                    // html += '<p class="text-xs text-secondary mb-0">' + row.title + '</p>';
                    // html += '</td>';
                    html += '<td class="align-middle text-center text-sm">';
                    if (row.image != null) {
                        html += '<img src="{{ asset('storage/') }}/' + row.image +
                            '" class="img-fluid" style="width: 70px; height: 70px;" />';
                    } else {
                        html += 'Not Available';
                    }
                    html += '</td>';
                    html += '<td class="text-center">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + moment(row.created_at).format(
                        'DD/MM/YYYY hh:mm A') + '</p>';
                    html += '</td>';
                    html += '<td class="text-center">';
                    if (row.status == 1) {
                        html += '<p class="text-xs font-weight-bold mb-0">' + moment(row.updated_at).format(
                            'DD/MM/YYYY hh:mm A') + '</p>';
                    } else {
                        html += '<span class="bg-danger text-white">Yet Not Resolve</span>';
                    }
                    html += '</td>';
                    html += '<td class="text-center">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + row.source + '</p>';
                    html += '</td>';
                    html += '<td class="text-center">';
                    // html += row.status == 1 ?
                    //     '<select class="form-control select2" complaint-id="' + row.id +
                    //     '" id="change-status" onchange="updateStatus(' + row.id + ',0)"><option selected disabled>Completed</option><option value="2">Work In Progress</option><option value="0">Pending</option></select>'? :

                    //     '<span class="badge bg-danger text-white">Pending</span>';
                    if (row.status == 1 || row.status == 2) {
                        html += '<select class="form-control select2" complaint-id="' + row.id + '" onchange="updateStatus(' + row.id + ',this)">';

                        if (row.status == 1) {
                            html += '<option selected disabled>Completed</option>';
                        } else {
                            html += '<option value="1">Completed</option>';
                        }

                        if (row.status == 2) {
                            html += '<option selected disabled>WIP</option>';
                        } else {
                            html += '<option value="2">WIP</option>';
                        }

                        html += '<option value="0">Pending</option>';
                        html += '</select>';
                    } else {
                        html += '<span class="badge bg-danger text-white">Pending</span>';
                    }
                    html += '</td>';
                    html += '<td class="text-center">';
                    if (row.bounce_back_complaints && row.bounce_back_complaints.length > 0) {
                        html += '<a href="' + "{{ route('bounce-back.detail', '') }}/" + row.id + '" class="badge bg-warning text-dark">Bounced Back</a>';
                    } else {
                        html += '<span class="text-muted">No</span>';
                    }
                    html += '</td>';
                    html += '<td class="align-middle">';
                    // Check if we're on request management page
                    var isRequestPage = window.location.search.includes('comp_type_id');
                    var requestParam = isRequestPage ? '?from_request=1' : '';
                    
                    html += row.assigned_complaints == null && row.assigned_complaints_department ==  null ? '<a href="' +
                        "{{ route('compaints-management.details', '') }}/" + row.id + requestParam +
                        '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Assign</a>' :
                        row.assigned_complaints != null ?
                        '<a href="{{ route('agent-management.details', '') }}/' + row.assigned_complaints.agent_id +
                        '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Already Assigned</a>':
                        '<a href="{{ route('departments.details', '') }}/' + row.assigned_complaints_department.user_id +
                        '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Already Assigned</a>';

                    html +=
                        '  <button class="btn btn-sm rounded dropdown-toggle more-horizontal text-muted" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    html += '<span class="text-muted sr-only">Action</span>';
                    html += '</button>';
                    html += '<div class="dropdown-menu dropdown-menu-right shadow">';
                    // Check if we're on request management page
                    var isRequestPage = window.location.search.includes('comp_type_id');
                    var requestParam = isRequestPage ? '?from_request=1' : '';
                    
                    html += '<a class="dropdown-item" href="' + currentUrl + '/' + row.id +
                        '/edit' + requestParam + '"><i class="fe fe-edit-2 fe-12 mr-3 text-muted"></i>Edit</a>';
                    // html += '<a class="dropdown-item" href="#"><i class="fe fe-trash fe-12 mr-3 text-muted"></i>Remove</a>';
                    // if (row.status != 1) {
                        html += '<a class="dropdown-item" href="' +
                            "{{ route('compaints-management.details', '') }}/" + row.id + requestParam +
                            '"><i class="fe fe-flag fe-12 mr-3 text-muted"></i>Detail</a>';
                    // }
                    html += '<a class="dropdown-item" href="' +
                        "{{ route('compaints-management.logs', '') }}/" + row.id + requestParam +
                        '"><i class="fe fe-activity fe-12 mr-3 text-muted"></i>View Logs</a>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });

                $('#user-table-body').html(html);
            }

            // Function to generate pagination
            pre = 0;
            nxt = 0;

            function generatePagination(response) {
                var html = '';
                var totalPages = response.last_page;
                var currentPage = response.current_page;

                // Determine how many pages to show at the start and end
                var startPages = 2;
                var endPages = 2;
                var middlePages = 2;
                var range = middlePages * 2 + 1;

                if (response.prev_page_url) {
                    pre = currentPage - 1;
                    html += '<li class="page-item"><a onclick="fetchDataOnClick(\'' + pre +
                        '\')" href="javascript:void(0);" class="page-link">Previous</a></li>';
                }

                // Show first few pages
                for (var i = 1; i <= startPages && i <= totalPages; i++) {
                    html += '<li class="page-item ' + (i == currentPage ? 'active' : '') +
                        '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i +
                        '" href="javascript:void(0);">' + i + '</a></li>';
                }

                // Show "..." if there are hidden pages before the current page
                if (currentPage > startPages + middlePages + 1) {
                    html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                }

                // Show pages around the current page
                var start = Math.max(startPages + 1, currentPage - middlePages);
                var end = Math.min(totalPages - endPages, currentPage + middlePages);

                for (var i = start; i <= end; i++) {
                    html += '<li class="page-item ' + (i == currentPage ? 'active' : '') +
                        '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i +
                        '" href="javascript:void(0);">' + i + '</a></li>';
                }

                // Show "..." if there are hidden pages after the current page
                if (currentPage < totalPages - endPages - middlePages) {
                    html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                }

                // Show last few pages
                for (var i = totalPages - endPages + 1; i <= totalPages; i++) {
                    if (i > startPages) {
                        html += '<li class="page-item ' + (i == currentPage ? 'active' : '') +
                            '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i +
                            '" href="javascript:void(0);">' + i + '</a></li>';
                    }
                }

                if (response.next_page_url) {
                    nxt = currentPage + 1;
                    html += '<li class="page-item"><a class="page-link" onclick="fetchDataOnClick(\'' + nxt +
                        '\')" href="javascript:void(0);">Next</a></li>';
                }

                $('#user-pagination').html(html);
            }
        </script>
    @endsection
