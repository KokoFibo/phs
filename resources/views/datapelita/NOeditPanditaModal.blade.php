{{-- modal Add --}}
<div wire:ignore.self class="modal" id="editPanditaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Data Pandita</h5>

            </div>
            <div class="modal-body ">

                <input type="text" class="form-control" wire:model="nama_pandita">
                {{-- <div class="card card-sm mt-3">
                    <div class="card-header">Data Pandita</div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama_pandita') is-invalid @enderror"
                                    id="nama" wire:model="nama_pandita" autocomplete="off">
                                @error('nama_pandita')
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
                                                <td>{{ $p->nama_pandita }}</td>
                                                <td class="text-center">
                                                    @if ($p->pandita_is_used == false)
                                                        <button wire:click="delete({{ $p->id }})"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    @else
                                                        <button class="btn btn-warning btn-sm"
                                                            wire:click="rename({{ $p->id }})"><i
                                                                class="fa fa-pen"></i></button>
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            @endif
                        </div>

                    </div>
                </div> --}}

                <button class="btn btn-primary" data-toggle="modal" data-target="#AddPanditaModal"
                    wire:click="update">Rename</button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#AddPanditaModal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
