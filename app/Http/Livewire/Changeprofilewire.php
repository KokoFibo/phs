<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Auth;

class Changeprofilewire extends Component
{
    public $name, $email, $password, $current_id;
    public function render()
    {
        $data = User::find(Auth::user()->id);
        $this->name = $data->name;
        $this->email = $data->email;
        return view('livewire.changeprofilewire')
        ->extends('layouts.main')
        ->section('content');
    }
}
