<div>
    <div class="p-2 row align-items-center">
        @if (Auth::user()->role == 3)
        <div class="col-xl-2">
            <select wire:model="selectedGroupVihara" class="shadow form-select">
                <option value="">{{ __('All Groups') }}</option>
                @foreach ($groupvihara as $g)
                <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="col-xl-2">
            <select wire:model="selectedBranch" class="shadow form-select">
                <label>Pilih Kelas</label>
                @if (Auth::user()->role == '3')
                <option value="">{{ __('All Vihara') }}</option>
                @endif
                @foreach ($branch as $b)
                <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
                @endforeach
            </select>

        </div>
        <div class="text-center col-xl-8">
            @if (Auth::user()->role == '3')
            <h2 style="color: purple">{{ getGroupVihara($selectedGroupVihara) }} {{
                getBranch($selectedBranch) }}</h2>
            @elseif ($selectedBranch == '')
            <h2 style="color: purple">{{ getGroupVihara($selectedGroupVihara) }}</h2>
            @else
            <h2 style="color: purple">{{ getGroupVihara($selectedGroupVihara) }} - {{
                getBranch($selectedBranch) }}</h2>
            @endif
        </div>
    </div>

</div>
{{-- select box end --}}




<div>
    <div class="p-2 row ">
        <div class="mb-2 col-6 col-xl-2 ">
            <x-card smalltext="{{ __('Umat') }}" bigtext="{{ $totalUmat }}" textcolor="primary" bordercolor="primary" />
        </div>
        {{-- <div>
            <x-card smalltext="{{ __('Umat Active') }}" bigtext="{{ $umatActive }}" textcolor="text-green-500"
                bordercolor="border-green-500" />
        </div> --}}

        <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('Umat') }} {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="success"
                bordercolor="success" />
        </div>

        {{-- <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('Umat Inactive') }}" bigtext="{{ $umatInactive }}" textcolor="text-blue-500"
                bordercolor="border-blue-500" />
        </div> --}}
        <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('Vihara') }}" bigtext="{{ $totalBranch }}" textcolor="danger"
                bordercolor="danger" />
        </div>
        <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('Kelas 3 Hari') }}" bigtext="{{ $sd3h }}" textcolor="warning"
                bordercolor="warning" />
        </div>

        <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('V. Total') }}" bigtext="{{ $vtotal }}" textcolor="success"
                bordercolor="success" />
        </div>
        <div class="col-6 col-xl-2">
            <x-card smalltext="{{ __('Users') }}" bigtext="{{ $totalUsers }}" textcolor="primary"
                bordercolor="primary" />
        </div>
    </div>

</div>