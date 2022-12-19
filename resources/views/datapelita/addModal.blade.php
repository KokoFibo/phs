{{-- modal Add --}}
<div wire:ignore.self class="modal fade " id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Umat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <form wire:submit.prevent="store">

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
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            placeholder="Nama Lengkap" wire:model="nama">
                        @error('nama')
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
                        <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur"
                            placeholder="Umur antara 1 - 150" wire:model="umur">
                        @error('umur')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            placeholder="Alamat rumah" wire:model="alamat">
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Kota --}}
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota"
                            placeholder="Kota sesuai dengan alamat rumah" wire:model="kota">
                        @error('kota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- telp --}}
                    <div class="form-group">
                        <label for="telp">Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp"
                            placeholder="021 12345678" wire:model="telp">
                        @error('telp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- HP --}}
                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" class="form-control @error('hp') is-invalid @enderror" id="hp"
                            placeholder="0821 1234 5678" wire:model="hp">
                        @error('hp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="name@example.com" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check d-flex">

                            <div class="col-md-2">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="jenis_kelamin"
                                    wire:model="jenis_kelamin" value="1" checked>
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
                        <select id="branch" class="form-control" wire:model="pengajak">

                            @foreach ($alldatapelita as $pengajak)
                                <option value="{{ $pengajak->nama }}">{{ $pengajak->nama }} ==>
                                    {{ $pengajak->mandarin }}</option>
                            @endforeach
                        </select>
                        @error('pengajak')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Penjamin --}}
                    <div class="form-group ">
                        <label for="branch">Penjamin</label>
                        <select id="branch" class="form-control" wire:model="penjamin">
                            @foreach ($alldatapelita as $penjamin)
                                <option value="{{ $penjamin->nama }}">{{ $penjamin->nama }} ==>
                                    {{ $pengajak->mandarin }}</option>
                            @endforeach
                        </select>
                        @error('penjamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Pandita --}}
                    <div class="form-group">
                        <label for="pandita">Pandita</label>
                        <input type="text" class="form-control @error('pandita') is-invalid @enderror"
                            id="pandita" wire:model="pandita">
                        @error('pandita')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>




                    {{-- button submit --}}
                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
