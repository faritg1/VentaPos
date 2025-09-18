@extends('adminlte::page')

@section('title', '🧾 Ventas')

@section('content_header')
    <h1 class="fw-bold text-primary">
        <i class="fas fa-shopping-cart me-2"></i> Ventas
    </h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list me-2"></i> Listado de Ventas
    </div>

    <div class="card-body">
        <table id="tablaVentas" class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->cliente->nombre ?? 'Mostrador' }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $venta->tipo == 'factura' ? 'success' : 'secondary' }}">
                                {{ ucfirst($venta->tipo) }}
                            </span>
                        </td>
                        <td>
                            <!-- Ver -->
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Editar -->
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#tablaVentas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });
</script>
@stop
