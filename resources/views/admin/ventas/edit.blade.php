@extends('adminlte::page')

@section('title', 'Editar Venta')

@section('content_header')
    <h1>Editar Venta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
             <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- CAMBIO: Reemplazar el <select> por un <input> --}}
                <div class="form-group">
                    <label for="cliente_nombre">Cliente</label>
                    <input type="text" id="cliente_nombre" class="form-control" 
                           value="{{ $venta->cliente->nombre ?? 'Cliente no encontrado' }}" readonly>
                    {{-- Se mantiene un campo oculto para no romper la lógica del update si fuera necesaria --}}
                    <input type="hidden" name="cliente_id" value="{{ $venta->cliente_id }}">
                </div>

                <div class="form-group">
                    <label for="metodo_pago_id">Método de Pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-control" required>
                        @foreach($metodosPago as $metodo)
                            <option value="{{ $metodo->id }}" {{ $venta->metodo_pago_id == $metodo->id ? 'selected' : '' }}>
                                {{ $metodo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" step="0.01" name="total" id="total" class="form-control"
                           value="{{ old('total', $venta->total) }}" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" name="tipo" id="tipo" class="form-control"
                           value="{{ old('tipo', $venta->tipo) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control"
                           value="{{ old('fecha', $venta->fecha) }}" required>
                </div>

                <div class="form-group">
                    <label for="numero_factura">Número de Factura</label>
                    <input type="text" name="numero_factura" id="numero_factura" class="form-control"
                           value="{{ old('numero_factura', $venta->numero_factura) }}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
