<?php

namespace App\Http\Controllers;

use App\Models\DataPelita;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index (Request $request) {
           $datapelita = DataPelita::whereIn('id',$request->IdPilihan )->orderBy('nama_umat', 'asc')->get();
        return view ('datapelitacetak', compact('datapelita'));
    }
}


