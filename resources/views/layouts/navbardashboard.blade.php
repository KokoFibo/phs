<nav class="px-5 navbar navbar-expand-lg navbar-dark "
    style="background-color: rgb(236, 72, 153); color: white !important">

    <a class="navbar-brand fs-xl" href="#">
        <h4>Vihara Pelita Hati</h4>
    </a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }} <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('main') }}">{{ __('Data Umat') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Absensi') }}
                </a>
                <div style="color: rgb(236, 72, 153); background-color: white" class="dropdown-menu"
                    aria-labelledby="navbarDropdownMenuLink">
                    @if (Auth::user()->role == '3')
                        <a class="dropdown-item" href="{{ route('tambahkelas') }}">{{ __('Tambah Kelas') }}</a>
                        <a class="dropdown-item" href="{{ route('daftarkelas') }}">{{ __('Daftar Kelas') }}</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('absensi') }}">{{ __('Absensi Kelas') }}</a>
                </div>
            </li>
            @if (Auth::user()->role == '3')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Group Vihara') }}
                    </a>
                    <div style="color: rgb(236, 72, 153) !important; background-color: white" class="dropdown-menu"
                        aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('tambahgroup') }}">{{ __('Tambah Group Vihara') }}</a>
                        <a class="dropdown-item" href="{{ route('branchwire') }}">{{ __('Tambah Data Vihara') }} </a>
                    </div>
                </li>
            @endif
            <li class="nav-item active">

                @if (app()->getLocale() == 'id')
                    <a class="nav-link" href="{{ url('locale/cn') }}">中文 <span class="sr-only">(current)</span></a>
                @endif

                @if (app()->getLocale() == 'cn')
                    <a class="nav-link" href="{{ url('locale/id') }}">{{ __('Indonesia') }} <span
                            class="sr-only">(current)</span></a>
                @endif
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">{{ Auth::user()->name }} <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="d-none d-lg-inline"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?rounded=true&length=1&background=random&font-size=.8"
                        width="30" />
                    <div class="d-inline d-lg-none">
                        {{ _('Profile') }}
                    </div>
                </a>
                <div style="color: rgb(236, 72, 153); background-color: white"
                    class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('changeprofile') }}">{{ __('Change Profile') }}</a>
                    @if (Auth::user()->role == '3' || Auth::user()->role == '2')
                        <a class="dropdown-item" href="{{ route('registration') }}">{{ __('Update New Admin') }}</a>
                    @endif
                    <a class="dropdown-item" href="#">{{ __('User Setting') }} <span
                            class="text-danger">({{ __('Under Construction') }})</span></a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </div>
            </li>


            <li class="nav-item active d-inline d-lg-none">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </li>

        </ul>

    </div>



</nav>


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
