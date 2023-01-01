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
})->name('welcome');

// Route::get('/kota', function () {
//     return view('Menu-Kota');
// });

// Route::get('/pandita', function () {
//     return view('Menu-Pandita');
// });
Route::middleware(['auth'])->group(function () {
    
    Route::get('/', function () {
        return view('auth.login');
    });
    
    Route::get('/main', function() {
        return view('main');
    })->name('main');

    Route::get('/registration', function() {
        return view('menuRegistration');
    })->name('registration');

    Route::get('/branch', function() {
        return view('menuBranch');
    })->name('branch');
    
    Route::get('locale/{locale}', function($locale){
        \Session::put('locale', $locale);
        return redirect()->back();
    });
    
    Route::get('/adddata', function() {
        return view('menuAddData');
    })->name('adddata');
    Route::get('/editdata/{id}', function($id) {
        return view('menuEditData', ['id' => $id]);
    })->name('editdata');


});