<div>
    <header>
        <nav class="flex flex-wrap items-center justify-between w-full px-4 py-4 text-lg text-white bg-pink-500 md:py-0">
            <div class="text-2xl text-white">
                <a href="#">Vihara Pelita Hati </a>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="block w-6 h-6 cursor-pointer md:hidden"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
                <ul class="pt-4 text-base text-white md:flex md:justify-between md:pt-0">
                    <li>
                        <a class="block py-2 md:p-4 hover:text-purple-400" href="#">Features</a>
                    </li>
                    <li class="{{ 'dashboard' == request()->path() ? 'active' : '' }}">
                        <a class="block py-2 md:p-4 hover:text-purple-400"
                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="{{ 'main' == request()->path() ? 'active' : '' }}">
                        <a class="block py-2 md:p-4 hover:text-purple-400"
                            href="{{ route('main') }}">{{ __('Data Umat') }}</a>
                    </li>
                    <li>
                        <div x-data="{ open: false }">
                            <button @click="open = !open"
                                class="block py-2 md:p-4 hover:text-purple-400
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
                    <li>
                        @if (Auth::user()->role == '3')
                            <div x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="block py-2 md:p-4 hover:text-purple-400 {{ 'branch' == request()->path() || 'panditawire' == request()->path() || 'datakotawire' == request()->path() ? 'active' : '' }}">{{ __('Group Vihara') }}
                                    <i class="ml-1 fa-sharp fa-solid fa-caret-down"></i>

                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" x-transition
                                    class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 bg-white border rounded ">
                                    <ul class="mx-5 divide-y w-44">

                                        <li
                                            class="py-2 my-2 hover:bg-gray-200 {{ 'tambahgroup' == request()->path() ? 'active1' : '' }}">
                                            <a class="block"
                                                href="{{ route('tambahgroup') }}">{{ __('Tambah Group Vihara') }}</a>
                                        </li>
                                        <li
                                            class="py-2 my-2 hover:bg-gray-200 {{ 'branch' == request()->path() ? 'active1' : '' }}">
                                            <a class="block"
                                                href="{{ route('branchwire') }}">{{ __('Tambah Data Cetya') }}</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        @endif

                    </li>
                    <li>
                        @if (app()->getLocale() == 'id')
                            {{-- <a class="dropdown-item" href="{{ url('locale/en') }}">{{ __('english') }}</a> --}}
                            <a class="block py-2 md:p-4 hover:text-purple-400"
                                href="{{ url('locale/cn') }}">{{ __('中文') }}</a>
                        @endif

                        @if (app()->getLocale() == 'cn')
                            <a class="block py-2 md:p-4 hover:text-purple-400"
                                href="{{ url('locale/id') }}">{{ __('Indonesia') }}</a>
                        @endif
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <div class="px-4">
        <div class="flex items-center justify-center max-w-2xl p-16 mx-auto my-16 bg-white rounded-lg">
            <h1 class="text-2xl font-medium">Responsive Navbar with TailwindCSS</h1>
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
</div>
