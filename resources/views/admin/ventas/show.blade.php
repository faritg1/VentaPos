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
    </div>
</div>

<a href="{{ route('ventas.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Volver al listado
</a>
@stop
