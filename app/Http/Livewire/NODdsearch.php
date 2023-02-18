<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DataPelita;

class Ddsearch extends Component
{
    public $query;
    public $contacts;
    public $highLightIndex;

    public function mount () {
        $this->reset1();
    }

    public function reset1() {
        $this->query = "";
        $this->contacts = [];
        $this->highLightIndex = 0;
    }

    public function incrementHighlight () {

        if ($this->highLightIndex === count($this->contacts) - 1) {
            $this->highLightIndex = 0;
            return;
        }
        $this->highLightIndex++;
    }
    public function decrementHighlight () {

        if ($this->highLightIndex === 0) {
            $this->highLightIndex = count($this->contacts) - 1;
            return;
        }
        $this->highLightIndex--;
    }

    public function selectContact () {
        $contact = $this->contacts[$this->highLightIndex] ?? null;
        if($contact) {
            $this->redirect(route('adddata', $contact['id']));
        }
    }

    public function updatedQuery () {
        $this->contacts = DataPelita::where('nama_umat', 'like', '%' . $this->query . '%' )->get()->toArray();
    }




    public function render()
    {
        return view('livewire.ddsearch');
    }
}
