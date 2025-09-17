@extends('layouts.app')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">📦 Gestión de Productos</h4>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">➕ Nuevo Producto</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No hay productos registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
