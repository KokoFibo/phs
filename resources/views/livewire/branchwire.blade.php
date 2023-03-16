<div>
    @section('title', 'Add Data Vihara')
    <div class="flex justify-between w-full p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl lg:w-3/4 ">
        <h5 class="text-2xl font-semibold">{{ __('Add Data Vihara') }}</h5>

        <button wire:click="close">
            <i class="fa fa-circle-xmark fa-2xl"></i>
        </button>
    </div>

    <div class="w-3/4 mx-auto mt-3 text-center ">
        @if (session()->has('message'))
            <div class="w-full py-2 text-xl text-red-500 bg-teal-500 rounded-xl">{{ session('message') }}</div>
        @endif
    </div>

    <div class="flex flex-col w-full p-3 mx-auto lg:w-3/4 lg:flex lg:flex-row items-top justify-evenly">
        <div class="w-full p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl lg:w-1/2 rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Data Vihara') }}</div>
            <div class="w-full mt-3">
                <label class="block px-2" for="kota">{{ __('Group Vihara') }}</label>
                <select wire:model="groupvihara_id"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    {{-- $kode_cetya = $data->kode_branch; --}}
                    <option value="" selected>{{ __('Silakan Pilih Group Vihara') }}</option>
                    @foreach ($groupvihara as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_group }}</option>
                    @endforeach
                </select>

                @error('groupvihara_id')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full mt-3 ">
                <label class="px-2 " for=" nama_vihara">{{ __('Nama Vihara') }}</label>
                <input id="nama_vihara" type="text" placeholder="{{ __('Nama Vihara') }}" wire:model="nama_branch"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_branch')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            @if ($is_add == true)
                <button wire:click="store" class="button button-purple">{{ __('Save') }}</button>
            @else
                <button wire:click="update" class="button button-teal">{{ __('Update') }}</button>
            @endif
        </div>
        {{-- TABLE --}}
        <div class="w-full mt-3 lg:w-1/2">
            @if (!empty($branch))
                <table class="w-full table-auto">
                    <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                        <tr>
                            <th class="p-3 font-semibold text-center">#</th>
                            <th class="p-3 font-semibold text-center">{{ __('Nama Vihara') }}</th>
                            <th class="p-3 font-semibold text-center">{{ __('Group Vihara') }}</th>
                            <th class="p-3 font-semibold text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    @foreach ($branch as $index => $b)
                        <tbody>
                            <tr>
                                <td class="p-3 text-gray-800 border rounded dark:text-white">
                                    {{ $branch->firstItem() + $index }}</td>
                                <td class="p-3 text-gray-800 border rounded dark:text-white">{{ $b->nama_branch }}</td>
                                <td class="p-3 text-gray-800 border rounded dark:text-white">
                                    {{ $b->groupvihara->nama_group }}</td>
                                <td class="p-3 text-center text-gray-800 border rounded dark:text-white">
                                    @if ($b->branch_is_used == false)
                                        <button class="button-red button "
                                            wire:click="delete_confirmation({{ $b->id }})">{{ __('Delete') }}</button>
                                    @else
                                        <button class="button button-teal"
                                            wire:click="edit({{ $b->id }})">{{ __('Edit') }}</button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="mt-3">
                    {{ $branch->links() }}
                </div>
            @else
                <div>
                    <h1>No Data Found!</h1>
                </div>
            @endif
        </div>
        {{-- TABLE END --}}
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('success', function(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: e.detail.title,
                showConfirmButton: false,
                timer: 2000
            });
        });
        window.addEventListener('error', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: e.detail.title,

            })
        });


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
                'Deleted!', 'Data sudah di delete.', 'success'
            );
        });
    </script>
@endpush
