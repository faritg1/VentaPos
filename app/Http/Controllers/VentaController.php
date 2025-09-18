<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Listado de ventas
    public function index()
    {
        $ventas = Venta::with('cliente', 'metodoPago')
                        ->orderBy('fecha', 'desc') // usamos fecha en lugar de created_at
                        ->get();

        return view('admin.ventas.index', compact('ventas'));
    }

    // Detalle de una venta
    public function show($id)
    {
        $venta = Venta::with('detalles.producto', 'cliente', 'metodoPago')
                       ->findOrFail($id);

        return view('admin.ventas.show', compact('venta'));
    }
}
