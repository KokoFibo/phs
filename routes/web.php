<?php

use App\Models\Namakota;
use App\Models\Propinsi;
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
Route::get('/', function () {
    return view('main');
});
Route::get('/kota', function () {
    return view('Menu-Kota');
});

Route::get('propinsi', function() {
    $propinsi = Namakota::all();
    return view ('propinsi', compact('propinsi'));
});