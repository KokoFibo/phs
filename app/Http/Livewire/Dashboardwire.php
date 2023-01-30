<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Illuminate\Support\Facades\DB;


class Dashboardwire extends Component
{
    public function render()
    {
        $thisYear = getYear();
        $totalUmat = DataPelita::count();
        // $umatActive = DataPelita::where('status','Active')->count();
        $umatInactive = DataPelita::where('status','Inactive')->count();
        $umatActive = $totalUmat -  $umatInactive;
        $umatYTD = DataPelita::where(DB::raw('YEAR(tgl_mohonTao)'), '=', $thisYear)->count();
        $totalPandita = Pandita::all()->count();
        $totalBranch = Branch::all()->count();
        $totalUsers = User::all()->count();


        return view('livewire.dashboardwire', compact(['totalUmat', 'umatActive', 'umatInactive', 'umatYTD','totalPandita', 'totalBranch', 'totalUsers']))
        ->extends('layouts.main')
        ->section('content');
    }
}
