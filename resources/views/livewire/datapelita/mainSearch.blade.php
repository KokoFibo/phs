<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-2 mt-3">
                <Label class="text">Search</Label>
                <input type="text" class="form-control" wire:model="search" placeholder="Search...">
            </div>
            <div class=" form-group col-md-1 mt-3">
                <label for="name">{{ __('Category') }} </label>

                <select wire:model="category" class="form-control">
                    <option value="data_pelitas.nama_umat" selected>{{ __('Nama') }}</option>
                    <option value="data_pelitas.pengajak">{{ __('Pengajak') }}</option>
                    <option value="data_pelitas.penjamin">{{ __('Penjamin') }}</option>
                    <option value="panditas.nama_pandita">{{ __('Pandita') }}</option>
                    <option value="kotas.nama_kota">{{ __('Kota') }}</option>
                </select>
            </div>
            <div class="form-group col-md-1 mt-3">
                <label for="name">{{ __('Page') }}: </label>
                <select wire:model="perpage" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </div>

            {{-- Jika Role adalah Manager --}}
            @if (Auth::user()->role == '3')
                <div class="form-group col-md-1 mt-3">
                    <label for="name">{{ __('Tgl Chiu Tao') }}: </label>
                    <input type="date" class="form-control" wire:model="startDate">
                </div>

                <div class="form-group col-md-1 mt-3">
                    <label for="name">-</label>
                    <input type="date" class="form-control" wire:model="endDate">
                </div>
            @else
                <div class="form-group col-md-2 mt-3">
                    <label for="name">{{ __('Tgl Chiu Tao') }}: </label>
                    <input type="date" class="form-control" wire:model="startDate">
                </div>

                <div class="form-group col-md-2 mt-3">
                    <label for="name">-</label>
                    <input type="date" class="form-control" wire:model="endDate">
                </div>
            @endif
            <div class="form-group col-md-1 mt-3">
                <label for="name">{{ __('Umur') }}</label>
                <input type="text" class="form-control" wire:model="startUmur">
            </div>

            <div class="form-group col-md-1 mt-3">
                <label for="name">-</label>
                <input type="text" class="form-control" wire:model="endUmur">
            </div>

            <div class="form-group col-md-1 mt-3">
                <label for="name">{{ __('Gender') }}</label>
                <select wire:model="jen_kel" class="form-control">
                    <option value="0">{{ __('All') }}</option>
                    <option value="1">{{ __('Laki-laki') }}</option>
                    <option value="2">{{ __('Perempuan') }}</option>
                </select>
            </div>
            <div class="form-group col-md-1 mt-3">
                <label for="name">{{ __('Status') }} </label>
                <select wire:model="active" class="form-control">
                    <option value="">{{ __('All') }}</option>
                    <option value="Active">{{ __('Active Only') }}</option>
                    <option value="Inactive">{{ __('Inactive Only') }}</option>
                </select>
            </div>
            @if (Auth::user()->role == '3')
                <div class="form-group col-md-1 mt-3">
                    <label for="name">{{ __('Branch') }} </label>
                    <select wire:model="kode_branch" class="form-control">
                        <option value="">{{ __('All') }}</option>
                        @foreach ($all_branch as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_branch }}</option>
                        @endforeach
                    </select>
                </div>
            @endif



        </div>
        <div class="card rounded mt-3">


            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                @include('livewire.datapelita.main_table')
                <div class="d-flex align-items-center justify-content-between">
                    <span>{{ $datapelita->onEachSide(1)->links() }}</span>
                    <span>{{ __('Total hasil pencarian') }} :
                        {{ number_format($datapelita->total()) }} {{ __('Data') }}</span>
                </div>


            </div>
        </div>
    </div>
</div>
