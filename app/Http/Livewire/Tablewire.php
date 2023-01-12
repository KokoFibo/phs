<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Auth;


class Tablewire extends Component
{
    public $perpage = 10;
    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    use WithPagination;
    public $branch_id;
    public $nama_umat, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota;
    public $category="data_pelitas.nama_umat";
    public $active="";
    public $kode_branch, $kode_branch_view, $kode_branch_khusus;
    protected $listeners = ['delete'];
    public $nama_cetya;


    public function updatingSearch () {
        $this->resetPage();
    }

    public function resetFilter () {
        $this->perpage = 10;
        $this->search = '';
        $this->columnName = 'data_pelitas.id';
        $this->direction = 'desc';
        $this->startUmur = NULL;
        $this->endUmur = NULL;
        $this->startDate = NULL;
        $this->endDate = NULL;
        $this->jen_kel = NULL;
        $this->category="data_pelitas.nama_umat";
        $this->active="";
        $this->resetPage();
    }
    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }

    public function deleteConfirmation ($id) {
        $data = DataPelita::find($id);
        $nama = $data->nama_umat;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = DataPelita::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted');
    // session()->flash('message', 'Data Sudah di Delete');


    }

    public function sortColumnName ($namaKolom) {
        $this->columnName = $namaKolom;
        $this->direction = $this->swapDirection();
    }
    public function swapDirection () {
        return $this->direction === 'asc' ? 'desc' : 'asc';
    }

    public function edit ($id) {

        $this->current_id = $id;
        $data = DataPelita::find($id);

        if ($data) {
            $this->branch_id = $data->branch_id;
            $this->kode_branch_view = $this->branch_id;
            $this->nama_umat = $data->nama_umat;
            $this->mandarin = $data->mandarin;
            $this->gender = $data->gender;
            $this->umur = $data->umur;
            $this->umur_sekarang = $data->umur_sekarang;
            $this->alamat = $data->alamat;
            $this->kota_id = $data->kota_id;
            $this->telp = $data->telp;
            $this->hp = $data->hp;
            $this->email = $data->email;
            $this->pengajak = $data->pengajak;
            $this->penjamin = $data->penjamin;
            $this->pandita_id = $data->pandita_id;
            $np = Pandita::find($this->pandita_id);
            $this->namaPandita = $np->nama_pandita;
            $nk = Kota::find($this->kota_id);
            $this->namaKota = $nk->nama_kota;

            $this->tgl_mohonTao = $data->tgl_mohonTao;
            $this->status = $data->status;
        }
    }


    public function render()
    {
        if (Auth::user()->role == '3'){
            $this->branch_id = $this->kode_branch;
            $this->kode_branch_khusus = $this->kode_branch;
    }
    else {
        $this->branch_id = Auth::user()->branch_id;
        $this->kode_branch = $this->branch_id ;
        $this->kode_branch_khusus = $this->kode_branch;
    }




    $datapelita = DB::table('data_pelitas')
    ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
    ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
    ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
    ->orderBy($this->columnName, $this->direction)
    ->where($this->category,'like','%'.$this->search.'%')
    ->when($this->branch_id, function($query){
        $query->where('data_pelitas.branch_id', $this->branch_id );
    })
    ->when($this->startUmur, function($query){
        $query->where('data_pelitas.umur_sekarang', '>=', $this->startUmur );
    })
    ->when($this->endUmur, function($query){
        $query->where('data_pelitas.umur_sekarang', '<=', $this->endUmur );
    })
    ->when($this->startDate, function($query){
        $query->where('data_pelitas.tgl_mohonTao', '>=', $this->startDate );
    })
    ->when($this->endDate, function($query){
        $query->where('data_pelitas.tgl_mohonTao', '<=', $this->endDate );
    })
    ->when($this->jen_kel, function($query){
        $query->where('data_pelitas.gender',  $this->jen_kel );
    })
    ->when($this->active, function($query){
        $query->where('data_pelitas.status',  $this->active );
    })
    //  ->paginate($this->perpage);
     ->paginate(10);


    $data_branch = Branch::find(Auth::user()->branch_id);
    $all_branch = Branch::orderBy('nama_branch', 'asc')->get();

    if($this->kode_branch_khusus != null){
        $dataft = Branch::find($this->kode_branch_khusus);
        $namaft = $dataft->nama_branch;
    }
    $namaft = 'Welcome';

    $dp = DataPelita::paginate(10);

    if($this->kode_branch != null) {
        $datacetya = Branch::find($this->kode_branch);
        $this->nama_cetya = $datacetya->nama_branch;
    } else {
        $this->nama_cetya = "Welcome";
    }


        return view('livewire.tablewire', compact(['datapelita', 'data_branch', 'all_branch', 'namaft', 'dp']))
        ->extends('layouts.main')
        ->section('content');
    }
}












