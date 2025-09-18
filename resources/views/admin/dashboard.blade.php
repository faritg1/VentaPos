@extends('layouts.admin')

@section('title', '⚙️ Panel de Administración')

@section('content')
<div class="container-fluid mt-5">

    <div class="text-center py-5">
        <h1 class="fw-bold display-4 text-gradient mb-4">
            <i class="fas fa-cogs fa-spin me-2"></i>
            Bienvenido al Panel de Administración
        </h1>
        <p class="fs-5 text-muted">
            Aquí podrás <span class="fw-semibold">gestionar productos, ventas y reportes</span> 
            de manera rápida y sencilla.  
            Usa el menú lateral para comenzar 🚀
        </p>
    </div>

</div>

{{-- Estilos personalizados --}}
<style>
    /* Gradiente más moderno */
    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997, #6f42c1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    h1 {
        letter-spacing: 1px;
        text-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .container-fluid {
        animation: fadeIn 1s ease-in-out;
    }

    /* Animación de entrada */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Mejor contraste en el texto secundario */
    p {
        max-width: 700px;
        margin: auto;
        line-height: 1.6;
    }
</style>
@endsection
