<div>
    @section('title', 'Update Data')

    <div
        class="flex items-center justify-between w-full px-5 py-3 mx-3 mt-2 text-white bg-purple-500 shadow-lg lg:w-3/4 lg:mx-auto rounded-xl">
        <div>
            <h4 class="text-lg font-semibold lg:text-2xl">{{ __('View Data') }}</h3>
        </div>
        <div>

            <h3 class="text-2xl">
                {{ getBranch($branch_id) }}
            </h3>

        </div>

        <div class="flex gap-1">
        </div>
    </div>
    <div
        class="flex justify-center w-full py-5 pb-3 mx-3 my-2 mt-2 mb-5 shadow lg:w-3/4 lg:mx-auto shadow-purple-300 bg-purple-50 rounded-xl">
        <div class="w-1/2 px-5">

            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Nama') }}</label>
                <input id="nama" type="text" wire:model="nama_umat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Nama Alias') }}</label>
                <input id="nama_alias" type="text" wire:model="nama_alias"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="mandarin">{{ __('中文名') }}</label>
                <input id="mandarin" type="text" wire:model="mandarin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="umur">{{ __('Umur / Tanggal Lahir') }}</label>
                <input id="umur" type="text" wire:model="umur_sekarang"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="alamat">{{ __('Alamat') }}</label>
                <input id="alamat" type="text" wire:model="alamat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 ">{{ __('Kota') }}</label>
                <input id="alamat" type="text" value="{{ getNamaKota($kota_id) }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="telepon">{{ __('Telepon') }}</label>
                <input id="telepon" type="text" wire:model="telp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="handphone">{{ __('Handphone') }}</label>
                <input id="handphone" type="text" wire:model="hp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="email">{{ __('Email') }}</label>
                <input id="email" type="text" wire:model="email"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>

        </div>
        <div class="w-1/2 px-5">

            <div class="mt-3">
                <div>
                    <label class="px-2 ">{{ __('Gender') }}</label>
                </div>
                <input id="alamat" type="text" value="{{ check_JK($gender, $umur_sekarang) }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="tgl">{{ __('Tanggal Mohon Tao') }}</label>
                <input id="tgl" type="text" wire:model="tgl_mohonTao"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="pengajak">{{ __('Pengajak') }}</label>
                <input id="tgl" type="text" wire:model="pengajak"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="penjamin">{{ __('Penjamin') }}</label>
                <input id="tgl" type="text" wire:model="penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">

                <label class="px-2 " for="pandita">{{ __('Pandita') }}</label>
                <input id="tgl" type="text" value="{{ getNamaPandita($pandita_id) }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>

            <div class="mt-3">
                <label class="px-2 " for="tgl">{{ __('Kelas Dharma 3 Hari') }}</label>
                <input id="tgl" type="text" wire:model="tgl_sd3h"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>

            <div class="mt-3">
                <label class="px-2 " for="tgl">{{ __('Tanggal Vegetarian Total') }}</label>
                <input id="tgl" type="text" wire:model="tgl_vtotal"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>

            </div>
            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Status') }}</label>
                <input id="tgl" type="text" wire:model="status"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>
            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Keterangan') }}</label>
                <input id="tgl" type="text" wire:model="keterangan"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" disabled>
            </div>



            <div class="flex items-center justify-between w-full mt-9">
                <h5 class="text-sm">Last Update : {{ $last_update }}</h5>
                <div>
                    <a href="{{ route('main') }}"><button type="button" class="button button-black"><i
                                class="fa fa-circle-arrow-left"></i>
                            {{ __('Back') }}</button></a>
                </div>
            </div>
        </div>
    </div>

</div>
