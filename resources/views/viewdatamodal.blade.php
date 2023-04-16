<!-- Modal toggle -->
{{-- <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
  </button> --}}

<!-- Main modal -->
<div x-cloak x-show="openModal" @click="openModal = false"
    class="dark:bg-gray-800 bg-black/70 fixed top-0 left-0 right-0 z-50  w-full p-4 overflow-x-hidden overflow-y-auto  md:inset-0 h-[calc(100%-1rem)] lg:h-full">
    {{-- <div class="relative w-full h-full max-w-2xl "> --}}
    <div class="relative w-full h-full mx-auto lg:w-3/4">

        <!-- Modal body -->
        <div class="p-3 space-y-6">
            {{-- isi mulai disini  --}}
            <div class="flex items-center w-full px-5 py-3 mt-2 bg-purple-500 shadow-lg lg:mx-auto rounded-xl">
                <div class="w-full lg:w-1/4">
                    <h4 class="text-lg font-semibold text-white lg:text-2xl">{{ __('Views Data') }}</h4>
                </div>
                <div class="w-full lg:w-1/2 ">
                    <h3 class="text-2xl text-center text-white">
                        {{ getBranch($branch_id) }}
                    </h3>
                </div>
                <button type="button" @click="openModal=false"
                    class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
            <div
                class="flex flex-col w-full py-5 my-2 mt-2 mb-5 shadow dark:bg-gray-800 lg:flex-row lg:mx-auto shadow-purple-300 bg-purple-50 rounded-xl">
                <div class="w-full px-5 lg:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-black ">

                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="nama">{{ __('Nama') }}</label>
                        <input id="nama" type="text" wire:model="nama_umat"
                            class="w-full rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="nama">{{ __('Nama Alias') }}</label>
                        <input id="nama_alias" type="text" wire:model="nama_alias"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="mandarin">{{ __('中文名') }}</label>
                        <input id="mandarin" type="text" wire:model="mandarin"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="umur">{{ __('Umur / Tanggal Lahir') }}</label>
                        <input id="umur" type="text" wire:model="umur_sekarang"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="alamat">{{ __('Alamat') }}</label>
                        <input id="alamat" type="text" wire:model="alamat"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white ">{{ __('Kota') }}</label>
                        <input id="alamat" type="text" value="{{ getNamaKota($kota_id) }}"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="telepon">{{ __('Telepon') }}</label>
                        <input id="telepon" type="text" wire:model="telp"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="handphone">{{ __('Handphone') }}</label>
                        <input id="handphone" type="text" wire:model="hp"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="email">{{ __('Email') }}</label>
                        <input id="email" type="text" wire:model="email"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>

                </div>
                <div class="w-full px-5 lg:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-black ">

                    <div class="mt-3">
                        <div>
                            <label class="px-2 dark:text-white ">{{ __('Gender') }}</label>
                        </div>
                        <input id="alamat" type="text" value="{{ check_JK($gender, $umur_sekarang) }}"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="tgl">{{ __('Tanggal Mohon Tao') }}</label>
                        <input id="tgl" type="text" wire:model="tgl_mohonTao"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="pengajak">{{ __('Pengajak') }}</label>
                        <input id="tgl" type="text" wire:model="pengajak"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="penjamin">{{ __('Penjamin') }}</label>
                        <input id="tgl" type="text" wire:model="penjamin"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">

                        <label class="px-2 dark:text-white " for="pandita">{{ __('Pandita') }}</label>
                        <input id="tgl" type="text" value="{{ getNamaPandita($pandita_id) }}"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>

                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="tgl">{{ __('Kelas Dharma 3 Hari') }}</label>
                        <input id="tgl" type="text" wire:model="tgl_sd3h1"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>

                    <div class="mt-3">
                        <label class="px-2 dark:text-white "
                            for="tgl">{{ __('Tanggal Vegetarian Total') }}</label>
                        <input id="tgl" type="text" wire:model="tgl_vtotal1"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white ">{{ __('Status') }}</label>
                        <input type="text" wire:model="status1"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>
                    <div class="mt-3">
                        <label class="px-2 dark:text-white " for="nama">{{ __('Keterangan') }}</label>
                        <input id="tgl" type="text" wire:model="keterangan"
                            class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
                    </div>

                    <div class="flex items-center justify-between w-full mt-9">
                        @if ($last_update != null)
                            <h5 class="text-sm dark:text-white">Last Update : {{ $last_update }}</h5>
                        @endif
                        <div>
                            <button type="button" @click="openModal=false"
                                class="button button-black dark:bg-purple-500"><i class="fa fa-circle-arrow-left"></i>
                                {{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- isi Selesai disini  --}}

        </div>
        <!-- Modal footer -->
        {{-- <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="defaultModal" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                    accept</button>
                <button data-modal-hide="defaultModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div> --}}
        {{-- </div> --}}
    </div>
</div>
