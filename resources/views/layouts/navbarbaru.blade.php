{{-- @extends('layouts.main')
@section('content') --}}
<div class="flex items-center justify-between px-5 text-white bg-pink-500 shadow-xl h-14">
    <div class="items-center block space-x-10 md:flex">
        <h1 class="text-2xl">{{ __('Vihara Pelita Hati') }}</h1>
        <ul class="flex space-x-5">
            <li>
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li>
                <a href="{{ route('main') }}">{{ __('Main') }}</a>
            </li>


            <li>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="">{{ __('Kelas Pendalaman') }} <i
                            class="ml-1 fa-sharp fa-solid fa-caret-down"></i>
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                        <ul class="w-40 mx-5 divide-y">
                            <li class="py-2 my-2 hover:bg-gray-200">
                                <a class="dropdown-item" href="#">{{ __('Input Kelas') }}</a>
                            </li>
                            <li class="py-2 my-2 hover:bg-gray-200">
                                <a class="dropdown-item" href="#">{{ __('Absensi Kelas') }}</a>
                            </li>


                        </ul>
                    </div>

                </div>
            </li>
            <li>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="">{{ __('Utilities') }} <i
                            class="ml-1 fa-sharp fa-solid fa-caret-down"></i>

                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                        <ul class="w-40 mx-5 divide-y">
                            {{-- language --}}
                            <li class="py-2 my-2 hover:bg-gray-200">


                                @if (app()->getLocale() == 'id')
                                    {{-- <a class="dropdown-item" href="{{ url('locale/en') }}">{{ __('english') }}</a> --}}
                                    <a class="dropdown-item" href="{{ url('locale/cn') }}">{{ __('中文') }}</a>
                                @endif

                                @if (app()->getLocale() == 'cn')
                                    <a class="dropdown-item" href="{{ url('locale/id') }}">{{ __('Indonesia') }}</a>
                                @endif


                            </li>
                            {{-- language-end --}}
                            <li class="py-2 my-2 hover:bg-gray-200">
                                <a class="" href="{{ route('branchwire') }}">{{ __('Branch') }}</a>
                            </li>

                            <li class="py-2 my-2 hover:bg-gray-200">
                                <a class="" href="{{ route('resetumur') }}">{{ __('Reset Umur') }}</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </li>
        </ul>
    </div>
    <div>
        <div class="flex items-center space-x-10">
            <h4>{{ Auth::user()->name }}</h4>
            <div x-data="{ open: false }" class="relative items-center">
                <button @click="open=!open">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?rounded=true&length=1&background=random&font-size=.8"
                        width="30" />
                </button>
                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute right-0 z-10 py-1 pb-3 text-purple-700 bg-white border top-11 rounded-xl ">
                    <ul class="w-40 mx-5 text-gray-700 divide-y">
                        <li class="py-2 my-2 text-center text-black hover:bg-gray-100">
                            <a href="#">{{ __('Change Profile') }}</a>
                        </li>
                        @if (Auth::user()->role == '2' || Auth::user()->role == '3')
                            <li class="py-2 my-2 text-center text-black hover:bg-gray-100">
                                <a href="{{ route('registration') }}">{{ __('Register New Admin') }}</a>
                            </li>
                        @endif
                        <li class="py-2 my-2 text-center text-black hover:bg-gray-100">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
