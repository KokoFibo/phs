@if (Auth::user()->role != '0')
    <div>
        <div class="flex flex-wrap items-center justify-between w-full px-4 py-3 text-lg text-white bg-pink-500 lg:py-1">
            <div class="text-2xl text-white">
                <a href="#">Vihara Pelita Hati </a>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="block w-6 h-6 mr-3 cursor-pointer lg:hidden"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <div class="hidden w-full lg:flex lg:items-center lg:w-auto" id="menu">
                <ul class="pt-4 text-base text-white lg:flex lg:justify-between lg:items-center lg:pt-0">

                    <li
                        class="{{ 'dashboard' == request()->path() ? 'active' : '' }} text-center text-white hover:bg-gray-100 hover:text-purple-500 hover:lg:bg-pink-500">
                        <a class="block py-2 lg:p-4 hover:text-purple-500"
                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li
                        class="{{ 'main' == request()->path() ? 'active' : '' }} text-center text-white hover:bg-gray-100 hover:text-purple-500 hover:lg:bg-pink-500">
                        <a class="block py-2 lg:p-2 hover:text-purple-500"
                            href="{{ route('main') }}">{{ __('Data Umat') }}</a>
                    </li>
                    @if (Auth::user()->role == '3' || Auth::user()->role == '2')

                        <li>
                            <div x-data="{ open: false }" class="text-center">
                                <button @click="open = !open"
                                    class=" py-2 lg:p-2  text-center text-white hover:bg-gray-100 hover:text-purple-500 hover:lg:bg-pink-500
                                {{ 'tambahkelas' == request()->path() || 'daftarkelas' == request()->path() || 'absensi' == request()->path() ? 'active' : '' }}">{{ __('Absensi') }}
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
                    @endif

                    <li class="text-center text-white hover:bg-gray-100 hover:text-purple-500 hover:lg:bg-pink-500">
                        @if (Auth::user()->role == '3')
                            <div x-data="{ open: false }">
                                <button @click="open = !open"
                                    class=" py-2 lg:p-2 hover:text-purple-400 {{ 'branch' == request()->path() || 'panditawire' == request()->path() || 'datakotawire' == request()->path() ? 'active' : '' }}">{{ __('Group Vihara') }}
                                    <i class="ml-1 fa-sharp fa-solid fa-caret-down"></i>

                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" x-transition
                                    class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                                    <ul class="w-32 mx-5 divide-y">
                                        <li
                                            class="py-2 my-2 hover:bg-gray-200 {{ 'tambahgroup' == request()->path() ? 'active1' : '' }}">
                                            <a class="block"
                                                href="{{ route('tambahgroup') }}">{{ __('Group Vihara') }}</a>
                                        </li>
                                        <li
                                            class="py-2 my-2 hover:bg-gray-200 {{ 'branch' == request()->path() ? 'active1' : '' }}">
                                            <a class="block"
                                                href="{{ route('branchwire') }}">{{ __('Data Vihara') }}</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        @endif

                    </li>
                    <li class="text-center text-white hover:bg-gray-100 ">
                        @if (app()->getLocale() == 'id')
                            {{-- <a class="dropdown-item" href="{{ url('locale/en') }}">{{ __('english') }}</a> --}}
                            <a class="block py-2 lg:p-2 hover:text-purple-500 hover:lg:bg-pink-500"
                                href="{{ url('locale/cn') }}">{{ __('中文') }}</a>
                        @endif

                        @if (app()->getLocale() == 'cn')
                            <a class="block py-2 lg:p-2 hover:text-purple-500 hover:lg:bg-pink-500"
                                href="{{ url('locale/id') }}">{{ __('Indonesia') }}</a>
                        @endif
                    </li>
                    <li>
                        <div class="flex items-center hidden space-x-10 lg:inline">
                            <h4 class="block py-2 lg:p-2">{{ Auth::user()->name }}</h4>
                        </div>
                    </li>
                    <li class="text-center text-white hover:bg-gray-100 hover:text-pink-500 lg:hover:green-500">
                        <div x-data="{ open: false }" class="relative items-center ">
                            <button @click="open=!open" class="py-2 lg:p-2 hover:text-purple-500 hover:lg:bg-pink-500 ">
                                <img class="hidden  lg:inline hover:lg:transform hover:lg:scale-125 hover:lg:transition-all"
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?rounded=true&length=1&background=random&font-size=.8"
                                    width="30" />
                                <p class="text-center lg:hidden">{{ __('Profile') }} <i
                                        class="ml-1 fa-sharp fa-solid fa-caret-down"></i></p>


                            </button>


                            <div x-show="open" x-cloak @click.away="open = false" x-transition
                                class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded lg:right-0 ">
                                <ul class="w-40 mx-5 text-gray-700 divide-y">
                                    <li class="py-2 my-2 text-center text-purple-500 hover:bg-gray-100">
                                        <a class="block"
                                            href="{{ route('changeprofile') }}">{{ __('Change Profile') }}</a>
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

                    </li>
                    <li class="py-2 my-2 text-center text-white lg:hidden hover:bg-gray-100 hover:text-pink-500">
                        <a class="block" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                            @csrf
                        </form>
                    </li>

                </ul>

            </div>
        </div>
    </div>
    @push('script')
        <script>
            const button = document.querySelector("#menu-button");
            const menu = document.querySelector("#menu");

            button.addEventListener("click", () => {
                menu.classList.toggle("hidden");
            });
        </script>
    @endpush
@endif
