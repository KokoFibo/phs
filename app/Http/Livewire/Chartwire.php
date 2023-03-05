<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use Livewire\Component;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;

class Chartwire extends Component
{
    public $selectedGroupVihara, $selectedDaftarKelasId, $openchart, $dataXjson, $dataYjson;
    public $dataX = [], $dataY = [];

    public function mount () {
        $this->selectedGroupVihara =1;
        $this->selectedDaftarKelasId =2;
        // $this->openchart=false;

        // $dataX = [];
        // $dataY = [];

        $groupvihara = Groupvihara::all();
        $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();

        try {
            $absensiDataX = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
             $absensiDataY = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
            foreach($absensiDataX as $a) {
                $this->dataX[] = $a->tgl_kelas;
            }

            for( $i = 0; $i < count($this->dataX); $i++) {
                $this->dataY[] = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)
                    ->where('tgl_kelas', $this->dataX[$i])
                    ->where('absensi','1')
                    ->select('absensi')
                    ->count();
            }
        } catch (\Exception $e) {
             return $e->getMessage();
        }

        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        // dd($this->dataXjson);


    }

    public function updateChart () {
        // $this->selectedGroupVihara ='';
        // $this->selectedDaftarKelasId ='';
        $dataX = [];
        $dataY = [];
        $this->dataXjson = '';
        $this->dataYjson = '';
        $this->dataX = [];
        $this->dataY = [];
        // $groupvihara = Groupvihara::all();
        // $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();
        try {
            $absensiDataX = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
             $absensiDataY = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
            foreach($absensiDataX as $a) {
                $this->dataX[] = $a->tgl_kelas;
            }

            for( $i = 0; $i < count($this->dataX); $i++) {
                $this->dataY[] = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)
                    ->where('tgl_kelas', $this->dataX[$i])
                    ->where('absensi','1')
                    ->select('absensi')
                    ->count();
            }
        } catch (\Exception $e) {
             return $e->getMessage();
        }

        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        $this->emit('berhasilUpdate',['dataXjson' => $this->dataXjson ,'dataYjson'=> $this->dataYjson]);
    }


    public function render()
    {
        $groupvihara = Groupvihara::all();
        $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();

        return view('livewire.chartwire', compact(['groupvihara', 'daftarkelas']))
        ->extends('layouts.main')
            ->section('content');
    }
}
