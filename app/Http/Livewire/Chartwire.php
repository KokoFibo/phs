<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Branch;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Groupvihara;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;


class Chartwire extends Component
{




    public function render()
    {



        return view('livewire.chartwire')
            ->extends('layouts.main')
            ->section('content');
    }
}
