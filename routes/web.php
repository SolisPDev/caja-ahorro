<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\AportacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbonoController;
use App\Http\Controllers\PrestamoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Vista de estado de cuenta del socio
Route::get('/socios/{id}/estadoCuenta', [SocioController::class, 'estadoCuenta'])->name('socios.estadoCuenta');
Route::get('/socios/activos', [SocioController::class, 'indexActivos'])->name('socios.activos');
Route::resource('socios', SocioController::class)->middleware('auth');
Route::resource('aportaciones', AportacionController::class)->middleware('auth');
Route::get('/socios/{socio}/aportaciones', [AportacionController::class, 'showBySocio'])->name('aportaciones.socio');
Route::get('/aportaciones/create/{socio}', [AportacionController::class, 'create'])->name('aportaciones.create');
Route::get('/aportaciones/{socio}', [AportacionController::class, 'index'])->name('aportaciones.index');

// Rutas para el control de prestamos
Route::get('/prestamos/socios', [PrestamoController::class, 'listarSocios'])->name('prestamos.socios');
Route::prefix('prestamos')->group(function () {
    Route::get('/', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/create/{socio}', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/{prestamo}', [PrestamoController::class, 'show'])->name('prestamos.show');
    Route::get('/{prestamo}/edit', [PrestamoController::class, 'edit'])->name('prestamos.edit');
    Route::put('/{prestamo}', [PrestamoController::class, 'update'])->name('prestamos.update');
    Route::delete('/{prestamo}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');
});
// Rutas para abonos (pagos de préstamos)
Route::prefix('abonos')->group(function () {
    Route::get('/{prestamo}', [AbonoController::class, 'index'])->name('abonos.index'); // Lista de abonos por préstamo
    Route::get('/{prestamo}/create', [AbonoController::class, 'create'])->name('abonos.create'); // Formulario para un nuevo abono
    Route::post('/', [AbonoController::class, 'store'])->name('abonos.store'); // Registrar abono
    Route::get('/show/{abono}', [AbonoController::class, 'show'])->name('abonos.show'); // Ver detalle de un abono
    Route::delete('/{abono}', [AbonoController::class, 'destroy'])->name('abonos.destroy'); // Eliminar abono
});

Route::get('/socios/{socio}/estado-cuenta', [SocioController::class, 'mostrarEstadoCuenta'])->name('estado-cuenta.show');


Route::post('/abonos', [AbonoController::class, 'store'])->name('abonos.store');