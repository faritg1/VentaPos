<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\AdminController;

// Panel Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/data', [ReporteController::class, 'data'])->name('reportes.data');

    // Ventas (solo index, show, edit, update, destroy)
    Route::resource('ventas', VentaController::class)->except(['create', 'store']);
  

    
   // Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('admin.productos.update');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

// Clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('admin.clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('admin.clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('admin.clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy');

});

  // Productos fuera del admin
Route::resource('producto', ProductoController::class);

// POS
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos', [PosController::class, 'store'])->name('pos.store');
Route::get('/pos/clientes/buscar/{numeroDocumento}', [PosController::class, 'searchClient'])->name('pos.client.search'); 
Route::post('/pos/clientes', [PosController::class, 'storeClient'])->name('pos.client.store'); 

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});