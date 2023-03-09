<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Models\DataPelita;
use Illuminate\Support\Facades\Hash;

class Chartwire extends Component
{



    public function render()
    {
        $datapelita = DataPelita::paginate(5);
        return view('livewire.chartwire', compact('datapelita'))
            ->extends('layouts.main')
            ->section('content');
    }
}
