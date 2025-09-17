@extends('adminlte::page')

@section('title', '📊 Reportes')

@section('content_header')
    <h1>📊 Reportes y Estadísticas</h1>
@stop

@section('content')
<div class="container-fluid">

    <!-- Botón volver -->
    <a href="{{ url('/admin') }}" class="btn btn-secondary mb-3">
        ⬅️ Volver al Panel de Administración
    </a>

    <!-- Tarjetas resumen -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="ventasTotales">$0</h3>
                    <p>Ventas Totales</p>
                </div>
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="clientes">0</h3>
                    <p>Clientes Registrados</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="productosVendidos">0</h3>
                    <p>Productos Vendidos</p>
                </div>
                <div class="icon"><i class="fas fa-box"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="facturas">0</h3>
                    <p>Facturas Emitidas</p>
                </div>
                <div class="icon"><i class="fas fa-file-invoice"></i></div>
            </div>
        </div>
    </div>

    <!-- Gráficas -->
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">📅 Ventas por Día</div>
                <div class="card-body">
                    <canvas id="chartDia"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">📆 Ventas por Mes</div>
                <div class="card-body">
                    <canvas id="chartMes"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">🥟 Productos Más Vendidos</div>
                <div class="card-body">
                    <canvas id="chartProducto"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">👥 Tipo de Clientes</div>
                <div class="card-body">
                    <canvas id="chartClientes"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    fetch("{{ route('reportes.data') }}")
        .then(res => res.json())
        .then(data => {
            // === Totales ===
            document.getElementById('ventasTotales').innerText = "$" + parseFloat(data.ventasTotales).toFixed(2);
            document.getElementById('clientes').innerText = data.clientes;
            document.getElementById('productosVendidos').innerText = data.productosVendidos;
            document.getElementById('facturas').innerText = data.facturas;

            // === Ventas por Día ===
            new Chart(document.getElementById('chartDia'), {
                type: 'line',
                data: {
                    labels: data.porDia.map(v => v.fecha),
                    datasets: [{
                        label: 'Ventas por Día',
                        data: data.porDia.map(v => v.total),
                        borderColor: '#007bff',
                        fill: false,
                        tension: 0.3
                    }]
                }
            });

            // === Ventas por Mes ===
            new Chart(document.getElementById('chartMes'), {
                type: 'bar',
                data: {
                    labels: data.porMes.map(v => v.mes),
                    datasets: [{
                        label: 'Ventas por Mes',
                        data: data.porMes.map(v => v.total),
                        backgroundColor: '#28a745'
                    }]
                }
            });

            // === Productos Más Vendidos ===
            new Chart(document.getElementById('chartProducto'), {
                type: 'pie',
                data: {
                    labels: data.porProducto.map(p => p.producto?.nombre ?? 'Desconocido'),
                    datasets: [{
                        data: data.porProducto.map(p => p.cantidad),
                        backgroundColor: ['#FF5733','#FFC300','#28A745','#007BFF','#6F42C1']
                    }]
                }
            });

            // === Tipo de Clientes ===
            new Chart(document.getElementById('chartClientes'), {
                type: 'doughnut',
                data: {
                    labels: ['Mostrador', 'Registrados'],
                    datasets: [{
                        data: [data.tipoClientes.mostrador, data.tipoClientes.registrados],
                        backgroundColor: ['#17A2B8','#E83E8C']
                    }]
                }
            });
        })
        .catch(err => console.error("Error cargando datos:", err));
});
</script>
@stop
