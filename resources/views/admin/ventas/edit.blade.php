@extends('adminlte::page')

@section('title', '✏️ Editar Venta')

@section('content_header')
    <h1><i class="fas fa-edit"></i> Editar Venta</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipo" class="form-label">Tipo de Venta</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="mostrador" {{ $venta->tipo == 'mostrador' ? 'selected' : '' }}>Mostrador</option>
                        <option value="factura" {{ $venta->tipo == 'factura' ? 'selected' : '' }}>Factura</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="metodo_pago_id" class="form-label">Método de Pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-control" required>
                        @foreach ($metodosPago as $metodo)
                            <option value="{{ $metodo->id }}" {{ $venta->metodo_pago_id == $metodo->id ? 'selected' : '' }}>
                                {{ $metodo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ $venta->total }}" required>
            </div>

            <div class="mb-3">
                <label for="numero_factura" class="form-label">Número de Factura</label>
                <input type="text" name="numero_factura" id="numero_factura" class="form-control" value="{{ $venta->numero_factura }}">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </form>
    </div>
</div>
@stop
