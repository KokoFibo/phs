<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Usersetting;


class Testaja extends Component
{

    public function render()
    {
        $usersetting = Usersetting::where('user_id', 1)->get()->toArray();

        return view('livewire.testaja', compact('usersetting'))
            ->extends('layouts.app1')
            ->section('content');
    }
}
