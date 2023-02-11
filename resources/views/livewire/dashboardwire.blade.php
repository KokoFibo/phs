<div class="bg-slate-100 ">

    @section('title', 'Dashboard')
    {{-- first row --}}

    @if (Auth::user()->role == 0)
        {
        <h1>Silakan Hubungi Supervisor atau Manager anda untuk mengaktifkan akun anda.</h1>
        <h1>Terima Kasih</h1>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
            @csrf
        </form>
        }
    @else
        <div class="flex flex-col items-center gap-2 pt-5 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">

            <div>
                <x-card smalltext="Umat" bigtext="{{ $totalUmat }}" textcolor="text-purple-500"
                    bordercolor="border-purple-500" />
            </div>
            <div>
                <x-card smalltext="UmatActive" bigtext="{{ $umatActive }}" textcolor="text-green-500"
                    bordercolor="border-green-500" />
            </div>

            <div>
                <x-card smalltext="Umat Inactive" bigtext="{{ $umatInactive }}" textcolor="text-blue-500"
                    bordercolor="border-blue-500" />
            </div>

            <div>
                <x-card smalltext="Umat {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="text-yellow-500"
                    bordercolor="border-yellow-500" />
            </div>
            <div>
                <x-card smalltext="Cetya" bigtext="{{ $totalBranch }}" textcolor="text-red-500"
                    bordercolor="border-red-500" />
            </div>

        </div>
        {{-- second row --}}
        <div class="flex flex-col items-center gap-2 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">
            <div>
                <x-card smalltext="Pandita" bigtext="{{ $totalPandita }}" textcolor="text-indigo-500"
                    bordercolor="border-indigo-500" />
            </div>

            <div>
                <x-card smalltext="Users" bigtext="{{ $totalUsers }}" textcolor="text-orange-500"
                    bordercolor="border-orange-500" />
            </div>
            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $umatActive }}" textcolor="text-teal-500"
                    bordercolor="border-teal-500" />
            </div>

            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $umatInactive }}" textcolor="text-pink-500"
                    bordercolor="border-pink-500" />
            </div>

            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $umatYTD }}" textcolor="text-sky-500"
                    bordercolor="border-sky-500" />
            </div>


        </div>
        {{-- Third row --}}
        <div class="flex flex-col items-center gap-2 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">
            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $totalBranch }}" textcolor="text-lime-500"
                    bordercolor="border-lime-500" />
            </div>
            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $totalPandita }}" textcolor="text-fuchsia-500"
                    bordercolor="border-fuchsia-500" />
            </div>
            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $totalBranch }}" textcolor="text-red-500"
                    bordercolor="border-red-500" />
            </div>
            <div>
                <x-card smalltext="Future Reserved" bigtext="{{ $totalPandita }}" textcolor="text-blue-500"
                    bordercolor="border-blue-500" />
            </div>
            <div>
                <x-card smalltext="Umat {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="text-yellow-500"
                    bordercolor="border-yellow-500" />
            </div>
        </div>
    @endif

</div>
