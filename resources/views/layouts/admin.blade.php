@extends('adminlte::page')

@section('title', '🖥️ Panel de Administración')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="fw-bold text-primary m-0">
            <i class="fas fa-tachometer-alt me-2"></i> Panel de Administración
        </h1>
        <span class="badge bg-gradient-primary text-white px-3 py-2 shadow-sm">
            Bienvenido
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid py-4">
    <div class="alert alert-light border-start border-4 border-primary shadow-sm" role="alert">
        <i class="fas fa-info-circle me-2 text-primary"></i>
        Usa el menú lateral para navegar entre las diferentes secciones del sistema.
    </div>
</div>
@stop

{{-- Estilos personalizados --}}
@push('css')
<style>
    h1 {
        letter-spacing: 0.5px;
    }
    .badge {
        font-size: 0.9rem;
        border-radius: 20px;
    }
</style>
@endpush
