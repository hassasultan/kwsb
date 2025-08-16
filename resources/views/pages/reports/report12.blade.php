<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Executive Engineer Performance Report</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            body {
                font-size: 10pt;
            }
            .report-container {
                padding: 0;
            }
            table {
                font-size: 9pt;
            }
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

        <!-- Export Buttons -->
        <div class="export-buttons">
            <button class="btn btn-success btn-export" onclick="exportToExcel()">
                <i class="fas fa-file-excel"></i> Export to Excel
            </button>
        </div>

        <!-- Report Details -->
        <div style="margin-bottom: 15px;">
            <p><strong>Report Duration:</strong> From {{ \Carbon\Carbon::parse($dateS)->format('d F Y') }} to {{ \Carbon\Carbon::parse($dateE)->format('d F Y') }}</p>
             <p><strong>Report Type:</strong> Town Wise Report</p>
        </div>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr style="background-color:#5b9bd5; color: #FFF !important;">
                        <th><b>Executive Engineer</b></th>
                        <th><b>Town</b></th>
                        <th><b>Department</b></th>
                        <th><b>Solved</b></th>
                        <th><b>Pending</b></th>
                        <th><b>Total Complaints Assigned</b></th>
                        <th><b>Percentage Solved</b></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exen_complete_filter2 as $record)
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Print function
        function getPrint() {
            window.print();
        }
        
        // Export to Excel function
        function exportToExcel() {
            let table = document.querySelector('.data-table');
            let html = table.outerHTML;
            let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            let downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            downloadLink.href = url;
            downloadLink.download = 'Executive_Engineer_Performance_Report.xls';
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
        
        // Automatically trigger print when page loads
        window.onload = function() {
            setTimeout(function() {
                // Remove auto-print for better user experience
                // window.print();
            }, 500);
        };
    </script>
</body>
</html>
