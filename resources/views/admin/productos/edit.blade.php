@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">✏️ Editar Producto</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="{{ $producto->precio }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" value="{{ $producto->cantidad }}" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">⬅ Volver</a>
                <button type="submit" class="btn btn-primary">💾 Actualizar</button>
            </div>
        </form>
    </div>
</div>
@stop