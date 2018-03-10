<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="author" content="Wojciech Mleczek">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/facebook.png') }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="{{ config('app.description') }}">

    @section('scripts-synced')
        <script>document.documentElement.className = document.documentElement.className.replace("no-js", "js")</script>
        <script src="{{ mix('js/synced.js') }}"></script>
    @endsection

    @section('styles-synced')
        <link href="{{ mix('css/synced.css') }}" rel="stylesheet">
    @endsection
</head>
<body>
    @include('layouts.fragments.navbar')
    @include('layouts.fragments.alerts')
    @yield('content')

    @section('scripts-deferred')
        <script src="{{ mix('js/deferred.js') }}"></script>
    @endsection

    @section('styles-deferred')
        @include('layouts.fragments.styles-deferred')
    @endsection
</body>
</html>
