<div>
      @section('title', 'Branch')
      <div class="flex justify-between w-2/3 p-3 mx-auto mt-3 text-white bg-teal-500 rounded shadow-xl ">
            <h5 class="text-2xl font-semibold">{{ __('Add Data Vihara') }}</h5>

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
                  <div class="text-xl font-semibold text-center">{{ __('Data Vihara') }}</div>
                  <div class="w-full mt-3">
                        <label class="block px-2" for="kota">{{ __('Kota') }}</label>
                        <select id="kota" wire:model="kota_id" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                              <option value="" selected>--> {{ __('Silakan Pilih Kota') }}
                                    <-- </option>
                                          @foreach ($kota as $k)
                              <option value="{{ $k->id }}"">{{ $k->nama_kota }}</option>
                    @endforeach
                </select>

                @error('kota')
                    <span class=" text-red-500">{{ $message }}</span>
                                    @enderror
                  </div>
                  <div class="w-full mt-3">
                        <label class="px-2" for="nama_vihara">{{ __('Nama Vihara') }}</label>
                        <input id="nama_vihara" type="text" placeholder="{{ __('Nama Vihara') }}" wire:model="nama_branch" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @error('nama_branch')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                  </div>
                  <div class="w-full mt-3">
                        <label class="px-2" for="kode_vihara">{{ __('Kode Vihara') }}</label>
                        <input id="kode_vihara" type="text" placeholder="{{ __('Kode Vihara') }}" wire:model="kode_branch" class="w-full my-3 text-gray-700 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @error('kode_branch')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                  </div>
                  @if ($is_add == true)
                  <button wire:click="store" class="px-3 py-1 text-teal-600 bg-white rounded hover:text-teal-800">{{ __('Save') }}</button>
                  @else
                  <button wire:click="update" class="button button-teal">{{ __('Update') }}</button>
                  @endif
            </div>
            {{-- TABLE --}}
            <div class="w-1/2 mt-3">
                  @if (!empty($branch))
                  <table class="w-full table-auto">
                        <thead class="text-white bg-purple-500 border-b-2 border-gray-200 rounded-xl">
                              <tr>
                                    <th class="p-3 font-semibold text-center">#</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Kota') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Nama Vihara') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Kode Vihara') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Action') }}</th>
                              </tr>
                        </thead>
                        @foreach ($branch as $index => $b)
                        <tbody>
                              <tr>
                                    <td class="p-3 text-gray-800 border rounded">
                                          {{ $branch->firstItem() + $index }}</td>
                                    <td class="p-3 text-gray-800 border rounded">{{ $b->nama_kota }}</td>
                                    <td class="p-3 text-gray-800 border rounded">{{ $b->nama_branch }}</td>
                                    <td class="p-3 text-gray-800 border rounded">{{ $b->kode_branch }}</td>
                                    <td class="p-3 text-center text-gray-800 border rounded">
                                          @if ($b->branch_is_used == false)
                                          <button class="button-red button " wire:click="delete_confirmation({{ $b->id }})">{{ __('Delete') }}</button>
                                          @else
                                          <button class="button button-teal" wire:click="edit({{ $b->id }})">{{ __('Rename') }}</button>
                                          @endif
                                    </td>
                              </tr>
                        </tbody>
                        @endforeach
                  </table>
                  <div class="mt-3">
                        {{ $branch->links() }}
                  </div>
                  @else
                  <div>
                        <h1>No Data Found!</h1>
                  </div>
                  @endif
            </div>
            {{-- TABLE END --}}
      </div>
</div>

@push('script')
<script>
      window.addEventListener('delete_confirmation_branch', function(event) {
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
                        window.livewire.emit('delete_branch', event.detail.id)
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
