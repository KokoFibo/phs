<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Changeprofilewire extends Component
{
    use WithPagination;
    public  $name, $email, $role, $branch_id, $kota_id, $password_confirmation, $password, $currentId, $curr_pass, $current_id;



    public function close () {
        return redirect()->route('dashboard');
    }
public function mount () {
    $mydata = User::find(Auth::user()->id);
        $this->name = $mydata->name;
        $this->email = $mydata->email;
        // $this->password = $mydata->password;
}
    public function  clear_fields() {
        // $mydata = User::find(Auth::user()->id);

        $this->name = $mydata->name;
        $this->email = $mydata->email;
        $this->password='';
        $this->curr_pass='';
        $this->password='';
        $this->password_confirmation='';
        $this->role='';
        $this->kota_id='';
        $this->branch_id='';
        $this->resetPage();
        // $this->is_edit=false;
        $this->reset();
    }

    public function updatename () {

    auth()->user()->update(['name' => $this->name]);

        // $data = User::find(Auth::user()->id);
        // $data->name = $this->name;
        // $data->save();
        // $this->clear_fields();
        $this->dispatchBrowserEvent('nameUpdated');
    }
    public function updateemail () {

        $validatedData = $this->validate([
            'email' => 'required|email',
        ]);

    auth()->user()->update(['email' => $this->email]);

        // $data = User::find(Auth::user()->id);
        // $data->email = $this->email;
        // $data->save();
        // $this->clear_fields();

        $this->dispatchBrowserEvent('emailUpdated');
    }


public function changePassword () {
    $validatedData = $this->validate([
        'curr_pass' => 'required',
        'password' => 'required|min:8|confirmed'
    ]);

    if (!Hash::check($this->curr_pass, auth()->user()->password)) {
        throw ValidationException::withMessages([
            'curr_pass' => 'Current password tidak sama dengan database kami'
        ]);
    }

    auth()->user()->update(['password' => Hash::make($this->password)]);

    // if($this->password_confirmation == $this->password){
    //     $data = User::find(Auth::user()->id);
    // $data->password = Hash::make($this->password);
    // $data->save();

    $this->dispatchBrowserEvent('passwordChanged');




}

    public function render()
    {
         $data = User::where('id', Auth::user()->id)->get();

        return view('livewire.changeprofilewire', compact(['data']))
        ->extends('layouts.main')
        ->section('content');
    }
}
