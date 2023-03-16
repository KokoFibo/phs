<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use Livewire\Component;

class Chartabsensiwr extends Component
{
    public $dataAbsensi;
    public $selectedKelasId = 1;
    protected $listeners = ['berubah' => 'render'];

    public function render()
    {
        $absensi = Absensi::where('daftarkelas_id',$this->selectedKelasId)->get();
        foreach($absensi as $a){
            $data['label'][] = $a->tgl_kelas;
            $data['data'][] = $a->jumlah_peserta;
        }
        $this->dataAbsensi = json_encode($data);
        return view('livewire.chartabsensiwr')->extends('layouts.main')->section('content');
    }
}
