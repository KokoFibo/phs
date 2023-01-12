<?php

use Carbon\Carbon;
use App\Models\Namakota;
use App\Models\Propinsi;
use App\Models\DataPelita;
use App\Http\Livewire\Data;
use App\Http\Livewire\Kota;
use App\Http\Livewire\Tablewire;
use App\Http\Livewire\Dashboardwire;
use Illuminate\Support\Facades\Route;
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

Route::get('/navbar', function () {
    return view('layouts.navbarbaru');
});


// Route::get('/table', Tablewire::class);


    Route::get('/resetpswd', function() {
        return view('menuResetPassword');
    })->name('resetpassword');



Route::middleware(['auth'])->group(function () {

    Route::get('/registration', function() {
        return view('menuRegistration');
    })->middleware(['supervisor'])->name('registration');

    Route::get('/', function () {
        return view('auth.login');
    });





    Route::get('/branch', function() {
        return view('menuBranch');
    })->name('branch');


    Route::get('locale/{locale}', function($locale){
        \Session::put('locale', $locale);
        return redirect()->back();
    });



    Route::get('/adddata/{kode_branch}', Adddata::class)->name('adddata');

    Route::get('/editdata/{current_id}', Editdata::class)->name('editdata');

    Route::get('/main1', Data::class)->name('main');
    Route::get('/main', Tablewire::class)->name('main');

    Route::get('/dashboard', Dashboardwire::class)->name('dashboard');



    Route::get('/resetumur', function () {
        $data = DataPelita::all();
            foreach($data as $d ){
                $now = Carbon::now();
                $tahun = $now->year;
                $year = date('Y', strtotime($d->tgl_mohonTao));
                $selisih = $tahun - $year;
                $d->umur_sekarang = $d->umur + $selisih;
                $d->save();
            session()->flash('message', 'Seluruh Data Umur Umat Sudah di Reset');
            return redirect(route('main'));
            }
        })->name('resetumur');


});
