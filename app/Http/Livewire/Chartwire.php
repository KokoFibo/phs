<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Chartwire extends Component
{
    public $pswd;
    public $open;

    public function checkPassword()
    {
        if (Hash::check($this->pswd, Auth::user()->password)) {
                $this->open = 1;
        } else {
                $this->open = 0;
        }
    }


    public function render()
    {

        return view('livewire.chartwire')
            ->extends('layouts.main')
            ->section('content');
    }
}
