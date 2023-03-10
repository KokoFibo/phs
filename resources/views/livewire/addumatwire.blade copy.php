<div>
    @section('title', 'Add Data')
    {{-- @dump($selectedGroup)
    @dump($selectedBranch)
    @dump($selectedKota) --}}
    <div
        class="flex items-center justify-between w-full px-5 py-3 mx-3 mt-2 text-white bg-purple-500 shadow-lg lg:mx-auto lg:w-3/4 rounded-xl">
        <div>
            <h4 class="text-xl font-semibold lg:text-2xl">{{ __('Add Data') }}</h3>
        </div>
        <div>
            <h3 class="text-2xl">
                {{ getBranch($kode_branch) }}
            </h3>
        </div>
        <div class="flex gap-1">

            <div>
                <a href="/panditawire"><button class="button button-yellow">{{ __('Add Data Pandita') }}</button>
                </a>
            </div>
            <div>
                <a href="/datakotawire"><button class="button button-teal">{{ __('Add Data Kota') }}</button>
                </a>

            </div>
        </div>

    </div>

    <div
        class="flex items-center w-full py-3 mx-3 my-2 mb-3 shadow lg:mx-auto lg:w-3/4 justify-evenly shadow-purple-300 bg-purple-50 rounded-xl">

        <div class="w-1/4 mx-1 lg:mx-4 ">
            <label class="px-2 ">{{ __('Group') }}</label><span class="text-red-500">*</span>
            <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                wire:model="selectedGroup">
                {{-- <option value="">{{ __('Silakan Pilih Group') }}</option> --}}
                @foreach ($selectGroup as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4 mx-1 lg:mx-4 ">
            <label class="px-2 ">{{ __('Vihara') }}</label><span class="text-red-500">*</span>
            <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                wire:model="selectedBranch">
                {{-- <option value="">{{ __('Silakan Pilih Vihara') }}</option> --}}
                @foreach ($selectBranch as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_branch }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4 mx-1 lg:mx-4 ">
            <label class="px-2 ">{{ __('Kota') }}</label><span class="text-red-500">*</span>
            <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                wire:model="selectedKota">
                <option value="">{{ __('Silakan Pilih Kota') }}</option>
                @foreach ($selectKota as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_kota }}</option>
                @endforeach
            </select>
        </div>


        <div>
            <button wire:click="setDefault" class="mx-1 lg:mx-4 button button-purple">Set as
                Default</button>

        </div>
    </div>

    <div
        class="flex justify-center w-full py-5 pb-3 mx-3 my-2 mt-2 mb-5 shadow lg:mx-auto lg:w-3/4 shadow-purple-300 bg-purple-50 rounded-xl">
        <div class="w-1/2 px-3 ">
            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Nama') }}</label><span class="text-red-500">*</span>
                <input id="nama" type="text" placeholder="{{ __('Nama Lengkap') }}" wire:model="nama_umat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_umat')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="nama">{{ __('Alias') }}</label>
                <input id="nama" type="text" placeholder="{{ __('Nama Alias') }}" wire:model="nama_alias"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_alias')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="mandarin">{{ __('中文名') }}</label>
                <input id="mandarin" type="text" placeholder="{{ __('中文名') }}" wire:model="mandarin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('mandarin')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="tgl_lahir">{{ __('Tanggal Lahir') }}</label><span
                    class="text-red-500">*</span>
                <input type="date" wire:model="tgl_lahir"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_lahir')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="alamat">{{ __('Alamat') }}</label><span class="text-red-500">*</span>
                <input id="alamat" type="text" placeholder="{{ __('Alamat Rumah') }}" wire:model="alamat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('alamat')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="mt-3">
                <label class="px-2 ">{{ __('Kota') }}</label><span class="text-red-500">*</span>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="kota_id">
                    <option value="">{{ __('Silakan Pilih Kota') }}</option>
                    @foreach ($datakota as $kota)
                    <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                    @endforeach

                </select>
                @error('kota_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="mt-3">
                <label class="px-2 " for="telepon">{{ __('Telepon') }}</label>
                <input id="telepon" type="text" placeholder="02112345678" wire:model="telp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('telp')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="handphone">{{ __('Handphone') }}</label>
                <input id="handphone" type="text" placeholder="082112345678" wire:model="hp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('hp')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 " for="email">{{ __('Email') }}</label>
                <input id="email" type="text" placeholder="name@example.com" wire:model="email"
                    class="w-full mb-5 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


        </div>
        <div class="w-1/2 px-3 ">

            <div class="mt-5">
                <div>
                    <label class="px-2 ">{{ __('Gender') }}</label><span class="text-red-500">*</span>
                </div>
                <div class="mt-1">
                    <input type="radio" value="1" checked id="laki""
                        class="rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        wire:model="gender">
                    <label class="pr-2" for="laki">{{ __('Laki-laki') }}</label>

                    <input type="radio" value="2" checked id="perempuan""
                        class="rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        wire:model="gender">
                    <label for="perempuan">{{ __('Perempuan') }}</label>
                </div>
                @error('gender')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-5">
                <label class="px-2 " for="tgl">{{ __('Tanggal Mohon Tao') }}</label><span
                    class="text-red-500">*</span>
                <input id="datepicker" type="date" wire:model="tgl_mohonTao"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_mohonTao')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="relative mt-3" x-data="{ pengajak: false }">
                <label class="px-2 " for="pengajak">{{ __('Pengajak') }}</label><span class="text-red-500">*</span>
                <input @click="pengajak=true" id="pengajak" autocomplete="off" type="text"
                    placeholder="Masukkan data Pengajak"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="pengajak">
                <input type="hidden" wire:model="pengajak_id">
                <div x-show="pengajak" @click.away="pengajak = false" x-transition
                    class="absolute z-10 overflow-auto h-44">
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
                @error('pengajak_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="mt-3">
                <label class="px-2 " for="pengajak">{{ __('Nama Pengajak') }}</label><span
                    class="text-red-500">*</span>
                <input id="pengajak" type="text" placeholder="{{ __('Nama Pengajak') }}" wire:model="pengajak"
                    autocomplete="on"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('pengajak')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="relative mt-3" x-data="{ penjamin: false }">
                <label class="px-2 " for="penjamin">{{ __('Penjamin') }}</label><span class="text-red-500">*</span>
                <input @click="penjamin=true" autocomplete="off" id="penjamin" type="text"
                    placeholder="Masukkan data penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="penjamin">
                <input type="hidden" wire:model="penjamin_id">
                <div x-show="penjamin" @click.away="penjamin = false" x-transition
                    class="absolute z-10 overflow-auto h-44">
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
                @error('penjamin_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="mt-3">
                <label class="px-2 " for="penjamin">{{ __('Nama Penjamin') }}</label><span
                    class="text-red-500">*</span>
                <input id="penjamin" type="text" placeholder="{{ __('Nama Penjamin') }}" wire:model="penjamin"
                    autocomplete="on"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('penjamin')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="mt-3">
                <label class="px-2 " for="penjamin">{{ __('Penjamin') }}</label>
                <input id="penjamin" type="text" placeholder="Masukkan data Penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div> --}}
            <div class="mt-3">
                <label class="px-2 " for="pandita">{{ __('Pandita') }}</label><span class="text-red-500">*</span>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="pandita_id">
                    <option value="">{{ __('Data Pandita') }}</option>
                    @foreach ($datapandita as $pandita)
                        <option value="{{ $pandita->id }}">{{ $pandita->nama_pandita }}</option>
                    @endforeach

                </select>
                @error('pandita_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <div class="mt-3">
                <label class="px-2 " for="tgl">{{ __('Kelas Dharma 3 Hari') }}</label>

                <input id="datepicker" type="date" wire:model="tgl_sd3h"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_sd3h')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <div class="mt-3">
                <label class="px-2 " for="tgl">{{ __('Tanggal Vegetarian Total') }}</label>
                <input id="datepicker" type="date" wire:model="tgl_vtotal"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_vtotal')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between w-full mt-9">
                <div>
                    <button class="button button-purple" wire:click="store">{{ __('Save') }}</button>
                </div>
                <div>
                    <a href="{{ route('main') }}"><button class="button button-black"><i
                                class="fa fa-circle-arrow-left"></i>
                            {{ __('Back') }}</button></a>
                    {{-- <button class="button button-orange">{{ __('Back') }}</button> --}}
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('stored', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.detail.title,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
            window.addEventListener('setDefault', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.detail.title,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endpush
</div>
