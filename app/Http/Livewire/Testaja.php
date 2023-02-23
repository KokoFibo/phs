<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Groupvihara;

class Testaja extends Component
{
    public function render()
    {
        // $datapelita = DB::table('data_pelitas')
        // ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        // ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')


        $gabung = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->where('groupviharas.id', 2)->get();




        return view('livewire.testaja', compact('gabung'))->extends('layouts.app1')->section('content');
    }
}
