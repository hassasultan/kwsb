<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Perfect Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="vertical dark">
    <div id="app" class="wrapper">
        <div class="container p-4 bg-white text-center" >
            <div class="bg-white m-auto">
                <!-- Header -->
                <div class="row align-items-center">
                    <div class="col-5 text-center">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="img-fluid" alt="main_logo" style="width: 200px;">
                    </div>
                    <div class="col-7 text-start">
                        <h5 class="fs-1">KW&SC-CRM</h5>
                        <p style="font-size: 1.2rem"><span class="bg-dark text-white px-2">Engineer Performance Report(Summary)</span></p>
                        <h5 style="font-size: 0.8rem">REPORT CREATED DATE: {{ \Carbon\Carbon::now()->format('d F Y') }}</h5>
                    </div>
                </div>
                <!-- Details -->
                <div class="container">
                    <div style="text-align: left; color: #343a40;">
                        <p style="font-size: 1.2rem;">EXECUTIVE ENGINEER: {{ $agent->user->name }}</p>
                        <p style="font-size: 1.2rem;">TOWN: {{ $agent->town->town }}</p>
                        <p style="font-size: 1.2rem;">DEPARTMENT: {{ $complaintTypeTitle  }}</p>
                        @if(!empty($dateS) && !empty($dateE))
                                <p style="font-size: 1.2rem;">DURATION: From {{ \Carbon\Carbon::parse($dateS)->format('d F Y') }} To
                                {{ \Carbon\Carbon::parse($dateE)->format('d F Y') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Total Complaints Section -->
                <section>
                    <h2>Total Complaints</h2>
                    <div class="row justify-content-center text-center">
                        <div class="col-12 col-md-4">
                            <div class="card shadow eq-card mb-2">
                                <div class="card-body">
                                    <p class="text-dark fw-bold">Total Complaints</p>
                                    <h4 class="text-primary">{{ $totalComplaints }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card shadow eq-card mb-2">
                                <div class="card-body">
                                    <p class="text-dark fw-bold">Resolved Complaints</p>
                                    <h4 class="text-success">{{ $resolvedComplaints }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card shadow eq-card mb-2">
                                <div class="card-body">
                                    <p class="text-dark fw-bold">Pending Complaints</p>
                                    <h4 class="text-danger">{{ $pendingComplaints }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="totalComplaintsChart" width="200" height="100"></canvas>
                </section>

                <!-- Grievance Details Section -->
                <section>
                    <h2>Grievance Details</h2>
                    <div class="row align-items-start">
                        <div class="col-md-6">
                            <div class="card shadow eq-card mb-4">
                                <div class="card-body">
                                    <canvas id="grievancePieChart" width="200" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow eq-card mb-4">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Grievance</th>
                                                <th class="text-dark fw-bold">Total Complaints</th>
                                                <th class="text-dark fw-bold">Resolved</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subtypeCounts1 as $subtype)
                                            <tr>
                                                <td class="text-dark fw-bold">{{ $subtype->subtype_name }}</td>
                                                <td class="text-dark fw-bold">{{ $subtype->total_complaints }}</td>
                                                <td class="text-dark fw-bold">{{ $subtype->resolved_complaints }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Turnaround Time Section -->
                <section>
                    <h2>Complaint Resolve Time</h2>
                    <div class="row align-items-start">
                        @if ($turnaroundTimes->isNotEmpty())
                        <div class="col-md-6">
                            <div class="card shadow eq-card mb-4">
                                <div class="card-body">
                                    <canvas id="resolveTimeChart" width="200" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow eq-card mb-4">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Complaints Resolution Detail</th>
                                                <th class="text-dark fw-bold">Total Resolved Complaints</th>
                                                <th class="text-dark fw-bold">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($turnaroundTimes as $data)
                                            <tr>
                                                <td class="text-dark fw-bold">{{ $data->ResolutionDetails }}</td>
                                                <td class="text-dark fw-bold">{{ $data->TotalComplaints }}</td>
                                                <td class="text-dark fw-bold">{{ $data->Percentage }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12">
                            <p>No turnaround time data available.</p>
                        </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Total Complaints Bar Chart
    const totalComplaintsCtx = document.getElementById('totalComplaintsChart').getContext('2d');
    new Chart(totalComplaintsCtx, {
        type: 'bar',
        data: {
            labels: ['Total', 'Resolved', 'Pending'],
            datasets: [{
                label: 'Complaints',
                data: [{{ $totalComplaints }}, {{ $resolvedComplaints }}, {{ $pendingComplaints }}],
                backgroundColor: ['#007bff', '#28a745', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });

    // Data for Grievance Pie Chart
    const grievancePieCtx = document.getElementById('grievancePieChart').getContext('2d');

        // Define colors for each type of grievance
        const grievanceColors = [
            '#007bff', // Blue
            '#28a745', // Green
            '#dc3545', // Red
            '#ffc107', // Yellow
            '#6c757d', // Gray
            '#17a2b8', // Teal
            '#fd7e14', // Orange
            '#6610f2'  // Purple
        ];

        // Generate the backgroundColor array dynamically based on the number of subtypes
        const subtypeTitles = @json($subtypeCounts->toArray() ? array_column($subtypeCounts->toArray(), 'title') : []);
        const subtypeCounts = @json($subtypeCounts->toArray() ? array_column($subtypeCounts->toArray(), 'count') : []);

        new Chart(grievancePieCtx, {
            type: 'pie',
            data: {
                labels: subtypeTitles,
                datasets: [{
                    data: subtypeCounts,
                    // Use only as many colors as there are types
                    backgroundColor: subtypeTitles.map((_, index) => grievanceColors[index % grievanceColors.length])
                }]
            }
        });


    // Data for Complaint Resolve Time Chart
    const resolveTimeCtx = document.getElementById('resolveTimeChart').getContext('2d');
    new Chart(resolveTimeCtx, {
        type: 'bar',
        data: {
            labels: @json($turnaroundTimes->pluck('ResolutionDetails')),
            datasets: [{
                label: 'Resolution Time (in days)',
                data: @json($turnaroundTimes->pluck('TotalComplaints')),
                backgroundColor: '#17a2b8',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });
</script>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src='{{ asset('assets/js/daterangepicker.js') }}'></script>
    <script src='{{ asset('assets/js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('assets/js/chroma.min.js') }}"></script>
    <script src="{{ asset('assets/js/ifbreakpoint.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/theme.switcher.js') }}"></script>
    <script src="{{ asset('assets/js/d3.min.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>


