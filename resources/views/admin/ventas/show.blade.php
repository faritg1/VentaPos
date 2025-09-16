@extends('layouts.app')

@section('content')
<h1>Detalle de Venta #{{ $venta->id }}</h1>

<p><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'Mostrador' }}</p>
<p><strong>Tipo:</strong> {{ ucfirst($venta->tipo) }}</p>
<p><strong>Método de Pago:</strong> {{ $venta->metodoPago->nombre ?? 'N/A' }}</p>
<p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
<p><strong>Fecha:</strong> {{ $venta->fecha }}</p>

<h3>Productos Vendidos</h3>
<table border="1">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($venta->detalles as $detalle)
        <tr>
            <td>{{ $detalle->producto->nombre }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>${{ $detalle->precio_unitario }}</td>
            <td>${{ $detalle->subtotal }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
