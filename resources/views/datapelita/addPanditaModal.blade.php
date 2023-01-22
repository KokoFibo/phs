{{-- modal Add --}}
@section('title', 'Add Data Pandita')


<div class="flex items-center justify-between">
    <h5 class="text-2xl">{{ __('Add Data Pandita') }}</h5>
    <button @click="pandita=false">
        Close
    </button>
</div>
@if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="w-1/2 mx-auto d-flex justify-content-evenly">
    <div class="w-1/2 mt-3">
        <div class="text-center">{{ __('Data Pandita') }}</div>
        <div class="card-body">

            <div class="mt-3">
                <label for="nama">{{ __('Nama') }}</label>
                <input type="text" class="form-control @error('nama_pandita') is-invalid @enderror" id="nama"
                    wire:model="nama_pandita" autocomplete="off">
                @error('nama_pandita')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if ($is_add == true)
                <button wire:click="store" class="btn btn-primary">{{ __('Save') }}</button>
            @else
                <button wire:click="update" class="btn btn-primary">{{ __('Update') }}</button>
            @endif

        </div>
    </div>
    <div class="w-1/2 mt-3">
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
                                    <button class="button-red button "
                                        wire:click="deleteConfirmation({{ $p->id }})">{{ __('Delete') }}</button>
                                @else
                                    <button class="button button-teal"
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
{{-- Modal Add End --}}
