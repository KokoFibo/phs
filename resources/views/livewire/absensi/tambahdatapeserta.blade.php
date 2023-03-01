<div class="flex w-2/3 p-3 mx-auto items-top justify-evenly">
      <div class="w-1/3 p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Absensi Kelas') }}</div>

            <div class="w-full mt-3">
                  <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                  <input id="kelas" type="text" value="{{ $nama_kelas }}" disabled class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div class="w-full mt-3">
                  <div class="relative mt-3" x-data="{ peserta: false }">
                        <label class="px-2 " for="peserta">{{ __('Peserta') }}</label><span class="text-red-500">*</span>
                        <input @click="peserta=true" autocomplete="off" id="peserta" type="text" placeholder="Masukkan data peserta" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" wire:model="peserta">
                        <input type="hidden" wire:model="datapelita_id">
                        <div x-show="peserta" @click.away="peserta = false" x-transition class="absolute z-10 overflow-auto h-44">
                              <input id="peserta" type="text" placeholder="Cari peserta" wire:model="query" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
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
                        @error('peserta_id')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                  </div>
            </div>

            <button class="button button-purple">Tambahkan</button>


      </div>
