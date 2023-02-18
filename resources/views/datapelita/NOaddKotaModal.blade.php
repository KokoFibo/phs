{{-- modal Add --}}
<div wire:ignore.self class="modal fade " id="addKotaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Kota') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="d-flex justify-content-evenly">
                    @if ($is_add)
                        <div class="col-6">
                            <div class="mt-3">
                                <label>{{ __('Provinsi') }}</label>
                                <select class="form-control" wire:model="selectedPropinsi">
                                    <option value="" selected>-- {{ __('Pilih Provinsi') }} --</option>
                                    @foreach ($propinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @if (!is_null($selectedPropinsi))
                                <div class=" mt-3">
                                    <label>{{ __('Kota') }}</label>
                                    <select class="form-control" wire:model="nama_kota">
                                        @if (!is_null($nama_kota))
                                            <option value="" selected>-- {{ $nama_kota }} --</option>
                                        @endif
                                        <option value="" selected>-- {{ __('Pilih Kota') }} --</option>
                                        @foreach ($namakota as $p)
                                            <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_kota')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button wire:click="store" class="mt-2 btn btn-primary">{{ __('Save') }}</button>

                            @endif
                        </div>
                    @else
                        <div class="mb-3">
                            <label class="form-label">Rename Kota</label>
                            <input wire:model="nama_kota" type="text" class="form-control">
                            <button class="mt-2 btn-primary" wire:click="update">Update</button>
                        </div>
                    @endif


                    <div class="col-6">

                        {{-- Table Kota --}}
                        @if (!empty($kota))

                            <div class="col-12 mt-3">

                                <table class="table table-bordered mt-5">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Kota') }}</th>
                                            <th>{{ __('Delete') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kota as $index => $k)
                                            <tr>
                                                <td>{{ $kota->firstItem() + $index }}</td>
                                                <td>{{ $k->nama_kota }}</td>
                                                <td class="text-center">
                                                    @if ($k->kota_is_used == false)
                                                        <button
                                                            wire:click="delete_confirmation_kota({{ $k->id }})"
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash"></i></button>
                                                    @else
                                                        <button wire:click="edit({{ $k->id }})"
                                                            class="btn btn-warning btn-sm"><i
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
    </div>
    @push('script')
        <script>
            window.addEventListener('delete_confirmation_aja', function(event) {
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
                        window.livewire.emit('delete_kota', event.detail.id)
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
{{-- Modal Add End --}}
