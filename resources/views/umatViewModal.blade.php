<div class="overflow-auto">
    {{-- Nama Cetya --}}
    <div class="w-1/2 h-16 mx-auto mt-3 mb-3 bg-purple-500 border shadow rounded-xl">
        <h1 class="pt-3 text-3xl text-center text-white">
            {{ $nama_cetya }}
        </h1>
    </div>


    <div class="w-1/2  overflow-auto mx-auto bg-white rounded-xl shadow-xl  ">

        {{-- Table Start --}}
        {{-- <table class="w-1/2 mx-auto border-separate border-spacing-4 border-slate-400 bg-white rounded-xl mt-2"> --}}
        <table class="  border-separate border-spacing-2 border-slate-400 bg-white rounded-xl mt-2 ">
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Nama') }}
                </td>
                <td class=" h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $nama_umat }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('中文名') }}
                </td>
                <td class=" h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $mandarin }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Gender') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $gender }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Umur') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $umur_sekarang }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Alamat') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $alamat }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Kota') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $namaKota }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Telepon') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $telp }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Handphone') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $hp }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Email') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $email }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Pengajak') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $pengajak }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Penjamin') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $penjamin }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Pandita') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $namaPandita }}
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Tanggal Mohon Tao') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $tgl_mohonTao }}
                </td>
            </tr>

            <tr>
                <td class="w-1/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ __('Status') }}
                </td>
                <td class="w-3/4 h-5 px-2 text-lg border rounded border-slate-300">
                    {{ $status }}
                </td>
            </tr>
        </table>
        {{-- Table End --}}

        {{-- Close Button --}}
        <div class="p-5 flex justify-end">
            <button @click="open=false"
                class="px-3 py-2 text-sm text-white bg-red-500 rounded shadow-xl hover:bg-red-700">
                Cancel
            </button>
        </div>
    </div>
</div>
