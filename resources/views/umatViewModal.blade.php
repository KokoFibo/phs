<div>
    <div class="w-1/2 h-16 mx-auto mt-3 bg-purple-500 border shadow rounded-xl">
        <h1 class="pt-3 text-3xl text-center text-white">
            {{ __('Data Umat') }}
        </h1>
    </div>
    <div class="w-1/2 mx-auto bg-white rounded-xl shadow-xl ">


        {{-- <table class="w-1/2 mx-auto border-separate border-spacing-4 border-slate-400 bg-white rounded-xl mt-2"> --}}
        <table class=" border-separate border-spacing-4 border-slate-400 bg-white rounded-xl mt-2">
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Nama') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Ryan
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('中文名') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Lau
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Gender') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    乾
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Umur') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    21
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Alamat') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Gading
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Kota') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Jakarta
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Telepon') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    0215562233
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Handphone') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    087855223322
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Email') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Ryan@gmail.com
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Pengajak') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Muhammad Situmorang
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Penjamin') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Dinda Novitasari S.IP
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Pandita') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Lin TCS
                </td>
            </tr>
            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Tanggal Mohon Tao') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    2023-01-08
                </td>
            </tr>

            <tr>
                <td class="w-1/4 h-10 px-2 text-xl border rounded border-slate-300">
                    {{ __('Status') }}
                </td>
                <td class="w-3/4 h-10 px-2 text-xl border rounded border-slate-300">
                    Active
                </td>
            </tr>
        </table>
        <div class="p-5">
            <button @click="open=false"
                class="px-3 py-2 text-sm text-white bg-red-500 rounded shadow-xl hover:bg-red-700">
                Cancel
            </button>
        </div>
    </div>
</div>
