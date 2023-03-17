<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Absensi;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;
use App\Models\Pesertakelas;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Absensiwire extends Component
{
    use WithPagination;
    public $groupvihara_id, $kelas_id, $kelas, $daftarkelas_id, $tgl_kelas,  $group, $id_absensi, $nama_cetya, $nama_kelas;
    public $selectedGroup = null;
    public $selectedKelas = null;
    public $is_add = true;
    public $menuTambahData;
    public $menuUtama, $data, $jumlahpeserta, $jumlahdaftarkelas,  $pesertaKelasId, $pesertaKelasAdd;
    public $tglTable =[];
    public $namaTable =[];

    public $menuInputAbsensi, $menuEditAbsensi, $nama, $query;
    public $selectedPeserta, $peserta, $datapelita_id, $selectedTgl, $selectedTglEdit;
    protected $listeners = ['delete', 'deleteAbsensiByTgl', 'deletePesertaKelas'];

    public function updatedSelectedTglEdit () {
        $this->tgl_kelas = $this->selectedTglEdit;

    }

    public function deleteAbsensiByTglConfirmation () {
        $this->dispatchBrowserEvent('deleteAbsensiByTglConfirmation', [
            'title' => 'Yakin Untuk Hapus Data',
              'text' => "Kelas  : " . getDaftarKelas($this->daftarkelas_id) . ", Tanggal :" . $this->selectedTglEdit,
             'icon' => 'warning',
        ]);
    }
   public function deleteAbsensiByTgl () {

     DB::table('absensis')->where('daftarkelas_id',$this->daftarkelas_id)->where('tgl_kelas',$this->tgl_kelas)->delete();

   }



    public function createAbsensi ( $daftarkelas_id) {
        $checkDuplicate = Absensi::where('daftarkelas_id',$daftarkelas_id)->where('tgl_kelas',$this->tgl_kelas)->first();
        if($checkDuplicate == null) {
            $pesertakelas = Pesertakelas::where('daftarkelas_id',$daftarkelas_id)->get();
        foreach($pesertakelas as $p) {
            $absensi = new Absensi();
        $absensi->datapelita_id = $p->datapelita_id;
        $absensi->daftarkelas_id = $p->daftarkelas_id;
        $absensi->absensi = "-";
        $absensi->tgl_kelas = $this->tgl_kelas;
        try {
        $absensi->save();

        } catch (\Exception $e) {
             return $e->getMessage();
}
        }
        } else {
            $this->dispatchBrowserEvent('absensiSudahAda', [
            ]);
        }



    }

    public function updatedTglKelas () {
        $absensi = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->where('tgl_kelas', $this->tgl_kelas)->get();
        $this->resetPage();


    }
    public function hadir ($id, $kodeAbsen) {
        $absensi = Absensi::find($id);
        $daftarkelasid = $absensi->daftarkelas_id;
        $datapelitaid = $absensi->datapelita_id;
        $absensi->absensi = $kodeAbsen;
        $absensi->save();

        // update data kota_is_Used
        // $dataID = Pesertakelas::where('datapelita_id',$datapelitaid)->where('daftarkelas_id', $daftarkelasid )->first();
        // $data = Pesertakelas::find($dataID->id);
        // $data->pesertakelas_is_used = true;
        // $data->save();

        // $this->resetPage();






    }

    public function editpesertakelas ($id) {
        $this->pesertaKelasAdd = false;

        $this->pesertaKelasId = $id;
        $data = Pesertakelas::find($id);
        $this->datapelita_id = $data->datapelita_id;
        $this->peserta = getName($this->datapelita_id);

    }

    public function updatePesertakelas () {
        $data = Pesertakelas::find($this->pesertaKelasId);
        $data->datapelita_id = $this->datapelita_id;
        $data->save();
        $this->pesertaKelasAdd = true;
        // $this->cancel();
        // session()->flash('message', 'Absensi Kelas Sudah di Simpan');
        $this->dispatchBrowserEvent('success', ['message' => 'updated']);

    }


    public function edit ($id) {
        $this->id_absensi = $id;
        $data = Absensi::find($id);
        $this->daftarkelas_id = $data->daftarkelas_id;
        $this->nama_cetya = getDaftarKelasCetya($data->daftarkelas_id);
        $this->nama_kelas = getDaftarKelas($data->daftarkelas_id);
        $this->tgl_kelas = $data->tgl_kelas;
        $this->is_add=false;
    }

    public function update () {
        $data = Absensi::find($this->id_absensi);
        $data->tgl_kelas = $this->tgl_kelas;
        $data->save();
        $this->cancel();
        // session()->flash('message', 'Absensi Kelas Sudah di Simpan');
        $this->dispatchBrowserEvent('success', ['message' => 'updated']);

    }

    public function mount() {
        $this->menuTambahData = false;
        $this->menuUtama = true;
        $this->jumlahpeserta = 0;
        $this->jumlahdaftarkelas = 0;
        $this->pesertaKelasAdd = true;
        $query = "";
        $nama = [];

        if(Auth::user()->role!=3){
            $this->selectedGroup = Auth::user()->groupvihara_id;
        }
        $this->data='';

        $this->menuInputAbsensi = false;
        $this->menuEditAbsensi = false;
        // if(Auth::user()->role == '3'){

            $this->group = Groupvihara::orderBy('nama_group', 'asc')->get();
            $this->kelas = collect();
        // }
        $this->resetPage();
    }

    public function getDataPeserta ($nama, $id) {
        $this->peserta = $nama;
        $this->datapelita_id = $id;
    }

    public function storePeserta () {

            //  dd($this->datapelita_id, $this->daftarkelas_id);
        // $validatedData = Validator::make(
        //     ['daftarkelas_id' =>'required'],
        //     ['datapelita_id' =>'required'],
        // )->validate();
        // Pesertakelas::create($validatedData);

        // belum ada validasi
        if($this->datapelita_id != '') {
            // $data = Pesertakelas::where('datapelita_id','$this->datapelita_id')->where('daftarkelas_id', '$this->daftarkelas_id')->count();
            // if($data>0){
                // $this->dispatchBrowserEvent('pesertaTerdaftar');
            // } else {
                $data_peserta = new Pesertakelas();
                $data_peserta->datapelita_id = $this->datapelita_id;
                $data_peserta->daftarkelas_id = $this->daftarkelas_id;
                try {
                    $data_peserta->save();
                    $this->dispatchBrowserEvent('success', ['message' => 'Saved']);

                } catch (\Exception $e) {
                    // $this->dispatchBrowserEvent('pesertaTerdaftar');
                    $this->dispatchBrowserEvent('error', ['message' => 'Peserta Sudah Terdaftar']);

       }

        //    }
        }


    }

    public function updatedQuery () {
        $this->nama = DataPelita::where('nama_umat', 'like', '%'. $this->query .'%')
        ->get(['id', 'nama_umat'])
        ->toArray();
    }

    public function deletepesertaConfirmation($id) {
        $data = Pesertakelas::find($id);
        $this->pesertaKelasId = $id ;
        // $namakelas = getKelas($data->kelas_id);
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
              'text' => "Nama Peserta : " .  getName($data->datapelita_id),
             'icon' => 'warning',
        ]);

    }


    public function deletePesertaKelas () {
        $data = Pesertakelas::find($this->pesertaKelasId);
        if( $data->daftarkelas_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Data TIDAK di Delete']);

        }

    }


    public function deleteConfirmation ($id) {
        $data = Absensi::find($id);
        // $namakelas = getKelas($data->kelas_id);
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
             'text' => "You won't be able to revert this!",
            //   'text' => "Data Kelas : " . $namakelas . ", di Cetya : " . $namacetya,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        dd($id);
        $data = Absensi::find($id);

        if( $data->daftarkelas_is_used == '0'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


     }

    public function clear_fields() {
         $this->selectedGroup = null;
     $this->selectedKelas = null;
     $this->kelas = '';
     $this->group = '';
     $this->tgl_kelas='';
     $this->datapelita_id='';


     $this->group = Groupvihara::orderBy('nama_group', 'asc')->get();
     $this->kelas = collect();
    }
    public function updatedSelectedGroup($id) {
        $this->kelas = collect();

        try {

            // $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('groupvihara_id', $id)->get();
            $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('groupvihara_id', $this->selectedGroup)->get();
        } catch (\Exception $e) {
             return $e->getMessage();
}


    }
    public function updateDaftarKelas() {
        $data_kelas = Daftarkelas::find($this->daftarkelas_id);
        $data_kelas->daftarkelas_is_used = true;
        $data_kelas->save();
    }

    protected $rules = [

        'daftarkelas_id' => 'required',
        'datapelita_id' => 'required',
        'tgl_kelas' => 'required',

];
public function updated($fields) {
    $this->validateOnly($fields);
}


public function closeMenuTambahDataPeserta () {
    $this->menuTambahData = false;
    $this->menuInputAbsensi = false;
    $this->menuEditAbsensi = false;

    $this->menuUtama = true;
}
public function tambahPeserta () {
    if( $this->daftarkelas_id!='' && $this->selectedGroup!='') {
        $this->menuTambahData = true;
        $this->menuInputAbsensi = false;
        $this->menuEditAbsensi = false;
        $this->menuUtama = false;
    }
}

public function tambahAbsensi () {
    if( $this->daftarkelas_id!='' && $this->selectedGroup!='') {
        $this->menuTambahData = false;
        $this->menuInputAbsensi = true;
        $this->menuEditAbsensi = false;
        $this->menuUtama = false;
    }
}

public function editAbsensi () {
    if( $this->daftarkelas_id!='' && $this->selectedGroup!='') {
        $this->menuTambahData = false;
        $this->menuInputAbsensi = false;
        $this->menuEditAbsensi = true;
        $this->menuUtama = false;
    }
}



    public function store () {
        $validatedData = $this->validate();
        try {
        $data = new Absensi();
        $data->daftarkelas_id = $this->daftarkelas_id;
        $data->datapelita_id = $this->datapelita_id;

        $data->tgl_kelas = $this->tgl_kelas;
            $data->save();
            $this->updateDaftarKelas();
            $this->clear_fields();
            // session()->flash('message', 'Absensi Kelas Sudah di Simpan');
            $this->dispatchBrowserEvent('success', ['message' => 'saved']);

        } catch (\Exception $e) {
            return $e->getMessage();
        }




    }

    public function close () {
        return redirect()->route('dashboard');
    }
    public function cancel () {
        $this->clear_fields();
         $this->is_add=true;
        $this->render();
    }


    public function render()
    {

        $nama_peserta = DataPelita::all();

        if(Auth::user()->role != '3'){
            // $absensi = DB::table('daftarkelas')
            // ->join('absensis', 'daftarkelas.id','=','absensis.daftarkelas_id')
            // ->join('datapelitas', 'absensis.datapelita_id', '=', 'datapelitas.id')
            // ->select('daftarkelas.*','absensis.*', 'datapelitas.nama_umat')
            // ->where('daftarkelas.groupvihara_id',Auth::user()->groupvihara_id)
            // ->paginate(5);
            $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('groupvihara_id', Auth::user()->groupvihara_id)->get();
        }
            // } else {
            $absensi = Absensi::orderBy('tgl_kelas', 'desc')->where('daftarkelas_id',$this->daftarkelas_id)->where('tgl_kelas', $this->tgl_kelas)->get();
        // }
        $pesertakelas = Pesertakelas::where('daftarkelas_id',$this->daftarkelas_id)->orderBy('id', 'asc')
        ->get();

        // $absensi = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->where('tgl_kelas', $this->tgl_kelas);
         $dataAbsensi = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->where('tgl_kelas', $this->tgl_kelas)->get();
         $this->jumlahpeserta = 0;
        $tglAbsensi = DB::table('absensis')->orderby('tgl_kelas', 'asc')->where('daftarkelas_id',$this->daftarkelas_id)->distinct()->select('tgl_kelas')->get();
        $viewTglAbsensi = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->distinct('tgl_kelas')->select('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
        $viewNamaAbsensi = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->distinct()->select('datapelita_id')->orderBy('id', 'asc')->get();
        $this->jumlahpeserta = Absensi::where('daftarkelas_id',$this->daftarkelas_id)->distinct('datapelita_id')->count();
        $this->tglTable = [];
        $this->namaTable = [];
        foreach($viewTglAbsensi as $tgl){
            $this->tglTable[] = $tgl->tgl_kelas;
        }
        foreach($viewNamaAbsensi as $nama){
            $this->namaTable[] = $nama->datapelita_id;
        }
        // if($this->selectedGroup && $this->daftarkelas_id) {
        //     dd($this->tglTable,$this->namaTable, count($this->namaTable) );
        // }
        $this->jumlahdaftarkelas =\App\Models\Absensi::query()
                  ->where('daftarkelas_id', $this->daftarkelas_id)->distinct('tgl_kelas')->count('tgl_kelas');

        $this->resetPage();
        return view('livewire.absensiwire', compact(['absensi', 'nama_peserta','pesertakelas', 'tglAbsensi', 'dataAbsensi', 'viewTglAbsensi', 'viewNamaAbsensi']))
        ->extends('layouts.main')
        ->section('content');
    }
}
