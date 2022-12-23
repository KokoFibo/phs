{{-- modal Add --}}
<div wire:ignore.self class="modal fade " id="AddPanditaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pandita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <div class="card card-sm mt-3">
                    <div class="card-header">Data Pandita</div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" wire:model="nama" autocomplete="off">
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <button wire:click="store" class="btn btn-primary mb-3">Save</button>
                            </div>
                            @if (!empty($pandita))
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="width-5">Nama</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($pandita as $index => $p)
                                        <tbody>
                                            <tr>
                                                <td>{{ $pandita->firstItem() + $index }}</td>
                                                <td>{{ $p->nama }}</td>
                                                <td class="text-center">
                                                    <button wire:click="delete({{ $p->id }})"
                                                        class="btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            @endif
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
