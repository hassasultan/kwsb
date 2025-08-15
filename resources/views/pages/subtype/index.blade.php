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
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1>SubType Management</h1>
                            <a href="{{ route('subtype-management.create') }}" class="btn btn-primary">Add SubType</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <div class="toolbar mb-3">
                            <form class="form">
                                <div class="form-row">
                                    <div class="form-group col-auto mr-auto">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search1" value=""
                                            placeholder="Search subtypes...">
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SubType</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body">
                                {{-- @if (count($user) > 0) --}}
                                @foreach ($subtype as $key => $row)
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
                              {{-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item active"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item"><a class="page-link" href="#">Next</a></li> --}}
                          </ul>
                      </nav>
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
                url: "{{ route('subtype-management.index') }}",
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
                url: "{{ route('subtype-management.index') }}",
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
        function generateTableRows(users) {
            var html = '';
            const currentUrl = window.location.href;
            $.each(users, function(index, user) {
                html += '<tr>';
                html += '<td>' + user.title + '</td>'; // Extracting title from user object
                html += '<td>';
                html +=
                    '<button class="btn btn-sm rounded dropdown-toggle more-horizontal text-muted" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                html += '<span class="text-muted sr-only">Action</span>';
                html += '</button>';
                html += '<div class="dropdown-menu dropdown-menu-right shadow">';
                html += '<a class="dropdown-item" href="' + currentUrl + '/' + user.id +
                    '/edit"><i class="fe fe-edit-2 fe-12 mr-3 text-muted"></i>Edit</a>';
                html += '</div></td>';
                html += '</tr>';
            });
            // console.log(html);
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
