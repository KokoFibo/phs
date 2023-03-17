<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url('favicon-32x32.png') }}">

    <title>{{ config('app.name') }} |
        @yield('title')
    </title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" /> --}}

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    @stack('style')


    @livewireStyles

</head>

<body class="dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    {{-- @include('layouts.navbarbaru') --}}
    @include('layouts.navbarresponsive')
    @yield('content')


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}



    {{-- @livewireChartsScripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- toastr JS Script --}}
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right"
            }
            window.addEventListener('success', event => {
                toastr.success(event.detail.message);
            });
            window.addEventListener('warning', event => {
                toastr.warning(event.detail.message);
            });
            window.addEventListener('error', event => {
                toastr.error(event.detail.message);
            });
        });
    </script>
    <script>
        window.addEventListener('delete_confirmation', function(e) {
            Swal.fire({
                title: e.detail.title,
                text: e.detail.text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, silakan hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('delete', e.detail.id)
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                }
            })
        });
        window.addEventListener('deleted', function(e) {
            Swal.fire(
                'Deleted!', 'Data sudah di delete.', 'success'
            );
        });
    </script>

    @stack('script')
    @livewireScripts
</body>

</html>
