{{--
<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Responsive Navbar with Dropdown Menu</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head> --}}
<style>
    .nav-link {
        color: white !important;
        transition: all 0.2s;
        position: relative;
    }

    .nav-link:hover {
        color: pink !important;
        border-bottom: 2px solid white;
    }

    .nav-link1:hover::after {
        content: "";
        height: 2px;
        width: 100%;
        background-color: pink;
        position: absolute;
        bottom: 0;
        left: 0;
    }
</style>
{{--

<body> --}}
    <nav class="px-5 navbar navbar-expand-lg navbar-dark"
        style="background-color: rgb(236, 72, 153); color: white !important">
        <a class="navbar-brand fs-xl" href="#">
            <h4>Vihara Pelita Hati</h4>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main') }}">Data Umat</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kelas Pendalaman
                    </a>
                    <div style="background-color: rgb(236, 72, 153); color: white" class="dropdown-menu"
                        aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('tambahkelas') }}">Tambah Kelas</a>
                        <a class="dropdown-item" href="{{ route('daftarkelas') }}">Daftar Kelas</a>
                        <a class="dropdown-item" href="{{ route('absensi') }}">Absensi Kelas</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Utilities
                    </a>
                    <div style="background-color: rgb(236, 72, 153); color: white" class="dropdown-menu"
                        aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('tambahgroup') }}">Tambah Group Vihara</a>
                        <a class="dropdown-item" href="{{ route('branchwire') }}">Tambah Data Cetya</a>
                    </div>
                </li>
                <li class="nav-item active">

                    @if (app()->getLocale() == 'id')
                    <a class="nav-link" href="{{ url('locale/cn') }}">中文 <span class="sr-only">(current)</span></a>

                    @endif

                    @if (app()->getLocale() == 'cn')
                    <a class="nav-link" href="{{ url('locale/id') }}">{{ __('Indonesia') }} <span
                            class="sr-only">(current)</span></a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
    {{--
</body>

</html> --}}
