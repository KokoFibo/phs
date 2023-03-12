<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Branch;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Groupvihara;

class Chartwire extends Component
{



    public function render()
    {
        $jumlah = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy('data_pelitas.id', 'desc')->count();
        $data = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy('data_pelitas.id', 'desc')->get();

        return view('livewire.chartwire', compact(['data', 'jumlah']))
            ->extends('layouts.maintest')
            ->section('content');
    }
}
