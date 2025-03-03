<?php

use Carbon\Carbon;
use App\Models\Namakota;
use App\Models\Propinsi;
use App\Models\DataPelita;
use App\Http\Livewire\Data;
use App\Http\Livewire\Kota;
use App\Http\Livewire\Testaja;
use App\Http\Livewire\Chartjswr;
use App\Http\Livewire\Chartwire;
use App\Http\Livewire\Tablewire;
use App\Http\Controllers\TestPdf;
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
use App\Http\Livewire\Tambahgroupwire;
use App\Http\Livewire\Tambahkelaswire;
use App\Http\Livewire\Usersettingwire;
use App\Http\Livewire\Adddataumatiwire;
use App\Http\Livewire\Changeprofilewire;
use App\Http\Controllers\CetakController;
use App\Http\Livewire\Datapelita\Adddata;
use App\Http\Livewire\Datapelita\Editdata;
use App\Http\Controllers\menuAddDataController;
use App\Http\Livewire\Test;

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
        Route::get('/branch', Branchwire::class)->name('branchwire');
        Route::get('/absensi', Absensiwire::class)->name('absensi');
    });

    Route::get('/tambahkelas', Tambahkelaswire::class)->middleware(['manager'])->name('tambahkelas');
    Route::get('/tambahgroup', Tambahgroupwire::class)->middleware(['manager'])->name('tambahgroup');


    Route::middleware(['admin'])->group(function () {
        Route::get('locale/{locale}', function ($locale) {
            Session::put('locale', $locale);
            return redirect()->back();
        });
        Route::get('/test1', Test::class);
        Route::get('/adddata1/{kode_branch}', Adddata::class)->name('adddata1');
        Route::get('/main1', Data::class)->name('main1');
        Route::get('/main', Tablewire::class)->name('main');
        // Route::get('/adddata/{kode_branch}', Addumatwire::class)->name('adddata');
        Route::get('/adddata', Addumatwire::class)->name('adddata');
        Route::get('/editdata/{current_id}', Editumatwire::class)->name('editdata');
        Route::get('/viewdata/{current_id}', Viewumatwire::class)->name('viewdata');
        Route::get('/umatview',)->name('umatview');
        Route::get('/panditawire', Panditawire::class)->name('panditawire');
        Route::get('/datakotawire', DataKotaWire::class)->name('datakotawire');
        Route::get('/changeprofile', Changeprofilewire::class)->name('changeprofile');

        // Route::get('/setting', Usersettingwire::class)->name('setting');
        Route::get('/test', Testaja::class);
        Route::post('/cetak', [CetakController::class, 'index']);
        Route::get('/tampil', [CetakController::class, 'tampil']);
        Route::post('/pdf', [CetakController::class, 'pdf']);
        Route::get('/resetumur', [CetakController::class, 'resetumur']);
        Route::get('/updatedAt', [CetakController::class, 'updatedAt']);
        Route::get('/chart', Chartwire::class)->name('chart');
    });
});
