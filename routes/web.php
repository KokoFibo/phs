<?php

use App\Models\Namakota;
use App\Models\Propinsi;
use App\Http\Livewire\Data;
use App\Http\Livewire\Kota;
use Illuminate\Support\Facades\Route;

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
});

// Route::get('/kota', function () {
//     return view('Menu-Kota');
// });

// Route::get('/pandita', function () {
//     return view('Menu-Pandita');
// });

Route::get('/', function () {
    return view('auth.login');
});





// Route::get('/main', Data::class);

Route::get('/main', function() {
    return view('main');
});

Route::get('/adddata', function() {
    return view('menuAddData');
})->name('adddata');
Route::middleware(['auth'])->group(function () {
});