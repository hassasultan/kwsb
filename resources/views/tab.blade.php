<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

    .card-extra-css {
        border: 2px solid;
        box-shadow: 0px 7px 6px 0px;
        border-radius: 1.2rem;
    }
</style>

<body class="vertical"
    style="background-color:#fff !important; background-image:url('{{ asset('assets/images/cmp-bg.jpg') }}') !important;">
    <style>
        .item-required {
            color: red;
        }

        .my-element {
            display: grid;
            align-items: center;
        }

        .skiptranslate {
            display: none !important;
        }

        .goog-te-combo {
            width: 170px;
            background: black;
            color: white;
            border-radius: 5px;
            padding: 3px;
            font-family: NexaBook;
            font-style: normal;
        }

        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0px !important;
        }

        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            display: none !important;
        }

        .goog-te-gadget {
            color: transparent !important;
        }

        #goog-gt-tt {
            display: none !important;
            top: 0px !important;
        }

        .goog-tooltip skiptranslate {
            display: none !important;
            top: 0px !important;
        }

        .activity-root {
            display: hide !important;
        }

        .status-message {
            display: hide !important;
        }

        .started-activity-container {
            display: hide !important;
        }

        .goog-text-highlight {
            background: none !important;
            box-shadow: none !important;
        }

        #google_element {
            display: block;
        }

        .make-header {
            height: 80px;
            margin-top: 32px !important;
        }

        .mobile-header {
            display: none;
        }

        @media only screen and (max-width: 767px) {

            .desktop-header {
                display: none;
            }

            .mobile-header {
                display: block;
            }

            .make-header {
                height: 120px !important;
            }
        }

        .mobile-heading {
            font-size: 0.9rem;
        }

        .mobile-row {
            display: flex;
        }

        .w-20 {
            max-width: 20%;
        }

        .w-80 {
            max-width: 80%;
        }
    </style>
    <div id="app" class="wrapper">
        <div class="container-fluid">
            <div class="bg-dark col-12 mt-3 make-header desktop-header">
                {{-- <div class="container"> --}}
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="img-fluid" alt="main_logo"
                            style="width: 130px; margin-top:-30px;">
                    </div>
                    <div class="col-md-9 pt-3">
                        <h5 class="text-white" style="font-size: 1.8rem; margin-bottom:0% !important;">COMPLAINT REDRESSAL MECHANISM
                        </h5>
                        <span class="text-white" style="font-size: 0.8rem">KW&SC |
                            {{ \Carbon\Carbon::now()->format('d F Y') }}</span>
                    </div>
                    {{-- <div class="col-md-3 pt-3">
                        <div id="google_translate_element"></div>
                        <a target="_blank" class="btn btn-link text-white font-weight-bolder"
                            href="./#googtrans(en|en)">English</a>
                        <a target="_blank" class="btn btn-link text-white font-weight-bolder"
                            href="./#googtrans(en|ur)">Urdu</a>
                    </div> --}}
                </div>
                {{-- </div> --}}
            </div>
            <div class="bg-dark col-12 mt-3 make-header mobile-header">
                {{-- <div class="container-fluid"> --}}
                <div class="mobile-row">
                    <div class="w-20">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="img-fluid" alt="main_logo"
                            style="width: 180px;">
                    </div>
                    <div class="w-80 pt-3 pl-2">
                        <h5 class="mobile-heading text-white">COMPLAINT REDRESSAL MECHANISM
                            <br />
                            <span style="font-size: 0.6rem">KW&SC |
                                {{ \Carbon\Carbon::now()->format('d F Y') }}</span>
                        </h5>
                    </div>
                </div>
                {{-- <div class="w-100 text-right">
                    <div id="google_translate_element"></div>
                    <a target="_blank" class="btn btn-link text-white font-weight-bolder"
                        href="./#googtrans(en|en)">English</a>
                    <a target="_blank" class="btn btn-link text-white font-weight-bolder"
                        href="./#googtrans(en|ur)">Urdu</a>
                </div> --}}
                {{-- </div> --}}
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="{{ route('front.home') }}" class="card-link">
                            <div class="card text-center p-4 card-extra-css">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/add-file-color.png') }}" style="width: 80px;" />
                                    <p class="card-text mt-3">Add Complaint</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="{{ route('front.home.connection') }}" class="card-link">
                            <div class="card text-center p-4 card-extra-css">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/water-tap.png') }}" style="width: 80px;" />
                                    <p class="card-text mt-3">New Connection</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="javascript:void(0);" class="card-link" data-toggle="modal"
                            data-target="#trackComplaintModal">
                            <div class="card text-center p-4 card-extra-css">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/search.png') }}" style="width: 80px;" />
                                    <p class="card-text mt-3">Track Your Complaint</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="javascript:void(0);" class="card-link" data-toggle="modal"
                            data-target="#generateBillModal">
                            <div class="card text-center p-4 card-extra-css">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/bill.png') }}" style="width: 80px;" />
                                    <p class="card-text mt-3">Generate Bill</p>
                                </div>
                            </div>
                        </a>
                    </div>
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="complaintPrefix">COMPLAINT-</span>
                                </div>
                                <input type="text" class="form-control" id="complaintNumber" name="comp_num"
                                       placeholder="Enter Number" required inputmode="numeric" pattern="[0-9]*">
                            </div>
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
    <div class="modal fade" id="generateBillModal" tabindex="-1" role="dialog"
        aria-labelledby="generateBillModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateBillModalLabel">Generate Your Current Bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="GET" action="{{ route('front.generate.bill') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="consumerNumber">Consumer Number</label>
                            <input type="text" class="form-control" id="consumerNumber" name="consumer_no"
                                placeholder="Enter Consumer Number" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="number" class="form-control" id="mobileNumber" name="phone"
                                placeholder="Enter Mobile Number" required>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Generate Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const input = document.getElementById('complaintNumber');
        input.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, ''); // removes non-digits
        });
    </script>

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
