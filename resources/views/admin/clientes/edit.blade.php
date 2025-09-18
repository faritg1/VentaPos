@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">✏️ Editar Cliente</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Tipo de Documento --}}
            <div class="mb-3">
                <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                    <option value="">-- Seleccione --</option>
                    <option value="CC" {{ $cliente->tipo_documento == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                    <option value="TI" {{ $cliente->tipo_documento == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                    <option value="CE" {{ $cliente->tipo_documento == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                    <option value="PP" {{ $cliente->tipo_documento == 'PP' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="NIT" {{ $cliente->tipo_documento == 'NIT' ? 'selected' : '' }}>NIT</option>
                    <option value="PPT" {{ $cliente->tipo_documento == 'PPT' ? 'selected' : '' }}>Permiso por Protección Temporal</option>
                </select>
            </div>

            {{-- Número de Documento --}}
            <div class="mb-3">
                <label for="numero_documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="{{ $cliente->numero_documento }}" required>
            </div>

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
            </div>

            {{-- Dirección --}}
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}">
            </div>

            {{-- Ciudad --}}
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $cliente->ciudad }}">
            </div>

            {{-- Teléfono --}}
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}">
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">⬅ Volver</a>
                <button type="submit" class="btn btn-primary">💾 Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
