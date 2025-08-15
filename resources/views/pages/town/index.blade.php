@extends('layouts.app')

@section('content')
    <style>
        .skeleton-row {
            background-color: #f2f2f2;
        }

        .skeleton-row td {
            height: 20px;
            /* Adjust height as needed */
            border: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1>Town Management</h1>
                            <a href="{{ route('town-management.create') }}" class="btn btn-primary">Add Town</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <div class="toolbar mb-3">
                            {{-- <form class="form"> --}}
                                <div class="form-row">
                                    <div class="form-group col-auto mr-auto">
                                    </div>
                                    <!-- <div class="form-group col-auto">
                                        <label for="district-filter" class="sr-only">District Filter</label>
                                        <select class="form-control" id="district-filter">
                                            <option value="">All Districts</option>
                                            <option value="1">District 1</option>
                                            <option value="2">District 2</option>
                                            <option value="3">District 3</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group col-auto">
                                        <label for="search" class="sr-only">Search</label>
                                        <input type="text" class="form-control" id="search1" value=""
                                            placeholder="Search towns...">
                                    </div>
                                    <div class="form-group col-auto">
                                        <button type="button" class="btn btn-secondary" id="reset-filters">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Town</th>
                                    <th>District</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body">
                              {{-- Skeleton loading rows will be dynamically generated here --}}
                              <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td></td>
                            </tr>
                                {{-- @foreach ($town as $key => $row)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $row->town }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('town-management.edit', $row->id) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach --}}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        var search = null;
        var district = null;
        
        $("input").keyup(function() {
            search = $(this).val();
            fetchDataOnReady();
        });
        
        $("#district-filter").change(function() {
            district = $(this).val();
            fetchDataOnReady();
        });
        
        $("#reset-filters").click(function(){
            // Reset all filter values
            search = null;
            district = null;
            
            // Reset form fields
            $("#search1").val('');
            $("#district-filter").val('').trigger('change');
            
            // Fetch data with reset filters
            fetchDataOnReady();
        });
        
        $(document).ready(function() {

            // Call the function on document ready
            fetchDataOnReady();

        });

        function fetchDataOnClick(page) {
            console.log(page);
            $.ajax({
                url: "{{ route('town-management.index') }}",
                type: "GET",
                data: {
                    search: search,
                    district: district,
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
                url: "{{ route('town-management.index') }}",
                type: "GET",
                data: {
                    type: 'ajax',
                    search: search,
                    district: district
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
                html += '<td>' + user.town + '</td>';
                html += '<td>' + user.district.title + '</td>';
                html += '<td>'; 
                html += '  <button class="btn btn-sm rounded dropdown-toggle more-horizontal text-muted" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                html += '<span class="text-muted sr-only">Action</span>';
                html += '</button>';
                html += '<div class="dropdown-menu dropdown-menu-right shadow">';
                html += '<a class="dropdown-item" href="'+currentUrl+'/'+user.id+'/edit"><i class="fe fe-edit-2 fe-12 mr-3 text-muted"></i>Edit</a>';
                html += '<a class="dropdown-item" href="#"><i class="fe fe-trash fe-12 mr-3 text-muted"></i>Remove</a>';
                html += '<a class="dropdown-item" href="#"><i class="fe fe-flag fe-12 mr-3 text-muted"></i>Assign</a>';
                html += '</div></td>';
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
                pre = response.current_page-1;
                html += '<li class="page-item"><a onclick="fetchDataOnClick(\'' + pre + '\')" href="javascript:void(0);" class="page-link" >Previous</a></li>';
            }
            for (var i = 1; i <= response.last_page; i++) {
                html += '<li class="page-item ' + (i == response.current_page ? 'active' : '') +
                    '"><a class="page-link pg-btn" onclick="fetchDataOnClick(\'' + i + '\')" data-attr="page=' + i +
                    '" href="javascript:void(0);">' + i + '</a></li>';
            }
            if (response.next_page_url) {
              nxt = response.current_page+1;
              html += '<li class="page-item"><a class="page-link" onclick="fetchDataOnClick(\'' + nxt + '\')" href="javascript:void(0);">Next</a></li>';
            }
            $('#user-pagination').html(html);
        }
    </script>
@endsection
