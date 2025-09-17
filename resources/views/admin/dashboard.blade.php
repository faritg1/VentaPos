@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
    <h1>⚙️ Panel de Administración</h1>
    <p>Selecciona una opción del menú:</p>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <a href="{{ route('ventas.index') }}" style="padding:20px; background:#007bff; color:white; border-radius:8px; text-decoration:none;">
            🛒 Ventas
        </a>

        <a href="{{ route('reportes.index') }}" style="padding:20px; background:#28a745; color:white; border-radius:8px; text-decoration:none;">
            📊 Reportes
        </a>

        <a href="#" style="padding:20px; background:#ffc107; color:black; border-radius:8px; text-decoration:none;">
            👥 Clientes
        </a>

        <a href="#" style="padding:20px; background:#17a2b8; color:white; border-radius:8px; text-decoration:none;">
            🍴 Productos
        </a>
    </div>
@endsection
