<div>
      @section('title', 'Daftar Kelas')


      <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
            <h5 class="text-2xl font-semibold">{{ __('Daftar Kelas') }}</h5>

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
            <div class="w-1/2 p-4 mt-3 mr-3 text-white bg-teal-500 border shadow-xl rounded-xl">
                  @if(Auth::user()->role == 3)
                  <div class="text-xl font-semibold text-center">{{ __('Daftar Kelas') }}</div>
                  @else
                  <div class="text-xl font-semibold text-center">{{ __('Daftar Kelas') }} Vihara {{ getNamaCetya(Auth::user()->branch_id) }}</div>
                  @endif
                  @if( Auth::user()->role == 3)

                  <div class="w-full mt-3">
                        <label class="px-2" for="nama_kelas">{{ __('Nama Cetya') }}</label>
                        <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded" wire:model="branch_id">
                              <option value="">Pilih Cetya</option>
                              @foreach ($branch as $b)
                              <option value="{{ $b->id }}">{{ $b->nama_branch }} </option>
                              @endforeach
                        </select>

                        @error('selectedBranch')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                  </div>
                  @endif
                  <div class="w-full mt-3 mb-3">
                        <label class="px-2" for="nama_kelas">{{ __('Nama Kelas') }}</label>
                        <select class="w-full px-2 py-1 text-purple-700 border border-purple-700 rounded" wire:model="kelas_id">
                              @if (empty($kelas))
                              <option value="" selected>Tidak ada kelas</option>
                              @else
                              <option value="" selected>Pilih Kelas</option>
                              @endif

                              @foreach ($kelas as $b)
                              <option value="{{ $b->id }}">{{ $b->nama_kelas }}</option>
                              @endforeach

                        </select>
                        @error('kelas_id')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                  </div>
                  @if ($is_add == true)
                  <button wire:click="store" class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{ __('Save') }}</button>
                  @else
                  <button wire:click="update" class="px-3 py-1 text-teal-600 bg-white border-white rounded hover:bg-teal-800 hover:text-white">{{ __('Update') }}</button>
                  @endif
                  <button wire:click="cancel" class="button button-yellow">{{ __('Cancel') }}</button>
            </div>
            <div class="w-1/2 mt-3">
                  @if (!empty($daftarkelas))
                  <table class="w-full table-auto">
                        <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                              <tr>
                                    <th class="p-3 font-semibold text-center">#</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Cetya') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Kelas') }}</th>
                                    <th class="p-3 font-semibold text-center"></th>
                              </tr>
                        </thead>
                        @foreach ($daftarkelas as $index => $p)
                        <tbody>
                              <tr>
                                    <td class="p-3 text-gray-800 border rounded">
                                          {{ $daftarkelas->firstItem() + $index }}</td>
                                    {{-- <td class="p-3 text-gray-800 border rounded">{{ $p->nama_kelas }}</td> --}}
                                    <td class="p-3 text-gray-800 border rounded">{{ getBranch($p->branch_id) }}
                                    </td>
                                    <td class="p-3 text-gray-800 border rounded">{{ getKelas($p->kelas_id) }}</td>
                                    <td class="p-3 text-center text-gray-800 border rounded">
                                          @if ($p->daftarkelas_is_used == false)
                                          <button class="button-red button " wire:click="deleteConfirmation({{ $p->id }})"><i class="fa fa-trash "></i></button>
                                          @else
                                          <button class="button button-teal" wire:click="edit({{ $p->id }})"><i class="fa fa-pen-to-square "></i></button>
                                          @endif
                                    </td>
                              </tr>
                        </tbody>
                        @endforeach
                  </table>
                  <div class="mt-3">
                        {{ $daftarkelas->links() }}
                  </div>
                  @else
                  <div>
                        <h1>No Data Found!</h1>
                  </div>
                  @endif
            </div>
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

            window.addEventListener('duplicate', function(e) {
                  Swal.fire({
                        icon: 'error'
                        , title: 'Data Duplikat'
                        , text: 'Kelas ini sudah terdaftar pada Vihara'
                        , footer: 'Data Ini Tidak Di Simpan'
                  })
            });

      </script>
      @endpush

</div>
