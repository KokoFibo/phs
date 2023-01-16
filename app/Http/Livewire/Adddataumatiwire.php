<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DataPelita;

class Adddataumatiwire extends Component
{
    public $nama, $query, $pengajak_id, $penjamin_id, $nama_pengajak, $nama_penjamin;

    public function mount () {

        $query = "";
        $nama = [];
    }

    public function getDataPengajak ($nama, $id) {
        $this->nama_pengajak = $nama;
        $this->pengajak_id = $id;
    }
    public function getDataPenjamin ($nama, $id) {
        $this->nama_penjamin = $nama;
        $this->penjamin_id = $id;
    }

    public function updatedQuery () {
        $this->nama = DataPelita::where('nama_umat', 'like', '%' . $this->query . '%')
        ->get()
        ->toArray();

    }
    public function render()
    {
        return view('livewire.adddataumatiwire')
        ->extends('layouts.secondMain')
        ->section('content');
    }
}
