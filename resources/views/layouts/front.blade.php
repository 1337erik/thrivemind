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
    <script src="{{ asset( 'js/front/jquery-1.10.2.js' ) }}" type="text/javascript" defer></script>
    <script src="{{ asset( 'js/front/jquery-ui-1.10.4.custom.min.js' ) }}" type="text/javascript" defer></script>
    <script src="{{ asset( 'js/front/bootstrap.js' ) }}" type="text/javascript" defer></script>
    <script src="{{ asset( 'js/front/awesome-landing-page.js' ) }}" type="text/javascript" defer></script>

    <!-- Style Sheets -->
    <link href="{{ asset( 'css/front/bootstrap.css' ) }}" rel="stylesheet" />
    <link href="{{ asset( 'css/front/landing-page.css' ) }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <script src="https://kit.fontawesome.com/b21d9cc4eb.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset( 'css/front/pe-icon-7-stroke.css' ) }}" rel="stylesheet" />

</head>
<body class="landing-page landing-page1">

    @include( 'front.components.topnav' )

    <div class="wrapper">

        @yield( 'content' )

        @include( 'front.components.footer' )
    </div>
</body>
</html>
