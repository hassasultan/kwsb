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
                <h2 class="page-title">Complaint Management</h2>
                {{-- <p> Tables with built-in bootstrap styles </p> --}}
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('compaints-management.create') }}">add</i>&nbsp;&nbsp;<i
                            class="fa fa-user"></i></a>
                </div>
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow">
                            <div class="card-title">
                                <h5>
                                    Comlaints List
                                </h5>
                                {{-- <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p> --}}
                            </div>
                            <div class="toolbar">
                                <form class="form">
                                    <div class="form-row">
                                        <div class="form-group col-auto mr-auto">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Search</label>
                                            <input type="text" class="form-control" id="search1" value=""
                                                placeholder="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 skeleton-container">
                                    <table class="skeleton-table table table-borderless table-hover">
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
                                                <th>
                                                    Title Description</th>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            var search = null;
            $("input").keyup(function() {
                search = $(this).val();
                fetchDataOnReady();
            });
            $(document).ready(function() {

                // Call the function on document ready
                fetchDataOnReady();

            });

            function fetchDataOnClick(page) {
                console.log(page);
                $.ajax({
                    url: "{{ route('compaints-management.index') }}",
                    type: "GET",
                    data: {
                        type: 'ajax',
                        page: page
                    },
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
                $.ajax({
                    url: "{{ route('compaints-management.index') }}",
                    type: "GET",
                    data: {
                        type: 'ajax',
                        search: search
                    },
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
                const currentUrl = window.location.href;
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
                    html += '<td class="align-middle text-center text-sm">';
                    html += '<p class="text-xs text-secondary mb-0">' + row.title + '</p>';
                    html += '</td>';
                    html += '<td class="align-middle text-center text-sm">';
                    if (row.image != null) {
                        html += '<img src="{{ asset("storage/") }}/' + row.image +
                            '" class="img-fluid" style="width: 70px; height: 70px;" />';
                    } else {
                        html += 'Not Available';
                    }
                    html += '</td>';
                    html += '<td class="text-center">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + moment(row.created_at).format(
                        'DD/MM/YYYY hh:mm:ss') + '</p>';
                    html += '</td>';
                    html += '<td class="text-center">';
                    if (row.status == 1) {
                        html += '<p class="text-xs font-weight-bold mb-0">' + moment(row.updated_at).format(
                            'DD/MM/YYYY hh:mm:ss') + '</p>';
                    } else {
                        html += '<span class="bg-danger">Yet Not Resolve</span>';
                    }
                    html += '</td>';
                    html += '<td class="text-center">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + row.source + '</p>';
                    html += '</td>';
                    html += '<td class="text-center">';
                    html += row.status == 1 ? '<span class="badge bg-success">Completed</span>' :
                        '<span class="badge bg-danger">Pending</span>';
                    html += '</td>';
                    html += '<td class="align-middle">';
                    html += row.assigned_complaints == null ? '<a href="' + "{{ route('compaints-management.details', '') }}/" +row.id+ '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Assign</a>' :
                        '<a href="{{ route("agent-management.details","") }}/' + row.assigned_complaints.id +
                        '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Already Assigned</a>';
                    html += '<a href="'+currentUrl+'/'+row.id +'/edit" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';
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
                if (response.prev_page_url) {
                    pre = response.current_page - 1;
                    html += '<li class="page-item"><a onclick="fetchDataOnClick(\'' + pre +
                        '\')" href="javascript:void(0);" class="page-link" >Previous</a></li>';
                }
                for (var i = 1; i <= response.last_page; i++) {
                    html += '<li class="page-item ' + (i == response.current_page ? 'active' : '') +
                        '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i +
                        '" href="javascript:void(0);">' + i + '</a></li>';
                }
                if (response.next_page_url) {
                    nxt = response.current_page + 1;
                    html += '<li class="page-item"><a class="page-link" onclick="fetchDataOnClick(\'' + nxt +
                        '\')" href="javascript:void(0);">Next</a></li>';
                }
                $('#user-pagination').html(html);
            }
        </script>
    @endsection
