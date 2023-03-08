<div>

    <x-spinner />
    {{-- Search Bar --}}

    {{-- <div wire:loading>Loading...</div> --}}
    <div class="items-center w-full md:flex">
        <div class="w-3/4 mx-5 ">
            <div class="items-center md:flex">


                {{-- Search --}}
                <div class="w-full mt-3 mr-3 md:w-2/5">
                    <input type="search" class="w-full px-4 py-1 text-purple-700 border border-purple-700 rounded "
                        wire:model="search" placeholder="{{ __('Search...') }}">
                </div>
                {{-- Category --}}
                <div class="w-full mt-3 mr-3 md:w-1/5">
                    <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                        wire:model="category">
                        <option value="data_pelitas.nama_umat" selected>{{ __('Nama') }}</option>
                        <option value="data_pelitas.nama_alias">{{ __('Alias') }}</option>
                        <option value="data_pelitas.mandarin">{{ __('中文') }}</option>
                        <option value="data_pelitas.pengajak">{{ __('Pengajak') }}</option>
                        <option value="data_pelitas.penjamin">{{ __('Penjamin') }}</option>
                        <option value="panditas.nama_pandita">{{ __('Pandita') }}</option>
                        <option value="kotas.nama_kota">{{ __('Kota') }}</option>

                    </select>
                </div>
                {{-- Rows per Page --}}
                <div class="w-full mt-3 mr-3 md:w-1/5">
                    <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                        wire:model="perpage">
                        <option value="5">{{ __('5 Rows') }}</option>
                        <option value="10">{{ __('10 Rows') }}</option>
                        <option value="15">{{ __('15 Rows') }}</option>
                        <option value="20">{{ __('20 Rows') }}</option>
                        <option value="25">{{ __('25 Rows') }}</option>
                    </select>
                </div>
                {{-- Filter Dropdown --}}
                <div x-data="{ open: false }" class="w-full mt-3 mr-3 md:w-1/5">
                    <button @click="open = !open" :class="open ? 'bg-purple-500 ' : ''"
                        class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded hover:bg-purple-700 hover:text-white"><i
                            class="fa fa-filter"></i>
                        {{ __('Filter Search') }}</button>


                    {{-- isi dari dropdown --}}

                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="min-h-120px mx-auto absolute z-10 px-3 pb-3 rounded-xl w-400px text-purple-700 bg-white  shadow-xl backdrop-blur-sm border border-[#ffffff/.3] ">
                        {{-- class="absolute z-10 px-3 pb-3 mx-auto text-purple-700 min-h-120px rounded-xl w-400px glass "> --}}


                        {{-- <div class="card card-body glass" style="width: 400px; color: purple;"> --}}
                            @if (Auth::user()->role == '3')
                            <div class="mt-3">
                                <label class="p-1 px-3 rounded bg-purple">{{ __('Group') }}</label>
                                <select wire:model="group_id" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" selected>{{ __('All') }}</option>
                                    @foreach ($group as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama_group }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="mt-3">
                                <label class="p-1 px-3 rounded bg-purple">{{ __('Vihara') }} </label>
                                <select wire:model="kode_branch"
                                    class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($all_branch as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama_branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="p-1 px-3 rounded bg-purple">{{ __('Gender') }}</label>
                                <select wire:model="jen_kel" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="0">{{ __('All') }}</option>
                                    {{-- <option value="Laki-laki">{{ __('Laki-laki') }}</option>
                                    <option value="Perempuan">{{ __('Perempuan') }}</option> --}}
                                    <option value="1">{{ __('Laki-laki') }}</option>
                                    <option value="2">{{ __('Perempuan') }}</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="p-1 px-3 rounded bg-purple">{{ __('Status') }} </label>
                                <select wire:model="status" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="Active">{{ __('Active Only') }}</option>
                                    <option value="Inactive">{{ __('Inactive Only') }}</option>
                                </select>
                            </div>

                            <div class="mt-3">
                                <label class="text-center bg-purple">{{ __('Umur') }}</label>
                                <div class="flex" style="display: flex">
                                    <div>
                                        <input type="text" class="w-full px-2 py-1 border border-gray-400 rounded"
                                            wire:model="startUmur">
                                    </div>
                                    <p class="px-1">-</p>
                                    <div>
                                        <input type="text" class="w-full px-2 py-1 border border-gray-400 rounded"
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
                                    <span class="ml-2">{{ __('Sidang Dharma 3 Hari') }}</span>
                                </label>
                            </div>
                            <div class="mt-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="tgl_vtotal" />
                                    <span class="ml-2">{{ __('Vegetarian Total') }}</span>
                                </label>
                            </div>


                            {{-- Jika Role adalah Manager --}}
                            {{-- @if (Auth::user()->role == '3') --}}

                            <div class="my-3">
                                <label class="text-center bg-purple">{{ __('Tanggal Mohon Tao') }}: </label>
                                <div class="flex" style="display: flex">
                                    <div>
                                        <input type="date" class="w-full px-2 py-1 border border-gray-400 rounded"
                                            wire:model="startDate">
                                    </div>
                                    <div>
                                        <p class="px-1">-</p>
                                    </div>
                                    <div>
                                        <input type="date" class="w-full px-2 py-1 border border-gray-400 rounded"
                                            wire:model="endDate">
                                    </div>
                                </div>
                            </div>


                            {{--
                        </div> --}}

                    </div>
                    {{-- end isi dropdown --}}
                </div>


            </div>
        </div>

        {{-- nama cetya --}}
        <div class="w-1/2 mx-5 mt-3 ">
            {{-- kode_branch --}}
            {{-- <h1 class="text-3xl font-bold text-center text-purple-700">{{ $nama_cetya }} </h1> --}}
            <h1 class="text-3xl font-bold text-center text-purple-700">{{ getGroupVihara($group_id) }} </h1>
        </div>

        {{-- End Search Bar --}}


    </div>
    {{-- export Excel $ PDF --}}
    @if ($selectedId != null)
    <div class="flex items-center w-full gap-2 px-5 mt-3 md:w-1/2">
        <x-button wire:click="excel" wire:loading.attr="disabled" class="button button-teal">Excel</x-button>
        <x-button wire:click="pdfdom" wire:loading.attr="disabled" class="button button-red">PDF</x-button>
        <button wire:click="cetak" wire:loading.attr="disabled" class="button button-blue">{{ __('Cetak')
            }}</button>
        <p class="text-lg font-semibold text-purple-500">{{ count($selectedId)}} Data Selected</p>
    </div>
    @endif
    {{-- Table --}}
    <div class="p-4 ">
        <div class="rounded-lg shadow bg-gray-50">


            <table class="w-full">
                <thead class="text-white bg-purple-500 border-b-2 border-gray-200">
                    <tr>
                        {{-- <th class="p-3 font-semibold text-left">{{ __('#') }}</th> --}}
                        <th class="px-2 text-center border rounded"><input type="checkbox" wire:model="selectAll"
                                class=" checked:bg-white-500" />
                        </th>

                        {{-- <th class="p-3 font-semibold text-center border rounded cursor-pointer" "></th> --}}
                                    <th class="p-3 font-semibold text-center border rounded " ">{{ __('#') }}</th>
                        {{-- <th class="p-3 font-semibold text-center border rounded cursor-pointer" ">{{ __('id') }}</th> --}}
                                    <th class="p-3 font-semibold text-left border rounded cursor-pointer " wire:click=" sortColumnName('nama_umat')">{{ __('NAMA') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer "
                            wire:click=" sortColumnName('nama_alias')">{{ __('ALIAS') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('mandarin')">{{ __('中文名') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('umur_sekarang') ">{{ __('UMUR') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('tgl_mohonTao')">{{ __('TGL CHIU TAO') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('gender')">{{ __('GENDER') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('pengajak')">{{ __('PENGAJAK') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('penjamin')">{{ __('PENJAMIN') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('nama_pandita')">{{ __('PANDITA') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('nama_kota')">{{ __('KOTA') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('nama_branch')">{{ __('CETYA') }}</th>
                        <th class="p-3 font-semibold text-left border rounded cursor-pointer"
                            wire:click="sortColumnName('nama_group')">{{ __('GROUP') }}</th>

                        <th class="p-3 font-semibold ">
                            <div class="flex justify-center space-x-1">

                                <div>
                                    <a href="/adddata">
                                        <x-button type="button" class="p-1 text-white bg-blue-500 rounded ">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </x-button>
                                    </a>

                                </div>

                                {{-- Reset --}}
                                <div>

                                    <button type="button" class="p-1 text-white bg-green-500 rounded "
                                        wire:click="resetFilter">
                                        <i class="fa fa-arrow-rotate-right"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datapelita1 as $index => $d)
                    <tr class="h-3">
                        <td class="text-center border rounded ">
                            <input type="checkbox" wire:model="selectedId" value="{{ $d->id }}"
                                class="checked:bg-purple-500" />
                        </td>

                        <td class="p-3 text-gray-800 border rounded">
                            {{ $datapelita1->firstItem() + $index }}
                        </td>
                        {{-- <td class="p-3 text-center text-gray-800 border rounded">
                            {{ $d->id }}
                        </td> --}}
                        @if ($d->tgl_sd3h != '' && $d->tgl_vtotal == '')
                        <td class="p-3 font-semibold text-purple-500 border rounded">
                            {{ $d->nama_umat }}
                        </td>
                        <td class="p-3 font-semibold text-purple-500 border rounded">
                            {{ $d->nama_alias }}
                        </td>
                        <td class="p-3 font-semibold text-purple-500 border rounded">
                            {{ $d->mandarin }}
                        </td>

                        @elseif($d->tgl_sd3h != '' && $d->tgl_vtotal != '')
                        <td class="p-3 font-semibold text-teal-500 border rounded">
                            {{ $d->nama_umat }}
                        </td>
                        <td class="p-3 font-semibold text-teal-500 border rounded">
                            {{ $d->nama_alias }}
                        </td>
                        <td class="p-3 font-semibold text-teal-500 border rounded">
                            {{ $d->mandarin }}
                        </td>
                        @else
                        <td class="p-3 text-gray-800 border rounded">
                            {{ $d->nama_umat }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">
                            {{ $d->nama_alias }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">
                            {{ $d->mandarin }}
                        </td>
                        @endif
                        <td class="p-3 text-center text-gray-800 border rounded">
                            {{ $d->umur_sekarang }}
                        </td>

                        <td class="p-3 text-gray-800 border rounded">
                            {{ \Carbon\Carbon::parse($d->tgl_mohonTao)->format('d M Y')}}</td>
                        <td
                            class="p-3    border rounded {{ $d->gender == '1' ? 'text-blue-500 text-lg' : 'text-pink-500 text-lg' }} text-center">
                            {{ check_JK($d->gender, $d->umur_sekarang) }}
                        </td>
                        {{-- <td class="p-3 text-gray-800 border rounded">{{ $d->pengajak_id }} --}}
                        <td class="p-3 text-gray-800 border rounded">
                            {{ $d->pengajak }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">{{ $d->penjamin }}</td>

                        <td class="p-3 text-gray-800 border rounded">
                            {{ $d->nama_pandita }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">{{ $d->nama_kota }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">{{ $d->nama_branch }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">{{ $d->nama_group }}
                        </td>

                        <td class="p-3 text-gray-800 border rounded ">

                            <div class="flex justify-center space-x-1">

                                <div>
                                    <a href="/viewdata/{{ $d->id }}">
                                        <x-button type="button" class="p-1 text-black bg-green-400 rounded">
                                            <i class="fa fa-eye "></i>
                                        </x-button>
                                    </a>

                                </div>

                                {{-- <div> --}}
                                    <div>
                                        <a href="/editdata/{{ $d->id }}">
                                            <x-button type="button" class="p-1 text-black bg-yellow-300 rounded">
                                                <i class="fa fa-pen-to-square "></i>
                                            </x-button>
                                        </a>

                                    </div>
                                    @if (Auth::user()->role != '1')
                                    <div>

                                        <x-button class="p-1 text-white bg-red-500 rounded"
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

            <div class="p-3">
                {{ $datapelita1->links() }}

            </div>
        </div>
    </div>
    {{-- End Table --}}

    {{-- JS utk Sweetalert Delete --}}
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
            window.addEventListener('resetfield', function(e) {
                  Swal.fire({
                        position: 'top-end'
                        , icon: 'success'
                        , title: 'Filter Sudah di Reset'
                        , showConfirmButton: false
                        , timer: 1500
                  })
            });

    </script>
    @endpush
</div>