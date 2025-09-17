<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/data', [ReporteController::class, 'data'])->name('reportes.data');

    // Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');

    // Clientes
    // Ejemplo: CRUD de clientes
    // Route::resource('clientes', ClienteController::class);

    // Productos
    // Ejemplo: CRUD de productos
    // Route::resource('productos', ProductoController::class);
});

Route::resource('producto', ProductoController::class);
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos', [PosController::class, 'store'])->name('pos.store');

Route::get('/', function () {
    return view('welcome');
});
