@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- @include('layouts.include.toolbar') --}}
                <h2 class="page-title">Customer Management</h2>
                <p> All Customer are available here... </p>
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('customer-management.create') }}">add</i>&nbsp;&nbsp;<i
                            class="fa fa-user"></i></a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body px-0 pb-2">
                                <div class="card-title p-3">
                                    <h5>
                                        Customer List
                                    </h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>
                                <div class="toolbar pr-3">
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
                                <div class="p-0">
                                    <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase  text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Customer#</th>
                                                <th
                                                    class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                                    Name / Phone</th>
                                                <th
                                                    class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                                    Town SubTown</th>
                                                <th
                                                    class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                                    Address</th>
                                                {{-- <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">Total Trucks</th> --}}
                                                {{-- <th class=" opacity-7">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody id="user-table-body">
                                            {{-- @if (count($user) > 0) --}}
                                            @foreach ($customer as $key => $row)
                                                <tr>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $row->customer_id }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs  mb-0">{{ $row->customer_name }}</p>
                                                        <p class="text-xs  mb-0">{{ $row->phone }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs  mb-0">{{ $row->town }} -
                                                            {{ $row->sub_town }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs  mb-0">{{ $row->address }}</p>
                                                    </td>
                                                </tr>
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
                url: "{{ route('customer-management.index') }}",
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
                url: "{{ route('customer-management.index') }}",
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
        function generateTableRows(complaints) {
            var html = '';
            const currentUrl = window.location.href;
            $.each(complaints, function(index, row) {
                html += '<tr>';
                html += '<td><p class="text-xs font-weight-bold mb-0">' + row.customer_id + '</p></td>';
                html += '<td class="align-middle text-center text-sm">';
                html += '<p class="text-xs mb-0">' + row.customer_name + '</p>';
                html += '<p class="text-xs mb-0">' + row.phone + '</p>';
                html += '</td>';
                html += '<td class="align-middle text-center text-sm">';
                html += '<p class="text-xs mb-0">' + row.town + ' - ' + row.sub_town + '</p>';
                html += '</td>';
                html += '<td class="align-middle text-center text-sm">';
                html += '<p class="text-xs mb-0">' + row.address + '</p>';
                html += '</td>';
                html += '<td>'; 
                html += '  <button class="btn btn-sm rounded dropdown-toggle more-horizontal text-muted" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                html += '<span class="text-muted sr-only">Action</span>';
                html += '</button>';
                html += '<div class="dropdown-menu dropdown-menu-right shadow">';
                html += '<a class="dropdown-item" href="'+currentUrl+'/'+row.id+'/edit"><i class="fe fe-edit-2 fe-12 mr-3 text-muted"></i>Edit</a>';
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
