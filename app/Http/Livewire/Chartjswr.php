<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use Livewire\Component;

class Chartjswr extends Component
{
    public $dataAbsensi;
    public $selected = 1;
    public $data;

    public function mount () {
        $this->updateAbsensi();

    }

    public function updateAbsensi () {

            $absensi = Absensi::where('daftarkelas_id',$this->selected)->get();
            foreach($absensi as $a){
                $data['label'][] = $a->tgl_kelas;
                $data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($data);

    }
    public function updatedSelected () {
        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);

    }
    public function ubahChart () {


            $this->updateAbsensi();
            $this->emit('updatedata', ['data' => $this->dataAbsensi]);

    }

    public function render()
    {
        return view('livewire.chartjswr')->extends('layouts.main')->section('content');
    }
}
