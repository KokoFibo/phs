<div>
    @section('title', 'Branch')

    <div class="container mt-5">
        <div class="d-flex justify-content-around">
            <div class="card col-4">
                <div class="card-header">
                    {{ __('Branch') }}
                </div>
                <div class="card-body ">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    {{-- <form wire:submit.prevent="store"> --}}
                    <div class="form-group">
                        <label for="nama">{{ __('Kota') }}</label>
                        <select wire:model="kota_id" class="form-control">
                            <option value="" selected>--> {{ __('Silakan Pilih Kota') }} <-- </option>
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
                        @if ($is_add == true)
                            <button wire:click="store" class="btn btn-primary">{{ __('Save') }}</button>
                        @else
                            <button wire:click="update" class="btn btn-primary">{{ __('Update') }}</button>
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
                                        <button wire:click="delete_confirmation({{ $b->id }})"
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
        @push('script')
            <script>
                window.addEventListener('delete_confirmation_branch', function(event) {
                    Swal.fire({
                        title: event.detail.title,
                        text: event.detail.text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, silakan hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.livewire.emit('delete_branch', event.detail.id)
                            // $this - > emit('delete_kota', event.detail.id)
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            // )
                        }
                    })
                });

                window.addEventListener('deleted', function(e) {
                    Swal.fire(
                        'Deleted!',
                        'Data sudah di delete.',
                        'success'
                    );
                });
            </script>
        @endpush
    </div>
