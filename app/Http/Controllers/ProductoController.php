<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        Producto::create($request->only(['nombre', 'descripcion', 'precio', 'cantidad']));

        return redirect()->route('admin.productos.index')
                         ->with('success', '✅ Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        $producto->update($request->only(['nombre', 'descripcion', 'precio', 'cantidad']));

        return redirect()->route('admin.productos.index')
                         ->with('success', '✏️ Producto actualizado correctamente.');
    }

public function destroy(Producto $producto)
{
    if ($producto->detallesVenta()->exists()) {
        return redirect()->route('admin.productos.index')
            ->with('error', '❌ No se puede eliminar el productos con ventas.');
    }

    $producto->delete();

    return redirect()->route('admin.productos.index')
        ->with('success', '🗑️ Producto eliminado correctamente.');
}

}

