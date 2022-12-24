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

                <table class="table">
                    <tr>
                        <td>Branch</td>
                        <td>{{ $branch_id }}</td>
                    </tr>

                    <tr>
                        <td>Nama</td>
                        <td>{{ $nama_umat }}</td>
                    </tr>
                    <tr>
                        <td>中文名</td>
                        <td>{{ $mandarin }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{ check_JK($jenis_kelamin, $umur_sekarang) }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>{{ $umur_sekarang }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $alamat }}</td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>{{ $namaKota }}</td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>{{ $telp }}</td>
                    </tr>
                    <tr>
                        <td>Handphone</td>
                        <td>{{ $hp }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr>
                        <td>Pengajak</td>
                        <td>{{ $pengajak }}</td>
                    </tr>
                    <tr>
                        <td>Penjamin</td>
                        <td>{{ $penjamin }}</td>
                    </tr>
                    <tr>
                        <td>Pandita</td>
                        <td>{{ $namaPandita }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Mohon Tao</td>
                        <td>{{ $tgl_mohonTao }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{ $status }}</td>
                    </tr>
                </table>




                {{-- button submit --}}
                <button class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
{{-- Modal Add End --}}
