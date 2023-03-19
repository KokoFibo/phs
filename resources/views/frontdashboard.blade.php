<div>
    <div class="p-2 row align-items-center">
        {{-- start --}}

        {{-- end --}}
        <div class="text-center ">
            @if (Auth::user()->role == '3')
                @if ($selectedGroupVihara != null || $selectedBranch != null)
                    <h2 style="color: rgb(236,72,153)">{{ getGroupVihara($selectedGroupVihara) }}
                        {{ getBranch($selectedBranch) }}</h2>
                @else
                    <h2 style="color: rgb(236,72,153)">Vihara Pelita Hati</h2>
                @endif
            @elseif ($selectedBranch == '')
                <h2 style="color: rgb(236,72,153)">{{ getGroupVihara($selectedGroupVihara) }}</h2>
            @else
                <h2 style="color: rgb(236,72,153)">{{ getGroupVihara($selectedGroupVihara) }} -
                    {{ getBranch($selectedBranch) }}</h2>
            @endif
        </div>
    </div>

</div>
{{-- select box end --}}




<div>
    <div class="p-2 row ">
        <div class="mb-2 col-6 col-xl-2 ">
            <x-card smalltext="{{ __('Umat') }}" bigtext="{{ $totalUmat }}" textcolor="primary"
                bordercolor="primary" />
        </div>
        {{-- <div>
            <x-card smalltext="{{ __('Umat Active') }}" bigtext="{{ $umatActive }}" textcolor="text-green-500"
                bordercolor="border-green-500" />
        </div> --}}

        <div class="mb-2 col-6 col-xl-2">
            <x-card smalltext="{{ __('Umat') }} {{ getYear() }}" bigtext="{{ $umatYTD }}"
                textcolor="success" bordercolor="success" />
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
    {{-- start --}}
    <div class="mx-1 mt-3 flex-column flex-sm-row row justify-content-between lg:justify-content-evenly">
        @if (Auth::user()->role == 3)
            <div class="mb-2 col-12 col-sm-3 col-4">
                <select wire:model="selectedGroupVihara" class="shadow form-select"
                    style="background-color:rgb(236,72,153); color: white; height:50px">
                    <option value="">{{ __('All Groups') }}</option>
                    @foreach ($groupvihara as $g)
                        <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mb-2 col-12 col-sm-3 col-4 ">
            <select wire:model="selectedBranch" class="shadow form-select"
                style="background-color:rgb(59,130,246); color: white; height:50px">
                <label>{{ __('Pilih Kelas') }}</label>
                @if (Auth::user()->role == '3')
                    <option value="">{{ __('All Vihara') }}</option>
                @endif
                @foreach ($branch as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-12 col-sm-3 col-4">
            <select class="shadow form-select" wire:model="selectedDaftarKelasId"
                style="background-color:rgb(168,85,247); color: white; height:50px; ">
                <option value="">{{ __('Pilih Kelas') }}</option>
                @foreach ($daftarkelas as $d)
                    <option value="{{ $d->id }}">{{ getDaftarKelas($d->id) }}</option>
                @endforeach
            </select>
        </div>
        {{-- end --}}
    </div>


</div>
