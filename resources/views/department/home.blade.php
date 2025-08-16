@extends('department.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('department.layouts.include.toolbar')
                <style>
                    #total-tanker {
                        height: 180px;
                        overflow-y: scroll;

                        /* padding-top: 15px; */
                    }

                    .icon-lg {
                        width: 40px !important;
                        height: 40px !important;
                    }

                    #piechart_3d>div {
                        background-color: #202940 !important;
                    }
                    
                    /* Dark mode compatibility */
                    [data-bs-theme="dark"] .text-dark {
                        color: #fff !important;
                    }
                    
                    [data-bs-theme="dark"] .table {
                        color: #fff !important;
                    }
                    
                    [data-bs-theme="dark"] .table tbody tr {
                        color: #fff !important;
                    }
                    
                    [data-bs-theme="dark"] .card-header {
                        color: #fff !important;
                    }
                    
                    [data-bs-theme="dark"] .fw-semibold {
                        color: #fff !important;
                    }
                </style>
                <style>
                    #container2 {
                        height: 400px;
                    }

                    .highcharts-figure,
                    .highcharts-data-table table {
                        min-width: 310px;
                        max-width: 800px;
                        margin: 1em auto;
                    }

                    .highcharts-data-table table {
                        font-family: Verdana, sans-serif;
                        border-collapse: collapse;
                        border: 1px solid #ebebeb;
                        margin: 10px auto;
                        text-align: center;
                        width: 100%;
                        max-width: 500px;
                    }

                    .highcharts-data-table caption {
                        padding: 1em 0;
                        font-size: 1.2em;
                        color: #555;
                    }

                    .highcharts-data-table th {
                        font-weight: 600;
                        padding: 0.5em;
                    }

                    .highcharts-data-table td,
                    .highcharts-data-table th,
                    .highcharts-data-table caption {
                        padding: 0.5em;
                    }

                    .highcharts-data-table thead tr,
                    .highcharts-data-table tr:nth-child(even) {
                        background: #f8f8f8;
                    }

                    .highcharts-data-table tr:hover {
                        background: #f1f7ff;
                    }
                </style>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                 {{-- <script type="text/javascript">
                    setInterval(function() {

                        $.ajax({
                                url: "{{ route('home') }}",
                                type: "Get",
                                data: {
                                    status: "api",
                                },
                            }).done(function(data) {
                                google.charts.load("current", {
                                    packages: ["corechart"]
                                });
                                google.charts.setOnLoadCallback(drawChart2);
                                let result2 = data['result'];
                                let result = data['type_count'];

                                function drawChart2() {
                                    var dataNew = google.visualization.arrayToDataTable(result2);
                                    var data = google.visualization.arrayToDataTable(result);
                                    var options = {
                                        title: '',
                                        is3D: true,
                                    };
                                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
                                    chart.draw(dataNew, options);
                                    var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                    chart2.draw(data, options);
                                }


                            })
                            .fail(function(error) {
                                console.log(error);
                                errorModal(error);

                            });

                    }, 3000);
                </script> --}}
                <div class="mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h3 class="mb-1 fw-bold text-dark">KWSC - {{ auth()->user()->name }}'s Portal</h3>
                                            <p class="text-muted mb-0">
                                                <i class="fas fa-building me-1"></i>
                                                Karachi Water & Sewerage Corporation
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-muted fw-semibold">Total Complaints</p>
                                        <span class="h2 fw-bold text-primary">{{ $totalComplaints }}</span>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-muted fw-semibold">Pending Complaints</p>
                                        <span class="h2 fw-bold text-warning">{{ $complaintsPending }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-muted fw-semibold">Resolved Complaints</p>
                                        <span class="h2 fw-bold text-success">{{ $complaintsComplete }}</span>
                                    </div>
                                </div>
                                
                                {{-- <div class="col-xl-12 col-sm-14  text-right">
                                    <a class="btn btn-primary mb-0" href="{{ route('compaints-management.create') }}"
                                        target="_blank">+
                                        Add New Complaint</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row items-align-baseline">
                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-body mb-n3">
                                <div class="row items-align-baseline h-100">
                                    <div class="col-md-12 my-3">
                                        <h3>Complaints Type</h3>
                                        <div id="piechart_3d"></div>
                                    </div>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->

                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-body">
                                <div class="chart-widget mb-2">
                                    <h3>Complaints Status</h3>
                                    <div id="piechart_3d2"></div>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                </div> <!-- .row -->
                <hr />
                <div class="row align-items-baseline">
                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card p-3 mb-4">
                            <div class="card-body mb-n3 ">
                                <div class="row mt-1 align-items-center">
                                    <span class="h3">TOP 3 WATER</span>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Executive Engineer</th>
                                                <th class="text-dark fw-bold">Town</th>
                                                <th class="text-dark fw-bold">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($top3water as $row)
                                                <tr>
                                                    <td class="text-dark fw-bold">{{ $row->Executive_Engineer }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Town }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Percentage_Solved }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card p-3 mb-4">
                            <div class="card-body mb-n3 ">
                                <div class="row mt-1 align-items-center">
                                    <span class="h3">TOP 3 SEWERAGE</span>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Executive Engineer</th>
                                                <th class="text-dark fw-bold">Town</th>
                                                <th class="text-dark fw-bold">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($top3sewe as $row)
                                                <tr>
                                                    <td class="text-dark fw-bold">{{ $row->Executive_Engineer }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Town }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Percentage_Solved }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                </div> <!-- .row -->
                <hr />
                <div class="row align-items-baseline">
                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card p-3 mb-4">
                            <div class="card-body mb-n3 ">
                                <div class="row mt-1 align-items-center">
                                    <span class="h3">WORST 3 WATER</span>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Executive Engineer</th>
                                                <th class="text-dark fw-bold">Town</th>
                                                <th class="text-dark fw-bold">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wor3water as $row)
                                                <tr>
                                                    <td class="text-dark fw-bold">{{ $row->Executive_Engineer }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Town }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Percentage_Solved }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-12 col-lg-6">
                        <div class="card shadow eq-card p-3 mb-4">
                            <div class="card-body mb-n3 ">
                                <div class="row mt-1 align-items-center">
                                    <span class="h3">WORST 3 SEWERAGE</span>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark fw-bold">Executive Engineer</th>
                                                <th class="text-dark fw-bold">Town</th>
                                                <th class="text-dark fw-bold">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wor3sewe as $row)
                                                <tr>
                                                    <td class="text-dark fw-bold">{{ $row->Executive_Engineer }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Town }}</td>
                                                    <td class="text-dark fw-bold">{{ $row->Percentage_Solved }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                </div> <!-- .row -->
                <hr /> --}}


            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
    <script>
        // $(document).ready(function() {
        //     {{-- var cat = @json($allTown); --}}
        //     {{-- var type = @json($typeComp); --}}
        //     // console.log(type);
        //     type = type.slice(0, 4);

        //     var seriesData = [];

        //     // Perform a loop to generate the series data dynamically
        //     for (var i = 0; i < type.length; i++) {
        //         console.log(type[i]);
        //         var series = {
        //             name: type[i].name,
        //             data: []
        //         };

        //         // Generate random data for each series
        //         for (var j = 0; j <= type[i].data.length; j++) {

        //             if (type[i].data[j] == undefined) {
        //                 // var value = 0;
        //                 // series.data.push(value);
        //                 console.log(type[i].data[j]);
        //             } else {
        //                 var value = type[i].data[j];
        //                 series.data.push(value);
        //             }
        //             // }
        //             // else
        //             // {
        //             //     var value = 0;
        //             //     series.data.push(value);
        //             // }
        //         }
        //         console.log(series);

        //         // Add the series to the seriesData array
        //         seriesData.push(series);
        //     }
        //     Highcharts.chart('container2', {
        //         chart: {
        //             type: 'column'
        //         },

        //         title: {
        //             text: 'Complaints High Chart'
        //         },

        //         xAxis: {
        //             categories: cat
        //         },

        //         yAxis: {
        //             allowDecimals: false,
        //             min: 0,
        //             title: {
        //                 text: 'Complaints'
        //             }
        //         },

        //         tooltip: {
        //             formatter: function() {
        //                 return '<b>' + this.x + '</b><br/>' +
        //                     this.series.name + ': ' + this.y;
        //             }
        //         },
        //         // series: [{
        //         // name: 'Series 1',
        //         // data: [5, 10, 15]
        //         // }, {
        //         // name: 'Series 2',
        //         // data: [8, 12, 7]
        //         // }]
        //         series: seriesData
        //     });
        // });
    </script>
@endsection
