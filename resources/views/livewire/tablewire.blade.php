<div x-data="{ openModal: false }">
    @push('style')
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" /> --}}
    @endpush
    @include('viewdatamodal')

    <x-spinner />

    {{-- Search Bar --}}
    {{-- <div wire:loading>Loading...</div> xa --}}

    <div class="items-center justify-between w-full lg:flex">
        <div class="items-center lg:w-3/4 lg:flex ">
            {{-- search  --}}

            <div class="flex w-full px-2 mt-3 lg:w-2/5">
                {{-- <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                    Email</label> --}}


                <button id="dropdown-button" data-dropdown-toggle="dropdown"
                    class="z-10 inline-flex items-center flex-shrink-0 py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                    type="button">{{ __($nama_kategori) }} <svg aria-hidden="true" class="w-4 h-4 ml-1"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">

                        <li>
                            <button type="button" wire:click="getCategory('Nama')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Nama') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('Alias')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Alias') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('中文名')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('中文名') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('Pengajak')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Pengajak') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('Penjamin')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Penjamin') }}</button>
                        </li>

                        <li>
                            <button type="button" wire:click="getCategory('Pandita')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Pandita') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('Kota')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Kota') }}</button>
                        </li>
                        <li>
                            <button type="button" wire:click="getCategory('Alamat')"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Alamat') }}</button>
                        </li>
                    </ul>
                </div>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" wire:model.debounce.500ms="search"
                        class="z-20 p-2.5 block w-full text-sm text-gray-900 border border-l-2 border-gray-300 rounded-r-lg bg-gray-50 border-l-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        required>
                    <button
                        class="absolute top-0 right-0 p-2.5 text-sm font-medium  text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>

            </div>





            <div class="flex items-center justify-between w-full gap-2 px-2 lg:w-3/5">

                {{-- Rows per Page --}}
                <div class="relative w-full mt-3 lg:w-1/4 ">
                    <select
                        class="w-full px-2 py-1 text-sm text-white bg-green-500 border border-green-500 rounded lg:text-base hover:bg-green-700"
                        wire:model="perpage">
                        <option value="5">{{ __('5 Rows') }}</option>
                        <option value="10">{{ __('10 Rows') }}</option>
                        <option value="15">{{ __('15 Rows') }}</option>
                        <option value="20">{{ __('20 Rows') }}</option>
                        <option value="25">{{ __('25 Rows') }}</option>
                    </select>
                </div>
                {{--  Filter Dropdown --}}
                <div x-data="{ open: false }" class="w-full mt-3 lg:w-1/4">
                    <button @click="open = !open" :class="open ? 'bg-purple-500 ' : ''"
                        class="w-full px-2 py-1 text-sm text-white bg-purple-500 border border-purple-500 rounded lg:text-base hover:bg-purple-700 hover:text-white">
                        <span class="hidden lg:inline"><i class=" fa fa-filter fa-sm"></i></span>
                        {{ __('Filter') }} <i class=" fa fa-angle-down"></i></i></button>


                    {{-- isi dari dropdown --}}

                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class=" absolute left-5 lg:left-1/3 z-10 px-3 pb-3 rounded-xl w-400px dark:bg-gray-800 dark:border-gray-700 dark:text-white text-purple-700 bg-white  shadow-xl backdrop-blur-sm border border-[#ffffff/.3] ">


                        {{-- <div class="card card-body glass" style="width: 400px; color: purple;"> --}}
                        @if (Auth::user()->role == '3')
                            <div class="mt-3">
                                <label
                                    class="p-1 px-3 text-sm rounded bg-purple lg:text-base">{{ __('Group') }}</label>
                                <select wire:model="group_id"
                                    class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base">
                                    <option value="" selected>{{ __('All') }}
                                    </option>
                                    @foreach ($group as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_group }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mt-3">
                            <label class="p-1 px-3 text-sm rounded lg:text-base bg-purple">{{ __('Vihara') }} </label>
                            <select wire:model="kode_branch"
                                class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base">
                                <option value="">{{ __('All') }}</option>
                                @foreach ($all_branch as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama_branch }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="p-1 px-3 text-sm rounded bg-purple lg:text-base">{{ __('Gender') }}</label>
                            <select wire:model="jen_kel"
                                class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base">
                                <option value="0">{{ __('All') }}</option>
                                {{-- <option value="Laki-laki">{{ __('Laki-laki') }}</option>
                                                <option value="Perempuan">{{ __('Perempuan') }}</option> --}}
                                <option value="1">{{ __('Laki-laki') }}</option>
                                <option value="2">{{ __('Perempuan') }}</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="p-1 px-3 text-sm rounded bg-purple lg:text-base">{{ __('Status') }}
                            </label>
                            <select wire:model="status"
                                class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base">
                                <option value="">{{ __('All') }}</option>
                                <option value="Active">{{ __('Active Only') }}</option>
                                <option value="Inactive">{{ __('Inactive Only') }}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label class="text-sm text-center bg-purple lg:text-base">{{ __('Umur') }}</label>
                            <div class="flex" style="display: flex">
                                <div>
                                    <input type="text"
                                        class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base"
                                        wire:model="startUmur">
                                </div>
                                <p class="px-1">-</p>
                                <div>
                                    <input type="text"
                                        class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base"
                                        wire:model="endUmur">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="block">
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" checked />
                                        <span class="ml-2">Simple checkbox</span>
                                    </label>
                                </div>
                            </div> --}}
                        <div class="mt-3">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="tgl_sd3h" />
                                <span class="ml-2 text-sm lg:text-base">{{ __('Sidang Dharma 3 Hari') }}</span>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="tgl_vtotal" />
                                <span class="ml-2 text-sm lg:text-base">{{ __('Vegetarian Total') }}</span>
                            </label>
                        </div>


                        {{-- Jika Role adalah Manager --}}
                        {{-- @if (Auth::user()->role == '3') --}}

                        <div class="my-3">
                            <label class="text-sm text-center bg-purple lg:text-base">{{ __('Tanggal Mohon Tao') }}:
                            </label>
                            <div class="flex" style="display: flex">
                                <div>
                                    <input type="date"
                                        class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base"
                                        wire:model="startDate">
                                </div>
                                <div>
                                    <p class="px-1">-</p>
                                </div>
                                <div>
                                    <input type="date"
                                        class="w-full px-2 py-1 text-sm border border-gray-400 rounded dark:text-gray-800 lg:text-base"
                                        wire:model="endDate">
                                </div>
                            </div>
                            <div class="mt-3 text-right lg:hidden">
                                <button @click="open=false"
                                    class="px-2 py-1 text-sm text-black border border-black rounded hover:bg-black hover:text-white lg:text-base">Close</button>
                            </div>
                        </div>


                        {{--
                        </div> --}}

                    </div>
                    {{-- end isi dropdown --}}
                </div>
                {{-- Tambah Kolom --}}
                <div x-data="{ open: false }" class="relative w-full mt-3 lg:w-1/4">
                    <button @click="open = !open" :class=" open ? 'bg-purple-500 text-white' : ''"
                        class="w-full px-2 py-1 text-sm text-white bg-blue-500 border border-blue-500 rounded lg:text-base hover:bg-blue-700 hover:text-white">
                        {{ __('Kolom') }} <i class="fa fa-angle-down"></i></button>

                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="absolute z-10 px-2 py-3 text-purple-700 bg-white shadow-xl dark:bg-gray-800 -left-5 lg:left-0 rounded-xl">
                        {{-- mulai isi Tambah Kolom --}}

                        <table class="text-sm lg:text-base dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="pandita" wire:model="kolomPandita" value="1"
                                        class="checked:bg-purple-500" />
                                </td>

                                <td class="px-1 py-1 ">
                                    <label for="pandita">Pandita</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="alamat" wire:model="kolomAlamat" value="1"
                                        class="checked:bg-purple-500" />
                                </td>

                                <td class="px-1 py-1 ">
                                    <label for="alamat">Alamat</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="kota" wire:model="kolomKota" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="kota">Kota</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="telepon" wire:model="kolomTelepon" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="telepon">Telepon</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="handphone" wire:model="kolomHandphone" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="handphone">Handphone</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="email" wire:model="kolomEmail" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="email">Email</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="kelas" wire:model="kolomSd3h" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="kelas">Kelas 3 Hari</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="vegetarian" wire:model="kolomVTotal" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="vegetarian">Veg. Total</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="status" wire:model="kolomStatus" value="1"
                                        class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="status">Status</label></td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 ">
                                    <input type="checkbox" id="keterangan" wire:model="kolomKeterangan"
                                        value="1" class="checked:bg-purple-500" />
                                </td>
                                <td class="px-1 py-1 "><label for="keterangan">Keterangan</label></td>
                            </tr>
                        </table>
                        {{-- end isi dropdown --}}
                    </div>
                </div>
                {{-- kolom aas --}}
                <div class="relative w-full mt-3 lg:w-1/4">
                    {{-- Reset --}}
                    <div>
                        <button wire:click="resetFilter"
                            class="w-full px-2 py-1 text-sm text-white bg-pink-500 border border-pink-500 rounded lg:text-base hover:bg-pink-700 hover:text-white">
                            {{ __('Reset') }} <i class="fa fa-arrow-rotate-right"></i>

                        </button>

                    </div>
                </div>

            </div>
        </div>



        {{-- nama cetya ax --}}
        <div class="mx-5 mt-3 lg:w-1/5 ">
            {{-- kode_branch --}}
            {{-- <h1 class="text-3xl font-bold text-center text-purple-700">{{ $nama_cetya }} </h1> --}}
            <h1 class="text-base font-semibold text-center text-purple-700 lg:text-xl">{{ getGroupVihara($group_id) }}
                {{ getBranch($kode_branch) }}
            </h1>
        </div>
        {{-- End Search Bar --}}
    </div>
    {{-- export Excel $ PDF --}}
    @if ($selectedId != null)
        <div class="flex items-center w-full gap-2 px-5 mt-3 lg:w-1/2">
            <x-button wire:click="excel" wire:loading.attr="disabled" class="button button-teal">Excel</x-button>
            {{-- PDF --}}
            <form action="/pdf" method="POST">

                @csrf
                @foreach ($selectedId as $s)
                    <input type="hidden" name="IdPilihan[]" value="{{ $s }}">
                @endforeach
                <button type=submit class="button button-red">{{ __('PDF') }}</button>
            </form>
            {{-- Cetak --}}
            <form action="/cetak" method="POST">

                @csrf
                @foreach ($selectedId as $s)
                    <input type="hidden" name="IdPilihan[]" value="{{ $s }}">
                @endforeach
                <button type=submit class="button button-blue">{{ __('Cetak') }}</button>
            </form>

            <p class="text-lg font-semibold text-purple-500">{{ count($selectedId) }} Data Selected</p>
        </div>
    @endif
    {{-- Table --}}
    {{-- <div class="p-4 "> --}}
    {{-- work --}}
    <div class="w-full py-4 overflow-x-auto ">

        @if ($isTambahKolom == 1)
            <table class="w-full text-sm rounded-lg shadow table-fixed bg-gray-50 lg:text-base">
            @else
                <table class="w-full text-sm rounded-lg shadow table-fixed lg:table-auto bg-gray-50 lg:text-base">
        @endif
        <thead class="text-white bg-purple-500 border-b-2 border-gray-200 ">
            <tr>

                <th class="w-20 py-3 text-center   "><input type="checkbox" wire:model="selectAll"
                        class=" checked:bg-white-500" />
                </th>

                <th class="w-10 py-3 font-semibold text-center ">{{ __('#') }}</th>
                <th class="w-40 py-3 font-semibold text-left cursor-pointer "
                    wire:click=" sortColumnName('nama_umat')">
                    {{ __('NAMA') }}</th>
                <th class="w-40 py-3 font-semibold text-left cursor-pointer "
                    wire:click=" sortColumnName('nama_alias')">
                    {{ __('ALIAS') }}</th>
                <th class="w-20 py-3 font-semibold text-left cursor-pointer " wire:click="sortColumnName('mandarin')">
                    {{ __('中文名') }}</th>
                <th class="w-20 py-3 font-semibold text-left cursor-pointer "
                    wire:click="sortColumnName('umur_sekarang') ">
                    {{ __('UMUR') }}</th>
                <th class="font-semibold text-left cursor-pointer w-28 py-30 "
                    wire:click="sortColumnName('tgl_mohonTao')">
                    {{ __('MOHON TAO') }}</th>
                <th class="w-20 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('gender')">
                    {{ __('GENDER') }}</th>
                <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('pengajak')">
                    {{ __('PENGAJAK') }}</th>
                <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('penjamin')">
                    {{ __('PENJAMIN') }}</th>

                @if ($kolomPandita == 1)
                    <th class="w-24 py-3 font-semibold text-left cursor-pointer"
                        wire:click="sortColumnName('nama_pandita')">
                        {{ __('PANDITA') }}</th>
                @endif
                <th class="w-20 py-3 font-semibold text-left cursor-pointer"
                    wire:click="sortColumnName('nama_branch')">
                    {{ __('CETYA') }}</th>
                <th class="w-40 py-3 font-semibold text-left cursor-pointer"
                    wire:click="sortColumnName('nama_group')">
                    {{ __('GROUP') }}</th>

                {{-- Header kolom tambahan  --}}
                @if ($kolomAlamat == 1)
                    <th class="py-3 font-semibold text-left cursor-pointer w-80"
                        wire:click="sortColumnName('alamat')">
                        {{ __('ALAMAT') }}</th>
                @endif
                @if ($kolomKota == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('kota')">
                        {{ __('KOTA') }}</th>
                @endif
                @if ($kolomTelepon == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('telp')">
                        {{ __('TELEPON') }}</th>
                @endif
                @if ($kolomHandphone == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('hp')">
                        {{ __('HANDPHONE') }}</th>
                @endif
                @if ($kolomEmail == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('email')">
                        {{ __('EMAIL') }}</th>
                @endif
                @if ($kolomSd3h == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer" wire:click="sortColumnName('sd3h')">
                        {{ __('KELAS 3 HARI') }}</th>
                @endif
                @if ($kolomVTotal == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer"
                        wire:click="sortColumnName('vtotal')">
                        {{ __('Veg. TOTAL') }}</th>
                @endif
                @if ($kolomStatus == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer"
                        wire:click="sortColumnName('status')">
                        {{ __('STATUS') }}</th>
                @endif
                @if ($kolomKeterangan == 1)
                    <th class="w-40 py-3 font-semibold text-left cursor-pointer"
                        wire:click="sortColumnName('keterangan')">
                        {{ __('KETERANGAN') }}</th>
                @endif
                <th class="py-3 font-semibold w-36 ">
                    <div class="flex justify-center space-x-1 aad">
                        <div>
                            <a href="/adddata">
                                <x-button type="button"
                                    class="p-1 px-5 text-white bg-teal-500 rounded hover:bg-teal-700 ">
                                    <i class="fa-solid fa-user-plus"></i>
                                </x-button>
                            </a>
                        </div>

                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datapelita1 as $index => $d)
                {{-- @if ($d->status == 'Active') --}}
                <tr
                    class="h-3 border-b dark:bg-gray-800 dark:border-gray-700 dark:text-white hover:bg-pink-50 dark:hover:bg-pink-600">
                    {{-- @else --}}
                    {{-- <tr @click="open=true" wire:click="viewdata({{ $d->id }})" --}}
                    {{-- class="h-3 bg-gray-300 border-b dark:bg-gray-800 dark:border-gray-700 dark:text-white hover:bg-pink-50 dark:hover:bg-pink-600"> --}}
                    {{-- @endif --}}
                    <td class="text-center">
                        <input type="checkbox" wire:model="selectedId" value="{{ $d->id }}"
                            class="checked:bg-purple-500" />
                    </td>

                    <td class="py-3 ">
                        {{ $datapelita1->firstItem() + $index }}
                    </td>

                    @if ($d->tgl_sd3h != '' && $d->tgl_vtotal == '')
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-purple-500 ">
                            {{ $d->nama_umat }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-purple-500 ">
                            {{ $d->nama_alias }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-purple-500 ">
                            {{ $d->mandarin }}
                        </td>
                    @elseif($d->tgl_sd3h != '' && $d->tgl_vtotal != '')
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-teal-500 ">
                            {{ $d->nama_umat }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-teal-500 ">
                            {{ $d->nama_alias }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                            class="py-3 font-semibold text-teal-500 ">
                            {{ $d->mandarin }}
                        </td>
                    @else
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->nama_umat }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->nama_alias }}
                        </td>
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->mandarin }}
                        </td>
                    @endif
                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                        class="py-3 text-center ">
                        {{ $d->umur_sekarang }}
                    </td>

                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                        {{ \Carbon\Carbon::parse($d->tgl_mohonTao)->format('d M Y') }}</td>
                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"
                        class="py-3     {{ $d->gender == '1' ? 'text-blue-500 text-lg' : 'text-pink-500 text-lg' }} text-center">
                        {{ check_JK($d->gender, $d->umur_sekarang) }}
                    </td>
                    {{-- <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})"   class="py-3 ">{{ $d->pengajak_id }} --}}
                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                        {{ $d->pengajak }}
                    </td>
                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                        {{ $d->penjamin }}</td>

                    @if ($kolomPandita == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->nama_pandita }}
                        </td>
                    @endif

                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                        {{ $d->nama_branch }}
                    </td>
                    <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                        {{ $d->nama_group }}
                    </td>

                    @if ($kolomAlamat == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->alamat }}
                        </td>
                    @endif
                    @if ($kolomKota == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->nama_kota }}
                        </td>
                    @endif
                    @if ($kolomTelepon == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->telp }}
                        </td>
                    @endif
                    @if ($kolomHandphone == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->hp }}
                        </td>
                    @endif
                    @if ($kolomEmail == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->email }}
                        </td>
                    @endif
                    @if ($kolomSd3h == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->tgl_sd3h }}
                        </td>
                    @endif
                    @if ($kolomVTotal == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->tgl_vtotal }}
                        </td>
                    @endif
                    @if ($kolomStatus == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->status }}
                        </td>
                    @endif
                    @if ($kolomKeterangan == 1)
                        <td @dblclick="openModal=true" wire:click="viewdata({{ $d->id }})" class="py-3 ">
                            {{ $d->keterangan }}
                        </td>
                    @endif


                    <td>

                        <div class="flex justify-center space-x-1">
                            {{-- viewdata --}}
                            <div>
                                {{-- <a href="/viewdata/{{ $d->id }}">
                                <x-button type="button"
                                    class="p-1 text-white bg-purple-500 rounded hover:bg-purple-700">
                                    <i class="fa fa-eye "></i>
                                </x-button>
                            </a> --}}
                                {{-- <button wire:click="viewdata({{ $d->id }})" data-modal-target="defaultModal"
                                @click="open=true" data-modal-toggle="defaultModal" type="button"
                                class="p-1 text-white bg-purple-500 rounded hover:bg-purple-700" type="button">
                                <i class="fa fa-eye "></i>
                            </button> --}}
                                <button wire:click="viewdata({{ $d->id }})" @click="openModal=true"
                                    type="button"
                                    class="p-1 text-white bg-purple-500 rounded hover:bg-purple-700 text-xl">
                                    <i class="fa fa-eye "></i>
                                </button>

                            </div>

                            {{-- <div> --}}
                            <div>
                                <a href="/editdata/{{ $d->id }}">
                                    <x-button type="button"
                                        class="p-1 text-white bg-orange-500 rounded hover:bg-orange-700 text-xl">
                                        <i class="fa fa-pen-to-square "></i>
                                    </x-button>
                                </a>

                            </div>
                            @if (Auth::user()->role != '1')
                                <div>

                                    <x-button class="p-1 text-white bg-red-500 rounded hover:bg-red-700 text-xl"
                                        wire:click="deleteConfirmation({{ $d->id }})">
                                        <i class="fa fa-trash "></i>
                                    </x-button>
                                </div>
                            @endif
                            {{--
                                    </div> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>

    </div>
    <div class="px-3 mt-3 text-sm dark:text-white">
        {{ $datapelita1->onEachSide(1)->links() }}

    </div>
    <hr class="invisible mt-3 ">
    {{--
    </div> --}}
    {{-- End Table --}}

    {{-- JS utk Sweetalert Delete --}}
    @push('script')
        <script>
            //     window.addEventListener('delete_confirmation', function(e) {
            //         Swal.fire({
            //             title: e.detail.title,
            //             text: e.detail.text,
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'Yes, silakan hapus!'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 window.livewire.emit('delete', e.detail.id)
            //                 // Swal.fire(
            //                 //     'Deleted!',
            //                 //     'Your file has been deleted.',
            //                 //     'success'
            //                 // )
            //             }
            //         })
            //     });
            //     window.addEventListener('deleted', function(e) {
            //         Swal.fire(
            //             'Deleted!', 'Data sudah di delete.', 'success'
            //         );
            //     });
            //     window.addEventListener('resetfield', function(e) {
            //         Swal.fire({
            //             position: 'top-end',
            //             icon: 'success',
            //             title: 'Filter Sudah di Reset',
            //             showConfirmButton: false,
            //             timer: 1500
            //         })
            //     });
            //
        </script>
        {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script> --}}
    @endpush
</div>
