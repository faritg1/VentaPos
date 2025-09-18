@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-dark text-white">
        <h4 class="mb-0">➕ Registrar Cliente</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.clientes.store') }}" method="POST">
            @csrf

            {{-- Tipo de Documento --}}
            <div class="mb-3">
                <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                    <option value="">-- Seleccione --</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PP">Pasaporte</option>
                    <option value="NIT">NIT</option>
                    <option value="PPT">Permiso por Protección Temporal</option>
                </select>
            </div>

            {{-- Número de Documento --}}
            <div class="mb-3">
                <label for="numero_documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
            </div>

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            {{-- Dirección --}}
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion">
            </div>

            {{-- Ciudad --}}
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad">
            </div>

            {{-- Teléfono --}}
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">⬅ Volver</a>
                <button type="submit" class="btn btn-success">💾 Guardar</button>
            </div>
        </form>
    </div>
</div>
@stop

