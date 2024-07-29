<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;

use App\Http\Controllers\Admin\SAWController;

// ADMIN
use App\Http\Controllers\Admin\KriteriaController as AdminKriteriaController;
use App\Http\Controllers\Admin\SubkriteriaController as AdminSubkriteriaController;
use App\Http\Controllers\Admin\BalitaController as AdminBalitaController;
use App\Http\Controllers\Admin\NilaiAlternatifController as AdminNilaiAlternatifController;

use App\Http\Controllers\Admin\DataOrangTuaController as AdminOrangTuaController;

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

Route::get('/', function () {
    return view('homepage');
});

Route::get('main',[LayoutController::class,'index'])->middleware('auth');
Route::get('home',[LayoutController::class,'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout','logout');
});

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cekUserLogin:1']],function(){
        Route::get('kriteria', [AdminKriteriaController::class,'index'])->name('kriteria');
        Route::get('kriteria/create', [AdminKriteriaController::class,'create']);
        Route::post('kriteria/store', [AdminKriteriaController::class,'store']);
        Route::get('kriteria/{id}/edit', [AdminKriteriaController::class,'edit'])->name('editkriteria');
        Route::put('kriteria/{id}', [AdminKriteriaController::class,'update']);
        Route::delete('kriteria/{id}', [AdminKriteriaController::class,'destroy'])->name('kriteria.destroy');

        Route::get('balita', [AdminBalitaController::class,'index'])->name('balita');
        Route::get('balita/create', [AdminBalitaController::class,'create']);
        Route::post('balita/store', [AdminBalitaController::class,'store']);
        Route::get('balita/{id}/edit', [AdminBalitaController::class,'edit'])->name('editbalita');
        Route::put('balita/{id}', [AdminBalitaController::class,'update']);
        Route::delete('balita/{id}', [AdminBalitaController::class,'destroy'])->name('balita.destroy');

        Route::get('nilai_alternatif', [AdminNilaiAlternatifController::class,'index'])->name('nilai_alternatif');
        Route::get('nilai_alternatif/create', [AdminNilaiAlternatifController::class,'create']);
        Route::post('nilai_alternatif/store', [AdminNilaiAlternatifController::class,'store']);
        Route::get('nilai_alternatif/{id}/edit', [AdminNilaiAlternatifController::class,'edit'])->name('editnilai_alternatif');
        Route::put('nilai_alternatif/{id}', [AdminNilaiAlternatifController::class,'update']);
        Route::delete('nilai_alternatif/{id}', [AdminNilaiAlternatifController::class,'destroy'])->name('nilai_alternatif.destroy');

        Route::get('sub_kriteria', [AdminSubkriteriaController::class,'index'])->name('sub_kriteria');
        Route::get('sub_kriteria/create', [AdminSubkriteriaController::class,'create']);
        Route::post('sub_kriteria/store', [AdminSubkriteriaController::class,'store']);
        Route::get('sub_kriteria/{id}/edit', [AdminSubkriteriaController::class,'edit'])->name('editsub_kriteria');
        Route::put('sub_kriteria/{id}', [AdminSubkriteriaController::class,'update']);
        Route::delete('sub_kriteria/{id}', [AdminSubkriteriaController::class,'destroy'])->name('sub_kriteria.destroy');

        Route::get('data_orangtua', [AdminOrangTuaController::class,'index'])->name('data_orangtua');
        Route::get('data_orangtua/create', [AdminOrangTuaController::class,'create']);
        Route::post('data_orangtua/store', [AdminOrangTuaController::class,'store']);
        Route::get('data_orangtua/{id}/edit', [AdminOrangTuaController::class,'edit'])->name('editdata_orangtua');
        Route::put('data_orangtua/{id}', [AdminOrangTuaController::class,'update']);
        Route::delete('data_orangtua/{id}', [AdminOrangTuaController::class,'destroy'])->name('data_orangtua.destroy');

        Route::get('saw-result', [SAWController::class, 'calculateSAW']);
        

    });
});
