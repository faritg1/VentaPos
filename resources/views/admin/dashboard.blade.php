@extends('layouts.app')

@section('title', '⚙️ Panel de Administración')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-4">⚙️ Panel de Administración</h1>
    <p class="text-muted">Selecciona una opción del menú:</p>

    <div class="d-flex flex-wrap justify-content-center gap-4 mt-4">

        <!-- Ventas -->
        <a href="{{ route('ventas.index') }}" 
           class="d-block p-4 bg-primary text-white rounded shadow text-decoration-none"
           style="width:220px; transition:transform .2s;">
            <i class="fas fa-shopping-cart fa-2x mb-2"></i>
            <h4>Ventas</h4>
            <p class="mb-0">Gestión de ventas</p>
        </a>

        <!-- Reportes -->
        <a href="{{ route('reportes.index') }}" 
           class="d-block p-4 bg-success text-white rounded shadow text-decoration-none"
           style="width:220px; transition:transform .2s;">
            <i class="fas fa-chart-line fa-2x mb-2"></i>
            <h4>Reportes</h4>
            <p class="mb-0">Estadísticas y gráficas</p>
        </a>

        <!-- Clientes -->
        <a href="#" 
           class="d-block p-4 bg-warning text-dark rounded shadow text-decoration-none"
           style="width:220px; transition:transform .2s;">
            <i class="fas fa-users fa-2x mb-2"></i>
            <h4>Clientes</h4>
            <p class="mb-0">Gestión de clientes</p>
        </a>

        <!-- Productos -->
        <a href="#" 
           class="d-block p-4 bg-info text-white rounded shadow text-decoration-none"
           style="width:220px; transition:transform .2s;">
            <i class="fas fa-box fa-2x mb-2"></i>
            <h4>Productos</h4>
            <p class="mb-0">Inventario y catálogo</p>
        </a>
    </div>
</div>
@endsection
