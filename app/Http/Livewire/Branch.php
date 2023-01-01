<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use Livewire\Component;
use Livewire\WithPagination;

class Branch extends Component
{
    public $kota_id, $nama_branch, $kode_branch;
    use WithPagination;

    public function rules () {

        return [
            'kota_id' => ['required'],
            'nama_branch' => ['required'],
            'kode_branch' => ['required'],
           
        ];

    }

    public function store () {
    }

    public function render()
    {
        $kota = Kota::orderBy('nama_kota', 'asc')->get();
        return view('livewire.branch', compact('kota'));
    }
}
