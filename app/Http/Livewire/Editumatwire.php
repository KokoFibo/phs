<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Illuminate\Support\Str;

class Editumatwire extends Component
{

    public $nama, $query,  $nama_pengajak, $nama_penjamin, $kode_branch, $current_id;
    public $nama_umat, $nama_alias, $mandarin,  $tgl_lahir, $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $tgl_sd3h, $tgl_vtotal, $pandita_id, $pengajak_id, $penjamin_id, $pengajak, $penjamin, $status, $branch_id;
    public $umur_sekarang;
    protected $rules = [
        'nama_umat' => 'required',
        'nama_alias' => 'nullable',
        'mandarin' => 'nullable',
        'gender' => 'required',


        'tgl_mohonTao' => 'required|date|before_or_equal:tgl_mohonTao',
        'alamat' => 'required',
        'kota_id' => 'required',
        'telp' => 'nullable|min_digits:9|max_digits:13',
        'hp' => 'nullable|min_digits:9|max_digits:13',
        'email' => 'nullable|email',
        'pengajak_id' => 'required',
        'pengajak' => 'required',
        'penjamin_id' => 'required',
        'penjamin' => 'required',
        'pandita_id' => 'required',
        'tgl_mohonTao' => 'nullable|date|before:tomorrow',
        'tgl_sd3h' => 'nullable|date|after_or_equal:tgl_mohonTao|before:tomorrow',
        'tgl_vtotal' => 'nullable|date|after_or_equal:tgl_sd3h|before:tomorrow|prohibited_if:tgl_sd3h,=,null',
        'status' => 'nullable',
];

public function updated($fields) {
        $this->validateOnly($fields);
}

    public function mount ($current_id) {
        $this->current_id = $current_id;
        $data = DataPelita::find($this->current_id);
         $this->branch_id = $data->branch_id;
          $this->nama_umat = $data->nama_umat;
          $this->nama_alias = $data->nama_alias;
          $this->mandarin = $data->mandarin;
          $this->gender = $data->gender;
          $this->tgl_lahir = $data->tgl_lahir;
          $this->umur_sekarang = $data->umur_sekarang;
          $this->alamat = $data->alamat;
          $this->kota_id = $data->kota_id;
          $this->telp = $data->telp;
          $this->hp = $data->hp;
          $this->email = $data->email;
          $this->pengajak_id = $data->pengajak_id;
          $this->pengajak = $data->pengajak;
        //   $this->nama_pengajak = getName($data->pengajak_id);
          $this->penjamin_id = $data->penjamin_id;
          $this->penjamin = $data->penjamin;
        //   $this->nama_penjamin = getName($data->penjamin_id);
          $this->pandita_id = $data->pandita_id;
          $this->tgl_mohonTao = $data->tgl_mohonTao;
          $this->tgl_sd3h = $data->tgl_sd3h;
          $this->tgl_vtotal = $data->tgl_vtotal;
        $this->status = $data->status;

        $query = "";
        $nama = [];

    }



    public function getDataPengajak ($nama, $id) {
        $this->pengajak = $nama;
        $this->pengajak_id = $id;
    }
    public function getDataPenjamin ($nama, $id) {
        $this->penjamin = $nama;
        $this->penjamin_id = $id;
    }
    public function updatedQuery () {
        $this->nama = DataPelita::where('nama_umat', 'like', '%' . $this->query . '%')
        ->get()
        ->toArray();
    }


    public function update () {
        $validatedData = $this->validate();
        session()->flash('message', '');


        $data_umat = DataPelita::find($this->current_id);


        $data_umat->nama_umat = Str::title($this->nama_umat);
        $data_umat->nama_alias = Str::title($this->nama_alias);


        $data_umat->mandarin = $this->mandarin;
        $data_umat->gender = $this->gender;
        $data_umat->tgl_lahir = $this->tgl_lahir;
        $data_umat->umur_sekarang = hitungUmurSekarang($this->tgl_lahir);
        $data_umat->alamat = $this->alamat;
        $data_umat->kota_id = $this->kota_id;
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        $data_umat->pengajak_id = $this->pengajak_id;
        $data_umat->pengajak = $this->pengajak;
        $data_umat->penjamin_id = $this->penjamin_id;
        $data_umat->penjamin = $this->penjamin;
        $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = $this->tgl_mohonTao;

        $data_umat->tgl_sd3h = empty($this->tgl_sd3h) ?  null : $this->tgl_sd3h;
        $data_umat->tgl_vtotal = empty($this->tgl_vtotal) ?  null : $this->tgl_vtotal;




        $data_umat->status = $this->status;



        $data_umat->save();

         // update data kota_is_Used
         $data_kota = Kota::find($this->kota_id);
         $data_kota->kota_is_used = true;
         $data_kota->save();


         // update data Pandita_is_Used
         $data_pandita = Pandita::find($this->pandita_id);
         $data_pandita->pandita_is_used = true;
         $data_pandita->save();

         // update data branch_is_Used
         $data_branch = Branch::find($this->branch_id);
         $data_branch->branch_is_used = true;
         $data_branch->save();

         // update data Nama pengajak dan Penjamin
        $data = DataPelita::all();
        foreach($data as $d ){
            $d->pengajak = getName($d->pengajak_id);
            $d->penjamin = getName($d->penjamin_id);
            $d->save();
        }

        session()->flash('message', 'Data Umat Sudah di update');
    $this->dispatchBrowserEvent('updated');

        // $this->dispatchBrowserEvent('updated', [
        //     'title' => 'Data Updated'
        // ]);

        $this->clear_fields();



        $this->redirect(route("main"));

    }
    public function  clear_fields() {

        // $this->branch_id= $this->defaultBranch_id;
        $this->nama_umat='';
        $this->nama_alias='';
        $this->mandarin='';
        $this->gender='';
        $this->tgl_lahir='';
        $this->umur_sekarang='';
        $this->alamat='';
        $this->kota_id='';
        $this->telp='';
        $this->hp='';
        $this->email='';
        $this->pengajak_id='';
        $this->pengajak='';
        $this->penjamin_id='';
        $this->penjamin='';
        $this->pandita_id='';
        $this->tgl_mohonTao='';
        $this->tgl_sd3h='';
        $this->tgl_vtotal='';
    }

    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();
        return view('livewire.editumatwire', compact(['datapandita', 'datakota']))
        ->extends('layouts.secondMain')
        ->section('content');
    }
}
