<div>
    <div class="col-3">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" wire:model="nama"
                autocomplete="off">
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button wire:click="store" class="btn btn-primary">Save</button>
        </div>
        @if (!empty($pandita))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($pandita as $index => $p)
                    <tbody>
                        <tr>
                            <td>{{ $pandita->firstItem() + $index }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>
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
