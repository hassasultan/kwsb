<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Engineer Performance Report</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.5;
            font-size: 12pt;
        }

        /* Print-specific Styles */
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        .report-container {
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            padding: 0.5cm;
        }

        /* Header Styles */
        .report-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .logo-container {
            flex: 0 0 30%;
            padding-right: 15px;
        }

        .logo-container img {
            max-width: 100%;
            height: auto;
            max-height: 80px;
        }

        .header-content {
            flex: 1;
        }

        .report-title {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .report-subtitle {
            display: inline-block;
            font-size: 14pt;
            background-color: #333;
            color: white;
            padding: 3px 10px;
            margin-bottom: 5px;
        }

        .report-date {
            font-size: 10pt;
        }

        /* Section Styles */
        .report-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }

        /* Info Card Styles */
        .info-card-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .info-card {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px;
            margin: 0 5px;
            text-align: center;
        }

        .info-card-title {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info-card-value {
            font-size: 14pt;
            font-weight: bold;
        }

        /* Chart Container Styles */
        .chart-container {
            width: 100%;
            height: 200px;
            margin: 0 auto 15px;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 15px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Utility Classes */
        .text-primary { color: #007bff; }
        .text-success { color: #28a745; }
        .text-danger { color: #dc3545; }
        .text-dark { color: #343a40; }
        .fw-bold { font-weight: bold; }

        /* Two-column Layout */
        .two-column {
            display: flex;
            margin-bottom: 15px;
        }

        .column {
            flex: 1;
            padding: 0 5px;
        }

        /* Print Adjustments */
        @media print {
            body {
                font-size: 10pt;
            }

            .report-container {
                padding: 0;
            }

            .info-card {
                margin: 0 3px;
                padding: 5px;
            }

            .info-card-value {
                font-size: 12pt;
            }

            .chart-container {
                height: 180px;
            }

            .data-table {
                font-size: 8pt;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Header Section -->
        <div class="report-header">
            <div class="logo-container">
                <img src="{{ asset('assets/images/unnamed.png') }}" alt="Company Logo">
            </div>
            <div class="header-content">
                <div class="report-title">KW&SC-CRM</div>
                <div class="report-subtitle">Engineer Performance Report (Summary)</div>
                <div class="report-date">REPORT CREATED DATE: {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            </div>
        </div>

        <!-- Engineer Details Section -->
        <div class="report-section">
            <div style="font-size: 11pt;">
                <p><strong>EXECUTIVE ENGINEER:</strong> {{ $agent->user->name }}</p>
                <p><strong>TOWN:</strong> {{ $agent->town->town }}</p>
                <p><strong>DEPARTMENT:</strong> {{ $complaintTypeTitle }}</p>
                @if(!empty($dateS) && !empty($dateE))
                    <p><strong>DURATION:</strong> From {{ \Carbon\Carbon::parse($dateS)->format('d F Y') }} To
                    {{ \Carbon\Carbon::parse($dateE)->format('d F Y') }}</p>
                @endif
            </div>
        </div>

        <!-- Total Complaints Section -->
        <div class="report-section">
            <div class="section-title">Total Complaints</div>
            <div class="info-card-container">
                <div class="info-card">
                    <div class="info-card-title">Total Complaints</div>
                    <div class="info-card-value text-primary">{{ $totalComplaints }}</div>
                </div>
                <div class="info-card">
                    <div class="info-card-title">Resolved Complaints</div>
                    <div class="info-card-value text-success">{{ $resolvedComplaints }}</div>
                </div>
                <div class="info-card">
                    <div class="info-card-title">Pending Complaints</div>
                    <div class="info-card-value text-danger">{{ $pendingComplaints }}</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="totalComplaintsChart"></canvas>
            </div>
        </div>

        <!-- Grievance Details Section -->
        <div class="report-section">
            <div class="section-title">Grievance Details</div>
            <div class="two-column">
                <div class="column">
                    <div class="chart-container">
                        <canvas id="grievancePieChart"></canvas>
                    </div>
                </div>
                <div class="column">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Grievance</th>
                                <th>Total</th>
                                <th>Resolved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subtypeCounts1 as $subtype)
                            <tr>
                                <td>{{ $subtype->subtype_name }}</td>
                                <td>{{ $subtype->total_complaints }}</td>
                                <td>{{ $subtype->resolved_complaints }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Turnaround Time Section -->
        <div class="report-section">
            <div class="section-title">Complaint Resolve Time</div>
            @if ($turnaroundTimes->isNotEmpty())
            <div class="two-column">
                <div class="column">
                    <div class="chart-container">
                        <canvas id="resolveTimeChart"></canvas>
                    </div>
                </div>
                <div class="column">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Resolution Detail</th>
                                <th>Total</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turnaroundTimes as $data)
                            <tr>
                                <td>{{ $data->ResolutionDetails }}</td>
                                <td>{{ $data->TotalComplaints }}</td>
                                <td>{{ $data->Percentage }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <p>No turnaround time data available.</p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Configuration
        Chart.defaults.font.size = 9;
        Chart.defaults.plugins.legend.labels.font = { size: 9 };
        Chart.defaults.plugins.title.font = { size: 11 };

        // Total Complaints Chart
        const totalComplaintsCtx = document.getElementById('totalComplaintsChart').getContext('2d');
        new Chart(totalComplaintsCtx, {
            type: 'bar',
            data: {
                labels: ['Total', 'Resolved', 'Pending'],
                datasets: [{
                    data: [{{ $totalComplaints }}, {{ $resolvedComplaints }}, {{ $pendingComplaints }}],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { font: { size: 9 } }
                    },
                    x: {
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        });

        // Grievance Pie Chart
        const grievancePieCtx = document.getElementById('grievancePieChart').getContext('2d');
        const grievanceColors = [
            '#007bff', '#28a745', '#dc3545', '#ffc107',
            '#6c757d', '#17a2b8', '#fd7e14', '#6610f2'
        ];

        new Chart(grievancePieCtx, {
            type: 'pie',
            data: {
                labels: @json($subtypeCounts->toArray() ? array_column($subtypeCounts->toArray(), 'title') : []),
                datasets: [{
                    data: @json($subtypeCounts->toArray() ? array_column($subtypeCounts->toArray(), 'count') : []),
                    backgroundColor: grievanceColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { font: { size: 8 } }
                    }
                }
            }
        });

        // Resolve Time Chart
        const resolveTimeCtx = document.getElementById('resolveTimeChart').getContext('2d');
        new Chart(resolveTimeCtx, {
            type: 'bar',
            data: {
                labels: @json($turnaroundTimes->pluck('ResolutionDetails')),
                datasets: [{
                    label: 'Count',
                    data: @json($turnaroundTimes->pluck('TotalComplaints')),
                    backgroundColor: '#17a2b8',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { font: { size: 9 } }
                    },
                    x: {
                        ticks: { font: { size: 8 } }
                    }
                }
            }
        });

        // Print optimization
        window.onbeforeprint = function() {
            document.querySelectorAll('.chart-container').forEach(el => {
                el.style.height = '160px';
            });
            document.body.style.fontSize = '9pt';
        };
    </script>
</body>
</html>
