{{-- @extends('layouts.main')
@section('content') --}}
@if (Auth::user()->role != '0')
    <div class="flex items-center justify-between w-screen px-5 text-white bg-pink-500 shadow-xl h-14">
        <div class="block space-x-10 lg:items-center lg:flex">
            <h1 class="text-2xl">{{ __('Vihara Pelita Hati') }}</h1>
            <ul class="flex space-x-5">
                <li class="{{ 'dashboard' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>

                <li class="{{ 'main' == request()->path() ? 'active' : '' }}">
                    <a href="{{ route('main') }}">{{ __('Data Umat') }}</a>
                </li>
                <li>
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="{{ 'tambahkelas' == request()->path() || 'daftarkelas' == request()->path() || 'absensi' == request()->path() ? 'active' : '' }}">{{ __('Absensi') }}
                            <i class="ml-1 fa-sharp fa-solid fa-caret-down"></i>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" x-transition
                            class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                            <ul class="w-32 mx-5 divide-y">
                                @if (Auth::user()->role == '3')
                                    <li
                                        class="py-2 my-2  hover:bg-gray-200 {{ 'tambahkelas' == request()->path() ? 'active1' : '' }}">
                                        <a class="block dropdown-item"
                                            href="{{ route('tambahkelas') }}">{{ __('Tambah Kelas') }}</a>
                                    </li>

                                    <li
                                        class="py-2 my-2 hover:bg-gray-200 {{ 'daftarkelas' == request()->path() ? 'active1' : '' }}">
                                        <a class="block dropdown-item"
                                            href="{{ route('daftarkelas') }}">{{ __('Daftar Kelas') }}</a>
                                    </li>
                                @endif

                                <li
                                    class="py-2 my-2 hover:bg-gray-200 {{ 'absensi' == request()->path() ? 'active1' : '' }}">
                                    <a class="block dropdown-item"
                                        href="{{ route('absensi') }}">{{ __('Absensi Kelas') }}</span></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </li>

                <li>
                    @if (Auth::user()->role == '3')
                        <div x-data="{ open: false }">
                            <button @click="open = !open"
                                class="{{ 'branch' == request()->path() || 'panditawire' == request()->path() || 'datakotawire' == request()->path() ? 'active' : '' }}">{{ __('Group Vihara') }}
                                <i class="ml-1 fa-sharp fa-solid fa-caret-down"></i>

                            </button>
                            <div x-show="open" x-cloak @click.away="open = false" x-transition
                                class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                                <ul class="mx-5 divide-y w-44">

                                    <li
                                        class="py-2 my-2 hover:bg-gray-200 {{ 'tambahgroup' == request()->path() ? 'active1' : '' }}">
                                        <a class="block"
                                            href="{{ route('tambahgroup') }}">{{ __('Group Vihara') }}</a>
                                    </li>
                                    <li
                                        class="py-2 my-2 hover:bg-gray-200 {{ 'branch' == request()->path() ? 'active1' : '' }}">
                                        <a class="block" href="{{ route('branchwire') }}">{{ __('Data Vihara') }}</a>
                                    </li>
                                    {{-- reset pakai link aja /resetumur --}}
                                    {{-- <li class="py-2 my-2 hover:bg-gray-200 ">
                                <a class="block" href="{{ route('resetumur') }}">{{ __('Reset All') }}</a>
                            </li> --}}

                                </ul>
                            </div>
                        </div>
                    @endif

                </li>
                {{-- language --}}
                <li>
                    @if (app()->getLocale() == 'id')
                        {{-- <a class="dropdown-item" href="{{ url('locale/en') }}">{{ __('english') }}</a> --}}
                        <a class="block dropdown-item" href="{{ url('locale/cn') }}">{{ __('中文') }}</a>
                    @endif

                    @if (app()->getLocale() == 'cn')
                        <a class="block dropdown-item" href="{{ url('locale/id') }}">{{ __('Indonesia') }}</a>
                    @endif
                </li>
                {{-- language-end --}}
            </ul>
        </div>
        <div>
            <div class="flex items-center space-x-10">
                <h4>{{ Auth::user()->name }} ({{ roleCheck(Auth::user()->role) }})</h4>
                <div x-data="{ open: false }" class="relative items-center">
                    <button @click="open=!open">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?rounded=true&length=1&background=random&font-size=.8"
                            width="30" />
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="absolute right-0 z-10 py-1 pb-3 text-purple-700 bg-white border top-11 rounded-xl ">
                        <ul class="w-40 mx-5 text-gray-700 divide-y">
                            <li class="py-2 my-2 text-center text-purple-500 hover:bg-gray-100">
                                <a class="block" href="{{ route('changeprofile') }}">{{ __('Change Profile') }}</a>
                            </li>
                            @if (Auth::user()->role == '2' || Auth::user()->role == '3')
                                <li class="py-2 my-2 text-center text-purple-500 hover:bg-gray-100">
                                    <a class="block"
                                        href="{{ route('registration') }}">{{ __('Update New Admin') }}</a>
                                </li>
                            @endif
                            <li class="py-2 my-2 text-center text-purple-500 hover:bg-gray-100">
                                <a class="block" href="#">{{ __('User Setting') }}<span
                                        class="text-red-500">({{ __('Under
                                                                                                                                                                                                                                                                                                                            Construction') }})</span></a>
                            </li>
                            <li class="py-2 my-2 text-center text-purple-500 hover:bg-gray-100">
                                <a class="block" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- @endsection --}}
