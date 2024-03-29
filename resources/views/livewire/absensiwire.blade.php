
<div>
    @section('title', 'Absensi Kelas Pendalaman')
    @if ($menuUtama)
    {{-- start menu Utama --}}
    {{-- <p>SelectedGroup: {{ $selectedGroup }}, daftarkelas_id: {{ $daftarkelas_id }}, tgl_kelas: {{ $tgl_kelas }}</p>
    --}}
    <x-spinner />
    <div class="flex justify-center lg:mx-0">
        <div class="flex justify-between w-full p-3 mt-3 text-white bg-teal-500 rounded shadow-xl lg:w-1/2 ">
            <h5 class="text-2xl font-semibold ">{{ __('Absensi Kelas') }}</h5>
        <button wire:click="close">
            <i class="fa fa-circle-xmark fa-2xl"></i>
        </button>
        </div>
    </div>
    <div class="w-2/3 mx-auto mt-3 text-center ">
        @if (session()->has('message'))
        <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
        @endif
    </div>
    <div class="flex w-full mx-auto items-top justify-evenly">
        <div class="w-full p-4 mx-3 mt-3 text-white bg-teal-500 border shadow-xl lg:w-1/2 rounded-xl">
            <div class="text-xl font-semibold text-center">{{ __('Absensi Kelas') }}</div>
            @if ($is_add == true)
            @if (Auth::user()->role == '3')
            <div class="w-full mt-3">
                <label class="px-2" for="nama_kelas">{{ __('Nama Group') }}</label>
                <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                    wire:model="selectedGroup">
                    <option value="">Pilih Group</option>
                    @foreach ($group as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_group }} </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="w-full mt-3">
                <label class="px-2" for="nama_kelas">{{ __('Nama Kelas') }}</label>
                <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded"
                    wire:model="daftarkelas_id">
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
                <input id="cetya" type="text" value="{{ $nama_cetya }}" disabled
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            @endif
            <div class="w-full mt-3">
                <label class="px-2" for="kelas">{{ __('Kelas') }}</label>
                <input id="kelas" type="text" value="{{ $nama_kelas }}" disabled
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
            </div>
            @endif
            {{-- <div class="w-full mt-3">
                <label class="px-2" for="tgl_kelas">{{ __('Tanggal Kelas') }}</label>
                <input id="tgl_kelas" type="date" wire:model="tgl_kelas"
                    class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                @error('tgl_kelas')
                <span class="text-black">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="flex flex-col mt-3 text-center lg:flex lg:justify-evenly">
                <div class="flex justify-between w-full gap-3">
                    <button wire:click="tambahPeserta" class="w-1/2 mt-2 button button-purple">Tambah Peserta Kelas</button>
                    <button wire:click="tambahAbsensi" class="w-1/2 mt-2 button button-pink">Input Absensi</button>
                </div>
                <div class="flex justify-between w-full gap-3">
                    <button wire:click="editAbsensi" class="w-1/2 mt-2 button button-blue">Edit & Delete Absensi</button>
                    <button wire:click="close" class="w-1/2 mt-2 button button-yellow">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    @if ($selectedGroup && $daftarkelas_id)
    <div class="flex flex-col items-center justify-between p-3 mt-5 lg:flex lg:flex-row">
        <h2 class="text-lg font-semibold text-center text-purple-500 lg:text-xl ">{{ getGroupVihara($selectedGroup) }}
        </h2>
        <h2 class="text-lg font-semibold text-center text-purple-500 lg:text-xl">{{ getDaftarKelas($daftarkelas_id) }}
        </h2>
    </div>
    <div class="mt-1 overflow-x-auto ">
        <table class="w-full mt-1 table-fixed lg:table-auto ">
            <thead class="text-white bg-purple-500 border-b-2 border-gray-200">
                <tr>
                    <th class="w-10 p-3 font-semibold text-center border rounded ">#</th>
                    <th class="w-32 p-3 font-semibold text-center border rounded ">Nama</th>
                    @foreach ($viewTglAbsensi as $h )
                    <th class="w-10 p-3 font-semibold text-center border rounded ">{{
                        \Carbon\Carbon::parse($h->tgl_kelas)->format('d/m')}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($viewNamaAbsensi as $n)
                <tr>
                    <td class="text-center border rounded ">{{ $loop->iteration }}</td>
                    @if (checkGender($n->datapelita_id)=='1')
                    <td class="text-center text-blue-500 border rounded ">
                        @else
                    <td class="text-center text-pink-500 border rounded ">
                        @endif
                        {{ getName($n->datapelita_id) }}</td>
                    @php
                    for($i = 0; $i < $jumlahdaftarkelas; $i++){ $hasil=\App\Models\Absensi::query() ->
                        where('daftarkelas_id', $daftarkelas_id)
                        ->where('datapelita_id',$n->datapelita_id)
                        ->where('tgl_kelas',$tglTable[$i])
                        ->orderBy('tgl_kelas', 'asc')
                        ->first( );
                        @endphp
                        @if ($hasil)
                        <td class="text-center border rounded ">
                            @if ($hasil->absensi == 1)
                            <i class="text-blue-500 fa-sharp fa-solid fa-check"></i>
                            @elseif($hasil->absensi == 2)
                            <i class="text-red-500 fa-sharp fa-solid fa-xmark"></i>
                            @endif
                            @else
                        <td class="text-center border rounded "><i class="text-gray-500 fa-solid fa-minus"></i></td>
                        @endif
                        @php
                        }
                        @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h2 class="px-3 mt-3 text-lg font-semibold text-center text-purple-500 lg:text-xl">Jumlah Peserta : {{ $jumlahpeserta }}</h2>
    <h2 class="px-3 mb-5 text-lg font-semibold text-center text-purple-500 lg:text-xl">Jumlah Pertemuan : {{ $jumlahdaftarkelas }} </h2>
    <hr class="mt-3">
    @endif

    @endif
    @if ($menuTambahData == true)
    @include('livewire.absensi.tambahdatapeserta')
    @endif
    @if ($menuInputAbsensi == true)
    @include('livewire.absensi.menuinputabsensi')
    @endif
    @if ($menuEditAbsensi == true)
    @include('livewire.absensi.menueditabsensi')
    @endif

    {{-- end menu Utama --}}

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
      window.addEventListener('deleteAbsensiByTglConfirmation', function(e) {
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
                        window.livewire.emit('deleteAbsensiByTgl', e.detail.id)
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                  }
            })
      });
      window.addEventListener('deletepesertaConfirmation', function(e) {
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
                        window.livewire.emit('deletePesertaKelas', e.detail.id)
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
    //   window.addEventListener('updated', function(e) {
    //         Swal.fire({
    //               position: 'top-end'
    //               , icon: 'success'
    //               , title: 'Data sudah di update'
    //               , showConfirmButton: false
    //               , timer: 1500
    //         })
    //   });
    //   window.addEventListener('saved', function(e) {
    //         Swal.fire({
    //               position: 'top-end'
    //               , icon: 'success'
    //               , title: 'Data sudah di Simpan'
    //               , showConfirmButton: false
    //               , timer: 1500
    //         })
    //   });
      window.addEventListener('absensiSudahAda', function(e) {
            Swal.fire({
                  icon: 'error'
                  , title: 'Oops...'
                  , text: 'Data absensi tanggal dan kelas ini sudah ada',
                  // footer: '<a href="">Why do I have this issue?</a>'
            })
      });
    //   window.addEventListener('pesertaTerdaftar', function(e) {
    //         Swal.fire({
    //               icon: 'error'
    //               , title: 'Oops...'
    //               , text: 'Peserta ini sudah terdaftar di kelas ini',
    //               // footer: '<a href="">Why do I have this issue?</a>'
    //         })
    //   });
</script>
@endpush
</div>
