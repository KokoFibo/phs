<div>

    <div class="col-2 mt-3">
        <label>Provinsi</label>
        <select class="form-control" wire:model="selectedPropinsi">
            <option value="" selected>-- Provinsi --</option>
            @foreach ($propinsi as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach

        </select>
    </div>
    @if (!is_null($selectedPropinsi))
        <div class="col-2 mt-3">
            <label>Kota</label>
            <select class="form-control" wire:model="nama">
                <option value="" selected>-- Kota --</option>
                @foreach ($namakota as $p)
                    <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                @endforeach
            </select>
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-2 mt-3">
            <button wire:click="store" class="btn btn-primary">Save</button>
        </div>
    @endif



    {{-- Table Kota --}}
    <div class="col-4 mt-3">

        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kota</th>
                    <th>Add</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kota as $index => $k)
                    <tr>
                        <td>{{ $kota->firstItem() + $index }}</td>
                        <td>{{ $k->nama }}</td>
                        <td>
                            <button wire:click="delete({{ $k->id }})" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kota->onEachSide(1)->links() }}
    </div>
</div>
