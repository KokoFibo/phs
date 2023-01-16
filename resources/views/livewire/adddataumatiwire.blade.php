<div>



    <div
        class="flex items-center justify-between w-3/4 px-5 py-3 mx-auto mt-2 text-white bg-purple-500 shadow-lg rounded-xl">
        <div>
            <h4>Add Data</h3>
        </div>
        <div>
            <h1>Nama Fothang</h1>
        </div>
        <div class="flex gap-1">
            <div>
                <button class="button button-yellow">Add Data Pandita</button>
            </div>
            <div>
                <button class="button button-teal">Add Data Kota</button>
            </div>
        </div>
    </div>
    <div class="flex justify-center w-3/4 py-5 mx-auto my-2 mt-2 shadow-lg shadow-purple-900 bg-purple-50 rounded-xl">
        <div class="w-2/5 px-5">
            <div class="mt-3">
                <label class="px-2 text-sm" for="nama">{{ __('Nama') }}</label>
                <input id="nama" type="text" placeholder="{{ __('Nama Lengkap') }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm" for="mandarin">{{ __('中文名') }}</label>
                <input id="mandarin" type="text" placeholder="{{ __('中文名') }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm" for="umur">{{ __('Umur') }}</label>
                <input id="umur" type="text" placeholder="{{ __('Umur antara 1 -150') }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm" for="alamat">{{ __('Alamat') }}</label>
                <input id="alamat" type="text" placeholder="{{ __('Alamat Rumah') }}"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm">{{ __('Kota') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="">{{ __('Silakan Pilih Kota') }}</option>
                    <option value="">Aceh</option>
                    <option value="">Medan</option>
                    <option value="">Jakarta</option>
                </select>
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm" for="telepon">{{ __('Telepon') }}</label>
                <input id="telepon" type="text" placeholder="021 12345678"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <label class="px-2 text-sm" for="handphone">{{ __('Handphone') }}</label>
                <input id="handphone" type="text" placeholder="0821 1234 5678"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
        </div>
        <div class="w-2/5 px-5">
            <div class="mt-3">
                <label class="px-2 text-sm" for="email">{{ __('Email') }}</label>
                <input id="email" type="text" placeholder="name@example.com"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="mt-3">
                <div>
                    <label class="px-2 text-sm">{{ __('Gender') }}</label>
                </div>
                <div class="mt-1">
                    <input type="radio" class="rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <label class="px-2" for="">{{ __('Laki-laki') }}</label>
                    <input type="radio" class="rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <label class="px-2" for="">{{ __('Perempuan') }}</label>
                </div>
            </div>
            <div class="mt-7">
                <label class="px-2 text-sm" for="tgl">{{ __('Tanggal Mohon Tao') }}</label>
                <input id="tgl" type="date"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            <div class="relative mt-3" x-data="{ pengajak: false }">
                <label class="px-2 text-sm" for="pengajak">{{ __('Pengajak') }}</label>
                <input @click="pengajak=true" id="pengajak" type="text" placeholder="Masukkan data Pengajak"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="nama_pengajak">
                <input type="hidden" wire:model="pengajak_id">
                <div x-show="pengajak" class="absolute z-10 overflow-auto h-44">
                    <input id="pengajak" type="text" placeholder="Cari Pengajak" wire:model="query"
                        class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <ul class="bg-white ">
                        @if (!empty($nama))
                            @foreach ($nama as $n)
                                <li class="px-4 py-1 text-purple-500 border ">
                                    <button class="hover:bg-gray-300"
                                        wire:click="getDataPengajak( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )"
                                        @click="pengajak=false">{{ $n['nama_umat'] }}</button>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="relative mt-3" x-data="{ penjamin: false }">
                <label class="px-2 text-sm" for="penjamin">{{ __('Penjamin') }}</label>
                <input @click="penjamin=true" id="penjamin" type="text" placeholder="Masukkan data penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="nama_penjamin">
                <input type="hidden" wire:model="penjamin_id">
                <div x-show="penjamin" class="absolute z-10 overflow-auto h-44">
                    <input id="penjamin" type="text" placeholder="Cari penjamin" wire:model="query"
                        class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <ul class="bg-white ">
                        @if (!empty($nama))
                            @foreach ($nama as $n)
                                <li class="px-4 py-1 text-purple-500 border ">
                                    <button class="hover:bg-gray-300"
                                        wire:click="getDataPenjamin( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )"
                                        @click="penjamin=false">{{ $n['nama_umat'] }}</button>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            {{-- <div class="mt-3">
                <label class="px-2 text-sm" for="penjamin">{{ __('Penjamin') }}</label>
                <input id="penjamin" type="text" placeholder="Masukkan data Penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div> --}}
            <div class="mt-3">
                <label class="px-2 text-sm" for="pandita">{{ __('Pandita') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Masukkan data Pengajak</option>
                    <option value="">Huang TCS</option>
                    <option value="">Lan TCS</option>
                    <option value="">Lin TCS</option>
                </select>

            </div>
            <div class="flex items-center justify-between w-full mt-9">
                <div>
                    <button class="button button-purple">{{ __('Save') }}</button>
                </div>
                <div>
                    <button class="button button-orange">{{ __('Back') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
