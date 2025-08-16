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
    
    <style>
        /* Table responsive and overflow fixes */
        .table-responsive {
            overflow-x: auto;
            margin-bottom: 1rem;
        }
        
        .table th, .table td {
            white-space: nowrap;
            min-width: 120px;
        }
        
        /* Export button styles */
        .btn-export {
            margin: 5px;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
        }
        
        .export-buttons {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        @media print {
            .export-buttons {
                display: none !important;
            }
        }
    </style>
</head>

<body class="vertical dark">
    <div id="app" class="wrapper">
        <div class="container p-4 bg-white text-center" id="getPrint">
            <div class="bg-white m-auto">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="img-fluid" alt="main_logo"
                            style="width: 200px;">
                    </div>
                    <div class="col-6 text-end" style="padding-top:2.4rem;">
                        <h2 class="mb-4">Complaint Management Center</h2>
                        <p>Karachi Water & Sewerage Corporation
                        </p>

                        <h5 style="font-size: 0.8rem">
                            ISSUE DATE: {{ \Carbon\Carbon::now()->format('d F Y, h:i A') }}
                        </h5>
                    </div>
                    <div class="col-9 text-left pl-4">
                        @php
                            $total_pending = 0;
                            $total_resolved = 0;
                            $total_recieved = 0;
                        @endphp
                        @foreach ($exen_complete_filter2 as $record)
                            @php
                                $total_pending = $total_pending + $record->Pending;
                                $total_resolved = $total_resolved + $record->Resolved;
                                $total_recieved = $total_recieved + $record->Total_Complaints;
                            @endphp
                        @endforeach
                        <p>
                            Compalints Created : From {{ $dateS }} till {{ $dateE }} (11:59 pm)
                        </p>
                        <p>
                            <strong>Total Complaints

                                <span style="margin-left: 15px;">{{ $total_recieved }}</span>
                            </strong>
                        </p>
                        <p>
                            <strong>Pending
                                <span style="margin-left: 15px;">{{ $total_pending }}</span>
                            </strong>
                        </p>
                        <p>
                            <strong>Resolve
                                <span style="margin-left: 15px;">{{ $total_resolved }}</span>
                            </strong>
                        </p>
                    </div>
                    <div class="col-3 text-right pr-4">
                        <h3>Report</h3>
                        <p>Complaint Sub-Type</p>

                    </div>
                    
                    <!-- Export Buttons -->
                    <div class="col-12">
                        <div class="export-buttons">
                            <button type="button" onclick="exportToExcel()" class="btn btn-success btn-export">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="background-color:#5b9bd5; color: #FFF !important;">
                                        <th><b>Executive Engineer</b></th>
                                        <th><b>Town</b></th>
                                        <th><b>Sub-Type </b></th>
                                        <th><b>Total Recieved</b></th>
                                        <th><b>Resolved </b></th>
                                        <th><b>Pending</b></th>
                                        <th><b>Resolved %</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exen_complete_filter2 as $record)
                                        <tr>
                                            <td>{{ $record->Executive_Engineer }}</td>
                                            <td>{{ $record->Town }}</td>
                                            <td>{{ $record->Complaint }}</td>
                                            <td>{{ $record->Total_Complaints }}</td>
                                            <td>{{ $record->Resolved }}</td>
                                            <td>{{ $record->Pending }}</td>
                                            <td>{{ $record->Percentage_Resolved }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No records found for the selected dates.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <button type="button"onclick="getPrint()" class="btn btn-primary">print</button> --}}

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

    <script src="{{ asset('assets/js/map.world.js') }}"></script>
    <script src="{{ asset('assets/js/map.euro.js') }}"></script>
    <script src="{{ asset('assets/js/map.us.js') }}"></script>
    <script src="{{ asset('assets/js/maps.custom.js') }}"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- select2 -->
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

            $('.select2-multiple2').select2({
                placeholder: "Select",
                allowClear: true
            });

        });

        function getPrint() {
            var elem = document.getElementById('getPrint');
            var print_area = window.open();
            print_area.document.write('<html>');
            print_area.document.write(
                '<link rel="dns-prefetch" href="//fonts.gstatic.com"><link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" /><link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" /><link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" /><link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"><link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="crossorigin="anonymous" referrerpolicy="no-referrer" /><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />'
            );
            print_area.document.write('<body>');
            print_area.document.write(elem.innerHTML);
            print_area.document.write('</body></html>');
            // print_area.focus();
            print_area.print();
            // print_area.close();
        }
        
        // Export to Excel function
        function exportToExcel() {
            let table = document.querySelector('.table');
            let html = table.outerHTML;
            let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            let downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            downloadLink.href = url;
            downloadLink.download = 'Complaint_Sub_Type_Report.xls';
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
        
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: [50, 20, 10, 22, 50, 10, 40],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
