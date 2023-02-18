<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Livewire\Component;
use Auth;

class Branchname extends Component
{
    public function render()
    {
        $nama = Branch::find(Auth::user()->branch_id);

        return view('livewire.branchname', compact('nama'));
    }
}
