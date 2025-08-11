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
                <h2 class="page-title">Agent Management</h2>
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('agent-management.create') }}">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                </div>
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>
                                        Agents List
                                    </h5>
                                </div>
                                <div class="toolbar">
                                    <div class="form-row">
                                        <div class="form-group col-auto mr-auto">
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Town</label>
                                            <select class="form-control select2" id="town-id">
                                                <option disabled selected> -- Select Town --</option>
                                                @foreach ($towns as $row)
                                                    <option value="{{ $row->id }}"> {{ $row->town }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Agent Type</label>
                                            <select class="form-control select2" id="type-id">
                                                <option disabled selected> -- Select Agent Type --</option>
                                                @foreach ($types as $row)
                                                    <option value="{{ $row->id }}"> {{ $row->title }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="search" class="sr-only">Search</label>
                                            <input type="text" class="form-control" id="search1" value=""
                                                placeholder="Search Agent Name">
                                        </div>
                                        <div class="form-group col-auto">
                                            <button type="button" class="btn btn-secondary" id="reset-filters">
                                                <i class="fa fa-refresh"></i> Reset Filters
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 skeleton-container">
                                        <table class="skeleton-table table table-borderless table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Agent</th>
                                                    <th>Town</th>
                                                    <th>Type</th>
                                                    <th>Address</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="user-table-body">
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
                                                    </tr>
                                                @endfor
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
            fetchDataOnReady();

            $(document).ready(function() {
                $("input").keyup(function() {
                    search = $(this).val();
                    fetchDataOnReady();
                });
                $("#town-id").change(function() {
                    town = $(this).val();
                    fetchDataOnReady();
                });
                $("#type-id").change(function() {
                    type = $(this).val();
                    fetchDataOnReady();
                });
                $("#reset-filters").click(function() {
                    // Reset variables
                    search = null;
                    town = null;
                    type = null;

                    // Reset UI elements
                    $("#search1").val('');
                    $("#town-id").val('').trigger('change');
                    $("#type-id").val('').trigger('change');

                    // Fetch data with reset filters
                    fetchDataOnReady();
                });
            });

            function fetchDataOnClick(page) {
                console.log(page);
                $.ajax({
                    url: "{{ route('agent-management.index') }}",
                    type: "GET",
                    data: {
                        type: 'ajax',
                        search: search,
                        town: town,
                        type_id: type,
                        page: page
                    },
                    success: function(response) {
                        console.log("Data fetched successfully on click:", response);
                        generateTableRows(response.data);
                        generatePagination(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data on click:", error);
                    }
                });
            }

            function fetchDataOnReady() {
                $.ajax({
                    url: "{{ route('agent-management.index') }}",
                    type: "GET",
                    data: {
                        type: 'ajax',
                        search: search,
                        town: town,
                        type_id: type
                    },
                    success: function(response) {
                        console.log("Data fetched successfully on document ready:", response);
                        $('#user-table-body').empty();
                        generateTableRows(response.data);
                        generatePagination(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data on document ready:", error);
                    }
                });
            }

            function generateTableRows(response) {
                var html = '';
                const currentUrl = window.location.href;
                $.each(response, function(index, row) {
                    html += '<tr>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + (row.user ? row.user.name : 'N/A') + '</p>';
                    if (row.avatar) {
                        html += '<img src="{{ asset('storage/') }}/' + row.avatar + '" class="img-fluid" style="width: 70px; height: 70px;" />';
                    }
                    html += '</td>';
                    html += '<td class="w-20">';
                    if (row.town) {
                        html += '<p class="text-xs font-weight-bold mb-0">' + row.town.town + '</p>';
                        if (row.town.subtown) {
                            html += '<p class="text-xs text-secondary mb-0">' + row.town.subtown + '</p>';
                        }
                    } else {
                        html += '<p class="text-xs text-secondary mb-0">N/A</p>';
                    }
                    html += '</td>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs font-weight-bold mb-0">' + (row.complaint_type ? row.complaint_type.title : 'Type is not defined...') + '</p>';
                    html += '</td>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs text-center font-weight-bold mb-0">' + (row.address || 'N/A') + '</p>';
                    html += '</td>';
                    html += '<td class="w-20">';
                    html += '<p class="text-xs text-center font-weight-bold mb-0">' + (row.description || 'N/A') + '</p>';
                    html += '</td>';
                    html += '<td class="align-middle">';
                    html += '<a href="' + "{{ route('agent-management.edit', '') }}/" + row.id + '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';
                    html += ' | ';
                    html += '<a href="' + "{{ route('agent-management.details', '') }}/" + row.id + '" class="text-secondary font-weight-bold text-xs m-3" data-toggle="tooltip" data-original-title="Show Complaints">Assigned Complaints</a>';
                    html += ' | ';
                    html += '<button class="btn btn-link text-secondary p-0 m-0" onclick="openDateRangeModal(' + row.id + ')">GET REPORT</button>';
                    html += '</td>';
                    html += '</tr>';
                });

                $('#user-table-body').html(html);
            }

            function generatePagination(response) {
                var html = '';
                var totalPages = response.last_page;
                var currentPage = response.current_page;

                var startPages = 2;
                var endPages = 2;
                var middlePages = 2;
                var range = middlePages * 2 + 1;

                if (response.prev_page_url) {
                    var pre = currentPage - 1;
                    html += '<li class="page-item"><a onclick="fetchDataOnClick(\'' + pre + '\')" href="javascript:void(0);" class="page-link">Previous</a></li>';
                }

                for (var i = 1; i <= startPages && i <= totalPages; i++) {
                    html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
                }

                if (currentPage > startPages + middlePages + 1) {
                    html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                }

                var start = Math.max(startPages + 1, currentPage - middlePages);
                var end = Math.min(totalPages - endPages, currentPage + middlePages);

                for (var i = start; i <= end; i++) {
                    html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
                }

                if (currentPage < totalPages - endPages - middlePages) {
                    html += '<li class="page-item disabled"><a class="page-link">...</a></li>';
                }

                for (var i = totalPages - endPages + 1; i <= totalPages; i++) {
                    if (i > startPages) {
                        html += '<li class="page-item ' + (i == currentPage ? 'active' : '') + '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i + '" href="javascript:void(0);">' + i + '</a></li>';
                    }
                }

                if (response.next_page_url) {
                    var nxt = currentPage + 1;
                    html += '<li class="page-item"><a class="page-link" onclick="fetchDataOnClick(\'' + nxt + '\')" href="javascript:void(0);">Next</a></li>';
                }

                $('#user-pagination').html(html);
            }

            function openDateRangeModal(agentId) {
                const form = document.getElementById('dateRangeForm');
                const action = form.getAttribute('action').replace(':id', agentId);
                form.setAttribute('action', action);

                const modal = new bootstrap.Modal(document.getElementById('dateRangeModal'));
                modal.show();
            }
        </script>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('agent-management.report', ':id') }}" id="dateRangeForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="dateRangeModalLabel">Select Date Range</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <input type="checkbox" id="use_date_range" name="use_date_range" value="1">
                            <label for="use_date_range">Filter by date range</label>
                        </div>
                        <div id="date-range-fields" style="display: none;">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control">

                            <label for="to_date" class="mt-2">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap CSS and JS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const dateRangeFields = document.getElementById('date-range-fields');
        const useDateRangeCheckbox = document.getElementById('use_date_range');
        const modal = new bootstrap.Modal(document.getElementById('dateRangeModal'));
        const dateRangeForm = document.getElementById('dateRangeForm');

        // Toggle date range fields
        useDateRangeCheckbox.addEventListener('change', () => {
            dateRangeFields.style.display = useDateRangeCheckbox.checked ? 'block' : 'none';
        });

        // Close the modal on "Cancel" button click
        document.getElementById('cancel-button').addEventListener('click', () => {
            modal.hide();
        });
    </script>
@endsection
