<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Executive Engineer Performance Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Print-specific Styles */
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.5;
            font-size: 12pt;
        }
        .report-container {
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            padding: 0.5cm;
        }
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 10pt;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }
        
        .table th, .table td {
            white-space: nowrap;
            min-width: 120px;
        }
        
        .table th:first-child, .table td:first-child {
            min-width: 100px;
        }
        
        .btn-export {
            margin: 10px;
        }
        
        .export-buttons {
            text-align: center;
            margin: 20px 0;
        }
        
        @media print {
            body {
                font-size: 10pt;
            }
            .report-container {
                padding: 0;
            }
            table {
                font-size: 9pt;
            }
            .export-buttons {
                display: none !important;
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
                <div class="report-subtitle">Executive Engineer Performance Report</div>
                <div class="report-date">ISSUE DATE: {{ \Carbon\Carbon::now()->format('d F Y, h:i A') }}</div>
            </div>
        </div>

        <!-- Report Details -->
        <div style="margin-bottom: 15px;">
            <p><strong>Report Duration:</strong> From {{ \Carbon\Carbon::parse($dateS)->format('d F Y') }} to {{ \Carbon\Carbon::parse($dateE)->format('d F Y') }}</p>
                <p><strong>Report Type:</strong> Performance Report</p>
        </div>

        <!-- Export Buttons -->
        <div class="export-buttons">
            <button type="button" onclick="exportToExcel()" class="btn btn-success btn-lg btn-export">
                <i class="fas fa-file-excel"></i> Export to Excel
            </button>
        </div>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color:#5b9bd5; color: #FFF !important;">
                        <th class="text-white"><b>Executive Engineer</b></th>
                        <th class="text-white"><b>Town</b></th>
                        <th class="text-white"><b>Department</b></th>
                        <th class="text-white"><b>Solved</b></th>
                        <th class="text-white"><b>Pending</b></th>
                        <th class="text-white"><b>Total Complaints Assigned</b></th>
                        <th class="text-white"><b>Percentage Solved</b></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exen_complete as $record)
                        <tr>
                            <td>{{ $record->Executive_Engineer }}</td>
                            <td>{{ $record->Town }}</td>
                            <td>{{ $record->Department }}</td>
                            <td>{{ $record->Solved }}</td>
                            <td>{{ $record->Pending }}</td>
                            <td>{{ $record->Total_Complaints }}</td>
                            <td>{{ $record->Percentage_Solved }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No records found for the selected dates.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function getPrint() {
            window.print();
        }

        function exportToExcel() {
            // Create a table element for export
            var table = document.querySelector('table');
            var html = table.outerHTML;
            
            // Create download link
            var link = document.createElement('a');
            link.download = 'executive_engineer_performance_report.xls';
            link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            link.click();
        }

        // Auto-hide export buttons on print
        window.addEventListener('beforeprint', function() {
            document.querySelectorAll('.export-buttons').forEach(btn => btn.style.display = 'none');
        });

        window.addEventListener('afterprint', function() {
            document.querySelectorAll('.export-buttons').forEach(btn => btn.style.display = 'block');
        });

        // Automatically trigger print when page loads (optional - can be removed if not needed)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // };
    </script>
</body>
</html>
