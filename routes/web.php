<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;

// POS: solo crear venta
Route::get('/pos', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/pos', [VentaController::class, 'store'])->name('ventas.store');

// ADMIN: solo ver ventas
Route::prefix('admin')->group(function () {
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
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
