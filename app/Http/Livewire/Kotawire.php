<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use Livewire\Component;
use App\Models\Namakota;
use App\Models\Propinsi;
use Livewire\WithPagination;

// use Livewire\Component;

class KotaWire extends Component
{ 
    public $propinsi, $namakota;
    public $selectedPropinsi = NULL;
    public $selectedNamaKota = NULL;
    public $nama;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount  () {
        $this->propinsi = Propinsi::all();
        $this->namakota = collect();
        
    }
    // public function rules () {
    //     return [
    //         'kota' => ['unique'],
    //         'kota' => ['unique:kota, kota'],

    //     ];
    // }

    // public function updated($fields) {
    //     $this->validateOnly($fields);
    // }

    public function updatedSelectedPropinsi ($propinsi) {
        $this->namakota = Namakota::where('propinsi_id', $propinsi)->get();
        $this->selectedNamaKota = NULL;
    }

    protected $rules = [
             'nama' => 'unique:kotas,nama',

    ];

    public function store () {
        // $validatedData = $this->validate();
         $this->validate();
        $data_kota = new Kota();
        $data_kota->nama = $this->nama;
        $data_kota->save();
    }
    
    public function delete ($id) {

        $data = Kota::find($id);
        $data->delete();

    }


    public function render()
    {
        // $this->selectedPropinsi = NULL;
        // $this->selectedNamaKota = NULL;
        $kota = Kota::orderBy('nama', 'asc')->paginate(10);
        return view('livewire.kotawire', compact('kota'));
    }
}