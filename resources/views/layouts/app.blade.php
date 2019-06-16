<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- Apple PWA links ( inactive ) -->
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset( 'js/app.js' ) }}" defer></script>

    <script src="{{ asset( 'js/core/jquery.3.2.1.min.js' ) }}" type="text/javascript" defer></script>
    <script src="{{ asset( 'js/core/popper.min.js' ) }}" type="text/javascript" defer></script>
    <script src="{{ asset( 'js/core/bootstrap.min.js' ) }}" type="text/javascript" defer></script>

    {{-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ --}}
    <script src="{{ asset( 'js/plugins/bootstrap-switch.js' ) }}" defer></script>

    {{-- Google Maps Plugin --}}
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?YOUR_KEY_HERE"></script> --}}

    <!--  Chartist Plugin  -->
    <script src="{{ asset( 'js/plugins/chartist.min.js' ) }}" defer></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset( 'js/plugins/bootstrap-notify.js' ) }}" defer></script>

    {{-- jVector Map   --}}
    <script src="{{ asset( 'js/plugins/jquery-jvectormap.js' ) }}" type="text/javascript" defer></script>

    {{-- Plugin for Date Time Picker and Full Calendar Plugin --}}
    <script src="{{ asset( 'js/plugins/moment.min.js' ) }}" defer></script>

    {{-- DatetimePicker    --}}
    <script src="{{ asset( 'js/plugins/bootstrap-datetimepicker.js' ) }}" defer></script>

    {{-- Sweet Alert   --}}
    <script src="{{ asset( 'js/plugins/sweetalert2.min.js' ) }}" type="text/javascript" defer></script>

    {{-- Tags Input   --}}
    <script src="{{ asset( 'js/plugins/bootstrap-tagsinput.js' ) }}" type="text/javascript" defer></script>

    {{-- Sliders   --}}
    <script src="{{ asset( 'js/plugins/nouislider.js' ) }}" type="text/javascript" defer></script>

    {{-- Bootstrap Select   --}}
    <script src="{{ asset( 'js/plugins/bootstrap-selectpicker.js' ) }}" type="text/javascript" defer></script>

    {{-- jQueryValidate   --}}
    <script src="{{ asset( 'js/plugins/jquery.validate.min.js' ) }}" type="text/javascript" defer></script>

    {{-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard  --}}
    <script src="{{ asset( 'js/plugins/jquery.bootstrap-wizard.js' ) }}" defer></script>

    {{-- Bootstrap Table Plugin  --}}
    <script src="{{ asset( 'js/plugins/bootstrap-table.js' ) }}" defer></script>

    {{-- DataTable Plugin  --}}
    <script src="{{ asset( 'js/plugins/jquery.dataTables.min.js' ) }}" defer></script>

    {{-- Full Calendar    --}}
    <script src="{{ asset( 'js/plugins/fullcalendar.min.js' ) }}" defer></script>

    {{-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc  --}}
    <script src="{{ asset( 'js/light-bootstrap-dashboard.js?v=2.0.1' ) }}" type="text/javascript" defer></script>

    <script src="{{ asset( 'js/core/demo.js' ) }}" defer></script>
    <script src="{{ asset( 'js/core/login.js' ) }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b21d9cc4eb.js"></script>

    <!-- Styles -->
    <link href="{{ asset( 'css/app.css' ) }}" rel="stylesheet">
</head>
<body>

    @auth

        <div id="app" class="wrapper">

            @include( 'app.components.sidenav' )
    
            <div class="main-panel">
    
                @include( 'app.components.appnavbar' )
    
                <div class="content">
    
                    <div class="container-fluid">
    
                        @yield( 'content' )
                    </div>
                </div>
    
                @include( 'app.components.footer' )
            </div>
        </div>
    @else

        <div id="app" class="wrapper wrapper-full-page">

            @include( 'app.components.topnav' )

            <div class="full-page section-image" data-color="azure" data-image="{{ url( '/img/app/full-screen-image-3.jpg' ) }}" >

                <div class="content">

                    @yield( 'content' )
                </div>
            </div>
        </div>
    @endauth
</body>
</html>
