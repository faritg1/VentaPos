@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Agregar Producto</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf

            {{-- Nombre (select en vez de texto) --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Tipo de Producto</label>
                <select name="nombre" id="nombre" class="form-select" required>
                    <option value="">-- Seleccione --</option>
                    <option value="Empanada">Empanada</option>
                    <option value="Papa Rellena">Papa Rellena</option>
                </select>
            </div>

            {{-- Descripción --}}
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ej: Empanada de pollo, Papa mixta" required>
            </div>

            {{-- Precio --}}
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
            </div>

            {{-- Cantidad --}}
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad en inventario</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
