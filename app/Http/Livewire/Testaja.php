<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Groupvihara;


class Testaja extends Component
{
    public $selectedGroup, $selectedBranch;

    public function updatedSelectedGroup () {
        $this->selectedBranch = '';
    }
    public function updatedSelectedBranch () {
        $this->selectedGroup = '';
    }

    public function render()
    {
        $group = Groupvihara::all();
        $vihara = Branch::all();
        if($this->selectedGroup){
            $dataUmatAktif = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->select('data_pelitas.*')
            ->where('groupviharas.id', $this->selectedGroup)
            ->where('data_pelitas.status', 'Active')
            ->count();
            $dataUmatTidakAktif = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->select('data_pelitas.*')
            ->where('groupviharas.id', $this->selectedGroup)
            ->where('data_pelitas.status', 'Inactive')
            ->count();

            $umatYTD = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->select('data_pelitas.*')
            ->where('groupviharas.id', $this->selectedGroup)
            ->whereYear('data_pelitas.tgl_mohonTao', '=', getYear())
            ->count();

        } elseif ($this->selectedBranch) {

            $dataUmatAktif = DataPelita::where('status','Active')->where('branch_id',$this->selectedBranch)->count();
            $dataUmatTidakAktif = DataPelita::where('status','Inactive')->where('branch_id',$this->selectedBranch)->count();
            $umatYTD = DataPelita::where('branch_id',$this->selectedBranch)->whereYear('data_pelitas.tgl_mohonTao', '=', getYear())->count();
        } else {

            $dataUmatAktif = DataPelita::where('status','Active')->count();
            $dataUmatTidakAktif = DataPelita::where('status','Inactive')->count();
            $umatYTD = DataPelita::whereYear('data_pelitas.tgl_mohonTao', '=', getYear())->count();
        }
        $totalUmat = $dataUmatAktif + $dataUmatTidakAktif;
        return view('livewire.testaja', compact(['group', 'vihara', 'dataUmatAktif', 'dataUmatTidakAktif', 'totalUmat', 'umatYTD']))
            ->extends('layouts.app1')
            ->section('content');
    }
}
