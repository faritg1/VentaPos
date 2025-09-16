@extends('layouts.app')

@section('content')
<h1>Historial de Ventas</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Tipo</th>
            <th>Método de Pago</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
        <tr>
            <td>{{ $venta->id }}</td>
            <td>{{ $venta->cliente ? $venta->cliente->nombre : 'Mostrador' }}</td>
            <td>${{ number_format($venta->total, 2) }}</td>
            <td>{{ ucfirst($venta->tipo) }}</td>
            <td>{{ $venta->metodoPago->nombre ?? 'N/A' }}</td>
            <td>{{ $venta->fecha }}</td>
            <td>
                <a href="{{ route('ventas.show', $venta->id) }}">Ver Detalle</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
