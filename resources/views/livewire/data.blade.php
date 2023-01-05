<div>
    {{-- {{ dd($datapelita->all()) }} --}}
    {{-- @include('datapelita.addModal') --}}
    @include('datapelita.viewModal')
    {{-- @include('datapelita.editModal') --}}
    {{-- @include('datapelita.deleteModal') --}}
    {{-- @include('layouts.navbar') --}}
    @section('title', 'Main')

    <div class="container-fluid">

        @include('livewire.datapelita.mainSearch')
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="col-md-2 mt-3">
                        <Label class="text">Search</Label>
                        <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">{{ __('Search Category') }} </label>

                        <select wire:model="category" class="form-control">
                            <option value="data_pelitas.nama_umat" selected>{{ __('Nama') }}</option>
                            <option value="data_pelitas.pengajak">{{ __('Pengajak') }}</option>
                            <option value="data_pelitas.penjamin">{{ __('Penjamin') }}</option>
                            <option value="panditas.nama_pandita">{{ __('Pandita') }}</option>
                            <option value="kotas.nama_kota">{{ __('Kota') }}</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">{{ __('Per Page') }}: </label>
                        <select wire:model="perpage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>

                    
                    <div class="col-md-2 mt-3">
                        <label for="name">{{ __('Tgl Chiu Tao') }}: </label>
                        <input type="date" class="form-control" wire:model="startDate">
                    </div>
                    <div class="col-md-2 mt-3">
                        <label for="name">-</label>
                        <input type="date" class="form-control" wire:model="endDate">
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">{{ __('Umur') }}</label>
                        <input type="text" class="form-control" wire:model="startUmur">
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="name">-</label>
                        <input type="text" class="form-control" wire:model="endUmur">
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="name">{{ __('Jenis Kelamin') }}</label>
                        <select wire:model="jen_kel" class="form-control">
                            <option value="0">{{ __('All') }}</option>
                            <option value="1">{{ __('Laki-laki') }}</option>
                            <option value="2">{{ __('Perempuan') }}</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="name">{{ __('Status') }} </label>
                        <select wire:model="active" class="form-control">
                            <option value="">{{ __('All') }}</option>
                            <option value="Active">{{ __('Active Only') }}</option>
                            <option value="Inactive">{{ __('Inactive Only') }}</option>
                        </select>
                    </div>

                    

                </div>
                <div class="card rounded mt-3">


                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        @include('livewire.datapelita.main_table')
                        <div class="d-flex align-items-center justify-content-between">
                            <span>{{ $datapelita->onEachSide(5)->links() }}</span>
                            <span>{{ __('Total hasil pencarian') }} :
                                {{ number_format($datapelita->total()) }} {{ __('Data') }}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    @push('script')
        <script>
            // window.addEventListener('close-modal', event => {
            //     $('#AddModal').modal('hide');
            // });
            // window.addEventListener('close-modal', event => {
            //     $('#EditModal').modal('hide');
            // });
            // window.addEventListener('close-modal', event => {
            //     $('#DeleteModal').modal('hide');
            // });
        </script>
        <script>
            window.addEventListener('delete_confirmation', function(e) {
                Swal.fire({
                    title: e.detail.title,
                    text: e.detail.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, silakan hapus!'
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
                    'Deleted!',
                    'Data sudah di delete.',
                    'success'
                );
            });
        </script>
    @endpush

</div>
