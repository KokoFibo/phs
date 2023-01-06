{{-- modal Add --}}
<div wire:ignore.self class="modal" id="AddPanditaModal">
    @section('title', 'Add Data Pandita')

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Data Pandita') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="d-flex justify-content-evenly">
                    <div class="card card-sm mt-3 col-6">
                        <div class="card-header">{{ __('Data Pandita') }}</div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">{{ __('Nama') }}</label>
                                    <input type="text"
                                        class="form-control @error('nama_pandita') is-invalid @enderror" id="nama"
                                        wire:model="nama_pandita" autocomplete="off">
                                    @error('nama_pandita')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($is_add == true)
                                    <button wire:click="store" class="btn btn-primary">Save</button>
                                @else
                                    <button wire:click="update" class="btn btn-primary">Update</button>

                                    {{-- <button wire:click="new" class="btn btn-primary">New</button> --}}
                                @endif


                            </div>

                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        @if (!empty($pandita))
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="width-5">{{ __('Nama') }}</th>
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
                                                    <button class="btn-danger btn btn-sm"
                                                        wire:click="deleteConfirmation({{ $p->id }})">{{ __('Delete') }}</button>
                                                @else
                                                    <button class="btn btn-primary"
                                                        wire:click="edit({{ $p->id }})">{{ __('Rename') }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $pandita->links() }}
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('delete_confirmation', function(e) {
                Swal.fire({
                    title: e.detail.title,
                    text: e.detail.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, silakan hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('delete', e.detail.id)
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
