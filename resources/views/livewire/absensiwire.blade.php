<div>
    {{-- Modal --}}

    <!-- Modal toggle -->
    {{-- <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Toggle modal
    </button> --}}

    <!-- Main modal -->
    <div wire:ignore.self id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Update Absensi') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">

                    {{-- <form> --}}
                    <div class="mb-6">
                        <label for="Cetya"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Cetya') }}</label>
                        <input type="text" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $nama_cetya }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="Kelas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kelas') }}</label>
                        <input type="text" id="Kelas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $nama_kelas }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="tgl_kelas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Kelas') }}</label>
                        <input type="date" id="tgl_kelas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="tgl_kelas">
                    </div>
                    <div class="mb-6">
                        <label for="jumlah_peserta"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Jumlah Peserta') }}</label>
                        <input type="text" id="jumlah_peserta"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="jumlah_peserta">
                    </div>

                    {{-- <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form> --}}

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="defaultModal" type="button" wire:click="update()"
                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-600">{{ __('Update') }}</button>
                    <button data-modal-hide="defaultModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal End --}}
    @section('title', 'Absensi Kelas Pendalaman')

    <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
        <h5 class="text-2xl font-semibold">{{ __('Absensi Kelas') }}</h5>

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
        <div class="w-1/3 p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Absensi Kelas') }}</div>

            @if (Auth::user()->role == '3')
                <div class="w-full mt-3">
                    <label class="px-2" for="nama_kelas">{{ __('Nama Cetya') }}</label>
                    <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                        wire:model="selectedBranch">
                        <option value="">Pilih Cetya</option>
                        @foreach ($branch as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_branch }} </option>
                        @endforeach
                    </select>
                </div>
            @endif


            <div class="w-full mt-3">
                <label class="px-2" for="nama_kelas">{{ __('Nama Kelas') }}</label>
                <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                    wire:model="daftarkelas_id">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $b)
                        <option value="{{ $b->id }}"> {{ getDaftarKelas($b->id) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full mt-3">
                <label class="px-2" for="tgl_kelas">{{ __('Tanggal Kelas') }}</label>
                <input id="tgl_kelas" type="date" wire:model="tgl_kelas"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_kelas')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full mt-3">
                <label class="px-2" for="jumlah_peserta">{{ __('Jumlah Peserta') }}</label>
                <input id="jumlah_peserta" type="number" wire:model="jumlah_peserta"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('jumlah_peserta')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button wire:click="store"
                class="px-3 py-1 text-teal-600 bg-white rounded hover:text-teal-800">{{ __('Save') }}</button>

        </div>
        <div class="w-2/3 mt-3">
            @if (!empty($absensi))
                <table class="w-full table-auto">
                    <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                        <tr>
                            <th class="p-3 text-sm font-semibold text-center">#</th>
                            <th class="p-3 text-sm font-semibold text-center">{{ __('Cetya') }}</th>
                            <th class="p-3 text-sm font-semibold text-center">{{ __('Kelas') }}</th>
                            <th class="p-3 text-sm font-semibold text-center">{{ __('Tanggal') }}</th>
                            <th class="p-3 text-sm font-semibold text-center">{{ __('Jumlah Peserta') }}</th>
                            <th class="p-3 text-sm font-semibold text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $index => $p)
                            <tr>
                                <td class="p-3 text-sm text-gray-800 border rounded">
                                    {{ $absensi->firstItem() + $index }}</td>
                                {{-- <td class="p-3 text-sm text-gray-800 border rounded">{{ $p->nama_kelas }}</td> --}}

                                <td class="p-3 text-sm text-gray-800 border rounded">
                                    {{ getDaftarKelasCetya($p->daftarkelas_id) }}
                                </td>
                                <td class="p-3 text-sm text-gray-800 border rounded">
                                    {{ getDaftarKelas($p->daftarkelas_id) }}
                                </td>
                                <td class="p-3 text-sm text-gray-800 border rounded">{{ $p->tgl_kelas }}</td>
                                <td class="p-3 text-sm text-gray-800 border rounded">{{ $p->jumlah_peserta }}
                                </td>

                                <td class="p-3 text-sm text-center text-gray-800 border rounded">
                                    <div class="flex justify-center space-x-1">



                                        <button class="p-1 text-white bg-red-500 rounded"
                                            wire:click="deleteConfirmation({{ $p->id }})"><i
                                                class="fa fa-trash "></i></button>
                                        {{-- <button class="button button-teal"
                                        wire:click="edit({{ $p->id }})">{{ __('Edit') }}</button> --}}

                                        {{-- pakai yg diatas --}}

                                        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                                            class="p-1 text-black bg-yellow-300 rounded"
                                            wire:click="edit({{ $p->id }})" type="button">
                                            <i class="fa fa-pen-to-square"></i>
                                        </button>

                                    </div>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $absensi->links() }}
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
            window.addEventListener('updated', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data sudah di update',
                    showConfirmButton: false,
                    timer: 1500
                })
            });

            window.addEventListener('saved', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data sudah di Simpan',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endpush

</div>
