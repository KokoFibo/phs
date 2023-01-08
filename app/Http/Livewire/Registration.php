<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use App\Models\User;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class Registration extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $email, $password, $role, $branch_id, $kota_id, $password_confirmation , $currentId;
    public $is_edit = false;
    public $is_reset = false;

    public function  clear_fields() {
    
        $this->name='';
        $this->email='';
        $this->password='';
        $this->password_confirmation='';
        $this->role=''; 
        $this->kota_id='';
        $this->branch_id='';
        $this->resetPage();
        $this->is_edit=false;
    }

    // public function rules () {
    //     return [
    //         'name' => ['required'],
    //          'email' => ['required', 'unique:users,email'],
    //          //Rule::unique('users')->ignore($this->user), 
    //         //  this->user  adalah model, iluminate/validation/ruleu
    //         'password' => ['required','string', 'min:8', 'confirmed'],
    //      'password_confirmation'=> ['required'],
    //         'role' => ['required'],
    //         'kota_id' => ['required'],
    //         'branch_id' => ['required']
    //     ];
    // }

    // public function updated($fields) {
    //     $this->validateOnly($fields);
    // }
    
    public function store () {
        // $validatedData = $this->validate();

        $this->validate([
            'name' => ['required'],
             'email' => ['required', 'unique:users,email'],
             //Rule::unique('users')->ignore($this->user), 
            //  this->user  adalah model, iluminate/validation/ruleu
            'password' => ['required','string', 'min:8', 'confirmed'],
         'password_confirmation'=> ['required'],
            'role' => ['required'],
            'kota_id' => ['required'],
            'branch_id' => ['required']
        ]);
        session()->flash('message', '');
        $data_user = new User();
        $data_user->name = $this->name;
        $data_user->email = $this->email;
        // $data_user->password = $this->password;
        $data_user->password = Hash::make($this->password);
        $data_user->role = $this->role;
        $data_user->kota_id = $this->kota_id;
        $data_user->branch_id = $this->branch_id;
        $data_user->save();

        // update branch is_used
        $branch = Branch::find($this->branch_id);
        $branch->branch_is_used = '1';
        $branch->save();
        session()->flash('message', 'Data Registered Successfully');
        $this->clear_fields();    
    }

    public function edit ($id) {
        $this->currentId = $id;
        $data = User::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
        $this->kota_id = $data->kota_id;
        $this->branch_id = $data->branch_id;
        $this->is_edit=true;
    }

    public function resetpassword ($id) {
        $this->currentId = $id;
        $data = User::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
        $this->kota_id = $data->kota_id;
        $this->branch_id = $data->branch_id;
        $this->is_reset=true;
    }

    public function storepassword () {
        $this->validate([
           
            'password' => ['required','string', 'min:8', 'confirmed'],
        //  'password_confirmation'=> ['required'],
           
        ]);
        session()->flash('message', '');
        $data = User::find($this->currentId);
        $data->password = Hash::make($this->password);

        $data->save();
        session()->flash('message', 'Password Reset Done');
        $this->clear_fields();    
        $this->is_reset=false;

    }

    public function update () {
        // $validatedData = $this->validate();
        $this->validate([
            'name' => ['required'],
            //   'email' => ['required', 'email', Rule::unique('users')->ignore($this->user) ],
            //   'email' => 'unique:users,email_address,'.$user->id
              'email' => 'unique:users,email,'.$this->currentId,
            
            //  this->user  adalah model, iluminate/validation/ruleu
       
            'role' => ['required'],
            'kota_id' => ['required'],
            'branch_id' => ['required']
        ]);
        session()->flash('message', '');
        $data_user = User::find($this->currentId);
        $data_user->name = $this->name;
        $data_user->email = $this->email;;
        $data_user->role = $this->role;
        $data_user->kota_id = $this->kota_id;
        $data_user->branch_id = $this->branch_id;
        $data_user->save();

        // update branch is_used
        $branch = Branch::find($this->branch_id);
        $branch->branch_is_used = '1';
        $branch->save();

        session()->flash('message', 'Data Updated Done');
        $this->clear_fields();    
        $this->is_edit=false;

    }

    public function delete ($id) {
        $data = User::find($id);
        $data->delete();
        session()->flash('message', 'Data Deleted');

    }



    public function cancel () {
        $this->clear_fields();
    }

    public function render()
    {
        $kota = Kota::orderBy('nama_kota', 'asc')->get();
        $branch = Branch::orderBy('nama_branch', 'asc')->get();

       

        $data = DB::table('users') 
        ->join('kotas', 'users.kota_id', '=', 'kotas.id')
         ->join('branches', 'users.branch_id' , '=','branches.id' )
         ->select('users.*', 'branches.nama_branch', 'kotas.nama_kota')
         ->orderBy('users.id', 'desc')->paginate(5);
      
        return view('livewire.registration', compact(['data', 'kota', 'branch']));
    }
}
