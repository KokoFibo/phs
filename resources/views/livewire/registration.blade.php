<div>
    @section('title', 'Registration')




    <div class="w-full ml-3">
        <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Data User') }}</div>
        <div class="overflow-x-auto">
            <table class="table w-full mx-auto mt-5 table-fixed md:table-auto">
                <thead>
                    <tr class="text-white bg-purple-500 ">
                        <th class="w-10 h-10 text-center border">#</th>
                        <th class="h-10 text-center border w-52">{{ __('Nama') }}</th>
                        <th class="h-10 text-center border w-60">{{ __('Email') }}</th>
                        <th class="w-40 h-10 text-center border">{{ __('Role') }}</th>
                        <th class="w-40 h-10 text-center border">{{ __('Kota') }}</th>
                        <th class="w-40 h-10 text-center border">{{ __('Group') }}</th>
                        <th class="w-40 h-10 text-center border">{{ __('Branch') }}</th>
                        <th class="h-10 text-center border w-28">{{ __('Action') }}</th>
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
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->nama_group }}</td>
                                <td class="h-10 text-center text-gray-700 border ">{{ $d->nama_branch }}</td>
                                <td class="h-10 text-center text-gray-700 border ">
                                    <div class="flex gap-1 justify-evenly">
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
        </div>
        <div class="p-2">
            {{ $data->links() }}
        </div>
        <div class="mx-3 text-right">
            <button wire:click="close" class="button button-teal">Back</button>
        </div>
        <hr class="mt-3">
    </div>
    <div class="mx-2 mt-3 justify-evenly">
        @if ($is_edit == true || $is_reset == true)
            <div class="w-full md:w-1/3">
            @else
                <div>
        @endif
        @if ($is_reset == true)
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Reset Password') }}</div>
            @include('form_registration')
        @endif
        @if ($is_edit == true)
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Update data') }}</div>
            @include('form_registration')
        @endif
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
                'Deleted!', 'Data sudah di delete.', 'success'
            );
        });

        window.addEventListener('passwordChanged', function(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Password sudah di update',
                showConfirmButton: false,
                timer: 1500
            })
        });
        window.addEventListener('updated', function(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User Data sudah di update',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
@endpush
</div>
