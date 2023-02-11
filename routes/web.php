<?php

use Carbon\Carbon;
use App\Models\Namakota;
use App\Models\Propinsi;
use App\Models\DataPelita;
use App\Http\Livewire\Data;
use App\Http\Livewire\Kota;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');






// Route::get('/table', Tablewire::class);


    Route::get('/resetpswd', function() {
        return view('menuResetPassword');
    })->name('resetpassword');



Route::middleware(['auth'])->group(function () {

    // Route::get('/navbar', function () {
    //     return view('layouts.navbarbaru');
    // });

    Route::middleware(['supervisor'])->group(function () {

    // Route::get('/registration', Registration::class)->middleware(['supervisor'])->name('registration');
    // Route::get('/tambahkelas', Tambahkelaswire::class)->middleware(['supervisor'])->name('tambahkelas');
    // Route::get('/daftarkelas', Daftarkelaswire::class)->middleware(['supervisor'])->name('daftarkelas');

    Route::get('/registration', Registration::class)->name('registration');

    Route::get('/daftarkelas', Daftarkelaswire::class)->name('daftarkelas');

    });

    Route::get('/tambahkelas', Tambahkelaswire::class)->middleware(['manager'])->name('tambahkelas');




    // Route::get('/registration', function() {
    //     return view('menuRegistration');
    // })->middleware(['supervisor'])->name('registration');

    Route::get('/', function () {
        return view('auth.login');
    })->name('loginpage');




    // Route::get('/branch', function() {
    //     return view('menuBranch');
    // })->name('branch');


    Route::get('locale/{locale}', function($locale){
        \Session::put('locale', $locale);
        return redirect()->back();
    });



    Route::get('/adddata1/{kode_branch}', Adddata::class)->name('adddata1');

    // Route::get('/editdata/{current_id}', Editdata::class)->name('editdata');

    Route::get('/main1', Data::class)->name('main');
    Route::get('/main', Tablewire::class)->name('main');
    Route::get('/adddata/{kode_branch}', Addumatwire::class)->name('adddata');
    Route::get('/editdata/{current_id}', Editumatwire::class)->name('editdata');
    Route::get('/viewdata/{current_id}', Viewumatwire::class)->name('editdata');


    Route::get('/dashboard', Dashboardwire::class)->name('dashboard');

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
            $d->umur_sekarang = $d->umur + $selisih;
            $d->pengajak = getName($d->pengajak_id);
            $d->penjamin = getName($d->penjamin_id);
            $d->save();
        }
        session()->flash('message', 'Seluruh Data Umur Umat Sudah di Reset');
        return redirect(route('main'));
    })->name('resetumur');


});
