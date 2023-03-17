<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use App\Models\User;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Groupvihara;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Registration extends Component
{
    use WithPagination;

    public $name, $email, $password, $role, $branch_id, $groupvihara_id,  $kota_id, $password_confirmation, $currentId;
    public $is_edit = false;
    public $is_reset = false;
    protected $listeners = ['delete'];

    public function clear_fields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->kota_id = '';
        $this->branch_id = '';
        $this->groupvihara_id = '';
        $this->resetPage();
        $this->is_edit = false;
        $this->is_reset = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function store()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'role' => ['required'],
            'kota_id' => ['required'],
            'branch_id' => ['required'],
            'groupvihara_id' => ['required'],
        ]);
        session()->flash('message', '');
        $data_user = new User();
        $data_user->name = $this->name;
        $data_user->email = $this->email;
        $data_user->password = Hash::make($this->password);
        $data_user->role = $this->role;
        $data_user->kota_id = $this->kota_id;
        $data_user->branch_id = $this->branch_id;
        $data_user->groupvihara_id = $this->groupvihara_id;
        $data_user->save();

        // update branch is_used
        $branch = Branch::find($this->branch_id);
        $branch->branch_is_used = '1';
        $branch->save();
        // session()->flash('message', 'Data Registered Successfully');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Saved']);
        $this->clear_fields();
    }

    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_reset = false;

        $this->currentId = $id;
        $data = User::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
        $this->kota_id = $data->kota_id;
        $this->branch_id = $data->branch_id;
        $this->groupvihara_id = $data->groupvihara_id;
    }

    public function resetpassword($id)
    {

        $this->is_reset = true;
        $this->is_edit = false;

        $this->currentId = $id;
        $data = User::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function storepassword()
    {
        $validatedData = $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $data = User::find($this->currentId);
        $data->password = Hash::make($this->password);
        $data->save();
        $this->clear_fields();
        $this->is_reset = false;
        $this->is_edit = false;
        // $this->dispatchBrowserEvent('passwordChanged');
        $this->dispatchBrowserEvent('success', ['message' => 'Password sudah di update']);

    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email,' . $this->currentId,
            'role' => 'required',
            'kota_id' => 'required',
            'branch_id' => 'required',
            'groupvihara_id' => 'required',
        ]);

        session()->flash('message', '');
        $data_user = User::find($this->currentId);
        $data_user->name = $this->name;
        $data_user->email = $this->email;
        $data_user->role = $this->role;
        $data_user->kota_id = $this->kota_id;
        $data_user->branch_id = $this->branch_id;
        $data_user->groupvihara_id = $this->groupvihara_id;
        $data_user->save();

        // update branch is_used
        $branch = Branch::find($this->branch_id);
        $branch->branch_is_used = '1';
        $branch->save();

        $group = GroupVihara::find($this->groupvihara_id);
        $group->group_is_used = '1';
        $group->save();

        // $this->dispatchBrowserEvent('updated');
        $this->dispatchBrowserEvent('success', ['message' => 'User Data sudah di update']);

        $this->clear_fields();
        $this->is_edit = false;
        $this->is_reset = false;
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        $this->dispatchBrowserEvent('deleted');
    }

    public function deleteConfirmation($id)
    {
        $data = User::find($id);
        $nama = $data->name;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
            'text' => 'Data : ' . $nama,
            'icon' => 'warning',
            'id' => $id,
        ]);
    }

    public function close()
    {
        return redirect()->route('dashboard');
    }

    public function cancel()
    {
        $this->is_reset = false;
        $this->is_edit = false;
        $this->clear_fields();
    }

    public function render()
    {
        $kota = Kota::orderBy('nama_kota', 'asc')->get();
        $branch = Branch::where('groupvihara_id', $this->groupvihara_id)->orderBy('nama_branch', 'asc')->get();
        $group = Groupvihara::orderBy('nama_group', 'asc')->get();

        $data = DB::table('users')
            ->join('kotas', 'users.kota_id', '=', 'kotas.id')
            ->join('branches', 'users.branch_id', '=', 'branches.id')
            ->join('groupviharas', 'users.groupvihara_id', '=', 'groupviharas.id')
            ->select('users.*', 'branches.nama_branch', 'kotas.nama_kota', 'groupviharas.nama_group')
            ->orderBy('users.id', 'desc')
            ->paginate(10);

        return view('livewire.registration', compact(['data', 'kota', 'branch', 'group']))
            ->extends('layouts.main')
            ->section('content');
    }
}
