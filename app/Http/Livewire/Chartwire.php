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

        return view('livewire.chartwire')
            ->extends('layouts.maintest')
            ->section('content');
    }
}
