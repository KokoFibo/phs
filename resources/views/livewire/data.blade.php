<div>
    @include('datapelita.addModal')
    @include('datapelita.viewModal')
    @include('datapelita.editModal')
    @include('datapelita.deleteModal')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-header  bg-blue ">
                        <h4 class="text-center">Data Umat Vihara Pelita Hati</h4>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-4 mt-3">
                            <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="name">Perpage: </label>
                            <select wire:model="perpage" class="form-select form-select-sm ms-2"
                                aria-label=".form-select-sm example">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        <table class="table table-bordered">
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
                                    <th><button type="button" class="btn btn-sm bg-blue" data-toggle="modal"
                                            data-target="#AddModal" wire:click="clearSession">
                                            Add Data
                                        </button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datapelita as $index => $data)
                                    <tr>
                                        <td>{{ $datapelita->firstItem() + $index }}</td>
                                        {{-- <td>{{ $data->id }}</td> --}}
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->mandarin }}</td>
                                        <td>{{ $data->umur_sekarang }}</td>
                                        <td>{{ $data->tgl_mohonTao }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>{{ $data->pengajak }}</td>
                                        <td>{{ $data->penjamin }}</td>
                                        <td>{{ $data->pandita }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn-success btn btn-sm" data-toggle="modal"
                                                    data-target="#ViewModal">
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
