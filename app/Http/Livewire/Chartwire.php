<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class Chartwire extends Component
{
    public $email;
    public $open;



    public function checkEmail()
    {
        if ($this->email == Auth::user()->email) {
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
