<div>
    {{-- {{ dd($datapelita->all()) }} --}}
    {{-- @include('datapelita.addModal') --}}
    @include('datapelita.viewModal')
    {{-- @include('datapelita.editModal') --}}
    @include('datapelita.deleteModal')
    @include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="col-md-2 mt-3">
                        <Label>Search</Label>
                        <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">Search Category </label>

                        <select wire:model="category" class="form-control">
                            <option value="data_pelitas.nama_umat" selected>Nama</option>
                            <option value="data_pelitas.pengajak">Pengajak</option>
                            <option value="data_pelitas.penjamin">Penjamin</option>
                            <option value="panditas.nama_pandita">Pandita</option>
                            <option value="kotas.nama_kota">Kota</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">Per Page: </label>
                        <select wire:model="perpage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>

                    {{-- <div class="col-md-1 mt-3">
                        <label for="name">Kategori </label>
                        <select wire:model="columnName" class="form-control">
                            <option value="nama_umat">Nama</option>
                            <option value="mandarin">中文名</option>
                            <option value="tgl_mohonTao">Tgl Chiu Tao</option>
                            <option value="umur_sekarang">Umur</option>
                            <option value="pengajak">Pengajak</option>
                            <option value="penjamin">Penjamin</option>
                        </select>
                    </div> --}}
                    <div class="col-md-2 mt-3">
                        <label for="name">Tgl Chiu Tao: </label>
                        <input type="date" class="form-control" wire:model="startDate">
                    </div>
                    <div class="col-md-2 mt-3">
                        <label for="name">-</label>
                        <input type="date" class="form-control" wire:model="endDate">
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">Umur</label>
                        <input type="text" class="form-control" wire:model="startUmur">
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="name">-</label>
                        <input type="text" class="form-control" wire:model="endUmur">
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="name">Jenis Kelamin </label>
                        <select wire:model="jen_kel" class="form-control">
                            <option value="0">Semua</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">Active </label>
                        <select wire:model="active" class="form-control">
                            <option value="">All</option>
                            <option value="Active">Active Only</option>
                            <option value="Inactive">Inactive Only</option>
                        </select>
                    </div>

                    {{-- <div class="col-md-1 mt-3">
                        <label for="name">Sort Direction</label>
                        <select wire:model="direction" class="form-control">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div> --}}


                </div>
                <div class="card rounded mt-3">


                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        @include('livewire.datapelita.main_table')
                        <div class="d-flex align-items-center justify-content-between">
                            <span>{{ $datapelita->onEachSide(5)->links() }}</span>
                            <span>Total hasil pencarian :
                                {{ number_format($datapelita->total()) }} data</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            window.addEventListener('close-modal', event => {
                $('#AddModal').modal('hide');
            });
            window.addEventListener('close-modal', event => {
                $('#EditModal').modal('hide');
            });
            window.addEventListener('close-modal', event => {
                $('#DeleteModal').modal('hide');
            });
        </script>
    @endpush

</div>
