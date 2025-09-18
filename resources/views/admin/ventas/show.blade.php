@extends('adminlte::page')

@section('title', '🔍 Detalle Venta')

@section('content_header')
    <h1><i class="fas fa-file-invoice"></i> Detalle de Venta</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h4 class="mb-3 text-primary">Información de la Venta</h4>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'Mostrador' }}</li>
            <li class="list-group-item"><strong>Tipo:</strong> {{ ucfirst($venta->tipo) }}</li>
            <li class="list-group-item"><strong>Método de Pago:</strong> {{ $venta->metodoPago->nombre ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</li>
            <li class="list-group-item"><strong>Factura:</strong> {{ $venta->numero_factura ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Fecha:</strong> {{ $venta->fecha }}</li>
        </ul>

        <h4 class="mb-3 text-primary">Detalle de Productos</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
@stop
