<nav class="navbar navbar-expand-lg navbar-dark bg-purple">
    <a class="navbar-brand" href="#">Vihara Pelita Hati</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">{{ __('Dashboard') }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('main') }}">{{ __('Main') }}<span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('resetpassword') }}">{{ __('Reset Password') }}<span
                        class="sr-only">(current)</span></a>
            </li>
            {{-- ============================================= --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    {{ __('Utilities') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('branch') }}">{{ __('Branch') }}</a>
                    <a class="dropdown-item" href="{{ route('resetumur') }}">{{ __('Reset Umur') }}</a>
                </div>
            </li>

            {{-- logout --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </li> --}}


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    {{ __('Bahasa') }}
                </a>
                <div class="dropdown-menu">
                    @if (app()->getLocale() == 'id')
                        {{-- <a class="dropdown-item" href="{{ url('locale/en') }}">{{ __('english') }}</a> --}}
                        <a class="dropdown-item" href="{{ url('locale/cn') }}">{{ __('中文') }}</a>
                    @endif

                    @if (app()->getLocale() == 'cn')
                        <a class="dropdown-item" href="{{ url('locale/id') }}">{{ __('Indonesia') }}</a>
                    @endif

                </div>
            </li>

        </ul>
        <div>
            @livewire('branchname')
        </div>
        <div class="d-flex align-items-center">
            <div class="">
                {{-- ============================================= --}}
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown btn-group dropleft">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} (
                            @if (Auth::user()->role == '1')
                                {{ __('Admin') }}
                            @elseif (Auth::user()->role == '2')
                                {{ __('Supervisor') }}
                            @elseif (Auth::user()->role == '3')
                                {{ __('Manager') }}
                            @else
                                {{ __('Illegal') }}
                            @endif
                            )
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">{{ __('Change Profile') }}</a>
                            @if (Auth::user()->role != '1')
                                <a class="dropdown-item"
                                    href="{{ route('registration') }}">{{ __('Register New Admin') }}</a>
                            @endif
                        </div>
                    </li>

                </ul>
                {{-- ============================================= --}}
            </div>
            <div>
                <a class="text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="ml-2 fa-solid fa-right-from-bracket fa-xl"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
