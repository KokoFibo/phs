<div>
    @section('title', 'Tambah Kelas')


    <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
        <h5 class="text-2xl font-semibold">{{ __('Tambah Kelas') }}</h5>

        <button wire:click="close">
            <i class="fa fa-circle-xmark fa-2xl"></i>
        </button>
    </div>
    <div class="w-2/3 mx-auto mt-3 text-center ">
        @if (session()->has('message'))
            <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
        @endif
    </div>
    <div class="flex w-2/3 p-3 mx-auto items-top justify-evenly">
        <div class="w-1/2 p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Nama Kelas') }}</div>

            <div class="w-full mt-3">
                <label class="px-2" for="nama_kelas">{{ __('Nama Kelas') }}</label>
                <input id="nama_kelas" type="text" placeholder="{{ __('Nama Kelas') }}" wire:model="nama_kelas"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_kelas')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            @if ($is_add == true)
                <button wire:click="store"
                    class="px-3 py-1 text-teal-600 bg-white rounded hover:text-teal-800">{{ __('Save') }}</button>
            @else
                <button wire:click="update" class="button button-teal">{{ __('Update') }}</button>
            @endif
        </div>
        <div class="w-1/2 mt-3">
            @if (!empty($kelas))
                <table class="w-full table-auto">
                    <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                        <tr>
                            <th class="p-3 text-sm font-semibold text-center">#</th>
                            <th class="p-3 text-sm font-semibold text-center">{{ __('Nama') }}</th>
                            <th class="p-3 text-sm font-semibold text-center"></th>
                        </tr>
                    </thead>
                    @foreach ($kelas as $index => $p)
                        <tbody>
                            <tr>
                                <td class="p-3 text-sm text-gray-800 border rounded">
                                    {{ $kelas->firstItem() + $index }}</td>
                                <td class="p-3 text-sm text-gray-800 border rounded">{{ $p->nama_kelas }}</td>
                                <td class="p-3 text-sm text-center text-gray-800 border rounded">
                                    @if ($p->kelas_is_used == false)
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
                <div class="mt-3">
                    {{ $kelas->links() }}
                </div>
            @else
                <div>
                    <h1>No Data Found!</h1>
                </div>
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

</div>
