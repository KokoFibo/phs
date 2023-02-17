<?php

namespace App\Http\Controllers;

use App\Models\DataPelita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TestPdf extends Controller
{
    public function index () {
        $datapelita = DataPelita::where('tgl_sd3h','!=',null)->get();




        // $pdf = Pdf::loadView('livewire.datapelitapdf', ['datapelita'=>$datapelita]);
        // return $pdf->download('invoice.pdf');

        return view ('livewire.datapelitapdf', compact('datapelita'));
    }
}
