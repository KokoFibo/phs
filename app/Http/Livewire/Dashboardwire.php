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
    public $selectedGroupVihara;
    public $selectedDaftarKelas_id = [];
    public $selectedKelasId;
    public $totalUmat_sp;
    public $daftarKelasIdUpdate = 2;
    public $daftarkelas;
    // ,
    public $data, $years;
    public  $selectedDaftarKelasId, $openchart, $dataXjson, $dataYjson, $dataPeserta, $dataYjsonPeserta;
    public $dataX = [], $dataY = [];
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
        $this->selectedGroupVihara = '';

        try {
            $dataPertama = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->first();
            $this->selected = $dataPertama->id;
            $this->selectedYear = date('Y');
            $this->getYears();
            $this->totalUmat_sp = DataPelita::where('branch_id', $this->selectedBranch)->count();
            $this->isiPilihKelas();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function isiPilihKelas()
    {
        $this->daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();
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
    public function updatedSelectedDaftarKelasId () {
      $this->updateChart();
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

    public function updatedSelectedGroupVihara()
    {
        $this->selectedBranch = '';
        $this->selectedDaftarKelasId ='';
        // $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();
        $this->daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();


    }

    public function mount()
    {
        $this->selectedGroupVihara =1;
        $this->selectedDaftarKelasId =2;


        // $this->openchart=false;

        // $dataX = [];
        // $dataY = [];

        // $groupvihara = Groupvihara::all();
        // $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();


        try {
            $absensiDataX = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
             $absensiDataY = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
            foreach($absensiDataX as $a) {
                $this->dataX[] = $a->tgl_kelas;
            }

            for( $i = 0; $i < count($this->dataX); $i++) {
                $this->dataY[] = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)
                    ->where('tgl_kelas', $this->dataX[$i])
                    ->where('absensi','1')
                    ->select('absensi')
                    ->count();
            }
            $totalPesertaKelasTerakhir = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('datapelita_id')->orderBy('tgl_kelas', 'desc')->get();
            $vtotal = 0;
            $sd3h = 0;
            $belumKeduanya = 0;

            foreach($totalPesertaKelasTerakhir as $t){
                $data = DataPelita::find($t->datapelita_id);

                if($data->tgl_sd3h != null && $data->tgl_vtotal == null){
                    $sd3h++;
                } elseif($data->tgl_sd3h != null && $data->tgl_vtotal != null) {
                    $vtotal++;
                } else {
                    $belumKeduanya++;
                }
            }

            $this->dataPeserta = [$vtotal, $sd3h, $belumKeduanya];




        } catch (\Exception $e) {
            return $e->getMessage();
        }



        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        $this->dataYjsonPeserta = json_encode($this->dataPeserta);


        if (Auth::user()->role != '3') {
            $this->selectedGroupVihara = Auth::user()->groupvihara_id;
        } else {
            // $this->selectedGroupVihara = null;
        }
        $this->selected = Auth::user()->branch_id;

        $this->isiPilihKelas();
        $this->selectedYear = date('Y');
        $this->updateAbsensi();
        $this->getYears();

    }

    public function updateChart () {
        // $this->selectedGroupVihara ='';
        // $this->selectedDaftarKelasId ='';
        $dataX = [];
        $dataY = [];
        $this->dataXjson = '';
        $this->dataYjson = '';
        $this->dataX = [];
        $this->dataY = [];
        // $groupvihara = Groupvihara::all();
        // $daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();
        try {
            $absensiDataX = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
             $absensiDataY = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->orderBy('tgl_kelas', 'asc')->get();
            foreach($absensiDataX as $a) {
                $this->dataX[] = $a->tgl_kelas;
            }

            for( $i = 0; $i < count($this->dataX); $i++) {
                $this->dataY[] = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)
                    ->where('tgl_kelas', $this->dataX[$i])
                    ->where('absensi','1')
                    ->select('absensi')
                    ->count();
            }

            $totalPesertaKelasTerakhir = Absensi::where('daftarkelas_id',$this->selectedDaftarKelasId)->distinct('tgl_kelas')->select('datapelita_id')->orderBy('tgl_kelas', 'desc')->get();
            $vtotal = 0;
            $sd3h = 0;
            $belumKeduanya = 0;

            foreach($totalPesertaKelasTerakhir as $t){
                $data = DataPelita::find($t->datapelita_id);

                if($data->tgl_sd3h != null && $data->tgl_vtotal == null){
                    $sd3h++;
                } elseif($data->tgl_sd3h != null && $data->tgl_vtotal != null) {
                    $vtotal++;
                } else {
                    $belumKeduanya++;
                }
            }

            $this->dataPeserta = [$vtotal, $sd3h, $belumKeduanya];

        } catch (\Exception $e) {
             return $e->getMessage();
        }

        $this->dataXjson = json_encode($this->dataX);
        $this->dataYjson = json_encode($this->dataY);
        $this->dataYjsonPeserta = json_encode($this->dataPeserta);

        $this->emit('berhasilUpdate',['dataXjson' => $this->dataXjson ,'dataYjson'=> $this->dataYjson, 'dataYjsonPeserta' => $this->dataYjsonPeserta ]);
    }

    public function render()
    {

        if (Auth::user()->role != '3') {
            $this->selectedGroupVihara = Auth::user()->groupvihara_id;
        }


        $umatActive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        ->where('data_pelitas.status', 'Active')
        ->when($this->selectedGroupVihara, function ($query) {
            $query->where('groupviharas.id', $this->selectedGroupVihara);
        })
        ->when($this->selectedBranch, function ($query) {
            $query->where('branch_id', $this->selectedBranch);
        })
        ->count();

        // umat Inactive
        $umatInactive = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
        ->where('data_pelitas.status', 'Inactive')
        ->when($this->selectedGroupVihara, function ($query) {
            $query->where('groupviharas.id', $this->selectedGroupVihara);
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
            ->when($this->selectedGroupVihara, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroupVihara);
            })
            ->when($this->selectedBranch, function ($query) {
                $query->where('branch_id', $this->selectedBranch);
            })
            ->count();

        // Total Cetya
        if (Auth::user()->role != '3') {
            $totalBranch = Branch::where('groupvihara_id', Auth::user()->groupvihara_id)->count();
        } elseif ($this->selectedGroupVihara != '') {
            $totalBranch = Branch::where('groupvihara_id', $this->selectedGroupVihara)->count();
        } else {
            $totalBranch = Branch::all()->count();
        }

        // Total yang sudahpernah ikut Sidang dharma 3 hari
        $sd3h = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            ->where('tgl_sd3h', '!=', null)
            ->when($this->selectedGroupVihara, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroupVihara);
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
            ->when($this->selectedGroupVihara, function ($query) {
                $query->where('groupviharas.id', $this->selectedGroupVihara);
            })
            ->when($this->selectedBranch, function ($query) {
                $query->where('branch_id', $this->selectedBranch);
            })
            ->count();

        // Jumlah Users
        $totalUsers = User::all()->count();

        $groupvihara = Groupvihara::all();

        if (Auth::user()->role != '3') {
            $branch = Branch::where('groupvihara_id', $this->selectedGroupVihara)->get();
        } else {
            $branch = Branch::all();
        }

            // masih belum beres logicnya utk autocreate usersetting saat register new user
        // $checkUserSetting = Usersetting::where('user_id', Auth::user()->id);
        // if (!empty($checkUserSetting)) {
        //     $datauser = new Usersetting();

        //     $datauser->user_id = Auth::user()->id;
        //     $datauser->save();

        // }
        $this->daftarkelas = Daftarkelas::where('groupvihara_id', $this->selectedGroupVihara)->get();

        return view('livewire.dashboardwire', compact(['totalUmat', 'umatActive', 'umatInactive', 'umatYTD', 'totalBranch', 'totalUsers', 'sd3h', 'vtotal', 'branch', 'groupvihara']))
            ->extends('layouts.main2')
            ->section('content');
    }
}
