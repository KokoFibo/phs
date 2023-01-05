{{-- modal View --}}
<div wire:ignore.self class="modal fade " id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Umat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <div class="card">
                    <div class="card-header">

                        <h3>Data Umat</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>{{ __('Branch') }}</td>

                                <td>{{ $branch_id }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('Nama') }}</td>
                                <td>{{ $nama_umat }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('中文名') }}</td>
                                <td>{{ $mandarin }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Gender') }}</td>
                                <td>{{ check_JK($gender, $umur_sekarang) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Umur') }}</td>
                                <td>{{ $umur_sekarang }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Alamat') }}</td>
                                <td>{{ $alamat }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Kota') }}</td>
                                <td>{{ $namaKota }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Telepon') }}</td>
                                <td>{{ $telp }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Handphone') }}</td>
                                <td>{{ $hp }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}</td>
                                <td>{{ $email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Pengajak') }}</td>
                                <td>{{ $pengajak }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Penjamin') }}</td>
                                <td>{{ $penjamin }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Pandita') }}</td>
                                <td>{{ $namaPandita }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Tanggal Mohon Tao') }}</td>
                                <td>{{ $tgl_mohonTao }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Status') }}</td>
                                <td>{{ $status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>





                {{-- button submit --}}
                <button class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
