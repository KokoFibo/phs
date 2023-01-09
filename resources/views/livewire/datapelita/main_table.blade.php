<style>
    .fsth {
        font-size: 11px;
        cursor: pointer;
        height: 10px;
    }

    .fsth.w {
        width: 90px;
    }

    .fstd {
        font-size: 14px;
    }
</style>
<table class="table table-bordered table-sm ">
    <thead class="bg-purple">
        <tr>
            <th class="fsth">#</th>
            <th class="fsth" wire:click="sortColumnName('nama_umat')">{{ __('NAMA') }}
                {{-- <span wire:click="sortColumnName('nama_umat')" class="float-right text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span> --}}

            </th>
            <th class="fsth" wire:click="sortColumnName('mandarin')">{{ __('中文名') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('umur_sekarang')">{{ __('UMUR') }}

            </th>
            <th class="fsth w" wire:click="sortColumnName('tgl_mohonTao')">{{ __('TGL CHIU TAO') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('gender')">{{ __('GENDER') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('pengajak')">{{ __('PENGAJAK') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('penjamin')">{{ __('PENJAMIN') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('nama_pandita')">{{ __('PANDITA') }}

            </th>
            <th class="fsth" wire:click="sortColumnName('nama_kota')">{{ __('KOTA') }}

            </th>
            {{-- <th class="fsth">
                branch_id
            </th> --}}
            <th class="text-center">
                {{-- Add Data --}}
                {{-- <button type="button" class="btn  btn-primary" data-toggle="modal"
                      data-target="#AddModal" wire:click="clearSession">
                      <i class="fa-solid fa-user-plus"></i>
                  </button> --}}

                {{-- <a href="/langsung/{{ $kode_branch }}"><button type="button" class="btn  btn-primary"> --}}
                @if ($kode_branch != '')
                    <a href="/adddata/{{ $kode_branch }}"><button type="button" class="btn  btn-primary btn-sm">
                            <i class="fa-solid fa-user-plus"></i>
                        </button></a>
                @endif


                {{-- Reset --}}
                <button type="button" class="btn  btn-success btn-sm" wire:click="resetFilter">
                    <i class="fa fa-arrow-rotate-right"></i>
                </button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datapelita as $index => $data)
            <tr class="{{ $data->status == 'Inactive' ? 'bg-secondary text-white' : '' }}">
                <td class="fstd">{{ $datapelita->firstItem() + $index }}</td>
                {{-- <td class="fstd">{{ $data->id }}</td> --}}
                <td class="fstd">{{ $data->nama_umat }}</td>
                <td class="fstd">{{ $data->mandarin }}</td>
                <td class="fstd text-center">{{ $data->umur_sekarang }}</td>
                <td class="fstd text-center">{{ $data->tgl_mohonTao }}</td>
                {{-- <td class="fstd">{{ $data->jenis_kelamin }}</td> --}}
                <td class="fstd text-center {{ $data->gender == '1' ? 'text-primary' : 'text-pink' }}"">
                    {{ check_JK($data->gender, $data->umur_sekarang) }}
                </td>
                <td class="fstd">{{ $data->pengajak }}</td>
                <td class="fstd">{{ $data->penjamin }}</td>
                {{-- <td class="fstd">{{ $data->pandita }}</td> --}}
                <td class="fstd">{{ $data->nama_pandita }}</td>
                {{-- <td class="fstd">{{ $data->kota }}</td> --}}
                <td class="fstd">{{ $data->nama_kota }}</td>
                {{-- <td class="fstd">{{ $data->branch_id }}</td> --}}
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn-success btn btn-sm" data-toggle="modal" data-target="#ViewModal"
                            wire:click="edit({{ $data->id }})">
                            <i class="fa fa-eye "></i>
                        </button>


                        <a href="/editdata/{{ $data->id }}"><button type="button" class="btn-warning btn btn-sm">
                                <i class="fa fa-pen-to-square "></i>
                            </button></a>

                        @if (Auth::user()->role != '1')
                            {{-- <button class="btn-danger btn btn-sm" data-toggle="modal" data-target="#DeleteModal"
                                wire:click="deleteConfirmation({{ $data->id }})">
                                <i class="fa fa-trash "></i>
                            </button> --}}
                            <button class="btn-danger btn btn-sm" wire:click="deleteConfirmation({{ $data->id }})">
                                <i class="fa fa-trash "></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
