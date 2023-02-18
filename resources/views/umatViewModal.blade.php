<div class="w-2/3 h-screen mx-auto bg-white">
    <div>
        <div class="p-5">
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Vihara') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $branch_id }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Nama') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $nama_umat }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">中文名</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $mandarin }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Umur') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $umur_sekarang }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Alamat') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $alamat }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Kota') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $kota }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Telepon') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $telp }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Handphone') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $hp }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Email') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $email }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Gender') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ check_JK($d->gender, $d->umur_sekarang) }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Tanggal Mohon Tao') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $tgl_mohonTao }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Pengajak') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg"><?php echo getName($d->pengajak_id); ?></div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Penjamin') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg"><?php echo getName($d->penjamin_id); ?></div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Pandita') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $namaPandita }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Status') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $status }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Sidang Dharma 3 Hari') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $tgl_sd3h }}</div>
            </div>
            <div class="flex w-full mt-2 ">
                <div class="w-1/4 text-lg">{{ __('Vegetarian Total') }}</div>
                <div class="text-lg">:</div>
                <div class="w-3/4 ml-2 text-lg">{{ $tgl_vtotal }}</div>
            </div>
            <button class="mt-5 button button-teal" @click="modal = false">{{ __('Close') }}</button>
        </div>
    </div>

</div>
