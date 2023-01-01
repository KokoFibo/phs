<div>
    <div class="container mt-5">
        <div class="d-flex justify-content-around">
            <div class="card col-4">
                <div class="card-header">
                    {{ __('Branch') }}
                </div>
                <div class="card-body ">
                    {{-- <form wire:submit.prevent="store"> --}}
                    <div class="form-group">
                        <label for="nama">{{ __('Kota') }}</label>
                        <select wire:model="kota_id" class="form-control">
                            <option value="" selected>--> {{ __('Silakan Pilih Kota ') }} <-- </option>
                                    @foreach ($kota as $k)
                            <option value="{{ $k->id }}"">{{ $k->nama_kota }}</option>
                            @endforeach
                        </select>
                        @error('kota_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">{{ __('Nama Cetya') }}</label>
                        <input type="text" class="form-control @error('nama_branch') is-invalid @enderror"
                            id="email" placeholder="立達" wire:model="nama_branch">
                        @error('nama_branch')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="email">{{ __('Kode Cetya') }}</label>
                            <input type="text" class="form-control @error('kode_branch') is-invalid @enderror"
                                id="email" placeholder="BNI-01" wire:model="kode_branch">
                            @error('kode_branch')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($is_edit == false && $is_add == true)
                            <button wire:click="store" class="btn btn-primary">Save</button>
                        @elseif ($is_edit == true && $is_add == false)
                            <button wire:click="update" class="btn btn-primary">Update</button>
                        @else
                            <button wire:click="new" class="btn btn-primary">New</button>
                        @endif

                        {{-- </form> --}}
                    </div>
                </div>
            </div>

            <div class="col-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Kota') }}</th>
                            <th>{{ __('Nama Cetya') }}</th>
                            <th>{{ __('Kode Cetya') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branch as $index => $b)
                            <tr>
                                <td>{{ $branch->firstItem() + $index }}</td>
                                <td>{{ $b->nama_kota }}</td>
                                <td>{{ $b->nama_branch }}</td>
                                <td>{{ $b->kode_branch }}</td>
                                <td>
                                    @if ($b->branch_is_used == true)
                                        <button wire:click="edit({{ $b->id }})"
                                            class="btn btn-warning btn-sm">{{ __('Edit') }}</button>
                                    @else
                                        <button wire:click="delete({{ $b->id }})"
                                            class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                    @endif
                            </tr>
                        @endforeach
                        </td>

                    </tbody>
                </table>
                {{ $branch->links() }}
            </div>
        </div>

    </div>
