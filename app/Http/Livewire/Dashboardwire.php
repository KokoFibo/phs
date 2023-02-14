<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class Dashboardwire extends Component
{
    public $selectedBranch;
    public $selectedDaftarKelas_id = [];
    public $totalUmat_sp;

    public function mount () {
        $this->selectedBranch=null;
    }

    public function updatedSelectedBranch () {
        $this->totalUmat_sp = DataPelita::where('branch_id',$this->selectedBranch)->count();
        $daftarkelas = Daftarkelas::where('branch_id',$this->selectedBranch)->get();
        $this->selectedDaftarKelas_id=[];
        foreach($daftarkelas as $dk) {
            $this->selectedDaftarKelas_id = Arr::prepend($this->selectedDaftarKelas_id, $dk->id);
        }


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
