@if ($menuTambahData)
    <x-spinner />

    <div class="flex flex-col w-full p-3 mx-auto lg:w-3/4 items-top ">
        <div
            class="w-full p-4 mt-3 mr-3 text-xl font-semibold text-center text-white bg-teal-500 border shadow-xl rounded-xl">
            {{ __('Peserta Kelas') }}
        </div>

        <div class="flex flex-col w-full gap-3 mt-3 lg:flex lg:flex-row ">
            <div class="w-full p-4 text-white bg-teal-500 border shadow-xl lg:w-1/3 rounded-xl">
                <div class="mt-3 ">
                    <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                    <input id="kelas" type="text" value="{{ getDaftarKelas($daftarkelas_id) }}" disabled
                        class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div class="relative mt-3" x-data="{ peserta: false }">
                    <label class="px-2 " for="peserta">{{ __('Peserta') }}</label>
                    <input @click="peserta=true" autocomplete="off" id="peserta" type="text"
                        placeholder="Nama Peserta"
                        class="w-full text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        wire:model="peserta">
                    <div x-show="peserta" @click.away="peserta = false" x-transition
                        class="absolute z-10 overflow-auto h-44">
                        <input id="peserta" type="text" placeholder="Cari peserta" wire:model="query"
                            class="w-full text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        {{-- <input type="hidden" wire:model="datapelita_id"> --}}

                        <ul class="bg-white ">
                            @if (!empty($nama))
                                @foreach ($nama as $n)
                                    <li class="px-4 py-1 text-purple-500 border ">
                                        <button class="hover:bg-gray-300"
                                            wire:click="getDataPeserta( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )"
                                            @click="peserta=false">{{ $n['nama_umat'] }}</button>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    @error('datapelita_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="flex justify-between">
                        @if ($pesertaKelasAdd == true)
                            <button wire:click="storePeserta" class="mt-3 button button-purple">Tambahkan</button>
                        @else
                            <button wire:click="updatePesertakelas" class="mt-3 button button-blue">Update</button>
                        @endif
                        <button wire:click="closeMenuTambahDataPeserta" class="mt-3 button button-yellow">Close</button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 ">
                @if ($pesertakelas->count())
                    <table class="w-full table-auto">
                        <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                            <tr>
                                <th class="p-3 font-semibold text-center">#</th>
                                <th class="p-3 font-semibold text-center">{{ __('Nama Peserta') }}</th>
                                <th class="p-3 font-semibold text-center">{{ __('Nama Kelas') }}</th>
                                <th class="p-3 font-semibold text-center"></th>
                            </tr>
                        </thead>
                        @foreach ($pesertakelas as $index => $p)
                            <tbody>
                                <tr>
                                    <td class="p-3 text-gray-800 border rounded">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-3 text-gray-800 border rounded">{{ getName($p->datapelita_id) }}
                                    </td>
                                    <td class="p-3 text-gray-800 border rounded">
                                        {{ getDaftarKelas($p->daftarkelas_id) }}
                                    </td>
                                    {{-- <td class="p-3 text-center text-gray-800 border rounded">
                                    @if ($p->pesertakelas_is_used == false)
                                    <button class="button-red button " wire:click="deleteConfirmation({{ $p->id }})">{{
                                        __('Delete') }}</button>
                                    @else
                                    <button class="button button-teal" wire:click="edit({{ $p->id }})">{{ __('Edit')
                                        }}</button>
                                    @endif
                                </td> --}}
                                    <td class="p-3 text-gray-800 border rounded">
                                        {{ check_is_peserta_terdaftar($p->datapelita_id, $p->daftarkelas_id) }}
                                        @if (check_is_peserta_terdaftar($p->datapelita_id, $p->daftarkelas_id) == null)
                                            <button wire:click="deletepesertaConfirmation({{ $p->id }})"
                                                class="p-1 text-white bg-red-500 rounded">
                                                <i class="fa fa-trash "></i>
                                            </button>
                                        @endif
                                        {{-- <div class="flex justify-center space-x-1">
                                            <button wire:click="editpesertakelas({{ $p->id }})" type="button"
                                                class="p-1 text-black bg-yellow-300 rounded">
                                                <i class="fa fa-pen-to-square "></i>
                                            </button>
                                            @if ($p->pesertakelas_is_used == false)

                                            @endif
                                        </div> --}}
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                @else
                    <div>
                        <h1>Belum ada peserta di kelas ini</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
