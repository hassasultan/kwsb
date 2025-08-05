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

        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">System Logs Management</h2>

                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>System Logs</h5>
                                </div>

                                <!-- Advanced Filters -->
                                <div class="filter-section">
                                    <h6 class="mb-3">Advanced Filters</h6>
                                    <form id="logs-filter-form">
                                        <div class="filter-row">
                                            <div class="filter-group">
                                                <label for="user_id">User</label>
                                                <select class="form-control select2" id="user_id" name="user_id">
                                                    <option value="">All Users</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="filter-group">
                                                <label for="user_name">User Name</label>
                                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Search by user name">
                                            </div>

                                            <div class="filter-group">
                                                <label for="user_email">User Email</label>
                                                <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Search by user email">
                                            </div>

                                            <div class="filter-group">
                                                <label for="action">Action</label>
                                                <select class="form-control select2" id="action" name="action">
                                                    <option value="">All Actions</option>
                                                    <option value="Complaint">Complaint</option>
                                                    <option value="User">User</option>
                                                    <option value="System">System</option>
                                                    <option value="Login">Login</option>
                                                    <option value="Logout">Logout</option>
                                                </select>
                                            </div>

                                            <div class="filter-group">
                                                <label for="complaint_number">Complaint Number</label>
                                                <input type="text" class="form-control" id="complaint_number" name="complaint_number" placeholder="Search by complaint number">
                                            </div>

                                            <div class="filter-group">
                                                <label for="date_from">Date From</label>
                                                <input type="date" class="form-control" id="date_from" name="date_from">
                                            </div>

                                            <div class="filter-group">
                                                <label for="date_to">Date To</label>
                                                <input type="date" class="form-control" id="date_to" name="date_to">
                                            </div>

                                            <div class="filter-group">
                                                <button type="button" class="btn btn-primary" id="apply-filters">
                                                    <i class="fa fa-search"></i> Apply Filters
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="clear-filters">
                                                    <i class="fa fa-times"></i> Clear
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Logs Table -->
                                <div class="row">
                                    <div class="col-sm-12 skeleton-container" id="logs-table-container">
                                        <div class="loading-overlay" id="loading-overlay" style="display: none;">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>

                                        <table class="skeleton-table table table-borderless table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Action</th>
                                                    <th>Action ID</th>
                                                    <th>Action Detail</th>
                                                    <th>Created At</th>
                                                    <th class="text-secondary opacity-7">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="logs-table-body">
                                                <!-- Skeleton loading rows -->
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <tr>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 60px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 150px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 100px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 80px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 200px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 120px;"></div>
                                                            </div>
                                                        </td>
                                                        <td class="skeleton-item">
                                                            <div class="skeleton-content">
                                                                <div class="skeleton-line" style="width: 80px;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>

                                        <div id="pagination-container" class="mt-3">
                                            <!-- Pagination will be loaded here -->
                                        </div>
                                    </div>
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
        $(document).ready(function() {
            // Initialize select2
            $('.select2').select2();

            // Load initial data
            loadLogsData();

            // Apply filters button
            $('#apply-filters').click(function() {
                loadLogsData();
            });

            // Clear filters button
            $('#clear-filters').click(function() {
                $('#logs-filter-form')[0].reset();
                $('.select2').val('').trigger('change');
                loadLogsData();
            });

            // Load logs data via AJAX
            function loadLogsData(page = 1) {
                showLoading();

                var formData = $('#logs-filter-form').serialize();
                formData += '&page=' + page;

                $.ajax({
                    url: '{{ route("admin.logs.index") }}',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        console.log("print");
                        $('#logs-table-body').html(response.html);
                        $('#pagination-container').html(response.pagination);
                        hideLoading();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading logs:', error);
                        hideLoading();
                        // Show error message
                        $('#logs-table-body').html('<tr><td colspan="7" class="text-center text-danger">Error loading data. Please try again.</td></tr>');
                    }
                });
            }

            // Show loading overlay
            function showLoading() {
                $('#loading-overlay').show();
            }

            // Hide loading overlay
            function hideLoading() {
                $('#loading-overlay').hide();
            }

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadLogsData(page);
            });

            // Handle enter key on filter inputs
            $('#user_name, #user_email, #complaint_number').keypress(function(e) {
                if (e.which == 13) {
                    loadLogsData();
                }
            });
        });
    </script>
@endsection
