<div>
    @include('datapelita.addModal')
    @include('datapelita.viewModal')
    @include('datapelita.editModal')
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
                        <label for="name">Per Page: </label>
                        <select wire:model="perpage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="name">Kategori </label>
                        <select wire:model="columnName" class="form-control">
                            <option value="nama">Nama</option>
                            <option value="mandarin">中文名</option>
                            <option value="tgl_mohonTao">Tgl Chiu Tao</option>
                            <option value="umur_sekarang">Umur</option>
                            <option value="pengajak">Pengajak</option>
                            <option value="penjamin">Penjamin</option>
                            <option value="pandita">Pandita</option>
                        </select>
                    </div>
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
                        <label for="name">Sort Direction</label>
                        <select wire:model="direction" class="form-control">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>

                </div>
                <div class="card rounded mt-3">


                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        <table class="table table-bordered ">
                            <thead class="bg-purple">
                                <tr>
                                    <th>#</th>
                                    <th>NAMA</th>
                                    <th>中文名</th>
                                    <th>UMUR</th>
                                    <th>TGL CHIU TAO</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>PENGAJAK</th>
                                    <th>PENJAMIN</th>
                                    <th>PANDITA</th>
                                    <th class="text-center">
                                        {{-- Add Data --}}
                                        <button type="button" class="btn  btn-primary" data-toggle="modal"
                                            data-target="#AddModal" wire:click="clearSession">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </button>

                                        {{-- Reset --}}
                                        <button type="button" class="btn  btn-success" wire:click="resetFilter">
                                            <i class="fa fa-arrow-rotate-right"></i>
                                        </button>


                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datapelita as $index => $data)
                                    <tr>
                                        <td>{{ $datapelita->firstItem() + $index }}</td>
                                        {{-- <td>{{ $data->id }}</td> --}}
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->mandarin }}</td>
                                        <td class="text-center">{{ $data->umur_sekarang }}</td>
                                        <td>{{ $data->tgl_mohonTao }}</td>
                                        {{-- <td>{{ $data->jenis_kelamin }}</td> --}}
                                        <td>{{ check_JK($data->jenis_kelamin, $data->umur_sekarang) }}
                                        </td>
                                        <td>{{ $data->pengajak }}</td>
                                        <td>{{ $data->penjamin }}</td>
                                        <td>{{ $data->pandita->nama }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn-success btn btn-sm" data-toggle="modal"
                                                    data-target="#ViewModal" wire:click="edit({{ $data->id }})">
                                                    <i class="fa fa-eye "></i>
                                                </button>
                                                <button class="btn-warning btn btn-sm" data-toggle="modal"
                                                    data-target="#EditModal" wire:click="edit({{ $data->id }})">
                                                    <i class="fa fa-pen-to-square "></i>
                                                </button>
                                                <button class="btn-danger btn btn-sm" data-toggle="modal"
                                                    data-target="#DeleteModal"
                                                    wire:click="deleteConfirmation({{ $data->id }})">
                                                    <i class="fa fa-trash "></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $datapelita->onEachSide(1)->links() }}


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
