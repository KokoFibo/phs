<div class="dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    @section('title', 'Add Data Kota')


    <div class="flex justify-between w-full p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl lg:w-2/3 ">
        <h5 class="text-2xl font-semibold">{{ __('Add Data Kota') }}</h5>

        <button wire:click="close">
            <i class="fa fa-circle-xmark fa-2xl"></i>
        </button>
    </div>
    {{-- <div class="w-full mt-3 text-center lg:w-2/3 ">
        @if (session()->has('message'))
            <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
        @endif
    </div> --}}
    <div class="flex flex-col justify-between w-full gap-2 p-3 lg:mx-auto lg:flex lg:flex-row lg:w-2/3 items-top ">
        <div class="w-full p-4 mt-3 text-white bg-teal-500 border shadow-xl lg:w-1/2 rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Data Kota') }}</div>

            <div class="w-full mt-3">
                <label class="px-2" for="nama_kota">{{ __('Nama Kota') }}</label>
                <input id="nama_kota" type="text" placeholder="{{ __('Nama Kota') }}" wire:model="nama_kota"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_kota')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            @if ($is_add == true)
                <div class="flex justify-between">
                    <button wire:click="store" class="button button-purple">{{ __('Save') }}</button>
                    <button wire:click="close" class="button button-black">{{ __('Close') }}</button>
                </div>
            @else
                <div class="flex justify-between">
                    <button wire:click="update" class="button button-purple">{{ __('Update') }}</button>
                    <button wire:click="cancel" class="button button-black">{{ __('Cancel') }}</button>
                </div>
            @endif
        </div>

        <div class="w-full mt-3 lg:w-1/2">
            @if (!empty($kota))
                <table class="w-full table-auto">
                    <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                        <tr>
                            <th class="p-3 font-semibold text-center">#</th>
                            <th class="p-3 font-semibold text-center">{{ __('Kota') }}</th>
                            <th class="p-3 font-semibold text-center"></th>
                        </tr>
                    </thead>
                    @foreach ($kota as $index => $p)
                        <tbody>
                            <tr>
                                <td class="p-3 text-gray-800 border rounded dark:text-white">
                                    {{ $kota->firstItem() + $index }}</td>
                                <td class="p-3 text-gray-800 border rounded dark:text-white">{{ $p->nama_kota }}</td>
                                <td class="p-3 text-center text-gray-800 border rounded dark:text-white">
                                    @if ($p->kota_is_used == false)
                                        <button class="px-2 py-1 text-sm text-white bg-red-500 rounded"
                                            wire:click="deleteConfirmation({{ $p->id }})"><i
                                                class="fa fa-trash "></i></button>
                                    @else
                                        <button class="px-2 py-1 text-sm text-white bg-orange-500 rounded"
                                            wire:click="edit({{ $p->id }})"><i
                                                class="fa fa-pen-to-square "></i></button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="mt-3">
                    {{ $kota->links() }}
                </div>
            @else
                <div>
                    <h1>No Data Found!</h1>
                </div>
            @endif
        </div>
    </div>

    {{-- @push('script')
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
                        window.livewire.emit('delete_kota', e.detail.id)
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
                    'Deleted!', 'Data sudah di delete.', 'success'
                );
            });
        </script>
    @endpush --}}

</div>
