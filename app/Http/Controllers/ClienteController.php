<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    // Mostrar formulario para crear cliente
    public function create()
    {
        return view('admin.clientes.create');
    }

    // Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'tipo_documento' => 'nullable|string|max:20',
            'numero_documento' => 'nullable|string|max:50|unique:clientes,numero_documento',
            'direccion' => 'nullable|string|max:150',
            'ciudad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:50',
        ]);

        Cliente::create($request->all());

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'tipo_documento' => 'nullable|string|max:20',
            'numero_documento' => 'nullable|string|max:50|unique:clientes,numero_documento,' . $cliente->id,
            'direccion' => 'nullable|string|max:150',
            'ciudad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:50',
        ]);

        $cliente->update($request->all());

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}

