<div class="w-2/3 mt-3">
      @if (!empty($absensi))
      <table class="w-full table-auto">
            <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                  <tr>
                        <th class="p-3 font-semibold text-center">#</th>
                        <th class="p-3 font-semibold text-center">{{ __('Cetya') }}</th>
                        <th class="p-3 font-semibold text-center">{{ __('Kelas') }}</th>
                        <th class="p-3 font-semibold text-center">{{ __('Tanggal') }}</th>
                        <th class="p-3 font-semibold text-center">{{ __('Jumlah Peserta') }}</th>
                        <th class="p-3 font-semibold text-center"></th>
                  </tr>
            </thead>
            <tbody>
                  @foreach ($absensi as $index => $p)
                  <tr>
                        <td class="p-3 text-gray-800 border rounded">
                              {{ $absensi->firstItem() + $index }}</td>
                        {{-- <td class="p-3 text-gray-800 border rounded">{{ $p->nama_kelas }}</td> --}}

                        <td class="p-3 text-gray-800 border rounded">
                              {{ getDaftarKelasCetya($p->daftarkelas_id) }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">
                              {{ getDaftarKelas($p->daftarkelas_id) }}
                        </td>
                        <td class="p-3 text-gray-800 border rounded">{{ $p->tgl_kelas }}</td>
                        <td class="p-3 text-gray-800 border rounded">{{ $p->jumlah_peserta }}
                        </td>

                        <td class="p-3 text-center text-gray-800 border rounded">
                              <div class="flex justify-center space-x-1">



                                    <button class="button-red button " wire:click="deleteConfirmation({{ $p->id }})"><i class="fa fa-trash "></i></button>
                                    <button class="button button-teal" wire:click="edit({{ $p->id }})"><i class="fa fa-pen-to-square"></i></button>

                              </div>
                        </td>
                  </tr>
                  @endforeach
            </tbody>
      </table>
      <div class="mt-3">
            {{ $absensi->links() }}
      </div>
      @else
      <div>
            <h1>No Data Found!</h1>
      </div>
      @endif
</div>
