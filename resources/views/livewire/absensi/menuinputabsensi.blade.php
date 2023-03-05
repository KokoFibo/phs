@if ($menuInputAbsensi)


<div class="w-2/3 p-3 mx-auto items-top justify-evenly">
      <div class="">
            <div class="w-full p-4 mt-3 mr-3 text-xl font-semibold text-center text-white bg-teal-500 border shadow-xl rounded-xl">{{ __('Input Absensi Kelas') }}</div>
            <div class="flex w-full gap-3 mt-3 ">
                  <div class="w-1/3 p-4 text-white bg-teal-500 border shadow-xl rounded-xl">

                        <div class="mt-3 ">
                              <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                              <input id="kelas" type="text" value="{{ getDaftarKelas($daftarkelas_id) }}" disabled class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        <div class="mt-3 ">
                              <label class="px-2" for="tanggal">{{ __('Tanggal Kelas') }}</label>
                              <input id="tanggal" type="date" wire:model="tgl_kelas" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div class="flex justify-between">
                              <button wire:click="createAbsensi({{ $daftarkelas_id }})" class="mt-3 button button-purple"><i class="fa-regular fa-eye"></i> Tampilkan Data peserta</button>
                              <button wire:click="closeMenuTambahDataPeserta" class="mt-3 button button-yellow">Save & Close</button>
                        </div>
                  </div>


                  {{-- <div class="w-full mt-3 "> --}}

                  {{-- table --}}
                  <div class="w-2/3 ">
                        @if ($absensi->count())
                        <table class="w-full table-auto">
                              <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                                    <tr>
                                          <th class="p-3 font-semibold text-center">#</th>
                                          <th class="p-3 font-semibold text-center">{{ __('Nama Peserta') }}</th>
                                          <th class="p-3 font-semibold text-center">{{ __('Group') }}</th>
                                          <th class="p-3 font-semibold text-center">{{ __('Kelas') }}</th>
                                          <th class="p-3 font-semibold text-center">{{ __('Tanggal') }}</th>
                                          <th class="p-3 font-semibold text-center">{{ __('Absensi') }}</th>
                                          {{-- <th class="p-3 font-semibold text-center">{{ __('Hadir/Absen') }}</th> --}}
                                          <th class="p-3 font-semibold text-center">

                                          </th>
                                    </tr>
                              </thead>
                              @foreach ($absensi as $p)
                              <tbody>
                                    <tr>
                                          <td class="p-3 text-gray-800 border rounded">
                                                {{ $loop->iteration }}</td>
                                          <td class="p-3 text-gray-800 border rounded">{{ getName($p->datapelita_id) }}</td>
                                          <td class="p-3 text-gray-800 border rounded">{{ getGroupVihara($selectedGroup) }}</td>

                                          <td class="p-3 text-gray-800 border rounded">{{ getDaftarKelas($p->daftarkelas_id) }}</td>
                                          <td class="p-3 text-gray-800 border rounded">{{ $p->tgl_kelas }}</td>
                                          <td class="p-3 text-center text-gray-800 border rounded">@if ($p->absensi == '1')
                                                <i class="text-blue-500 fa-solid fa-user-check"></i>
                                                @elseif ($p->absensi == '2')
                                                <i class="text-red-500 fa-solid fa-user-xmark"></i>

                                                @else
                                                -

                                                @endif</td>

                                          <td class="p-3 text-gray-800 border rounded">
                                                <div class="flex justify-center space-x-1">
                                                      <button type="button" wire:click="hadir({{ $p->id }},1)" class="p-1 text-white bg-blue-500 rounded">
                                                            <i class="text-white fa-solid fa-user-check"></i>
                                                      </button>
                                                      <button wire:click="hadir({{ $p->id }},2)" class="p-1 text-white bg-red-500 rounded">
                                                            <i class="text-white fa-solid fa-user-xmark"></i>
                                                      </button>
                                                </div>
                                          </td>
                                    </tr>
                              </tbody>
                              @endforeach
                        </table>

                        @else
                        <div>
                              <h1>Belum ada Absensi dan peserta ditanggal dan kelas ini </h1>
                        </div>
                        @endif
                  </div>

                  {{-- </div> --}}

            </div>

      </div>
      @endif