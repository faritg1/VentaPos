<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/data', [ReporteController::class, 'data'])->name('reportes.data');

    // Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');

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
    return view('welcome');
});