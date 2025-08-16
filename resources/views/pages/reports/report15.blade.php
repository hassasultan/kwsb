<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Detailed Report</title>

    <!-- Perfect Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .table-striped > tbody > tr:nth-of-type(odd) > td {
            background-color:rgb(230, 235, 238) !important;
        }
        
        .table-striped > tbody > tr:nth-of-type(even) > td {
            background-color: #ffffff !important;
        }
        
        .table-hover > tbody > tr:hover > td {
            background-color: #f8f9fa !important;
        }
        
        .stats-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-2px);
        }
        
        .stats-card-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .stats-card-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        
        .stats-card-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .stats-card-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .table-header {
            background: linear-gradient(135deg,rgb(169, 181, 238) 0%,rgb(204, 171, 238) 100%) !important;
            color: black !important;
        }
        
        .badge-priority {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        
        .badge-status {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        
        .badge-source {
            background-color: #6c757d !important;
            color: white !important;
        }
    </style>
</head>

<body class="vertical dark">
        <div id="app" class="wrapper">
        <div class="container p-4 bg-white" id="getPrint">
                    <div class="bg-white m-auto">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-4">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="img-fluid" alt="main_logo" style="width: 150px;">
                            </div>
                    <div class="col-8 text-end">
                        <h3 class="text-primary mb-2">KW&SC-CRM</h3>
                        <h4 class="mb-3">Detailed Complaint Report</h4>
                        <p class="mb-2">
                            <span class="badge bg-dark fs-6">Comprehensive Complaint Analysis</span>
                        </p>
                        <p class="mb-1">
                            <strong>Report Duration:</strong> {{ \Carbon\Carbon::parse($dateS)->format('d M Y') }} to {{ \Carbon\Carbon::parse($dateE)->format('d M Y') }}
                        </p>
                        <p class="mb-0 text-muted">
                            <small>Generated on: {{ \Carbon\Carbon::now()->format('d F Y, h:i A') }}</small>
                        </p>
                    </div>
                </div>

                <!-- Statistics Summary -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card stats-card-primary text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Complaints</h5>
                                <h3 class="mb-0">{{ count($detailed_report) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card stats-card-success text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solved</h5>
                                <h3 class="mb-0">{{ count(array_filter($detailed_report, function($item) { return $item->status === 'Solved'; })) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card stats-card-warning text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Pending</h5>
                                <h3 class="mb-0">{{ count(array_filter($detailed_report, function($item) { return $item->status === 'Pending'; })) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card stats-card-info text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Resolution Rate</h5>
                                <h3 class="mb-0">
                                    @php
                                        $total = count($detailed_report);
                                        $solved = count(array_filter($detailed_report, function($item) { return $item->status === 'Solved'; }));
                                        echo $total > 0 ? round(($solved / $total) * 100, 1) : 0;
                                    @endphp
                                    %
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Print Button -->
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <button type="button" onclick="exportToExcel()" class="btn btn-success btn-lg ms-2">
                            <i class="fas fa-file-excel"></i> Export to Excel
                        </button>
                    </div>
                            </div>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                                        <tr class="table-header">
                                            <th><b>Complaint #</b></th>
                                            <th><b>Type</b></th>
                                            <th><b>Sub-Type</b></th>
                                            <th><b>Priority</b></th>
                                            <th><b>Town</b></th>
                                            <th><b>Sub-town</b></th>
                                            <th><b>Consumer #</b></th>
                                            <th><b>CNIC</b></th>
                                            <th><b>Customer Name</b></th>
                                            <th><b>Phone</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Address</b></th>
                                            <th><b>Source</b></th>
                                            <th><b>Engineer</b></th>
                                            <th><b>Department</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Created Date</b></th>
                                            <th><b>Updated Date</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @forelse($detailed_report as $record)
                                <tr>
                                    <td><strong>{{ $record->comp_num }}</strong></td>
                                    <td>{{ $record->complain_type ?? 'N/A' }}</td>
                                    <td>{{ $record->sub_type ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-priority bg-{{ $record->priority === 'High' ? 'danger' : ($record->priority === 'Medium' ? 'warning' : 'success') }}">
                                            {{ $record->priority ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $record->town ?? 'N/A' }}</td>
                                    <td>{{ $record->sub_town ?? 'N/A' }}</td>
                                    <td>{{ $record->consumer_number ?? 'N/A' }}</td>
                                    <td>{{ $record->customer_cnic ?? 'N/A' }}</td>
                                    <td>{{ $record->customer_name ?? 'N/A' }}</td>
                                    <td>{{ $record->phone ?? 'N/A' }}</td>
                                    <td>{{ $record->email ?? 'N/A' }}</td>
                                    <td>{{ $record->address ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-source">{{ $record->source ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $record->executive_engineer ?? 'N/A' }}</td>
                                    <td>{{ $record->department_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-status bg-{{ $record->status === 'Solved' ? 'success' : 'warning' }}">
                                            {{ $record->status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($record->updated_at && $record->updated_at !== $record->created_at)
                                            {{ \Carbon\Carbon::parse($record->updated_at)->format('d/m/Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                            </tr>
                                        @empty
                                            <tr>
                                    <td colspan="18" class="text-center text-muted">
                                        <i class="fas fa-info-circle"></i> No records found for the selected criteria.
                                    </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                </div>

                <!-- Footer -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">
                            <small>This report was generated automatically by KW&SC-CRM System</small>
                        </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <script>
        function getPrint() {
            var elem = document.getElementById('getPrint');
            var print_area = window.open('', '_blank');
            print_area.document.write('<html>');
            print_area.document.write('<head>');
            print_area.document.write('<title>Detailed Complaint Report</title>');
            print_area.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">');
            print_area.document.write('<style>@media print { .btn { display: none !important; } }</style>');
            print_area.document.write('</head>');
            print_area.document.write('<body>');
            print_area.document.write(elem.innerHTML);
            print_area.document.write('</body></html>');
            print_area.document.close();
            print_area.focus();
            setTimeout(function() {
            print_area.print();
            }, 500);
        }

        function exportToExcel() {
            // Create a table element for export
            var table = document.querySelector('table');
            var html = table.outerHTML;
            
            // Create download link
            var link = document.createElement('a');
            link.download = 'detailed_complaint_report.xls';
            link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            link.click();
        }

        // Auto-hide print button on print
        window.addEventListener('beforeprint', function() {
            document.querySelectorAll('.btn').forEach(btn => btn.style.display = 'none');
        });

        window.addEventListener('afterprint', function() {
            document.querySelectorAll('.btn').forEach(btn => btn.style.display = 'inline-block');
        });
    </script>
</body>
</html>