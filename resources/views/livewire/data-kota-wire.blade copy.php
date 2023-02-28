<div>

      @section('title', 'Add Data Kota')


      <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
            <h5 class="text-2xl font-semibold">{{ __('Tambah Kota') }}</h5>

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
                  <div class="text-xl font-semibold text-center">{{ __('Data Kota') }}</div>
                  <div class="w-full mt-3">

                        <div class="w-full mt-3">
                              <label class="px-2" for="nama_kota">{{ __('Nama Kota') }}</label>
                              <input id="nama_kota" type="text" placeholder="{{ __('Nama Kota') }}" wire:model="nama_kota" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                              @error('nama_kota')
                              <span class="text-red-500">{{ $message }}</span>
                              @enderror
                        </div>

                        @if ($is_add == true)
                        <button wire:click="store" class="px-3 py-1 text-teal-600 bg-white rounded hover:text-teal-800">{{ __('Save') }}</button>
                        @else
                        <button wire:click="update" class="button button-teal">{{ __('Update') }}</button>
                        @endif
                  </div>
                  <div class="mb-3">
                        <label class="form-label">Rename Kota</label>
                        <input wire:model="nama_kota" type="text" class="form-control">
                        <button class="mt-2 btn-primary" wire:click="update">Update</button>
                  </div>
                  @endif

            </div>
      </div>
      <div class="w-1/2 mt-3">
            @if (!empty($kota))

            <div class="w-full">

                  <table class="w-full table-auto rounded-xl">
                        <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                              <tr>
                                    <th class="p-3 font-semibold text-center">#</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Kota') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Delete') }}</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach ($kota as $index => $k)
                              <tr>
                                    <td class="p-3 text-gray-800 border rounded">
                                          {{ $kota->firstItem() + $index }}</td>
                                    <td class="p-3 text-gray-800 border rounded">{{ $k->nama_kota }}</td>
                                    <td class="p-3 text-center text-gray-800 border rounded">
                                          @if ($k->kota_is_used == false)
                                          <button wire:click="delete_confirmation_kota({{ $k->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                          @else
                                          <button wire:click="edit({{ $k->id }})" class="btn btn-warning btn-sm"><i class="fa fa-pen"></i></button>
                                          @endif
                                    </td>
                              </tr>
                              @endforeach
                        </tbody>
                  </table>
                  <div class="mt-3">
                        {{ $kota->links() }}
                  </div>
            </div>
            @endif

      </div>
</div>





@push('script')
<script>
      window.addEventListener('delete_confirmation_aja', function(event) {
            Swal.fire({
                  title: event.detail.title
                  , text: event.detail.text
                  , icon: 'warning'
                  , showCancelButton: true
                  , confirmButtonColor: '#3085d6'
                  , cancelButtonColor: '#d33'
                  , confirmButtonText: 'Yes, silakan hapus!'
            }).then((result) => {
                  if (result.isConfirmed) {
                        window.livewire.emit('delete_kota', event.detail.id)
                        // $this - > emit('delete_kota', event.detail.id)
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

</script>
@endpush
</div>
{{-- Modal Add End --}}

</div>
