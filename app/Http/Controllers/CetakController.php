<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\DataPelita;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index (Request $request) {
           $datapelita = DataPelita::whereIn('id',$request->IdPilihan )->orderBy('nama_umat', 'asc')->get();
        // return view ('datapelitapdf', compact('datapelita'));
        return view ('datapelitacetak', compact('datapelita'));
    }

    public function pdf (Request $request) {
        $datapelita = DataPelita::whereIn('id',$request->IdPilihan )->orderBy('nama_umat', 'asc')->get();
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf-> autoLangToFont = true;
        // Harus di OB clean agar tampil di mobile
        ob_get_clean();
        $html = view ('datapelitapdf', compact('datapelita'));
        $mpdf->WriteHTML($html);
        $mpdf->Output('datapelita.pdf', \Mpdf\Output\Destination::DOWNLOAD);

    }
    public function tampil (Request $request) {
        $datapelita = DataPelita::orderBy('nama_umat', 'asc')->limit(20)->get();
        return view ('datapelitapdf', compact('datapelita'));
    }

    public function updatedAt () {
        $data = DataPelita::all();
            foreach($data as $d ){
                $d->updated_at = now();
            }
            return redirect(route('main'));
    }

    public function resetumur () {
        $data = DataPelita::all();
            foreach($data as $d ){
                // $now = Carbon::now();
                // $tahun = $now->year;
                // $year = date('Y', strtotime($d->tgl_mohonTao));
                // $selisih = $tahun - $year;
                $is_save = false;
                if($d->umur_sekarang != hitungUmurSekarang($d->tgl_lahir)) {
                    $is_save = true;
                }
                $d->umur_sekarang = hitungUmurSekarang($d->tgl_lahir);

                // $d->pengajak = getName($d->pengajak_id);
                // $d->penjamin = getName($d->penjamin_id);

                if($is_save) {
                    $d->save();
                    $is_save = false;
                }
            }

            // session()->flash('message', 'Seluruh Data Umur dan gender Umat Sudah di Reset');
            return redirect(route('main'));
    }
}


