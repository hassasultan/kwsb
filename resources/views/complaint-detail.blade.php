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
    .status {
        font-size: 2rem;
        font-weight: bold;
        margin-top: 10px;
    }

    .status.pending {
        color: orange;
    }

    .status.completed {
        color: green;
    }

    .status.processing {
        color: blue;
    }

    .card {
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body class="vertical"
    style="background-color:#fff !important; background-image:url('{{ asset('assets/images/cmp-bg.jpg') }}') !important;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Complaint Details</h3>
                        <div class="row">
                            <div class="col-md-6">

                                <p><strong>Complaint Number:</strong> <span id="comp_num"></span></p>
                                <p><strong>Title:</strong> <span id="title"></span></p>
                                <p><strong>Description:</strong> <span id="description"></span></p>
                                <p><strong>Customer Name:</strong> <span id="customer_name"></span></p>
                                <p><strong>Phone:</strong> <span id="phone"></span></p>
                                <p><strong>Email:</strong> <span id="email"></span></p>
                                <p><strong>Address:</strong> <span id="address"></span></p>
                                <p><strong>Landmark:</strong> <span id="landmark"></span></p>
                                <p><strong>Created Date:</strong> <span id="created-date"></span></p>
                                <p><strong>Resolved:</strong> <span id="solved"></span></p>
                            </div>
                            <div class="col-md-6">
                                @if ($comp->image != null)
                                    <p><strong>Complaint Main Image</strong></p>
                                    <img src="{{ asset('storage/' . $comp->image) }}" style="width:250px;" />
                                    <br />
                                @endif
                                @if ($comp->before_image != null)
                                    <p><strong>Complaint Before Image</strong></p>
                                    <img src="{{ asset('storage/' . $comp->before_image) }}" style="width:250px;" />
                                    <br />
                                @endif
                                @if ($comp->after_image != null)
                                    <p><strong>Complaint After Image</strong></p>
                                    <img src="{{ asset('storage/' . $comp->after_image) }}" style="width:250px;" />
                                    <br />
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center status" id="status">
                                    @if ($comp->status == 1)
                                        COMPLETED
                                    @elseif($comp->status == 0)
                                        PENDING
                                    @else
                                        IN PROCESS
                                    @endif
                                </h3>
                                <div class="text-center status">
                                    @if ($comp->status == 0)
                                        <img src="{{ asset('assets/images/pending.jpg') }}" style="width: 200px;" />
                                    @endif
                                    @if ($comp->status == 2)
                                        <img src="{{ asset('assets/images/progress.jpeg') }}" style="width: 200px;" />
                                    @endif
                                    @if ($comp->status == 1)
                                        <img src="{{ asset('assets/images/completed.png') }}" style="width: 200px;" />
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $content = $comp->description;

// Remove line breaks
    $updatedContent = str_replace(["\r\n", "\n", "\r"], '', $content);
    @endphp
    <script>
        // Mock complaint data
        const complaint = {
            comp_num: "{{ $comp->comp_num }}",
            customer_num: "CN123456",
            title: "{{ $comp->type->title }}",
            description: "{{ $updatedContent }}",
            customer_name: "{{ $comp->customer_name }}",
            phone: "{{ $comp->phone }}",
            email: "{{ $comp->email }}",
            address: "{{ $comp->address }}",
            landmark: "{{ $comp->landmark }}",
            CDate: "{{ $comp->created_at }}",
            solved: "{{ $comp->updated_at }}",
        };

        // Function to load complaint data
        function loadComplaintData() {
            console.log(complaint);
            document.getElementById('comp_num').innerText = complaint.comp_num;
            document.getElementById('title').innerText = complaint.title;
            document.getElementById('description').innerText = complaint.description;
            document.getElementById('customer_name').innerText = complaint.customer_name;
            document.getElementById('phone').innerText = complaint.phone;
            document.getElementById('email').innerText = complaint.email;
            document.getElementById('address').innerText = complaint.address;
            document.getElementById('landmark').innerText = complaint.landmark;
            document.getElementById('created-date').innerText = complaint.CDate;
            document.getElementById('solved').innerText = complaint.solved;

        }

        // Load data on page load
        document.addEventListener('DOMContentLoaded', loadComplaintData);
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
