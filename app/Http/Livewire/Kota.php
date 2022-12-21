<?php

namespace App\Http\Livewire;

use App\Models\Regency;
use Livewire\Component;
use App\Models\Province;
 
class Kota extends Component
{
     public $province, $regency;
     public $selectedProvince = NULL;
     public $selectedRegency = NULL;

    public function mount () {
        
         $this->province = Province::all();
         $this->regency = collect();

    }
    public function render()
    {
         

        return view('livewire.kota');
    }

    public function updatedSelectedProvince ($province) {
        $this->regency = Regency::where('province_id', $province)->get();
        $this->selectedRegency = NULL;
    }
}
