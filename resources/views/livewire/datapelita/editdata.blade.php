<div>
    @section('title', 'Edit Data')

    <div class="col-8 mt-3 mx-auto">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between
            ">
                <div>
                    <h3>{{ __('Update Data') }}
                        {{-- <x-namabranch :kode=$branch_id /> --}}
                        <livewire:getbranchname :kode=$branch_id>


                    </h3>

                </div>
                {{-- <div class="d-flex">
                    <div class="mr-3">
                        @livewire('panditawire')
                    </div>
                    <div>
                        @livewire('data-kota-wire')
                    </div>
                </div> --}}
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="d-flex">
                        {{-- kolom kiri --}}
                        <div class="col-6">
                            {{-- Branch --}}
                            {{-- <div class="form-group ">
                                <label for="branch">{{ __('Branch') }}</label>
                                <select id="branch" class="form-control" wire:model="branch_id">
                                    @foreach ($branch as $b)
                                        <option value={{ $b->id }}>{{ $b->kode_branch }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="name">{{ __('Nama Lengkap') }}</label>
                                <input type="text" class="form-control @error('nama_umat') is-invalid @enderror"
                                    id="nama" placeholder="Nama Lengkap" wire:model="nama_umat">
                                @error('nama_umat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mandarin --}}
                            <div class="form-group">
                                <label for="mandarin">{{ __('') }}中文名</label>
                                <input type="text" class="form-control @error('mandarin') is-invalid @enderror"
                                    id="mandarin" placeholder="中文名" wire:model="mandarin">
                                @error('mandarin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Umur --}}
                            <div class="form-group">
                                <label for="umur">{{ __('Umur') }}</label>
                                <input type="text" class="form-control @error('umur') is-invalid @enderror"
                                    id="umur" placeholder="Umur antara 1 - 150" wire:model="umur">
                                @error('umur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group">
                                <label for="alamat">{{ __('Alamat') }}</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" placeholder="Alamat rumah" wire:model="alamat">
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Kota --}}

                            <div class="form-group ">
                                <label for="branch">{{ __('Kota') }}</label>
                                <select id="branch" class="form-control" wire:model="kota_id">

                                    <option value="" selected>{{ __('Pilih Kota') }}</option>
                                    @foreach ($allKota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }} </option>
                                    @endforeach
                                </select>
                                @error('kota_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota"
                            placeholder="Kota sesuai dengan alamat rumah" wire:model="kota">
                        @error('kota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                            {{-- telp --}}
                            <div class="form-group">
                                <label for="telp">{{ __('Telepon') }}</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" placeholder="021 12345678" wire:model="telp">
                                @error('telp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- HP --}}
                            <div class="form-group">
                                <label for="hp">{{ __('Handphone') }}</label>
                                <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                    id="hp" placeholder="0821 1234 5678" wire:model="hp">
                                @error('hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        {{-- kolom kanan --}}
                        <div class="col-6">


                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="name@example.com" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Gender --}}
                            <div class="form-group">
                                <label>{{ __('Gender') }}</label>
                                <div class="form-check d-flex">

                                    <div class="col-md-3 mb-3">
                                        <input class="form-check-input" type="radio" wire:model="gender"
                                            value="1" checked>
                                        <label class="form-check-label mr-7">
                                            {{ __('Laki-laki') }}
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-check-input" type="radio" wire:model="gender"
                                            value="2" checked>
                                        <label class="form-check-label">
                                            {{ __('Perempuan') }}
                                        </label>
                                    </div>
                                </div>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- tgl_mohonTao --}}
                            <div class="form-group">
                                <label for="tgl_mohonTao">{{ __('Tanggal Mohon Tao') }}</label>
                                <input type="date" class="form-control @error('tgl_mohonTao') is-invalid @enderror"
                                    id="tgl_mohonTao" wire:model="tgl_mohonTao">
                                @error('tgl_mohonTao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Pengajak --}}

                            <div class="form-group ">
                                <label for="branch">{{ __('Pengajak') }}</label>
                                @php
                                    $x = 0;
                                @endphp
                                <select class="form-control" wire:model="pengajak">
                                    <option value="" selected>==> {{ __('Masukkan Data Pengajak') }} <==
                                            </option>
                                            @foreach ($datapelita as $data)
                                                @php
                                                    $x++;
                                                @endphp
                                    <option value="{{ $data->nama_umat }}">{{ $x }}.
                                        {{ $data->nama_umat }}</option>
                                    @endforeach
                                </select>
                                @error('pengajak')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Penjamin --}}
                            <div class="form-group ">
                                <label for="branch">{{ __('Penjamin') }}</label>
                                <select class="form-control" wire:model="penjamin">
                                    <option value="" selected>==> {{ __('Masukkan Data Penjamin') }} <==
                                            </option>

                                            @foreach ($datapelita as $data)
                                    <option value="{{ $data->nama_umat }}">{{ $data->nama_umat }} ==>
                                        {{ $data->mandarin }}</option>
                                    @endforeach
                                </select>
                                @error('penjamin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Pandita --}}
                            <div class="form-group ">
                                <label for="branch">{{ __('Pandita') }}</label>
                                <select id="branch" class="form-control" wire:model="pandita_id">
                                    <option value="" selected>==> {{ __('Masukkan Data Pandita') }} <==
                                            </option>

                                            @foreach ($dataPandita as $pandita)
                                    <option value="{{ $pandita->id }}">{{ $pandita->nama_pandita }}</option>
                                    @endforeach
                                </select>
                                @error('pandita_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <select id="status" class="form-control" wire:model="status">
                                    <option value="Active">{{ __('Active') }}</option>
                                    <option value="Inactive">{{ __('Inactive') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                        <div class="d-flex justify-content-between">

                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                            <a href="{{ route('main') }}"><i class="fa fa-circle-arrow-left"></i>
                                {{ __('Back') }}</a>
                            {{-- <a href="{{ route('main') }}"><button class="btn btn-warning float-end"><i
                                        class="fa fa-circle-arrow-left"></i> {{ __('Back') }}</button></a> --}}
                </form>

            </div>
        </div>
        {{-- button submit --}}


    </div>
</div>
</div>
{{-- @push('script')
    <script>
        window.addEventListener('updated', function(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: e.detail.title,
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
@endpush --}}
</div>
