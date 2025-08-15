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
                          <h1>SubTown Management</h1>
                          <a href="{{ route('subtown-management.create') }}" class="btn btn-primary">Add SubTown</a>
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
                                      <label for="town-filter" class="sr-only">Town Filter</label>
                                      <select class="form-control" id="town-filter">
                                          <option value="">All Towns</option>
                                          <option value="1">Town 1</option>
                                          <option value="2">Town 2</option>
                                          <option value="3">Town 3</option>
                                      </select>
                                  </div> -->
                                  <div class="form-group col-auto">
                                      <label for="search" class="sr-only">Search</label>
                                      <input type="text" class="form-control" id="search1" value=""
                                          placeholder="Search subtowns...">
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
                                  <th>SubTown</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody id="user-table-body">
                              @foreach ($subtown as $key => $row)
                                  <tr>
                                      <td>
                                          {{-- <p class="text-xs font-weight-bold mb-0">{{ $row->town->town }}
                                          </p> --}}
                                      </td>
                                      <td>
                                          {{-- <p class="text-xs font-weight-bold mb-0">{{ $row->title }}</p> --}}
                                      </td>
                                      <td>
                                          {{-- <a href="{{ route('subtown-management.edit', $row->id) }}"
                                              class="text-secondary font-weight-bold text-xs"
                                              data-toggle="tooltip" data-original-title="Edit user">
                                              Edit
                                          </a> --}}
                                      </td>
                                  </tr>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        var search = null;
        var town = null;
        
        $("input").keyup(function() {
            search = $(this).val();
            fetchDataOnReady();
        });
        
        $("#town-filter").change(function() {
            town = $(this).val();
            fetchDataOnReady();
        });
        
        $("#reset-filters").click(function(){
            // Reset all filter values
            search = null;
            town = null;
            
            // Reset form fields
            $("#search1").val('');
            $("#town-filter").val('').trigger('change');
            
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
                url: "{{ route('subtown-management.index') }}",
                type: "GET",
                data: {
                    search: search,
                    town: town,
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
                url: "{{ route('subtown-management.index') }}",
                type: "GET",
                data: {
                    type: 'ajax',
                    search: search,
                    town: town
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
                html += '<td>' + user.town.town + '</td>';
                html += '<td>' + user.title + '</td>';
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
