<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="user" content="{{ Auth::user() }}">

    <!-- Apple PWA links ( inactive ) -->
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset( 'js/app.js' ) }}" defer></script>
    <script src="{{ asset( 'js/pace.js' ) }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset( 'css/app.css' ) }}" rel="stylesheet">
</head>
<body>

    <v-app id="app" v-cloak>
        <snack-bar></snack-bar>

        @include( 'layouts.toolbar' )

        @yield( 'content' )
    </v-app>
</body>
</html>
