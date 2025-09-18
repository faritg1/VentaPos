@extends('adminlte::page')

@section('title', 'Factura de Venta')

@section('content_header')
    <h1>Factura de Venta #{{ $venta->id }}</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4>Detalles de la Venta</h4>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'Mostrador' }}</p>
        <p><strong>Método de Pago:</strong> {{ $venta->metodoPago->nombre }}</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
        <p><strong>Número de Factura:</strong> {{ $venta->numero_factura ?? 'N/A' }}</p>
        <p><strong>Total:</strong> ${{ number_format($venta->total, 0, ',', '.') }}</p>

        <hr>
        <h5>Productos vendidos:</h5>
        <table class="table table-bordered">
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
                        <td>${{ number_format($detalle->precio, 0, ',', '.') }}</td>
                        <td>${{ number_format($detalle->cantidad * $detalle->precio, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<a href="{{ route('ventas.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Volver al listado
</a>
@stop
