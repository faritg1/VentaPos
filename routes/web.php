<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;


Route::prefix('admin')->group(function () {
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/data', [ReporteController::class, 'data'])->name('reportes.data'); // API JSON para gráficos
});


Route::prefix('admin')->group(function () {
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
});

// ====== ADMIN ======
Route::prefix('admin')->group(function () {
    
    // Menú principal de admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Productos
    Route::get('/producto', [ProductoController::class, 'index'])->name('admin.producto.index');
    Route::get('/producto/create', [ProductoController::class, 'create'])->name('admin.producto.create');
    Route::post('/producto', [ProductoController::class, 'store'])->name('admin.producto.store');
    Route::get('/producto/{producto}/edit', [ProductoController::class, 'edit'])->name('admin.producto.edit');
    Route::put('/producto/{producto}', [ProductoController::class, 'update'])->name('admin.producto.update');
    Route::delete('/producto/{producto}', [ProductoController::class, 'destroy'])->name('admin.producto.destroy');

    // Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('admin.clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('admin.clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('admin.clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy');

    // Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('admin.ventas.index');

    // Informes
    Route::get('/informes', [InformeController::class, 'index'])->name('admin.informes.index');
});


Route::get('/', function () {
    return view('welcome');
});
