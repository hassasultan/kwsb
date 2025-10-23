@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('layouts.include.toolbar')
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
                <script type="text/javascript">
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
                </script>
                {{-- @if (auth()->user()->role == 1) --}}
                <div class="mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h2 class="mb-1 fw-bold text-dark">KW&SC</h2>
                                            <p class="text-muted mb-0">
                                                <i class="fas fa-building me-1 text-dark"></i>
                                                Karachi Water & Sewerage Corporation
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-dark fw-bold">Total Complaints</p>
                                        <span class="h2 fw-bold text-primary">{{ $totalcount[0]->totalc }}</span>
                                    </div>
                                </div>
                                
                                {{-- <div class="col-6 col-lg-2 text-center py-4">
                                    <p class="mb-1 small text-muted">Total Agents</p>
                                    <span class="h3">{{ $totalAgents }}</span><br />
                                </div> --}}
                                
                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-dark fw-bold">Pending Complaints</p>
                                        <span class="h2 fw-bold text-warning">{{ $complaintsPending }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-2 text-center py-3">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <p class="mb-1 small text-dark fw-bold">Resolved Complaints</p>
                                        <span class="h2 fw-bold text-success">
                                            {{ $tat_summary_complete[count($tat_summary_complete)-1]->TotalComplaints }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-xl-12 col-sm-14 text-end mt-3">
                                    <a class="btn btn-primary btn-lg shadow-sm" href="{{ route('compaints-management.create') }}"
                                        target="_blank">
                                        <i class="fas fa-plus me-2"></i>
                                        Add New Complaint
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-baseline">
                    <div class="col-md-12 col-lg-6 mb-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-gradient-success text-white border-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chart-line me-2"></i>
                                    <h3 class="mb-0 text-black">Turn Around Time Summary</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="border-0 px-4 py-3">
                                                    <i class="fas fa-info-circle me-1 text-success"></i>
                                                    <span class="text-dark fw-bold">Resolution Details</span>
                                                </th>
                                                <th class="border-0 px-4 py-3 text-center">
                                                    <i class="fas fa-hashtag me-1 text-success"></i>
                                                    <span class="text-dark fw-bold">Total</span>
                                                </th>
                                                <th class="border-0 px-4 py-3 text-center">
                                                    <i class="fas fa-percentage me-1 text-success"></i>
                                                    <span class="text-dark fw-bold">Percentage</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tat_summary_complete as $row)
                                                <tr class="border-bottom">
                                                    <td class="px-4 py-3">
                                                        <span class="fw-semibold text-dark">{{ $row->ResolutionDetails }}</span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="badge bg-success text-white fw-semibold fs-6">
                                                            {{ $row->TotalComplaints }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="fw-semibold text-success">{{ $row->Percentage }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-lg-6 mb-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-gradient-warning text-white border-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-hourglass-half me-2"></i>
                                    <h3 class="mb-0 text-black">Aging Summary</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="border-0 px-4 py-3">
                                                    <i class="fas fa-calendar-alt me-1 text-warning"></i>
                                                    <span class="text-dark fw-bold">Pending Details</span>
                                                </th>
                                                <th class="border-0 px-4 py-3 text-center">
                                                    <i class="fas fa-hashtag me-1 text-warning"></i>
                                                    <span class="text-dark fw-bold">Total Pending</span>
                                                </th>
                                                <th class="border-0 px-4 py-3 text-center">
                                                    <i class="fas fa-percentage me-1 text-warning"></i>
                                                    <span class="text-dark fw-bold">Percentage</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tat_summary_pending as $row)
                                                <tr class="border-bottom">
                                                    <td class="px-4 py-3">
                                                        <span class="fw-semibold text-dark">{{ $row->Pendingdays }}</span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="badge bg-warning text-dark fw-semibold fs-6">
                                                            {{ $row->TotalPendingComplaints }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="fw-semibold text-warning">{{ $row->Percentage }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr />
                            <div class="chartbox mr-4">
                                <div id="container2"></div>
                            </div> --}}
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
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
                </div> <!-- .row --> --}}
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
                    <hr />


            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
    <script>
        $(document).ready(function() {
            var cat = @json($allTown);
            var type = @json($typeComp);
            // console.log(type);
            type = type.slice(0, 4);

            var seriesData = [];

            // Perform a loop to generate the series data dynamically
            for (var i = 0; i < type.length; i++) {
                console.log(type[i]);
                var series = {
                    name: type[i].name,
                    data: []
                };

                // Generate random data for each series
                for (var j = 0; j <= type[i].data.length; j++) {

                    if (type[i].data[j] == undefined) {
                        // var value = 0;
                        // series.data.push(value);
                        console.log(type[i].data[j]);
                    } else {
                        var value = type[i].data[j];
                        series.data.push(value);
                    }
                    // }
                    // else
                    // {
                    //     var value = 0;
                    //     series.data.push(value);
                    // }
                }
                console.log(series);

                // Add the series to the seriesData array
                seriesData.push(series);
            }
            Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },

                title: {
                    text: 'Complaints High Chart'
                },

                xAxis: {
                    categories: cat
                },

                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Complaints'
                    }
                },

                tooltip: {
                    formatter: function() {
                        return '<b>' + this.x + '</b><br/>' +
                            this.series.name + ': ' + this.y;
                    }
                },
                // series: [{
                // name: 'Series 1',
                // data: [5, 10, 15]
                // }, {
                // name: 'Series 2',
                // data: [8, 12, 7]
                // }]
                series: seriesData
            });
        });
    </script>
@endsection
