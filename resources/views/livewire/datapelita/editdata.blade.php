<div>

    <div class="col-8 mt-3 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between
            ">
                <div>
                    <h3>Update Data</h3>
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
                            <div class="form-group ">
                                <label for="branch">Branch</label>
                                <select id="branch" class="form-control" wire:model="branch_id">
                                    @foreach ($branch as $b)
                                        <option value={{ $b->id }}>{{ $b->kode_branch }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_umat') is-invalid @enderror"
                                    id="nama" placeholder="Nama Lengkap" wire:model="nama_umat">
                                @error('nama_umat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mandarin --}}
                            <div class="form-group">
                                <label for="mandarin">中文名</label>
                                <input type="text" class="form-control @error('mandarin') is-invalid @enderror"
                                    id="mandarin" placeholder="中文名" wire:model="mandarin">
                                @error('mandarin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Umur --}}
                            <div class="form-group">
                                <label for="umur">Umur</label>
                                <input type="text" class="form-control @error('umur') is-invalid @enderror"
                                    id="umur" placeholder="Umur antara 1 - 150" wire:model="umur">
                                @error('umur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" placeholder="Alamat rumah" wire:model="alamat">
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Kota --}}

                            <div class="form-group ">
                                <label for="branch">Kota</label>
                                <select id="branch" class="form-control" wire:model="kota_id">

                                    <option value="" selected>Pilih Kota</option>
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
                                <label for="telp">Telepon</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" placeholder="021 12345678" wire:model="telp">
                                @error('telp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        {{-- kolom kanan --}}
                        <div class="col-6">
                            {{-- HP --}}
                            <div class="form-group">
                                <label for="hp">Handphone</label>
                                <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                    id="hp" placeholder="0821 1234 5678" wire:model="hp">
                                @error('hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="name@example.com" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-check d-flex">

                                    <div class="col-md-2">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="jenis_kelamin" wire:model="jenis_kelamin" value="1" checked>
                                        <label class="form-check-label mr-7" for="jenis_kelamin">
                                            Laki-laki
                                        </label>
                                    </div>

                                    <div class="col-md-2">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            wire:model="jenis_kelamin" id="jenis_kelamin" value="2" checked>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- tgl_mohonTao --}}
                            <div class="form-group">
                                <label for="tgl_mohonTao">Tanggal mohon Tao</label>
                                <input type="date" class="form-control @error('tgl_mohonTao') is-invalid @enderror"
                                    id="tgl_mohonTao" wire:model="tgl_mohonTao">
                                @error('tgl_mohonTao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Pengajak --}}

                            <div class="form-group ">
                                <label for="branch">Pengajak</label>
                                <select class="form-control" wire:model="pengajak">
                                    <option value="" selected>==> Masukkan data Pengajak <== </option>
                                            @foreach ($datapelita as $data)
                                    <option value="{{ $data->nama_umat }}">{{ $data->nama_umat }}</option>
                                    @endforeach
                                </select>
                                @error('pengajak')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Penjamin --}}
                            <div class="form-group ">
                                <label for="branch">Penjamin</label>
                                <select class="form-control" wire:model="penjamin">
                                    <option value="" selected>==> Masukkan data Penjamin <== </option>

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
                                <label for="branch">Pandita</label>
                                <select id="branch" class="form-control" wire:model="pandita_id">
                                    <option value="" selected>==> Masukkan data Pandita <== </option>

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
                                <label for="status">Status</label>
                                <select id="status" class="form-control" wire:model="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                        <div class="d-flex justify-content-between">

                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="route('main')"><button class="btn btn-warning" type="submit"><i
                                        class="fa fa-circle-arrow-left"></i> Back</button></a>
                        </div>
                    </div>
                    {{-- button submit --}}

                </form>
            </div>
        </div>
    </div>

</div>
