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
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme" disabled>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<style>
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card-link:hover .card {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
    }

    .vh-100 {
        height: 100vh !important;
    }

    .icon {
        font-size: 3rem;
    }
</style>

<body class="vertical"
    style="background-color:#fff !important; background-image:url('{{ asset('assets/images/cmp-bg.jpg') }}') !important;">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('front.home') }}" class="card-link">
                        <div class="card text-center p-4">
                            <div class="card-body">
                                <i class="fas fa-plus-circle icon"></i>
                                <p class="card-text mt-3">Add New Complaint</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('front.home.connection') }}" class="card-link">
                        <div class="card text-center p-4">
                            <div class="card-body">
                                <i class="fas fa-tint icon"></i>
                                <i class="fas fa-plus icon"></i>
                                <p class="card-text mt-3">Add New Connection</p>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="javascript:void(0);" class="card-link" data-toggle="modal"
                        data-target="#trackComplaintModal">
                        <div class="card text-center p-4">
                            <div class="card-body">
                                <i class="fas fa-search icon"></i>
                                <p class="card-text mt-3">Track Your Complaint</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="trackComplaintModal" tabindex="-1" role="dialog"
        aria-labelledby="trackComplaintModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackComplaintModalLabel">Track Your Complaint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="GET" action="{{ route('track.complaint') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="complaintNumber">Complaint Number</label>
                            <input type="text" class="form-control" id="complaintNumber" name="comp_num"
                                placeholder="Enter Complaint Number" required>
                        </div>
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="number" class="form-control" id="mobileNumber" name="phone"
                                placeholder="Enter Mobile Number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Track Complaint</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src='{{ asset('assets/js/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('assets/js/jquery.validate.min.js') }}'></script>
    <script src='{{ asset('assets/js/jQuery.tagify.min.js') }}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            //console.log("check");

            @if (session('success'))
                // toastr.success('Your Compaint has been Registered Successfully...');
                //$('#successModal').modal('show');
                toastr.success('{{ session('success') }}');
            @endif
            @if (session('error'))
                toastr.error('{{ session('error') }}');
            @endif
        });
    </script>
</body>

</html>
