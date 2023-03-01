<div>

      @section('title', 'Absensi Kelas Pendalaman')

      <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
            <h5 class="text-2xl font-semibold">{{ __('Absensi Kelas') }}</h5>

            <button wire:click="close">
                  <i class="fa fa-circle-xmark fa-2xl"></i>
            </button>
      </div>
      <div class="w-2/3 mx-auto mt-3 text-center ">
            @if (session()->has('message'))
            <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
            @endif
      </div>

      <div class="flex w-2/3 p-3 mx-auto items-top justify-evenly">
            <div class="w-1/3 p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl rounded-xl">
                  <div class="text-xl font-semibold text-center">{{ __('Absensi Kelas') }}</div>
                  @if ($is_add == true)
                  @if (Auth::user()->role == '3')
                  <div class="w-full mt-3">
                        <label class="px-2" for="nama_kelas">{{ __('Nama Cetya') }}</label>
                        <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded" wire:model="selectedBranch">
                              <option value="">Pilih Cetya</option>
                              @foreach ($branch as $b)
                              <option value="{{ $b->id }}">{{ $b->nama_branch }} </option>
                              @endforeach
                        </select>
                  </div>
                  @endif

                  <div class="w-full mt-3">
                        <label class="px-2" for="nama_kelas">{{ __('Nama Kelas') }}</label>
                        <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded" wire:model="daftarkelas_id">
                              <option value="">Pilih Kelas</option>
                              @foreach ($kelas as $b)
                              <option value="{{ $b->id }}"> {{ getDaftarKelas($b->id) }}</option>
                              @endforeach
                        </select>
                  </div>
                  @else
                  @if (Auth::user()->role == '3')
                  <div class="w-full mt-3">
                        <label class="px-2" for="cetya">{{ __('Cetya') }}</label>
                        <input id="cetya" type="text" value="{{ $nama_cetya }}" disabled class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                  </div>
                  @endif
                  <div class="w-full mt-3">
                        <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                        <input id="kelas" type="text" value="{{ $nama_kelas }}" disabled class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                  </div>
                  @endif

                  <div class="w-full mt-3">
                        <label class="px-2" for="tgl_kelas">{{ __('Tanggal Kelas') }}</label>
                        <input id="tgl_kelas" type="date" wire:model="tgl_kelas" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @error('tgl_kelas')
                        <span class="text-black">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="w-full mt-3">
                        <button wire:click="tambahPeserta" class="button button-yellow">Tambah data Peserta Kelas</button>
                  </div>
                  <div class="w-full mt-3">
                        <button wire:click="tambahAbsensi" class="button button-yellow">Masukkan data Absensi</button>
                  </div>



                  @if ($is_add == true)
                  <button wire:click="store" class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{ __('Save') }}</button>
                  @else
                  <button wire:click="update" class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{ __('Update') }}</button>
                  @endif
                  <button wire:click="cancel" class="button button-yellow">{{ __('Cancel') }}</button>

            </div>
            @if ($menuTambahData == true)
            @include('livewire.absensi.tambahdatapeserta')
            @endif
            @if ($menuAbsensi == true)
            @include('livewire.absensi.menuabsensi')
            @endif

      </div>

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
            window.addEventListener('updated', function(e) {
                  Swal.fire({
                        position: 'top-end'
                        , icon: 'success'
                        , title: 'Data sudah di update'
                        , showConfirmButton: false
                        , timer: 1500
                  })
            });

            window.addEventListener('saved', function(e) {
                  Swal.fire({
                        position: 'top-end'
                        , icon: 'success'
                        , title: 'Data sudah di Simpan'
                        , showConfirmButton: false
                        , timer: 1500
                  })
            });

      </script>
      @endpush

</div>
