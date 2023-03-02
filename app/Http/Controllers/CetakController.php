<?php

namespace App\Http\Controllers;

use App\Models\DataPelita;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index () {

        $datapelita = DataPelita::where('id', 4)->get();
        return view ('datapelitapdf', compact('datapelita'));
    }
}
