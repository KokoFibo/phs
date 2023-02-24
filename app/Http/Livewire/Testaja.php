<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Groupvihara;

class Testaja extends Component
{
    public $selectedBranch, $selectedGroup;

    public function render()
    {
        // $gabung = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        // ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        //  ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        // ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        // ->where('groupviharas.id', 2)->get();

        $branch = Branch::all();
        $groupvihara = GroupVihara::all();

        // $total = GroupVihara::with(['branch'])
        // ->withCount('datapelita')
        // ->where('id',$this->selectedGroup)
        // ->get();

        // $umatYTD = DataPelita::where('branch_id',$this->selectedBranch)->whereYear('tgl_mohonTao', '=', getYear())->count();
        // // $totalUmat = GroupVihara::with(['branch','datapelita'])->where('id',$this->selectedGroup)->withCount('datapelita')->get();
        // $totalUmat = Datapelita::with(['groupVihara','branch'])->where('groupvihara.id',$this->selectedGroup)->count();

        $totalpergroup = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        // ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id', '=', 'panditas.id')
        // ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->select('data_pelitas.*')
        ->when($this->selectedGroup, function($query){
            $query->where('groupviharas.id',$this->selectedGroup);
        })
        ->when($this->selectedBranch, function($query){
            $query->where('groupviharas.id',$this->selectedBranch);
        })
        ->count();



        $umatYTDpergroup = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        ->select('data_pelitas.*')
        ->when($this->selectedGroup, function($query){
            $query->where('groupviharas.id',$this->selectedGroup);
        })
        ->when($this->selectedBranch, function($query){
            $query->where('groupviharas.id',$this->selectedBranch);
        })
        ->whereYear('tgl_mohonTao', '=', getYear())->count();




        return view('livewire.testaja', compact(['branch', 'groupvihara', 'totalpergroup', 'umatYTDpergroup']))
            ->extends('layouts.app1')
            ->section('content');
    }
}
