<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url('favicon-32x32.png') }}">

    <title>{{ config('app.name') }} |
        @yield('title')
    </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    @livewireStyles

</head>

<body>
    {{-- @include('layouts.navbarbaru') --}}
    @yield('content')
    {{-- <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script> --}}
    {{-- <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script> --}}
    @livewireScripts
    @stack('script')
</body>

</html>
