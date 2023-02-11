<div>
    @section('title', 'Registration')
    <div class="flex mx-2 mt-3 justify-evenly">
        <div class="w-1/4">
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Registration') }}</div>
            @include('form_registration')
        </div>
        <div class="w-3/4 ml-3">
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Data User') }}</div>
            <table class="table w-full mx-auto mt-5">
                <thead>
                    <tr class="text-white bg-purple-500 ">
                        <th class="h-10 text-center border">#</th>
                        <th class="h-10 text-center border">{{ __('Nama') }}</th>
                        <th class="h-10 text-center border">{{ __('Email') }}</th>
                        <th class="h-10 text-center border">{{ __('Role') }}</th>
                        <th class="h-10 text-center border">{{ __('Kota') }}</th>
                        <th class="h-10 text-center border">{{ __('Branch') }}</th>
                        <th class="h-10 text-center border">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $d)
                        @if ((Auth::user()->role == '2' && $d->role != '3') || Auth::user()->role == '3')
                            <tr>
                                <td class="h-10 text-center text-gray-700 border ">
                                    {{ $data->firstItem() + $index }}
                                </td>
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->name }}</td>
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->email }}</td>
                                <td class="h-10 text-center text-gray-700 border ">{{ roleCheck($d->role) }}</td>
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->nama_kota }}</td>
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->nama_branch }}</td>
                                <td class="h-10 text-center text-gray-700 border ">
                                    <div class="text-center">
                                        <button wire:click="edit({{ $d->id }})"
                                            class="px-2 py-1 text-sm text-black bg-orange-500 rounded"><i
                                                class="fa fa-pen-to-square "></i></button>
                                        <button wire:click="deleteConfirmation({{ $d->id }})"
                                            class="px-2 py-1 text-sm text-white bg-red-500 rounded"><i
                                                class="fa fa-trash "></i></button>
                                        <button wire:click="resetpassword({{ $d->id }})"
                                            class="px-2 py-1 text-sm text-white bg-teal-500 rounded"><i
                                                class="fa fa-arrow-rotate-right"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="p-2">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    {{-- JS utk Sweetalert Delete --}}
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
