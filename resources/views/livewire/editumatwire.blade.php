<div>
    @section('title', 'Update Data')

    <div
        class="flex items-center justify-between w-full px-5 py-3 mt-2 text-white bg-purple-500 shadow-lg lg:w-3/4 lg:mx-auto rounded-xl">
        <div>
            <h4 class="text-xl font-semibold lg:text-2xl">{{ __('Update Data') }}</h3>
        </div>
        <div>

            <h3 class="text-2xl">{{ getBranch($branch_id) }}</h3>

        </div>
        <div class="flex gap-1">

        </div>
    </div>
    <div
        class="flex flex-col justify-center w-full py-5 pb-3 my-2 mt-2 mb-5 shadow dark:bg-gray-800 md:flex md:flex-row lg:w-3/4 lg:mx-auto shadow-purple-300 bg-purple-50 rounded-xl">
        <div class="w-full px-3 md:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-800">
            <div class="mt-3">
                <label class="px-2 dark:text-white ">{{ __('Vihara') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="branch_id">
                    {{-- <option value="">{{ __('Silakan Pilih Kota') }}</option> --}}
                    @foreach ($databranch as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->nama_branch }}</option>
                    @endforeach

                </select>
                @error('branch_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Nama Lengkap') }}</label>
                <input id="nama" type="text" wire:model="nama_umat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_umat')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Nama Alias') }}</label>
                <input id="nama" type="text" wire:model="nama_alias"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('nama_alias')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="mandarin">{{ __('中文名') }}</label>
                <input id="mandarin" type="text" wire:model="mandarin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('mandarin')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="tgl_lahir">{{ __('Tanggal Lahir') }}</label>
                <input id="tgl_lahir" type="date" wire:model="tgl_lahir"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_lahir')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="alamat">{{ __('Alamat') }}</label>
                <input id="alamat" type="text" wire:model="alamat"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('alamat')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white ">{{ __('Kota') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="kota_id">
                    <option value="">{{ __('Silakan Pilih Kota') }}</option>
                    @foreach ($datakota as $kota)
                        <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                    @endforeach

                </select>
                @error('kota_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="telepon">{{ __('Telepon') }}</label>
                <input id="telepon" type="text" wire:model="telp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('telp')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="handphone">{{ __('Handphone') }}</label>
                <input id="handphone" type="text" wire:model="hp"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('hp')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="email">{{ __('Email') }}</label>
                <input id="email" type="text" wire:model="email"
                    class="w-full mb-5 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="w-full px-3 md:w-1/2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-800">
            <div class="mt-3">
                <div>
                    <label class="hidden px-2 dark:text-white md:inline">{{ __('Gender') }}</label>
                </div>
                <div class="flex md:flex md:flex-col">
                    <div>
                        <label class="px-2 dark:text-white md:hidden">{{ __('Gender ') }} <span
                                class="text-red-500 md:hidden">*</span>
                            : </label>
                    </div>
                    <div>

                        <input type="radio" value="1" checked id="laki""
                            class="rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                            wire:model="gender">
                        <label class="dark:text-white" for="laki">{{ __('Laki-laki') }}</label>
                        <input type="radio" value="2" checked id="perempuan""
                            class="ml-2 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                            wire:model="gender">
                        <label class="dark:text-white" for="perempuan">{{ __('Perempuan') }}</label>
                    </div>

                </div>
                @error('gender')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-7">
                <label class="px-2 dark:text-white " for="tgl">{{ __('Tanggal Mohon Tao') }}</label>
                <input id="tgl" type="date" wire:model="tgl_mohonTao"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_mohonTao')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="relative mt-3" x-data="{ pengajak: false }">
                        <label class="px-2 dark:text-white " for="pengajak">{{ __('Pengajak') }}</label>
            <input @click="pengajak=true" id="pengajak" type="text" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" wire:model="pengajak">
            <input type="hidden" wire:model="pengajak_id">
            <div x-show="pengajak" @click.away="pengajak = false" x-transition class="absolute z-10 overflow-auto h-44">
                  <input id="pengajak" type="text" wire:model="query" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                  <ul class="bg-white ">
                        @if (!empty($nama))
                        @foreach ($nama as $n)
                        <li class="px-4 py-1 text-purple-500 border dark:text-white ">
                              <button class="hover:bg-gray-300" wire:click="getDataPengajak( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )" @click="pengajak=false">{{ $n['nama_umat'] }}</button>
                        </li>
                        @endforeach
                        @endif
                  </ul>
            </div>
            @error('pengajak_id')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
      </div> --}}

            <div class="mt-3">
                <label class="px-2 dark:text-white " for="pengajak">{{ __('Nama Pengajak') }}</label>
                <input id="pengajak" type="text" wire:model="pengajak"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('pengajak')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="relative mt-3" x-data="{ penjamin: false }">
                  <label class="px-2 dark:text-white " for="penjamin">{{ __('Penjamin') }}</label>
      <input @click="penjamin=true" id="penjamin" type="text" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500" wire:model="penjamin">
      <input type="hidden" wire:model="penjamin_id">
      <div x-show="penjamin" @click.away="penjamin = false" x-transition class="absolute z-10 overflow-auto h-44">
            <input id="penjamin" type="text" wire:model="query" class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            <ul class="bg-white ">
                  @if (!empty($nama))
                  @foreach ($nama as $n)
                  <li class="px-4 py-1 text-purple-500 border dark:text-white ">
                        <button class="hover:bg-gray-300" wire:click="getDataPenjamin( '{{ $n['nama_umat'] }}', '{{ $n['id'] }}' )" @click="penjamin=false">{{ $n['nama_umat'] }}</button>
                  </li>
                  @endforeach
                  @endif
            </ul>
      </div>
      @error('penjamin_id')
      <span class="text-red-500">{{ $message }}</span>
      @enderror
</div> --}}

            <div class="mt-3">
                <label class="px-2 dark:text-white " for="penjamin">{{ __('Nama Penjamin') }}</label>
                <input id="penjamin" type="text" wire:model="penjamin"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('penjamin')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3">
                <label class="px-2 dark:text-white " for="pandita">{{ __('Pandita') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="pandita_id">
                    <option value="">Masukkan data Pengajak</option>
                    @foreach ($datapandita as $pandita)
                        <option value="{{ $pandita->id }}">{{ $pandita->nama_pandita }}</option>
                    @endforeach
                </select>
                @error('pandita_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3">
                <label class="px-2 dark:text-white " for="tgl">{{ __('Kelas Dharma 3 Hari') }}</label>
                <input id="tgl" type="date" wire:model="tgl_sd3h"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_sd3h')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>



            <div class="mt-3">
                <label class="px-2 dark:text-white " for="tgl">{{ __('Tanggal Vegetarian Total') }}</label>
                <input id="tgl" type="date" wire:model="tgl_vtotal"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_vtotal')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Status') }}</label>
                <select class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500"
                    wire:model="status">
                    <option value="Active">{{ __('Active') }}</option>
                    <option value="Inactive">{{ __('Inactive') }}</option>
                </select>
                @error('status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="px-2 dark:text-white " for="nama">{{ __('Keterangan') }}</label>
                <input id="keterangan" type="text" wire:model="keterangan"
                    class="w-full rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('keterangan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="flex items-center justify-between w-full mt-10 ">
                <div>
                    <button class=" button button-teal" wire:click="update">{{ __('Update') }}</button>
                </div>
                <div>
                    <a href="{{ route('main') }}"><button class=" button button-black dark:bg-purple-500"><i
                                class="fa fa-circle-arrow-left"></i>
                            {{ __('Back') }}</button></a>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('stored', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.detail.title,
                    showConfirmButton: false,
                    timer: 3000
                });
            });

            window.addEventListener('updated', function(e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Updated',
                    showConfirmButton: false,
                    timer: 3000
                })
            });
        </script>
    @endpush
</div>
