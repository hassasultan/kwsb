<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Billing Report</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        .report-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        .table thead { background: #e9ecef; }
        .report-header { border-bottom: 2px solid #dee2e6; margin-bottom: 20px; padding-bottom: 10px; }
        .footer-note { font-size: 0.85rem; color: #6c757d; margin-top: 20px; }
    </style>
</head>

<body>
<div class="container my-4" id="getPrint">
    <div class="report-container">

        <!-- Header -->
        <div class="row report-header">
            <div class="col-6">
                <img src="{{ asset('assets/images/unnamed.png') }}" alt="Logo" style="height: 60px;">
            </div>
            <div class="col-6 text-end">
                <h4 class="mb-0">KW&SC-CRM</h4>
                <small>Consumer Billing Report</small><br>
                <small class="text-muted">Generated on: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</small>
            </div>
        </div>

        @if(isset($consumer))
            <!-- Consumer Info -->
            <div class="mb-3">
                <h5>Consumer Information</h5>
                <p class="mb-1"><strong>Consumer #:</strong> {{ $consumer['consumer_no'] }}</p>
                <p class="mb-1"><strong>Name:</strong> {{ $consumer['name'] }}</p>
                <p class="mb-1"><strong>Address:</strong> {{ $consumer['address'] }}</p>
                <p class="mb-1"><strong>Town:</strong> {{ $consumer['town'] }}</p>
            </div>

            <!-- Arrears Section -->
            @if(isset($arrears) && $arrears > 0)
                <div class="mb-4">
                    <h5 class="text-danger">Outstanding Arrears</h5>
                    <p><strong>Total Arrears:</strong> Rs. {{ number_format($arrears) }}</p>
                </div>
            @endif

            <!-- Billing Table -->
            <h5>Billing History</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Month</th>
                        <th>Billed Amount</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $current_month['month'] }}</td>
                        <td>Rs. {{ number_format($current_month['billed']) }}</td>
                        <td>{{ $current_month['status'] == 'Paid' ? 'Rs. '.$current_month['paid'] : '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $current_month['status'] == 'Paid' ? 'success' : 'danger' }}">
                                {{ $current_month['status'] }}
                            </span>
                        </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>{{ $last_month['month'] }}</td>
                        <td>Rs. {{ number_format($last_month['billed']) }}</td>
                        <td>Rs. {{ number_format($last_month['paid']) }}</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>{{ $last_month['date'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-danger">
                <i class="fas fa-info-circle"></i> No billing data found.
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center footer-note">
            <p><small>This report was generated automatically by KW&SC-CRM System</small></p>
        </div>
    </div>
</div>

<!-- Print Button -->
<div class="container text-end mt-3">
    <button type="button" onclick="getPrint()" class="btn btn-primary">
        <i class="fas fa-print"></i> Print
    </button>
</div>

<!-- Scripts -->
<script>
    function getPrint() {
        var elem = document.getElementById('getPrint');
        var print_area = window.open('', '_blank');
        print_area.document.write('<html><head><title>Billing Report</title>');
        print_area.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">');
        print_area.document.write('</head><body>');
        print_area.document.write(elem.innerHTML);
        print_area.document.write('</body></html>');
        print_area.document.close();
        print_area.focus();
        setTimeout(() => { print_area.print(); }, 500);
    }
</script>
</body>
</html>
