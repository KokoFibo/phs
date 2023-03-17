<div>
    @section('title', 'Tambah Kelas')

    @if ($open == 0)
        <div class="flex flex-col items-center justify-center w-full h-full min-h-screen gap-10 mx-auto lg:w-1/3">
            <!-- component -->
            <div>
                <h4 class="text-3xl font-semibold text-center text-purple-500">{{ __('Menu Tambah Kelas') }}</h4>
            </div>
            <div
                class="flex flex-col items-center justify-center px-8 pt-6 pb-8 mx-3 mb-4 border rounded shadow-md dark:bg-gray-800 dark:border-gray-800 dark:text-white bg-pink-50">
                <h5 class="text-lg text-center">{{ __('Hi') }}, {{ Auth::user()->name }}</h5>
                <h5 class="text-lg text-center">{{ __('Silakan masukkan password anda untuk mengakses menu ini') }}.</h5>

                <div class="w-full mt-6 mb-6">
                    <input
                        class="w-full px-3 py-2 mb-3 border rounded shadow appearance-none dark:text-gray-900 border-red text-grey-darker"
                        type="password" wire:model="pswd">
                </div>
                <button wire:click="checkPassword" class="w-full button button-purple">{{ __('Enter') }}</button>

            </div>
        </div>
    @endif
    @if ($open == 1)


        <div class="flex justify-between w-full p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl lg:w-2/3 ">
            <h5 class="text-2xl font-semibold">{{ __('Tambah Kelas') }}</h5>

            <button wire:click="close">
                <i class="fa fa-circle-xmark fa-2xl"></i>
            </button>
        </div>
        {{-- <div class="w-full mx-auto mt-3 text-center lg:w-2/3 ">
            @if (session()->has('message'))
                <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
            @endif
        </div> --}}
        <div class="flex flex-col w-full p-3 mx-auto lg:flex lg:flex-row lg:w-2/3 items-top justify-evenly">
            <div class="w-full p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl lg:w-1/2 rounded-xl">
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
                    <div class="flex justify-between px-3">
                        <button wire:click="store" class="button button-purple">{{ __('Save') }}</button>
                        <button wire:click="close" class="button button-black">{{ __('Back') }}</button>
                    </div>
                @else
                    <div class="flex justify-between px-3">
                        <button wire:click="update" class="button button-purple">{{ __('Update') }}</button>
                        <button wire:click="cancel" class="button button-black">{{ __('Cancel') }}</button>
                    </div>
                @endif
            </div>
            <div class="w-full mt-3 lg:w-1/2">
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
                                    <td class="p-3 text-gray-800 border rounded dark:text-white text">
                                        {{ $kelas->firstItem() + $index }}</td>
                                    <td class="p-3 text-gray-800 border rounded dark:text-white text">
                                        {{ $p->nama_kelas }}</td>
                                    <td class="p-3 text-center text-gray-800 border rounded dark:text-white text">
                                        @if ($p->kelas_is_used == false)
                                            <button class="button-red button "
                                                wire:click="deleteConfirmation({{ $p->id }})"><i
                                                    class="fa fa-trash "></i></button>
                                        @else
                                            <button class="text-white button button-orange"
                                                wire:click="edit({{ $p->id }})"><i
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
    @endif


</div>
