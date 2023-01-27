<div class="w-2/3 h-screen mx-auto bg-white">
    <div>
        <div class="p-5">
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Vihara</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $branch_id }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Nama</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $nama_umat }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Mandarin</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $mandarin }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Umur</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $umur_sekarang }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Alamat</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $alamat }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Kota</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $kota }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Telepon</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $telp }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Handphone</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $hp }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Email</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $email }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Gender</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ check_JK($d->gender, $d->umur_sekarang) }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Tanggal Mohon Tao</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $tgl_mohonTao }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Pengajak</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg"><?php echo getName($d->pengajak_id); ?></div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Penjamin</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg"><?php echo getName($d->penjamin_id); ?></div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Pandita</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $namaPandita }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">Status</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $status }}</div>
            </div>
            <button class="mt-5 button button-teal" @click="modal = false">Close</button>
        </div>
    </div>

</div>
