<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $producto = Producto::all();
        return view('admin.producto.index', compact('producto'));
    }

    public function create()
    {
        return view('admin.producto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());

        return redirect()->route('admin.producto.index')->with('success', '✅ Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('admin.producto.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        $producto->update($request->all());

        return redirect()->route('admin.producto.index')->with('success', '✏️ Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->detalleVentas()->count() > 0) {
            return redirect()->route('admin.producto.index')->with('error', '❌ No se puede eliminar un producto con ventas registradas.');
        }

        $producto->delete();

        return redirect()->route('admin.producto.index')->with('success', '🗑️ Producto eliminado correctamente.');
    }
}

