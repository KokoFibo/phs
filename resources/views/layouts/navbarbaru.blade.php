{{-- @extends('layouts.main')
@section('content') --}}
<div class="h-14 bg-pink-500 text-white flex justify-between items-center px-5 shadow-xl">
    <div class="block md:flex items-center space-x-10">
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
                    <button @click="open = !open" class="">{{ __('Utilities') }} <i
                            class="ml-1 fa-sharp fa-solid fa-caret-down"></i>

                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class=" mx-auto absolute z-10 px-3 pb-3 border rounded  text-purple-700 bg-white ">
                        <ul class="w-40 mx-5 divide-y">
                            <li class="hover:bg-gray-200 py-2 my-2">
                                <a class="" href="{{ route('branch') }}">{{ __('Branch') }}</a>
                            </li>

                            <li class="hover:bg-gray-200 py-2 my-2">
                                <a class="" href="{{ route('resetumur') }}">{{ __('Reset Umur') }}</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </li>
        </ul>
    </div>
    <div>
        <div class="flex space-x-10 items-center">
            <h4>{{ Auth::user()->name }}</h4>
            <div x-data="{ open: false }" class="relative items-center">
                <button @click="open=!open">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?rounded=true&length=1&background=random&font-size=.8"
                        width="30" />
                </button>
                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute right-0 top-11 z-10 py-1 pb-3 border rounded-xl  text-purple-700 bg-white ">
                    <ul class="mx-5 w-40 divide-y text-gray-700">
                        <li class="hover:bg-gray-100 text-black text-center py-2 my-2">
                            <a href="#">{{ __('Change Profile') }}</a>
                        </li>
                        @if (Auth::user()->role != '1')
                            <li class="hover:bg-gray-100 text-black text-center py-2 my-2">
                                <a href="{{ route('registration') }}">{{ __('Register New Admin') }}</a>
                            </li>
                        @endif
                        <li class="hover:bg-gray-100 text-black text-center py-2 my-2">
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
