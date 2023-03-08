<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Chartwire extends Component
{

public $ok;

    public function render()
    {

        return view('livewire.chartwire')
            ->extends('layouts.main')
            ->section('content');
    }
}
