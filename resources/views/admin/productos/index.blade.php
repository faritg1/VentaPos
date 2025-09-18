@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📦 Gestión de Productos</h3>
            <a href="{{ route('admin.productos.create') }}" class="btn btn-primary btn-sm float-right">
                ➕ Nuevo Producto
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>
                                <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No hay productos registrados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            })
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            })
        </script>
    @endif

    {{-- Confirmación al eliminar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.formulario-eliminar');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡Esta acción no se puede deshacer!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>
@stop


