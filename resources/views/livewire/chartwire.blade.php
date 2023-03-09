<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center ">
                        <input type="checkbox" wire:model="selectAll" class=" class=" w-4 h-4 text-blue-600 bg-gray-100
                            border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600
                            dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                            dark:border-gray-600" />
                    </div>
                </th>

                <th scope="col" class="p-4">{{ __('#') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="
                    sortColumnName('nama_umat')">{{ __('NAMA') }}</th>
                <th scope="col" class="px-6 py-3" wire:click=" sortColumnName('nama_alias')">{{
                    __('ALIAS') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('mandarin')">{{
                    __('中文名') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('umur_sekarang') ">{{
                    __('UMUR') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('tgl_mohonTao')">{{
                    __('TGL CHIU TAO') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('gender')">{{
                    __('GENDER') }}</th>
                <th scope="col" class="px-3 py-3" wire:click="sortColumnName('pengajak')">{{
                    __('PENGAJAK') }}</th>
                <th scope="col" class="px-3 py-3" wire:click="sortColumnName('penjamin')">{{
                    __('PENJAMIN') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('nama_pandita')">{{
                    __('PANDITA') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('nama_kota')">{{
                    __('KOTA') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('nama_branch')">{{
                    __('CETYA') }}</th>
                <th scope="col" class="px-6 py-3" wire:click="sortColumnName('nama_group')">{{
                    __('GROUP') }}</th>

                <th scope="col" class="px-6 py-3" ustify-center space-x-1">

                    <div>
                        <a href="/adddata">
                            <x-button type="button" class="p-1 text-white bg-blue-500 rounded ">
                                <i class="fa-solid fa-user-plus"></i>
                            </x-button>
                        </a>

                    </div>

                    {{-- Reset --}}
                    <div>

                        <button type="button" class="p-1 text-white bg-green-500 rounded " wire:click="resetFilter">
                            <i class="fa fa-arrow-rotate-right"></i>
                        </button>
                    </div>
</div>
</th>
</tr>
</thead>
<tbody>
    @foreach ($datapelita as $index=> $d)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">
            <input type="checkbox" wire:model="selectedId" value="{{ $d->id }}" class="checked:bg-purple-500" />
        </td>

        <td class="w-4 p-4">
            {{ $datapelita->firstItem() + $index }}
        </td>
        {{-- <td class="p-3 text-center text-gray-800 border rounded">
            {{ $d->id }}
        </td> --}}
        @if ($d->tgl_sd3h != '' && $d->tgl_vtotal == '')
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $d->nama_umat }}
        </th>
        <td class="px-6 py-4" border rounded">
            {{ $d->nama_alias }}
        </td>
        <td class="px-6 py-4" border rounded">
            {{ $d->mandarin }}
        </td>
        @elseif($d->tgl_sd3h != '' && $d->tgl_vtotal != '')
        <td class="px-6 py-4" order rounded">
            {{ $d->nama_umat }}
        </td>
        <td class="px-6 py-4" order rounded">
            {{ $d->nama_alias }}
        </td>
        <td class="px-6 py-4" order rounded">
            {{ $d->mandarin }}
        </td>
        @else
        <td class="px-6 py-4">
            {{ $d->nama_umat }}
        </td>
        <td class="px-6 py-4">
            {{ $d->nama_alias }}
        </td>
        <td class="px-6 py-4">
            {{ $d->mandarin }}
        </td>
        @endif
        <td class="px-6 py-4" der rounded">
            {{ $d->umur_sekarang }}
        </td>

        <td class="px-6 py-4">
            {{ \Carbon\Carbon::parse($d->tgl_mohonTao)->format('d M Y') }}</td>
        <td class="px-6 py-4" {{ $d->gender == '1' ? 'text-blue-500 text-lg' : 'text-pink-500 text-lg' }} text-center">
            {{ check_JK($d->gender, $d->umur_sekarang) }}
        </td>
        {{-- <td class="px-6 py-4">{{ $d->pengajak_id }} --}}
        <td class="px-3 py-4">
            {{ $d->pengajak }}
        </td>
        <td class="px-3 py-4">{{ $d->penjamin }}</td>

        <td class="px-6 py-4">
            {{ $d->nama_pandita }}
        </td>
        <td class="px-6 py-4">{{ $d->nama_kota }}
        </td>
        <td class="px-6 py-4">{{ $d->nama_branch }}
        </td>
        <td class="px-6 py-4">{{ $d->nama_group }}
        </td>

        <td class="flex items-center px-6 py-4 space-x-3">

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
    {{ $datapelita->links() }}

</div>
</div>