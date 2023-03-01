<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Branch;
use App\Models\Absensi;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;
use App\Models\Usersetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Dashboardwire extends Component
{
    public $dataAbsensi;
    public $selected;
    // dari sini
    public $selectedBranch;
    public $selectedGroup;
    public $selectedDaftarKelas_id = [];
    public $selectedKelasId;
    public $totalUmat_sp;
    public $daftarKelasIdUpdate = 2,
        $daftarkelas = [];
    public $data, $years;
    // public $is_absensi = false;

    // $now = Carbon::now();
    //     $tahun = $now->year;
    // public $selectedYear = date('Y', strtotime($tgl));
    public $selectedYear;

    public function updateAbsensi()
    {
        if ($this->selectedYear == null) {
            $this->selectedYear = date('Y');
        }
        if ($this->selected == null) {
            $this->selected = 1;
        }

        $this->dataAbsensi = null;
        $absensi = Absensi::query()
            ->whereYear('tgl_kelas', $this->selectedYear)
            ->orderBy('tgl_kelas', 'asc')
            ->where('daftarkelas_id', $this->selected)
            ->get();
        if ($this->dataAbsensi != null) {
            foreach ($absensi as $a) {
                $data['label'][] = $a->tgl_kelas;
                $data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($data);
        }
    }

    public function kirimId($daftarKelasId)
    {
        $this->daftarKelasIdUpdate = $daftarKelasId;
    }

    public function updatedSelectedBranch()
    {
        $this->selectedGroup = '';

        try {
            $dataPertama = Daftarkelas::where('groupvihara_id', $this->selectedGroup)->first();
            // dd($dataPertama->id);
            $this->selected = $dataPertama->id;
            $this->selectedYear = date('Y');
            $this->getYears();

            $this->totalUmat_sp = DataPelita::where('branch_id', $this->selectedBranch)->count();

            $this->isiPilihKelas();
        } catch (\Exception $e) {
            // return 'Nama Cetya Tidak Ada Dalam Database';
            return $e->getMessage();
        }
    }
    public function isiPilihKelas()
    {
        $this->daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroup)->get();
        $this->selectedDaftarKelas_id = [];
        foreach ($this->daftarkelas as $dk) {
            $this->selectedDaftarKelas_id[] = $dk->id;
        }
    }
    public function updatedSelectedKelasId()
    {
        $absensi = Absensi::where('daftarkelas_id', $this->selectedKelasId)->get();
        if ($this->data != null) {
            foreach ($absensi as $a) {
                $this->data['label'][] = $a->tgl_kelas;
                $this->data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($this->data);
            $this->emit('berubah', $this->selectedKelasId);
        }
    }

    public function tampilchart()
    {
        if ($this->dataAbsensi != null) {
            $absensi = Absensi::where('daftarkelas_id', $this->selectedKelasId)->get();
            foreach ($absensi as $a) {
                $this->data['label'][] = $a->tgl_kelas;
                $this->data['data'][] = $a->jumlah_peserta;
            }
            $this->dataAbsensi = json_encode($this->data);
        }
    }
    public function updatedSelected()
    {
        $this->getYears();
        $this->selectedYear = date('Y');
        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);
    }
    public function updatedSelectedYear()
    {
        $this->getYears();

        $this->updateAbsensi();
        $this->emit('updatedata', ['data' => $this->dataAbsensi]);
    }
    public function getYears()
    {
        $this->years = Absensi::orderBy('tgl_kelas', 'asc')
            ->where('daftarkelas_id', $this->selected)
            ->distinct()
            ->get([DB::raw('YEAR(tgl_kelas) as year')]);
    }

    public function updatedSelectedGroup()
    {
        $this->selectedBranch = '';
    }

    public function mount()
    {
        // $absensi = Absensi::all();
        // $daftarkelas = DaftarKelas::all();
        // $kelas = Kelas::all();
        // if($absensi == null || $daftarkelas == null | $kelas == null){

        //     $this->is_absensi = false;
        // }
        // else {
        //     $this->is_absensi = true;

        // }

        if (Auth::user()->role != 3) {
            $this->selectedGroup = Auth::user()->groupvihara_id;
        } else {
            $this->selectedGroup = null;
        }
        $this->selected = Auth::user()->branch_id;

        $this->isiPilihKelas();
        $this->selectedYear = date('Y');
        $this->updateAbsensi();
        $this->getYears();
    }

    public function render()
    {
        if (Auth::user()->role != '3') {
            $this->selectedGroup = Auth::user()->groupvihara_id;
        }

        // yg dibawah ini emang udah di remark
        // $tahun = Absensi::distinct()->get(['tgl_kelas']);
        // $years = Absensi::orderBy('tgl_kelas','asc')->where('daftarkelas_id',$this->selected)->whereNotNull('tgl_kelas')->distinct()->get([DB::raw('YEAR(tgl_kelas) as year')]);

        // Total Umat

        // if($this->selectedGroup){
            // $umatActive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            // ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->where('groupviharas.id', $this->selectedGroup)
            // ->where('data_pelitas.status', 'Active')
            // ->count();
            // $umatInactive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            // ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->where('groupviharas.id', $this->selectedGroup)
            // ->where('data_pelitas.status', 'Inactive')
            // ->count();

            // $umatYTD = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            // ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            // ->where('groupviharas.id', $this->selectedGroup)
            // ->whereYear('data_pelitas.tgl_mohonTao', '=', getYear())
            // ->count();

        // } elseif ($this->selectedBranch) {

            // $umatActive = DataPelita::where('status','Active')->where('branch_id',$this->selectedBranch)->count();
            // $umatInactive = DataPelita::where('status','Inactive')->where('branch_id',$this->selectedBranch)->count();
            // $umatYTD = DataPelita::where('branch_id',$this->selectedBranch)->whereYear('data_pelitas.tgl_mohonTao', '=', getYear())->count();
        // } else {

            // $umatActive = DataPelita::where('status','Active')->count();
            // $umatInactive = DataPelita::where('status','Inactive')->count();
            // $umatYTD = DataPelita::whereYear('data_pelitas.tgl_mohonTao', '=', getYear())->count();
        // }

        // umat Active
        $umatActive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        ->where('data_pelitas.status', 'Active')
        ->when($this->selectedGroup, function ($query) {
            $query->where('groupviharas.id', $this->selectedGroup);
        })
        ->when($this->selectedBranch, function ($query) {
            $query->where('branch_id', $this->selectedBranch);
        })
        ->count();

        // umat Inactive
        $umatInactive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        ->where('data_pelitas.status', 'Inactive')
        ->when($this->selectedGroup, function ($query) {
            $query->where('groupviharas.id', $this->selectedGroup);
        })
        ->when($this->selectedBranch, function ($query) {
            $query->where('branch_id', $this->selectedBranch);
        })
        ->count();

        $totalUmat = $umatActive + $umatInactive;


        // Umat YTD
        $umatYTD = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            ->whereYear('tgl_mohonTao', '=', getYear())
            ->when($this->selectedGroup, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroup);
            })
            ->when($this->selectedBranch, function ($query) {
                $query->where('branch_id', $this->selectedBranch);
            })
            ->count();

        // Total Cetya
        if (Auth::user()->role != 3) {
            $totalBranch = Branch::where('groupvihara_id', Auth::user()->groupvihara_id)->count();
        } elseif ($this->selectedGroup != '') {
            $totalBranch = Branch::where('groupvihara_id', $this->selectedGroup)->count();
        } else {
            $totalBranch = Branch::all()->count();
        }

        // Total yang sudahpernah ikut Sidang dharma 3 hari
        $sd3h = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            ->where('tgl_sd3h', '!=', null)
            ->when($this->selectedGroup, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroup);
            })
            ->when($this->selectedBranch, function ($query) {
                $query->where('branch_id', $this->selectedBranch);
            })
            ->count();

        // Total Vegetarian Total
        $vtotal = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            ->select('data_pelitas.*')
            ->where('tgl_vtotal', '!=', null)
            ->when($this->selectedGroup, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroup);
            })
            ->when($this->selectedBranch, function ($query) {
                $query->where('branch_id', $this->selectedBranch);
            })
            ->count();

        // Jumlah Users
        $totalUsers = User::all()->count();

        $groupvihara = Groupvihara::all();

        if (Auth::user()->role != '3') {
            $branch = Branch::where('groupvihara_id', $this->selectedGroup)->get();
        } else {
            $branch = Branch::all();
        }

            // masih belum beres logicnya
        // $checkUserSetting = Usersetting::where('user_id', Auth::user()->id);
        // if (!empty($checkUserSetting)) {
        //     $datauser = new Usersetting();

        //     $datauser->user_id = Auth::user()->id;
        //     $datauser->save();
        // }

        return view('livewire.dashboardwire', compact(['totalUmat', 'umatActive', 'umatInactive', 'umatYTD', 'totalBranch', 'totalUsers', 'sd3h', 'vtotal', 'branch', 'groupvihara']))
            ->extends('layouts.main')
            ->section('content');
    }
}
