<div>
    <div class="container">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Branch
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="nama">{{ __('Kota') }}</label>
                            <select wire:model="kota_id" class="form-control">
                                <option value="" selected>--> {{ __('Silakan Pilih Kota ') }} <-- </option>
                                        @foreach ($kota as $k)
                                <option value="$k->id">{{ $k->nama_kota }}</option>
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


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
