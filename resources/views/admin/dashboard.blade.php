@extends('layouts.app')

@section('title', '⚙️ Panel de Administración')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">⚙️ Panel de Administración</h1>
        <p class="text-muted">Bienvenido, selecciona una opción para continuar</p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Ventas -->
        <div class="col-md-3">
            <a href="{{ route('ventas.index') }}" class="card card-dashboard text-white bg-primary h-100 text-decoration-none">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                    <h4 class="fw-bold">Ventas</h4>
                    <p class="mb-0">Gestión de ventas</p>
                </div>
            </a>
        </div>

        <!-- Reportes -->
        <div class="col-md-3">
            <a href="{{ route('reportes.index') }}" class="card card-dashboard text-white bg-success h-100 text-decoration-none">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x mb-3"></i>
                    <h4 class="fw-bold">Reportes</h4>
                    <p class="mb-0">Estadísticas y gráficas</p>
                </div>
            </a>
        </div>

        <!-- Clientes -->
<li class="nav-item">
    <a href="{{ route('admin.clientes.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Clientes</p>
    </a>
</li>

        <!-- Productos -->
        <div class="col-md-3">
            <a href="#" class="card card-dashboard text-white bg-info h-100 text-decoration-none">
                <div class="card-body text-center">
                    <i class="fas fa-box fa-3x mb-3"></i>
                    <h4 class="fw-bold">Productos</h4>
                    <p class="mb-0">Inventario y catálogo</p>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    .card-dashboard {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .card-dashboard:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        filter: brightness(1.1);
    }
</style>
@endsection
