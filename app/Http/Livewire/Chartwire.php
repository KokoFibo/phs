<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;

class Chartwire extends Component
{
    public $selectedGroupVihara, $selectedDaftarKelasId, $openchart, $dataXjson, $dataYjson, $dataPeserta, $dataYjsonPeserta;
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
            $totalPesertaKelasTerakhir = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('datapelita_id')->orderBy('tgl_kelas', 'desc')->get();
            $vtotal = 0;
            $sd3h = 0;
            $belumKeduanya = 0;

            foreach($totalPesertaKelasTerakhir as $t){
                $data = DataPelita::find($t->datapelita_id);

                if($data->tgl_sd3h != null && $data->tgl_vtotal == null){
                    $sd3h++;
                } elseif($data->tgl_sd3h != null && $data->tgl_vtotal != null) {
                    $vtotal++;
                } else {
                    $belumKeduanya++;
                }
            }

            $this->dataPeserta = [$vtotal, $sd3h, $belumKeduanya];




        } catch (\Exception $e) {
            return $e->getMessage();
        }



        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        $this->dataYjsonPeserta = json_encode($this->dataPeserta);


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

            $totalPesertaKelasTerakhir = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('datapelita_id')->orderBy('tgl_kelas', 'desc')->get();
            $vtotal = 0;
            $sd3h = 0;
            $belumKeduanya = 0;

            foreach($totalPesertaKelasTerakhir as $t){
                $data = DataPelita::find($t->datapelita_id);

                if($data->tgl_sd3h != null && $data->tgl_vtotal == null){
                    $sd3h++;
                } elseif($data->tgl_sd3h != null && $data->tgl_vtotal != null) {
                    $vtotal++;
                } else {
                    $belumKeduanya++;
                }
            }

            $this->dataPeserta = [$vtotal, $sd3h, $belumKeduanya];

        } catch (\Exception $e) {
             return $e->getMessage();
        }

        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        $this->dataYjsonPeserta = json_encode($this->dataPeserta);

        $this->emit('berhasilUpdate',['dataXjson' => $this->dataXjson ,'dataYjson'=> $this->dataYjson, 'dataYjsonPeserta' => $this->dataYjsonPeserta ]);
    }


    public function render()
    {
        $groupvihara = Groupvihara::all();
        $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();

        return view('livewire.chartwire', compact(['groupvihara', 'daftarkelas']))
        ->extends('layouts.polos')
            ->section('content');
    }
}
