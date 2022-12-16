<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pelita</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    @livewireStyles
</head>

<body>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    @stack('script')
    @livewireScripts
</body>

</html>
