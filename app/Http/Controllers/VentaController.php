<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'metodoPago')->orderBy('fecha', 'desc')->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function show($id)
    {
        $venta = Venta::with('detalles.producto', 'cliente', 'metodoPago')->findOrFail($id);
        return view('admin.ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $metodosPago = MetodoPago::all();

        return view('admin.ventas.edit', compact('venta', 'clientes', 'metodosPago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:cliente,id',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'total' => 'required|numeric|min:0',
            'tipo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'numero_factura' => 'nullable|string|max:50',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('ventas.index')->with('success', '✅ Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', '🗑️ Venta eliminada correctamente.');
    }
}
