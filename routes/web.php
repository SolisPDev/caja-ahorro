<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\AportacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdelantoController;
use App\Http\Controllers\AbonoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Vista de socios con adelantos activos
Route::get('/adelantos/activos', [SocioController::class, 'adelantosActivos'])->name('adelantos.activos');
// Vistas para registro de abonos a los adelantos de quincena 
Route::get('/adelantos/{adelanto}/abonos/create', [AbonoController::class, 'create'])->name('abonos.create');
Route::post('/adelantos/{adelanto}/abonos', [AbonoController::class, 'store'])->name('abonos.store');
Route::middleware(['auth'])->group(function () {
    Route::get('/adelantos/create/{socio}', [AdelantoController::class, 'create'])->name('adelantos.create');
    Route::post('/adelantos', [AdelantoController::class, 'store'])->name('adelantos.store');
    Route::get('/adelantos/{adelanto}/edit', [AdelantoController::class, 'edit'])->name('adelantos.edit');
    Route::put('/adelantos/{adelanto}', [AdelantoController::class, 'update'])->name('adelantos.update');
});






// Vista de estado de cuenta del socio
Route::get('/socios/{id}/estadoCuenta', [SocioController::class, 'estadoCuenta'])->name('socios.estadoCuenta');
Route::get('/socios/activos', [SocioController::class, 'indexActivos'])->name('socios.activos');
Route::resource('socios', SocioController::class)->middleware('auth');
Route::resource('aportaciones', AportacionController::class)->middleware('auth');
Route::get('/socios/{socio}/aportaciones', [AportacionController::class, 'showBySocio'])->name('aportaciones.socio');
Route::get('/aportaciones/create/{socio}', [AportacionController::class, 'create'])->name('aportaciones.create');
Route::get('/aportaciones/{socio}', [AportacionController::class, 'index'])->name('aportaciones.index');
   


    

    
    