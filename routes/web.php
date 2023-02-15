<?php

use Carbon\Carbon;
use App\Models\Namakota;
use App\Models\Propinsi;
use App\Models\DataPelita;
use App\Http\Livewire\Data;
use App\Http\Livewire\Kota;
use App\Http\Livewire\Chartjswr;
use App\Http\Livewire\Tablewire;
use App\Http\Livewire\Branchwire;
use App\Http\Livewire\Absensiwire;
use App\Http\Livewire\Addumatwire;
use App\Http\Livewire\Panditawire;
use App\Http\Livewire\DataKotaWire;
use App\Http\Livewire\Editumatwire;
use App\Http\Livewire\Registration;
use App\Http\Livewire\Viewumatwire;
use App\Http\Livewire\Dashboardwire;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Daftarkelaswire;
use App\Http\Livewire\Tambahkelaswire;
use App\Http\Livewire\Adddataumatiwire;
use App\Http\Livewire\Changeprofilewire;
use App\Http\Livewire\Datapelita\Adddata;
use App\Http\Livewire\Datapelita\Editdata;
use App\Http\Controllers\menuAddDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', function () {
    return view('auth/login');
});


    // Route::get('/resetpswd', function() {
    //     return view('menuResetPassword');
    // })->name('resetpassword');



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', Dashboardwire::class)->name('dashboard');

    Route::middleware(['supervisor'])->group(function () {
        Route::get('/registration', Registration::class)->name('registration');
        Route::get('/daftarkelas', Daftarkelaswire::class)->name('daftarkelas');
    });

    Route::get('/tambahkelas', Tambahkelaswire::class)->middleware(['manager'])->name('tambahkelas');

    Route::middleware(['admin'])->group(function () {
        Route::get('locale/{locale}', function($locale){
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/adddata1/{kode_branch}', Adddata::class)->name('adddata1');
        Route::get('/main1', Data::class)->name('main');
        Route::get('/main', Tablewire::class)->name('main');
        Route::get('/chartjs', Chartjswr::class)->name('chartjs');
        Route::get('/adddata/{kode_branch}', Addumatwire::class)->name('adddata');
        Route::get('/editdata/{current_id}', Editumatwire::class)->name('editdata');
        Route::get('/viewdata/{current_id}', Viewumatwire::class)->name('editdata');
        Route::get('/umatview', )->name('umatview');
        Route::get('/panditawire', Panditawire::class)->name('panditawire');
        Route::get('/datakotawire', DataKotaWire::class)->name('datakotawire');
        Route::get('/branch', Branchwire::class)->name('branchwire');
        Route::get('/changeprofile', Changeprofilewire::class)->name('changeprofile');
        Route::get('/absensi', Absensiwire::class)->name('absensi');
        Route::get('/resetumur', function () {
            $data = DataPelita::all();
            foreach($data as $d ){
                $now = Carbon::now();
                $tahun = $now->year;
                $year = date('Y', strtotime($d->tgl_mohonTao));
                $selisih = $tahun - $year;
                $is_save = false;
                if($d->umur_sekarang != $d->umur + $selisih) {
                    $is_save = true;
                }
                $d->umur_sekarang = $d->umur + $selisih;
                $d->pengajak = getName($d->pengajak_id);
                $d->penjamin = getName($d->penjamin_id);
                if($is_save) {
                    $d->save();
                    $is_save = false;
                }
            }
            foreach($data as $d) {
                $gender_before = $d->gender;
                if($d->gender == '1') {
                    $d->gender = 'Laki-laki';
                }elseif($d->gender == '2') {
                    $d->gender = 'Perempuan';
                }

                $is_save = false;
                if($gender_before == '1' || $gender_before == '2' ) {
                    $is_save = true;
                }

                if($is_save) {
                    $d->save();
                    $is_save = false;
                    $gender_before=null;
                }
            }
            session()->flash('message', 'Seluruh Data Umur dan gender Umat Sudah di Reset');
            return redirect(route('main'));
        })->name('resetumur');

    });


});
