<div>
    @section('title', 'Add Data')
    <div class="mx-auto mt-3 col-8">
        <div class="mb-3 card">
            <div class="card-header d-flex justify-content-between ">
                <div>
                    <h3>{{ __('Add Data') }}
                        <livewire:getbranchname :kode=$kode_branch>

                    </h3>
                </div>
                <div class="d-flex">
                    <div class="mr-3">
                        @livewire('panditawire')
                    </div>
                    <div>
                        @livewire('data-kota-wire')
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="d-flex">
                        {{-- kolom kiri --}}
                        <div class="col-6">
                            {{-- Branch --}}
                            {{-- <div class="form-group "> --}}
                            {{-- <input type="text" value="{{ Auth::user()->branch_id }}" wire:model="branch_id"> --}}
                            {{-- <label for="branch">{{ __('Branch') }}</label>
                                <select id="branch" class="form-control" wire:model="branch_id">
                                    @foreach ($branch as $b)
                                        <option value={{ $b->id }}>{{ $b->kode_branch }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            {{-- </div> --}}

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="name">{{ __('Nama Lengkap') }}</label>
                                <input type="text" class="form-control @error('nama_umat') is-invalid @enderror"
                                    id="nama" placeholder="{{ __('Nama Lengkap') }}" wire:model="nama_umat">
                                @error('nama_umat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mandarin --}}
                            <div class="form-group">
                                <label for="mandarin">{{ __('中文名') }}</label>
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
                                    id="umur" placeholder="{{ __('Umur antara 1 - 150') }}" wire:model="umur">
                                @error('umur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group">
                                <label for="alamat">{{ __('Alamat') }}</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" placeholder="{{ __('Alamat Rumah') }}" wire:model="alamat">
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Kota --}}

                            <div class="form-group ">
                                <label for="branch">{{ __('Kota') }}</label>
                                <select id="branch" class="form-control" wire:model="kota_id">

                                    <option default value="" selected>Silakan Pilih Kota</option>
                                    @foreach ($allKota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }} </option>
                                    @endforeach

                                </select>
                                @error('kota_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



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
                                <label for="jenis_kelamin">{{ __('Gender') }}</label>
                                <div class="form-check d-flex">

                                    <div class="mb-3 col-md-3">
                                        <input class="form-check-input" type="radio" wire:model="gender"
                                            value="1" checked id="laki">
                                        <label class="form-check-label" for="laki">
                                            {{ __('Laki-laki') }}
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-check-input" type="radio" wire:model="gender"
                                            value="2" checked id="perempuan">
                                        <label class="form-check-label" for="perempuan">
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
                                <select class="form-control" wire:model="pengajak">
                                    <option value="" selected>==> {{ __('Masukkan Data Pengajak') }} <==
                                            </option>
                                            @php
                                                $x = 0;
                                            @endphp
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
                        </div>
                    </div>

                    {{-- button submit --}}
                    <div class="d-flex justify-content-between">
                        <button class="button button--action" type="submit">{{ __('Save') }}</button>


                        <a href="{{ route('main') }}"><i class="fa fa-circle-arrow-left"></i>
                            {{ __('Back') }}</a>
                </form>

            </div>

        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('stored', function(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: e.detail.title,
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
@endpush
</div>
