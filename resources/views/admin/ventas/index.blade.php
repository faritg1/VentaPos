@extends('adminlte::page')

@section('title', '🧾 Ventas')

@section('content_header')
    <h1 class="fw-bold text-primary">
        <i class="fas fa-shopping-cart me-2"></i> Ventas
    </h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i> Listado de Ventas</span>
        <a href="{{ route('ventas.create') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus-circle"></i> Nueva Venta
        </a>
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
                        <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</td>
                        <td>
                            {{ number_format($venta->total, 0, ',', '.') }} COP
                        </td>
                        <td>
                            <span class="badge bg-{{ $venta->tipo == 'factura' ? 'success' : 'secondary' }}">
                                {{ ucfirst($venta->tipo) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">
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
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tablaVentas').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });
</script>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop
