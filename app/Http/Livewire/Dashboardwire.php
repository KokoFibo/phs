<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Absensi;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class Dashboardwire extends Component
{
    public $dataAbsensi;
    public $selected = 1;
    // dari sini
    public $selectedBranch;
    public $selectedDaftarKelas_id = [];
    public $selectedKelasId;
    public $totalUmat_sp;
    public  $daftarKelasIdUpdate=2, $daftarkelas=[];
    public $data;

    public function mount () {
        $this->selectedBranch=null;
        $this->updateAbsensi();

    }

    public function updateAbsensi () {
        $this->dataAbsensi = null;
        $absensi = Absensi::where('daftarkelas_id',$this->selected)->get();
        foreach($absensi as $a){
            $data['label'][] = $a->tgl_kelas;
            $data['data'][] = $a->jumlah_peserta;
        }
        $this->dataAbsensi = json_encode($data);
}

    public function kirimId($daftarKelasId)  {
        $this->daftarKelasIdUpdate = $daftarKelasId;
    }

    public function updatedSelectedBranch () {
        $this->totalUmat_sp = DataPelita::where('branch_id',$this->selectedBranch)->count();

        $this->daftarkelas = Daftarkelas::where('branch_id',$this->selectedBranch)->get();
        $this->selectedDaftarKelas_id=[];
        foreach($this->daftarkelas as $dk) {
            $this->selectedDaftarKelas_id[] =  $dk->id;
        }

    }
    public function updatedSelectedKelasId () {
        $absensi = Absensi::where('daftarkelas_id',$this->selectedKelasId)->get();
        foreach($absensi as $a){
            $this->data['label'][] = $a->tgl_kelas;
            $this->data['data'][] = $a->jumlah_peserta;
        }
        $this->dataAbsensi = json_encode($this->data);
        $this->emit('berubah', $this->selectedKelasId);
    }

    public function tampilchart () {

        $absensi = Absensi::where('daftarkelas_id',$this->selectedKelasId)->get();
        foreach($absensi as $a){
            $this->data['label'][] = $a->tgl_kelas;
            $this->data['data'][] = $a->jumlah_peserta;
        }
        $this->dataAbsensi = json_encode($this->data);
    }
    public function updatedSelected () {

        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);

    }

    public function render()
    {




        if($this->selectedBranch == null){
            $thisYear = getYear();
            $totalUmat = DataPelita::count();
            // $umatActive = DataPelita::where('status','Active')->count();
            $umatInactive = DataPelita::where('status','Inactive')->count();
            $umatActive = $totalUmat -  $umatInactive;
            $umatYTD = DataPelita::where(DB::raw('YEAR(tgl_mohonTao)'), '=', $thisYear)->count();
            $totalPandita = Pandita::all()->count();
            $totalBranch = Branch::all()->count();
            $totalUsers = User::all()->count();
            $sd3h = DataPelita::where('tgl_sd3h','!=', null)->count();
            $vtotal = DataPelita::where('tgl_vtotal','!=', null)->count();
            $branch = Branch::all();

        } else {
            $thisYear = getYear();
            $totalUmat = DataPelita::where('branch_id',$this->selectedBranch)->count();
            $umatInactive = DataPelita::where('status','Inactive')->count();
            $umatActive = $totalUmat -  $umatInactive;
            // $umatYTD = DataPelita::where(DB::raw('YEAR(tgl_mohonTao)'), '=', $thisYear)->count();
            $umatYTD = DataPelita::where('branch_id',$this->selectedBranch)->whereYear('tgl_mohonTao', '=', $thisYear)->count();
            $totalPandita = Pandita::all()->count();
            $totalBranch = Branch::all()->count();
            $totalUsers = User::all()->count();
            $sd3h = DataPelita::where('branch_id',$this->selectedBranch)->where('tgl_sd3h','!=', null)->count();
            $vtotal = DataPelita::where('branch_id',$this->selectedBranch)->where('tgl_vtotal','!=', null)->count();
            $branch = Branch::all();
        }


        return view('livewire.dashboardwire', compact(['totalUmat', 'umatActive', 'umatInactive', 'umatYTD','totalPandita',
        'totalBranch', 'totalUsers', 'sd3h','vtotal', 'branch']))
        ->extends('layouts.main')
        ->section('content');



    }
}
