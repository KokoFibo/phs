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

class Data extends Component
{
    public $perpage = 10;
    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $defaultBranch_id = '2';
    public $branch_id = '2';
    public $nama_umat, $mandarin, $jenis_kelamin, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota;

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
        $this->resetPage();
    }

    public function rules () {

        return [
            'nama_umat' => ['required'],
            'mandarin' => ['nullable'],
            'jenis_kelamin' => ['required'],
            'umur' => ['required', 'numeric', 'min:1', 'max:150'],
            'umur_sekarang' => ['nullable'],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telp' => ['nullable', 'numeric', 'min_digits:9', 'max_digits:13'],
            'hp' => ['nullable', 'numeric'],
            'email' => ['nullable', 'email'],
            'pengajak' => ['required'],
            'penjamin' => ['required'],
            'pandita_id' => ['required'],
            'tgl_mohonTao' => ['required','date','before:tomorrow'],
            'status' => ['nullable'],
            'branch_id' => ['required']
        ];

    }

    public function updated($fields) {
        $this->validateOnly($fields);
    }

    public function clearSession () {
        $this->resetPage();
        $this->clear_fields();  
    }

    public function store () {
        $validatedData = $this->validate();
        session()->flash('message', '');
       
        $data_umat = new DataPelita();

        $data_umat->branch_id = $this->branch_id;
        $data_umat->nama_umat = $this->nama_umat;
        $data_umat->mandarin = $this->mandarin;
        $data_umat->jenis_kelamin = $this->jenis_kelamin;
        $data_umat->umur = $this->umur;
        $data_umat->umur_sekarang = $this->hitungUmurSekarang($this->tgl_mohonTao,$this->umur);
        $data_umat->alamat = $this->alamat;
        $data_umat->kota_id = $this->kota_id;
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        $data_umat->pengajak = $this->pengajak;
        $data_umat->penjamin = $this->penjamin;
        $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = $this->tgl_mohonTao;
        $data_umat->status = 'Active';

        $data_umat->save();

        session()->flash('message', 'Data Umat Sudah di tambah');

        $this->clear_fields();    
        
        // hiding the Modal after run Add Data 
        $this->dispatchBrowserEvent('close-modal');

    }

    public function edit ($id) {
        $this->current_id = $id;
        $data = DataPelita::find($id);
        
        if ($data) {
            $this->branch_id = $data->branch_id;
            $this->nama_umat = $data->nama_umat;
            $this->mandarin = $data->mandarin;
            $this->jenis_kelamin = $data->jenis_kelamin;
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

    public function update () {
        // validation
        // $validatedData = $this->validate();

        session()->flash('message', '');
        

        $data_umat = DataPelita::find($this->current_id);
        $data_umat->branch_id = $this->branch_id;
        $data_umat->nama_umat = $this->nama_umat;
        $data_umat->mandarin = $this->mandarin;
        $data_umat->jenis_kelamin = $this->jenis_kelamin;
        $data_umat->umur = $this->umur;
        $data_umat->umur_sekarang = $this->hitungUmurSekarang($this->tgl_mohonTao,$this->umur);
        $data_umat->alamat = $this->alamat;
        $data_umat->kota_id = $this->kota_id;
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        $data_umat->pengajak = $this->pengajak;
        $data_umat->penjamin = $this->penjamin;
        $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = $this->tgl_mohonTao;
        $data_umat->status = $this->status;

        $data_umat->save();

        session()->flash('message', 'Data Umat Sudah di Update');

        $this->clear_fields();    
        
        // hiding the Modal after run Add Data 
        $this->dispatchBrowserEvent('close-modal');
        
    }

        public function deleteConfirmation ($id) {
            $data = DataPelita::find($id);
            $this->delete_id = $data->id;

        }

        public function delete () {
            $data = DataPelita::find($this->delete_id);
            $data->delete();
        session()->flash('message', 'Data Sudah di Delete');

        $this->dispatchBrowserEvent('close-modal');

        }



    public function  clear_fields() {
    
        $this->branch_id= $this->defaultBranch_id;
        $this->nama_umat='';
        $this->mandarin='';
        $this->jenis_kelamin='';
        $this->umur='';
        $this->umur_sekarang='';
        $this->alamat='';
        $this->kota_id=''; 
        $this->telp='';
        $this->hp='';
        $this->email='';
        $this->pengajak='';
        $this->penjamin='';
        $this->pandita_id='';
        $this->tgl_mohonTao=NULL;
    }

    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }

    public function sortColumnName ($namaKolom) {
        $this->columnName = $namaKolom;
        $this->direction = $this->swapDirection();
    }

    public function swapDirection () {
        return $this->direction === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $alldatapelita =DataPelita::orderBy('nama_umat', 'asc')->get();
        $allKota = Kota::orderBy('nama_kota', 'asc')->get();
        $dataPandita = Pandita::all();
        $branch = Branch::all();
        $datapelita = DB::table('data_pelitas')
        ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
         ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')

        // $datapelita = DB::table('kotas')
        // ->join('data_pelitas', 'kotas.id', '=', 'data_pelitas.kota_id')   
        
        
        ->orderBy($this->columnName, $this->direction)
        ->where('data_pelitas.nama_umat','like','%'.$this->search.'%')
        // ->orWhere('mandarin','like','%'.$this->search.'%')
        // ->orWhere('pengajak','like','%'.$this->search.'%')
        // Kalau pakai orWhere maka query dibawah gak jalan
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
            $query->where('data_pelitas.jenis_kelamin',  $this->jen_kel );
        })
         ->paginate($this->perpage); 
        return view('livewire.data', compact(['datapelita', 'branch', 'alldatapelita', 'dataPandita', 'allKota']));
    }
}
