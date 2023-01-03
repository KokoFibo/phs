<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Resetpasswordwire extends Component
{
    public function  clear_fields() {
    
       
        $this->password='';
        $this->password_confirmation='';
    }
    public function cancel () {
        $this->clear_fields();
    }

    public function store () {
        // $validatedData = $this->validate();

        $this->validate([
          
            'password' => ['required','string', 'min:8', 'confirmed'],
        //  'password_confirmation'=> ['required'],
        ]);
        session()->flash('message', '');
        $data = new User();
        $data->password = Hash::make($this->password);
        $data->save();
        session()->flash('message', 'Password Reset Successfully');
        $this->clear_fields();    
        return redirect(route('main'));
    }
    public function render()
    {
        return view('livewire.resetpasswordwire');
    }
}
