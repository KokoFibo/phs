<div>
    @section('title', 'Absensi Kelas Pendalaman')
    @if ($menuUtama)
    {{-- start menu Utama --}}
    {{-- <p>SelectedGroup: {{ $selectedGroup }}, daftarkelas_id: {{ $daftarkelas_id }}, tgl_kelas: {{ $tgl_kelas }}</p>
    --}}
    <x-spinner />
    <div class="flex justify-between w-1/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
        <h5 class="text-2xl font-semibold ">{{ __('Absensi Kelas') }}</h5>
        <button wire:click="close">
            <i class="fa fa-circle-xmark fa-2xl"></i>
        </button>
    </div>
    <div class="w-2/3 mx-auto mt-3 text-center ">
        @if (session()->has('message'))
        <div class="w-full py-2 text-xl text-white bg-teal-500 rounded-xl">{{ session('message') }}</div>
        @endif
    </div>

    <div class="flex w-full mx-auto items-top justify-evenly">
        <div class="w-1/3 p-4 mt-3 text-white bg-teal-500 border shadow-xl rounded-xl">
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

            <div class="flex justify-between mt-3">
                <button wire:click="tambahPeserta" class="button button-purple">Tambah Peserta Kelas</button>
                <button wire:click="tambahAbsensi" class="button button-blue">Input Absensi</button>
                <button wire:click="editAbsensi" class="button button-blue">Edit & Delete Absensi</button>
                <button wire:click="close" class=" button button-yellow">{{ __('Close') }}</button>
            </div>
        </div>
    </div>

    @if ($selectedGroup && $daftarkelas_id)
    <div class="flex items-center justify-between mt-5">

        <h2 class="px-3 text-2xl font-semibold text-center text-purple-500">{{ getGroupVihara($selectedGroup) }}
        </h2>
        <h2 class="text-3xl font-semibold text-center text-purple-500">Absensi</h2>
        <h2 class="px-3 text-2xl font-semibold text-center text-purple-500">{{ getDaftarKelas($daftarkelas_id) }}
        </h2>
    </div>
    <table table class="w-full mt-1">
        <thead class="text-white bg-purple-500 border-b-2 border-gray-200">

            <tr>

                <th class="p-3 font-semibold text-center border rounded ">Nama</th>
                @foreach ($viewTglAbsensi as $h )
                <th class="p-3 font-semibold text-center border rounded ">{{
                    \Carbon\Carbon::parse($h->tgl_kelas)->format('d/m')}}</th>
                @endforeach

            </tr>

        </thead>
        <tbody>

            @foreach($viewNamaAbsensi as $n)
            <tr>
                <td class="text-center border rounded ">{{ getName($n->datapelita_id) }}</td>
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
    <h2 class="px-3 text-xl font-semibold text-center text-purple-500">Jumlah Peserta : {{ $jumlahpeserta }}</h2>
    <h2 class="px-3 text-xl font-semibold text-center text-purple-500">Jumlah Pertemuan : {{ $jumlahdaftarkelas }} </h2>
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

      window.addEventListener('absensiSudahAda', function(e) {
            Swal.fire({
                  icon: 'error'
                  , title: 'Oops...'
                  , text: 'Data absensi tanggal dan kelas ini sudah ada',
                  // footer: '<a href="">Why do I have this issue?</a>'
            })
      });
      window.addEventListener('pesertaTerdaftar', function(e) {
            Swal.fire({
                  icon: 'error'
                  , title: 'Oops...'
                  , text: 'Peserta ini sudah terdaftar di kelas ini',
                  // footer: '<a href="">Why do I have this issue?</a>'
            })
      });

</script>
@endpush

</div>
