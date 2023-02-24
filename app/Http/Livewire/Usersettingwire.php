<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Usersettingwire extends Component
{
    public function render()
    {
        return view('livewire.usersettingwire')
        ->extends('layouts.main')
        ->section('content');
    }
}
