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

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="vertical light">
    <div id="app" class="wrapper">
        @include('layouts.include.header')
        @if (auth()->user()->role == 1)
            @include('layouts.include.sidebar')
        @else
            @include('layouts.include.system-sidebar')
        @endif
        <main role="main" class="main-content">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
            {{-- @include('layouts.includes.footer') --}}
            {{-- @yield('content') --}}
            <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
                aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group list-group-flush my-n3">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-box fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Package has uploaded successfull</strong></small>
                                            <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                            <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-download fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Widgets are updated successfull</strong></small>
                                            <div class="my-0 text-muted small">Just create new layout Index, form, table
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-inbox fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Notifications have been sent</strong></small>
                                            <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-link fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Link was attached to menu</strong></small>
                                            <div class="my-0 text-muted small">New layout has been attached to the menu
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                        </div>
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .list-group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear
                                All</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
                aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-5">
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-success justify-content-center">
                                        <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Control area</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Activity</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Droplet</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Upload</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Users</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Settings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> <!-- main -->
    </div>
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

    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = cfFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="{{ asset('assets/js/gauge.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.custom.js') }}"></script>
    <script src='{{ asset('assets/js/jquery.dataTables.min.js') }}'></script>
    <script src='{{ asset('assets/js/dataTables.bootstrap4.min.js') }}'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bPaginate": false,
            "bFilter": true,
            "bSort": true,
            "aaSorting": [
                [1, "asc"]
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0]
            }, {
                "bSortable": true,
                "aTargets": [1]
            }, {
                "bSortable": false,
                "aTargets": [2]
            }],
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
        $('#dataTable-2').DataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bPaginate": false,
            "bFilter": true,
            "bSort": true,
            "aaSorting": [
                [1, "asc"]
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0]
            }, {
                "bSortable": true,
                "aTargets": [1]
            }, {
                "bSortable": false,
                "aTargets": [2]
            }],
            autoWidth: true,
            lengthMenu: [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ],
            language: {
                search: '',
                searchPlaceholder: "Search..."
            },
            order: [],
            //   columnDefs: [
            //     { targets: 'no-sort', orderable: false }
            //   ],
            dom: "<'row align-items-center'<'col-sm-12 col-md-6 text-muted mb-2'i>" +
                "<'col-sm-12 col-md-6 text-muted mb-2'f>>" +
                "<'row mb-4'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5 text-muted'l><'col-sm-12 col-md-7'p>>",
        });

        //custom search input
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_filter input').addClass('form-control');

        //custom page #
        $('.dataTables_length select').removeClass('form-control-sm');
        $('.dataTables_length select').addClass('form-control');
    </script>
    <script src='{{ asset('assets/js/jquery.mask.min.js') }}'></script>
    <script src='{{ asset('assets/js/select2.min.js') }}'></script>
    <script src='{{ asset('assets/js/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('assets/js/jquery.validate.min.js') }}'></script>
    <script src='{{ asset('assets/js/jquery.timepicker.js') }}'></script>
    <script src='{{ asset('assets/js/dropzone.min.js') }}'></script>
    <script src='{{ asset('assets/js/uppy.min.js') }}'></script>
    <script src='{{ asset('assets/js/ion.rangeSlider.min.js') }}'></script>
    <script src='{{ asset('assets/js/jQuery.tagify.min.js') }}'></script>

    <script src='{{ asset('assets/js/quill.min.js') }}'></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });

        $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $('.time-input').timepicker({
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });

        /** date range picker */
        if ($('.datetimes').length) {
            $('.datetimes').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        }

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            }
        }, cb);

        cb(start, end);

        $('.input-placeholder').mask("00/00/0000", {
            placeholder: "__/__/____"
        });
        $('.input-zip').mask('00000-000', {
            placeholder: "____-___"
        });
        $('.input-money').mask("#.##0,00", {
            reverse: true
        });
        $('.input-phoneus').mask('(000) 000-0000');
        $('.input-mixed').mask('AAA 000-S0S');
        $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                }
            },
            placeholder: "___.___.___.___"
        });

        // editor
        var editor = document.getElementById('editor');

        if (editor) {
            var toolbarOptions = [
                [{
                    'font': []
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'align': []
                }],

                ['clean'] // remove formatting button
            ];

            var quill = new Quill(editor, {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
        }

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        //ion-rangeslider
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000,
            from: 200,
            to: 500,
            grid: true
        });

        var tinput = $('input[name=tags-jquery]').tagify({
                whitelist: [{
                    "id": 1,
                    "value": "some string"
                }]
            })
            .on('add', function(e, tagName) {
                console.log('JQEURY EVENT: ', 'added', tagName)
            })
            .on("invalid", function(e, tagName) {
                console.log('JQEURY EVENT: ', "invalid", e, ' ', tagName);
            });

        // get the Tagify instance assigned for this jQuery input object so its methods could be accessed
        var jqTagify = tinput.data('tagify');
    </script>
    <script>
        var uptarg = document.getElementById('drag-drop-area');
        if (uptarg) {
            var uppy = Uppy.Core()
                .use(Uppy.Dashboard, {
                    inline: true,
                    target: uptarg,
                    proudlyDisplayPoweredByUppy: false,
                    theme: 'dark',
                    width: 770,
                    height: 210,
                    plugins: ['Webcam']
                })
                .use(Uppy.Tus, {
                    endpoint: 'https://master.tus.io/files/'
                });

            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
            });
        }
    </script>
    <script src="{{ asset('assets/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyAZtTVNWbZX8XNVXgxvhglYUozY5lODs40",
            authDomain: "kwsc-a96c0.firebaseapp.com",
            projectId: "kwsc-a96c0",
            storageBucket: "kwsc-a96c0.firebasestorage.app",
            messagingSenderId: "653256839310",
            appId: "1:653256839310:web:5738f31a533e76c80c79df",
            measurementId: "G-0FPCJCDP4H"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        messaging.requestPermission()
            .then(() => messaging.getToken({
                vapidKey: 'BLPgmK6tE_hiczwq3tUgPiRzsEurmn9MYLRP5AAjUS330sjSZ0SU-VzTC915DAc0T1QAUP3359bWIYLoOwDkd8s'
            }))
            .then((token) => {
                // Send this token to your Laravel backend via API
                if (token) {
                    // Save device token to backend
                    fetch('/api/device-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Authorization': 'Bearer ' + (localStorage.getItem('access_token') || ''),
                        },
                        body: JSON.stringify({
                            device_token: token,
                            platform: 'web'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Device token saved successfully');
                        } else {
                            console.error('Failed to save device token:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error saving device token:', error);
                    });
                }
            });
        messaging.onMessage((payload) => {
            // Show notification to user
            alert(payload.notification.title + ': ' + payload.notification.body);
        });
    </script>
    @yield('bottom_script')
</body>

</html>
