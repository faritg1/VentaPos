@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">👥 Gestión de Clientes</h2>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">
            ➕ Nuevo Cliente
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tipo Documento</th>
                        <th>Número</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Teléfono</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->tipo_documento ?? '-' }}</td>
                            <td>{{ $cliente->numero_documento ?? '-' }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->ciudad ?? '-' }}</td>
                            <td>{{ $cliente->telefono ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑 Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay clientes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection