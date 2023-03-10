<style>
    .glass {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.62);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
<div class="row">
    <div class="col-md-12 mb-3">

        <div class="form-row flex  ">
            <div class="form-group col-md-2 mt-3">
                <Label class="text">{{ __('Search') }}</Label>
                <input type="text" class="form-control" wire:model="search" placeholder="{{ __('Search') }}...">
            </div>
            <div class=" form-group col-md-1 mt-3">
                <label>{{ __('Category') }} </label>

                <select wire:model="category" class="form-control">
                    <option value="data_pelitas.nama_umat" selected>{{ __('Nama') }}</option>
                    <option value="data_pelitas.pengajak">{{ __('Pengajak') }}</option>
                    <option value="data_pelitas.penjamin">{{ __('Penjamin') }}</option>
                    <option value="panditas.nama_pandita">{{ __('Pandita') }}</option>
                    <option value="kotas.nama_kota">{{ __('Kota') }}</option>
                </select>
            </div>

            <div class="form-group col-md-1 mt-3">
                <label>{{ __('Page') }}: </label>
                <select wire:model="perpage" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </div>



            <div>
                <p>
                    <button class="btn btn-primary mt-5 ml-2" type="button" data-toggle="collapse"
                        data-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        <i class="fa fa-filter"></i> {{ __('Filter Search') }}
                    </button>
                </p>
                <div style="min-height: 120px; position: absolute; z-index: 10; ">
                    <div class="collapse width" id="collapseWidthExample">
                        <div class="card card-body glass" style="width: 400px; color: purple;">

                            @if (Auth::user()->role == '3')
                                <div class="form-group
                                        col-md-12 mt-3">
                                    <label class="bg-purple p-1 px-3 rounded">{{ __('Branch') }} </label>
                                    <select wire:model="kode_branch" class="form-control">
                                        <option value="" selected>{{ __('All') }}</option>
                                        @foreach ($all_branch as $a)
                                            <option value="{{ $a->id }}">{{ $a->nama_branch }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group col-md-12 mt-3">
                                <label class="bg-purple p-1 px-3 rounded">{{ __('Gender') }}</label>
                                <select wire:model="jen_kel" class="form-control">
                                    <option value="0">{{ __('All') }}</option>
                                    <option value="1">{{ __('Laki-laki') }}</option>
                                    <option value="2">{{ __('Perempuan') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label class="bg-purple p-1 px-3 rounded">{{ __('Status') }} </label>
                                <select wire:model="active" class="form-control">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="Active">{{ __('Active Only') }}</option>
                                    <option value="Inactive">{{ __('Inactive Only') }}</option>
                                </select>
                            </div>


                            {{-- Jika Role adalah Manager --}}
                            {{-- @if (Auth::user()->role == '3') --}}

                            <label class="text-center bg-purple">{{ __('Tanggal Mohon Tao') }}: </label>
                            <div class="flex" style="display: flex">
                                <div class="form-group col-md-6 mt-3">
                                    <input type="date" class="form-control" wire:model="startDate">
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    {{-- <label >-</label> --}}
                                    <input type="date" class="form-control" wire:model="endDate">
                                </div>
                            </div>
                            {{-- @else --}}
                            {{-- <div class="form-group col-md-12 mt-3">
                                                <label >{{ __('Tgl Chiu Tao') }}: </label>
                                                <input type="date" class="form-control" wire:model="startDate">
                                            </div>
                
                                            <div class="form-group col-md-12 mt-3">
                                                <label >-</label>
                                                <input type="date" class="form-control" wire:model="endDate">
                                            </div> --}}
                            {{-- @endif --}}

                            <label class="text-center bg-purple">{{ __('Umur') }}</label>
                            <div class="flex" style="display: flex">
                                <div class="form-group col-md-6 mt-3">
                                    <input type="text" class="form-control" wire:model="startUmur">
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <input type="text" class="form-control" wire:model="endUmur">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="mx-auto mt-5">
                <h1>
                    <x-namabranch :kode=$kode_branch />
                </h1>
            </div> --}}
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
