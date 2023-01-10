<div>

    <div class="w-full md:flex items-center">
        <div class="mx-5 my-3 w-1/2">
            <div class="md:flex items-center">
                <div class="w-full my-2 md:w-1/4 mr-3">
                    <input type="text" class="w-full  border border-gray-400 py-1 px-4 rounded"
                        placeholder="{{ __('Search') }}">

                </div>
                <div class="w-full my-2  md:w-1/4 mr-3">

                    <select class="w-full border border-gray-400 py-1 px-2 rounded">
                        <option value="data_pelitas.nama_umat" selected>{{ __('Nama') }}</option>
                        <option value="data_pelitas.pengajak">{{ __('Pengajak') }}</option>
                        <option value="data_pelitas.penjamin">{{ __('Penjamin') }}</option>
                        <option value="panditas.nama_pandita">{{ __('Pandita') }}</option>
                        <option value="kotas.nama_kota">{{ __('Kota') }}</option>
                    </select>
                </div>
                <div class="w-full my-2 md:w-1/4 mr-3">

                    <select class="w-full border border-gray-400 py-1 px-2 rounded">
                        <option value="5">5 {{ __('Rows Per Page') }}</option>
                        <option value="10">10 {{ __('Rows Per Page') }}</option>
                        <option value="15">15 {{ __('Rows Per Page') }}</option>
                        <option value="20">20 {{ __('Rows Per Page') }}</option>
                        <option value="25">25 {{ __('Rows Per Page') }}</option>
                    </select>
                </div>
                <div x-data="{ open: false }" class="w-full my-2 md:w-1/4 mr-3">

                    <button @click="open = !open" :class="open ? 'bg-purple-500 text-white' : ''"
                        class=" w-full border border-gray-400 py-1 px-2 rounded"><i class="fa fa-filter"></i>
                        {{ __('Filter Search') }}</button>


                    {{-- isi dari dropdown --}}
                    <div x-show="open" @click.away="open = false" x-transition
                        class="min-h-120px mx-auto absolute z-10 px-3 pb-3 rounded-xl w-400px text-purple-700 glass ">


                        {{-- <div class="card card-body glass" style="width: 400px; color: purple;"> --}}
                        @if (Auth::user()->role == '3')
                            <div class="mt-3">
                                <label class="bg-purple p-1 px-3 rounded">{{ __('Branch') }} </label>
                                <select wire:model="kode_branch" class="form-control">
                                    <option value="" selected>{{ __('All') }}</option>
                                    @foreach ($all_branch as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        {{-- <div class="mt-3"> --}} <label class="bg-purple p-1 px-3 rounded">{{ __('Gender') }}</label>
                        <select wire:model="jen_kel" class="w-full border border-gray-400 py-1 px-2 rounded">
                            <option value="0">{{ __('All') }}</option>
                            <option value="1">{{ __('Laki-laki') }}</option>
                            <option value="2">{{ __('Perempuan') }}</option>
                        </select>
                        {{-- </div> --}}
                        <div class="mt-3">
                            <label class="bg-purple p-1 px-3 rounded">{{ __('Status') }} </label>
                            <select wire:model="active" class="w-full border border-gray-400 py-1 px-2 rounded">
                                <option value="">{{ __('All') }}</option>
                                <option value="Active">{{ __('Active Only') }}</option>
                                <option value="Inactive">{{ __('Inactive Only') }}</option>
                            </select>
                        </div>

                        <label class="text-center bg-purple">{{ __('Umur') }}</label>
                        <div class="flex" style="display: flex">
                            <div class="mt-3">
                                <input type="text" class="w-full border border-gray-400 py-1 px-2 rounded"
                                    wire:model="startUmur">
                            </div>
                            <div class="mt-3">
                                <input type="text" class="w-full border border-gray-400 py-1 px-2 rounded"
                                    wire:model="endUmur">
                            </div>
                        </div>


                        {{-- Jika Role adalah Manager --}}
                        {{-- @if (Auth::user()->role == '3') --}}

                        <label class="text-center bg-purple">{{ __('Tanggal Mohon Tao') }}: </label>
                        <div class="flex" style="display: flex">
                            <div class="mt-3">
                                <input type="date" class="w-full border border-gray-400 py-1 px-2 rounded"
                                    wire:model="startDate">
                            </div>

                            <div class="mt-3">
                                {{-- <label >-</label> --}}
                                <input type="date" class="w-full border border-gray-400 py-1 px-2 rounded"
                                    wire:model="endDate">
                            </div>
                        </div>


                        {{-- </div> --}}

                    </div>

                    {{-- end isi dropdown --}}
                </div>
            </div>
        </div>
        <div class="mx-5 my-3 w-1/2">
            <h1 class="text-3xl text-center text-purple-700 font-bold">NAMA CETYA</h1>
        </div>

    </div>


    <div class="p-4 ">
        <div class="overflow-auto rounded-lg shadow bg-gray-50">
            <table class="w-full ">
                <thead class="bg-purple-400 text-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('#') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('NAMA') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('中文名') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('UMUR') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('TGL CHIU TAO') }}/th>

                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('GENDER') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('PENGAJAK') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('PENJAMIN') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('PANDITA') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">{{ __('KOTA') }}</th>
                        <th class="p-3 text-sm font-semibold tracking-wide flex space-x-1 ">
                            @if ($kode_branch != '')
                                <a href="/adddata/{{ $kode_branch }}"><button type="button"
                                        class="p-1 rounded bg-blue-500 text-white ">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button></a>
                            @endif

                            {{-- Reset --}}
                            <button type="button" class="p-1 rounded bg-green-500 text-white "
                                wire:click="resetFilter">
                                <i class="fa fa-arrow-rotate-right"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($datapelita as $index => $d)
                        <tr class="h-3">
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                                {{ $datapelita->firstItem() + $index }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->nama_umat }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->mandarin }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-center">
                                {{ $d->umur_sekarang }}
                            </td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->tgl_mohonTao }}</td>
                            <td
                                class="p-3 text-sm text-gray-800 whitespace-nowrap {{ $d->gender == '1' ? 'text-blue-500' : 'text-pink-500' }} text-center">
                                {{ check_JK($d->gender, $d->umur_sekarang) }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->pengajak }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->penjamin }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->nama_pandita }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap">{{ $d->nama_kota }}</td>
                            <td class="p-3 text-sm text-gray-800 whitespace-nowrap justify-center">
                                <button class="p-1 rounded bg-green-500 text-white" data-toggle="modal"
                                    data-target="#ViewModal" wire:click="edit({{ $d->id }})">
                                    <i class="fa fa-eye "></i>
                                </button>

                                <a href="/editdata/{{ $d->id }}"><button type="button"
                                        class="p-1 rounded bg-yellow-500 text-black">
                                        <i class="fa fa-pen-to-square "></i>
                                    </button></a>

                                @if (Auth::user()->role != '1')
                                    <button class="p-1 rounded bg-red-500 text-white"
                                        wire:click="deleteConfirmation({{ $d->id }})">
                                        <i class="fa fa-trash "></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3">
                {{ $datapelita->links() }}

            </div>


        </div>
    </div>
    <style>
        .glass {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.62);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</div>
