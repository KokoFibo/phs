<div>
    @section('title', 'Tambah Kelas')
    @if ($open==0)

    <div class="flex items-center justify-center w-1/3 h-full min-h-screen mx-auto">
        <!-- component -->
        <div class="flex flex-col items-center justify-center px-8 pt-6 pb-8 mb-4 rounded shadow-md bg-pink-50">
            <h5 class="text-lg text-center">Hi, {{ Auth::user()->name }}</h5>
            <h5 class="text-lg text-center">Silakan masukkan password anda untuk masuk ke menu ini.</h5>

            <div class="w-full mt-6 mb-6">
                <input class="w-full px-3 py-2 mb-3 border rounded shadow appearance-none border-red text-grey-darker"
                    type="password" wire:model="pswd">
            </div>
            <button wire:click="checkPassword" class="w-full button button-purple">Masuk</button>

        </div>
    </div>
    @endif
    @if($open==1)


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
                class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{
                __('Save') }}</button>
            @else
            <button wire:click="update"
                class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{
                __('Update') }}</button>
            @endif
            <button wire:click="cancel" class="button button-yellow">{{ __('Cancel') }}</button>
        </div>
        <div class="w-1/2 mt-3">
            @if (!empty($kelas))
            <table class="w-full table-auto">
                <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                    <tr>
                        <th class="p-3 font-semibold text-center text">#</th>
                        <th class="p-3 font-semibold text-center text">{{ __('Nama') }}</th>
                        <th class="p-3 font-semibold text-center text"></th>
                    </tr>
                </thead>
                @foreach ($kelas as $index => $p)
                <tbody>
                    <tr>
                        <td class="p-3 text-gray-800 border rounded text">
                            {{ $kelas->firstItem() + $index }}</td>
                        <td class="p-3 text-gray-800 border rounded text">{{ $p->nama_kelas }}</td>
                        <td class="p-3 text-center text-gray-800 border rounded text">
                            @if ($p->kelas_is_used == false)
                            <button class="button-red button " wire:click="deleteConfirmation({{ $p->id }})"><i
                                    class="fa fa-trash "></i></button>
                            @else
                            <button class="button button-teal" wire:click="edit({{ $p->id }})"><i
                                    class="fa fa-pen-to-square "></i></button>
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
                        title: e.detail.title
                        , text: e.detail.text
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#3085d6'
                        , cancelButtonColor: '#d33'
                        , confirmButtonText: 'Yes, silakan hapus!'
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
                        'Deleted!'
                        , 'Data sudah di delete.'
                        , 'success'
                  );
            });

    </script>
    @endpush
    @endif
</div>
