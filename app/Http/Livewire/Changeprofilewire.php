<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Changeprofilewire extends Component
{
    use WithPagination;
    public  $name, $email, $password, $role, $branch_id, $kota_id, $password_confirmation, $new_password, $currentId, $curr_pass, $current_id;

    public function close () {
        return redirect()->route('main');
    }
public function mount () {
    $mydata = User::find(Auth::user()->id);
        $this->name = $mydata->name;
        $this->email = $mydata->email;
        $this->password = $mydata->password;
}
    public function  clear_fields() {
        $mydata = User::find(Auth::user()->id);

        $this->name = $mydata->name;
        $this->email = $mydata->email;
        $this->password='';
        $this->curr_pass='';
        $this->new_password='';
        $this->password_confirmation='';
        $this->role='';
        $this->kota_id='';
        $this->branch_id='';
        $this->resetPage();
        // $this->is_edit=false;
        $this->reset();
    }

    public function updatename () {
        $data = User::find(Auth::user()->id);
        $data->name = $this->name;
        $data->save();
        $this->clear_fields();
        $this->dispatchBrowserEvent('nameUpdated');
    }
    public function updateemail () {
        $data = User::find(Auth::user()->id);
        $data->email = $this->email;
        $data->save();
        $this->clear_fields();

        $this->dispatchBrowserEvent('emailUpdated');
    }


public function changePassword () {
    if (Hash::check($this->curr_pass, $this->password)) {
        if($this->password_confirmation == $this->new_password){
            $data = User::find(Auth::user()->id);
        $data->password = Hash::make($this->new_password);
        $data->save();
        $this->dispatchBrowserEvent('passwordChanged');
        }
    }
}

    public function render()
    {
         $data = User::where('id', Auth::user()->id)->get();

        return view('livewire.changeprofilewire', compact(['data']))
        ->extends('layouts.main')
        ->section('content');
    }
}
