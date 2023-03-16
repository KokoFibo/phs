<div>
    @section('title', 'Update Data')


    <div class="flex items-center w-full px-5 py-3 mt-2 bg-purple-500 shadow-lg lg:w-3/4 lg:mx-auto rounded-xl">
        <div class="w-1/4">
            <h4 class="text-lg font-semibold text-white lg:text-2xl">{{ __('View Data') }}</h4>
        </div>
        <div class="w-3/4 ">
            <h3 class="text-2xl text-center text-white">
                {{ getBranch($branch_id) }}
            </h3>
        </div>
    </div>
    <div
        class="flex flex-col w-full py-5 my-2 mt-2 mb-5 shadow dark:bg-gray-800 md:flex md:flex-row md:justify-center md:mx-auto md:w-3/4 shadow-purple-300 bg-purple-50 rounded-xl">
        <div class="w-full px-5 md:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-black ">

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
        <div class="w-full px-5 md:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-black ">

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
                <input id="tgl" type="text" wire:model="tgl_sd3h"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>

            <div class="mt-3">
                <label class="px-2 dark:text-white " for="tgl">{{ __('Tanggal Vegetarian Total') }}</label>
                <input id="tgl" type="text" wire:model="tgl_vtotal"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Status') }}</label>
                <input id="tgl" type="text" wire:model="status"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Keterangan') }}</label>
                <input id="tgl" type="text" wire:model="keterangan"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>

            <div class="flex items-center justify-between w-full mt-9">
                <h5 class="text-sm dark:text-white">Last Update : {{ $last_update }}</h5>
                <div>
                    <a href="{{ route('main') }}"><button type="button"
                            class="button button-black dark:bg-purple-500"><i class="fa fa-circle-arrow-left"></i>
                            {{ __('Back') }}</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
