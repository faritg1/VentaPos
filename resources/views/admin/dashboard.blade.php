@extends('layouts.app')

@section('title', '⚙️ Panel de Administración')

@section('content')
<div class="container mt-4">

    <h1 class="text-center mb-4">⚙️ Panel de Administración</h1>
    <p class="text-center text-muted">Selecciona una opción del menú para gestionar tu sistema:</p>

    <div class="row mt-5">
        <!-- Ventas -->
        <div class="col-md-3">
            <a href="{{ route('ventas.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body bg-primary text-white rounded">
                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                        <h4 class="card-title">Ventas</h4>
                        <p class="card-text">Gestiona y registra ventas</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Reportes -->
        <div class="col-md-3">
            <a href="{{ route('reportes.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body bg-success text-white rounded">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h4 class="card-title">Reportes</h4>
                        <p class="card-text">Visualiza estadísticas de ventas</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Clientes -->
        <div class="col-md-3">
            <a href="#" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body bg-warning text-dark rounded">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h4 class="card-title">Clientes</h4>
                        <p class="card-text">Administra la base de clientes</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Productos -->
        <div class="col-md-3">
            <a href="#" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body bg-info text-white rounded">
                        <i class="fas fa-box-open fa-3x mb-3"></i>
                        <h4 class="card-title">Productos</h4>
                        <p class="card-text">Controla el inventario y catálogo</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
