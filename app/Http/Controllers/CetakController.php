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
        $html = view ('datapelitapdf', compact('datapelita'));
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf-> autoLangToFont = true;
        ob_get_clean();
        $mpdf->WriteHTML($html);
        $mpdf->Output('datapelita.pdf', \Mpdf\Output\Destination::DOWNLOAD);

    }
}


