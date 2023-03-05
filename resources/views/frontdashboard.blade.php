<div class="flex items-center w-full px-14">

    @if (Auth::user()->role == 3)
    <div class="relative inline-flex w-1/4 m-5">
        <select wire:model="selectedGroupVihara"
            class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
            <option value="">{{ __('All Groups') }}</option>
            @foreach ($groupvihara as $g)
            <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
            @endforeach
        </select>
    </div>






    @endif

    <div class="relative inline-flex w-1/4 m-5">
        <select wire:model="selectedBranch"
            class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
            <label>Pilih Kelas</label>
            @if (Auth::user()->role == '3')
            <option value="">{{ __('All Vihara') }}</option>
            @endif
            @foreach ($branch as $b)
            <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
            @endforeach
        </select>

    </div>

    <div class=w-full mx-auto>
        @if (Auth::user()->role == '3')
        <h1 class="text-4xl font-semibold text-center text-purple-500">{{ getGroupVihara($selectedGroupVihara) }} {{
            getBranch($selectedBranch) }}</h1>
        @elseif ($selectedBranch == '')
        <h1 class="text-4xl font-semibold text-center text-purple-500">{{ getGroupVihara($selectedGroupVihara) }}</h1>
        @else
        <h1 class="text-4xl font-semibold text-center text-purple-500">{{ getGroupVihara($selectedGroupVihara) }} - {{
            getBranch($selectedBranch) }}</h1>
        @endif
    </div>
</div>
{{-- select box end --}}

<div class="flex flex-col items-center md:flex md:flex-row md:justify-evenly ">

    <div>
        <x-card smalltext="{{ __('Umat') }}" bigtext="{{ $totalUmat }}" textcolor="text-purple-500"
            bordercolor="border-purple-500" />
    </div>
    {{-- <div>
        <x-card smalltext="{{ __('Umat Active') }}" bigtext="{{ $umatActive }}" textcolor="text-green-500"
            bordercolor="border-green-500" />
    </div> --}}

    <div>
        <x-card smalltext="{{ __('Umat') }} {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="text-yellow-500"
            bordercolor="border-yellow-500" />
    </div>

    <div>
        <x-card smalltext="{{ __('Umat Inactive') }}" bigtext="{{ $umatInactive }}" textcolor="text-blue-500"
            bordercolor="border-blue-500" />
    </div>
    <div>
        <x-card smalltext="{{ __('Vihara') }}" bigtext="{{ $totalBranch }}" textcolor="text-red-500"
            bordercolor="border-red-500" />
    </div>
    <div>
        <x-card smalltext="{{ __('Kelas 3 Hari') }}" bigtext="{{ $sd3h }}" textcolor="text-indigo-500"
            bordercolor="border-indigo-500" />
    </div>

    <div>
        <x-card smalltext="{{ __('V. Total') }}" bigtext="{{ $vtotal }}" textcolor="text-orange-500"
            bordercolor="border-orange-500" />
    </div>
    <div>
        <x-card smalltext="{{ __('Users') }}" bigtext="{{ $totalUsers }}" textcolor="text-teal-500"
            bordercolor="border-teal-500" />
    </div>

</div>