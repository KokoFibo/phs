{{-- modal Add --}}
<div wire:ignore.self class="modal fade " id="addKotaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">


                <div class="col-12 mt-3">
                    <label>Provinsi</label>
                    <select class="form-control" wire:model="selectedPropinsi">
                        <option value="" selected>-- Pilih Provinsi --</option>
                        @foreach ($propinsi as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach

                    </select>
                </div>
                @if (!is_null($selectedPropinsi))
                    <div class="col-12 mt-3">
                        <label>Kota</label>
                        <select class="form-control" wire:model="nama_kota">
                            <option value="" selected>-- Pilih Kota --</option>
                            @foreach ($namakota as $p)
                                <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        @error('nama_kota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mt-3">
                        <button wire:click="store" class="btn btn-primary">Save</button>
                    </div>
                @endif



                {{-- Table Kota --}}
                @if (!empty($kota))

                    <div class="col-12 mt-3">

                        <table class="table table-bordered mt-5">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kota</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kota as $index => $k)
                                    <tr>
                                        <td>{{ $kota->firstItem() + $index }}</td>
                                        <td>{{ $k->nama_kota }}</td>
                                        <td class="text-center">
                                            @if ($k->kota_is_used == false)
                                                <button wire:click="delete({{ $k->id }})"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            @else
                                                <button class="btn btn-warning btn-sm"><i
                                                        class="fa fa-pen"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $kota->onEachSide(1)->links() }}
                    </div>
                @endif



            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
