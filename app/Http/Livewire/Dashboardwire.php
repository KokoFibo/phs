<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
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
    public $selected  ;
    // dari sini
    public $selectedBranch;
    public $selectedDaftarKelas_id = [];
    public $selectedKelasId;
    public $totalUmat_sp;
    public  $daftarKelasIdUpdate=2, $daftarkelas=[];
    public $data, $years;
    // public $is_absensi = false;

    // $now = Carbon::now();
    //     $tahun = $now->year;
    // public $selectedYear = date('Y', strtotime($tgl));
    public $selectedYear;

    public function mount () {
            // $absensi = Absensi::all();
            // $daftarkelas = DaftarKelas::all();
            // $kelas = Kelas::all();
            // if($absensi == null || $daftarkelas == null | $kelas == null){

            //     $this->is_absensi = false;
            // }
            // else {
            //     $this->is_absensi = true;

            // }

        if(Auth::user()->role != 3) {
            $this->selectedBranch=Auth::user()->branch_id;
        } else {
            $this->selectedBranch=null;
        }
        $this->selected = Auth::user()->branch_id;

        $this->isiPilihKelas ();
        $this->selectedYear = date('Y');
        $this->updateAbsensi();
        $this->getYears();

    }

    public function updateAbsensi () {

        if ($this->selectedYear == null) {
            $this->selectedYear = date('Y');
        }
        if($this->selected == null) {
            $this->selected = 1;

        }

        $this->dataAbsensi = null;
        $absensi = Absensi::query()
        ->whereYear('tgl_kelas',$this->selectedYear)
        ->orderBy('tgl_kelas', 'asc')
        ->where('daftarkelas_id',$this->selected)
        ->get();
        if($this->dataAbsensi != null) {

            foreach($absensi as $a){
                $data['label'][] = $a->tgl_kelas;
                $data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($data);
        }
}

    public function kirimId($daftarKelasId)  {
        $this->daftarKelasIdUpdate = $daftarKelasId;
    }

    public function updatedSelectedBranch () {
        try {

            $dataPertama = Daftarkelas::where('branch_id', $this->selectedBranch)->first();
            // dd($dataPertama->id);
            $this->selected = $dataPertama->id;
            $this->selectedYear = date('Y');
            $this->getYears();

            $this->totalUmat_sp = DataPelita::where('branch_id',$this->selectedBranch)->count();

            $this->isiPilihKelas ();
        } catch (\Exception $e) {
            // return 'Nama Cetya Tidak Ada Dalam Database';
              return $e->getMessage();
          }




    }
    public function isiPilihKelas () {
        $this->daftarkelas = Daftarkelas::where('branch_id',$this->selectedBranch)->get();
        $this->selectedDaftarKelas_id=[];
        foreach($this->daftarkelas as $dk) {
            $this->selectedDaftarKelas_id[] =  $dk->id;
        }

    }
    public function updatedSelectedKelasId () {
        $absensi = Absensi::where('daftarkelas_id',$this->selectedKelasId)->get();
        if($this->data != null) {

            foreach($absensi as $a){
                $this->data['label'][] = $a->tgl_kelas;
                $this->data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($this->data);
            $this->emit('berubah', $this->selectedKelasId);
        }
    }

    public function tampilchart () {
if($this->dataAbsensi != null){

    $absensi = Absensi::where('daftarkelas_id',$this->selectedKelasId)->get();
    foreach($absensi as $a){
        $this->data['label'][] = $a->tgl_kelas;
        $this->data['data'][] = $a->jumlah_peserta;
    }
    $this->dataAbsensi = json_encode($this->data);
}
    }
    public function updatedSelected () {


        $this->getYears();
        $this->selectedYear = date('Y');
        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);

    }
    public function updatedSelectedYear () {
        $this->getYears();

        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);

    }
    public function getYears () {
        $this->years = Absensi::orderBy('tgl_kelas','asc')->where('daftarkelas_id',$this->selected)->distinct()->get([DB::raw('YEAR(tgl_kelas) as year')]);

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

        // $tahun = Absensi::distinct()->get(['tgl_kelas']);
        // $years = Absensi::orderBy('tgl_kelas','asc')->where('daftarkelas_id',$this->selected)->whereNotNull('tgl_kelas')->distinct()->get([DB::raw('YEAR(tgl_kelas) as year')]);



        return view('livewire.dashboardwire', compact(['totalUmat', 'umatActive', 'umatInactive', 'umatYTD','totalPandita',
        'totalBranch', 'totalUsers', 'sd3h','vtotal', 'branch']))
        ->extends('layouts.main')
        ->section('content');



    }
}
