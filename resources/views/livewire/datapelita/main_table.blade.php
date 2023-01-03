<table class="table table-bordered table-sm ">
    <thead class="bg-purple">
        <tr>
            <th>#</th>
            <th>{{ __('NAMA') }}
                <span wire:click="sortColumnName('nama_umat')" class="float-right text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>

            </th>
            <th>{{ __('中文名') }}
                <span wire:click="sortColumnName('mandarin')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('UMUR') }}
                <span wire:click="sortColumnName('umur_sekarang')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('TGL CHIU TAO') }}
                <span wire:click="sortColumnName('tgl_mohonTao')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('GENDER') }}
                <span wire:click="sortColumnName('gender')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('PENGAJAK') }}
                <span wire:click="sortColumnName('pengajak')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('PENJAMIN') }}
                <span wire:click="sortColumnName('penjamin')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('PANDITA') }}
                <span wire:click="sortColumnName('nama_pandita')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>{{ __('KOTA') }}
                <span wire:click="sortColumnName('nama_kota')" class=" text-sm" style="cursor: pointer"><i
                        class="fa fa-arrow-up {{ $direction === 'asc' ? '' : 'text-muted' }} "></i>
                    <i class="fa fa-arrow-down {{ $direction === 'desc' ? '' : 'text-muted' }}"></i>
                </span>
            </th>
            <th>
                branch_id
            </th>
            <th class="text-center">
                {{-- Add Data --}}
                {{-- <button type="button" class="btn  btn-primary" data-toggle="modal"
                      data-target="#AddModal" wire:click="clearSession">
                      <i class="fa-solid fa-user-plus"></i>
                  </button> --}}
                <a href="/adddata"><button type="button" class="btn  btn-primary">
                        <i class="fa-solid fa-user-plus"></i>
                    </button></a>


                {{-- Reset --}}
                <button type="button" class="btn  btn-success" wire:click="resetFilter">
                    <i class="fa fa-arrow-rotate-right"></i>
                </button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datapelita as $index => $data)
            <tr class="{{ $data->status == 'Inactive' ? 'bg-secondary text-white' : '' }}">
                <td>{{ $datapelita->firstItem() + $index }}</td>
                {{-- <td>{{ $data->id }}</td> --}}
                <td>{{ $data->nama_umat }}</td>
                <td>{{ $data->mandarin }}</td>
                <td class="text-center">{{ $data->umur_sekarang }}</td>
                <td class="text-center">{{ $data->tgl_mohonTao }}</td>
                {{-- <td>{{ $data->jenis_kelamin }}</td> --}}
                <td class="text-center {{ $data->gender == '1' ? 'text-primary' : 'text-pink' }}"">
                    {{ check_JK($data->gender, $data->umur_sekarang) }}
                </td>
                <td>{{ $data->pengajak }}</td>
                <td>{{ $data->penjamin }}</td>
                {{-- <td>{{ $data->pandita }}</td> --}}
                <td>{{ $data->nama_pandita }}</td>
                {{-- <td>{{ $data->kota }}</td> --}}
                <td>{{ $data->nama_kota }}</td>
                <td>{{ $data->branch_id }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn-success btn btn-sm" data-toggle="modal" data-target="#ViewModal"
                            wire:click="edit({{ $data->id }})">
                            <i class="fa fa-eye "></i>
                        </button>
                        {{-- <button class="btn-warning btn btn-sm" data-toggle="modal" data-target="#EditModal"
                            wire:click="edit({{ $data->id }})">
                            <i class="fa fa-pen-to-square "></i>
                        </button> --}}

                        <a href="/editdata/{{ $data->id }}"><button type="button" class="btn-warning btn btn-sm">
                                <i class="fa fa-pen-to-square "></i>
                            </button></a>

                        @if (Auth::user()->role != '1')
                            <button class="btn-danger btn btn-sm" data-toggle="modal" data-target="#DeleteModal"
                                wire:click="deleteConfirmation({{ $data->id }})">
                                <i class="fa fa-trash "></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
