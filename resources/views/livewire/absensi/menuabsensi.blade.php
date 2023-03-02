@if ($menuAbsensi)


<div class="w-2/3 p-3 mx-auto items-top justify-evenly">
      <div class="">
            <div class="w-full p-4 mt-3 mr-3 text-xl font-semibold text-center text-white bg-teal-500 border shadow-xl rounded-xl">{{ __('Absensi Kelas') }}</div>
            <div class="flex w-full gap-3 mt-3 ">
                  <div class="w-1/3 p-4 text-white bg-teal-500 border shadow-xl rounded-xl">

                        <div class="mt-3 ">
                              <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                              <input id="kelas" type="text" value="{{ getDaftarKelas($daftarkelas_id) }}" disabled class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        <div class="relative mt-3" x-data="{ peserta: false }">
                              <label class="px-2 " for="peserta">{{ __('Peserta') }}</label>
                              <input @click="peserta=true" autocomplete="off" id="peserta" type="text" placeholder="Nama Peserta" class="w-full text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" wire:model="peserta">
                              <div x-show="peserta" @click.away="peserta = false" x-transition class="absolute z-10 overflow-auto h-44">
                                    <input id="peserta" type="text" placeholder="Cari peserta" wire:model="query" class="w-full text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    <ul class="bg-white ">
                                          @if (!empty($nama))
                                          @foreach ($nama as $n)
                                          <li class="px-4 py-1 text-purple-500 border ">
                                                <button class="hover:bg-gray-300" wire:click="getDataPeserta( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )" @click="peserta=false">{{ $n['nama_umat'] }}</button>
                                          </li>
                                          @endforeach
                                          @endif
                                    </ul>
                              </div>
                              @error('datapelita_id')
                              <span class="text-red-500">{{ $message }}</span>
                              @enderror
                              <div class="flex justify-between">
                                    <button wire:click="storePeserta" class="mt-3 button button-purple">Tambahkan</button>
                                    <button wire:click="closeMenuTambahDataPeserta" class="mt-3 button button-yellow">close</button>
                              </div>
                        </div>
                  </div>


                  {{-- <div class="w-full mt-3 "> --}}

                  {{-- table --}}
                  <div class="w-2/3 ">
                        @if (!empty($pesertakelas))
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
                                                {{ $pesertakelas->firstItem() + $index }}</td>
                                          <td class="p-3 text-gray-800 border rounded">{{ getName($p->datapelita_id) }}</td>
                                          <td class="p-3 text-gray-800 border rounded">{{ getDaftarKelas($p->daftarkelas_id) }}</td>
                                          {{-- <td class="p-3 text-center text-gray-800 border rounded">
                                        @if ($p->pandita_is_used == false)
                                        <button class="button-red button " wire:click="deleteConfirmation({{ $p->id }})">{{ __('Delete') }}</button>
                                          @else
                                          <button class="button button-teal" wire:click="edit({{ $p->id }})">{{ __('Edit') }}</button>
                                          @endif
                                          </td> --}}
                                          <td class="p-3 text-gray-800 border rounded">
                                                <div class="flex justify-center space-x-1">
                                                      <a href="#"><button type="button" class="p-1 text-black bg-yellow-300 rounded">
                                                                  <i class="fa fa-pen-to-square "></i>
                                                            </button></a>
                                                      <button class="p-1 text-white bg-red-500 rounded">
                                                            <i class="fa fa-trash "></i>
                                                      </button>
                                                </div>
                                          </td>
                                    </tr>
                              </tbody>
                              @endforeach
                        </table>
                        <div class="mt-3">
                              {{ $pesertakelas->links() }}
                        </div>
                        @else
                        <div>
                              <h1>No Data Found!</h1>
                        </div>
                        @endif
                  </div>

                  {{-- </div> --}}

            </div>

      </div>
      @endif
