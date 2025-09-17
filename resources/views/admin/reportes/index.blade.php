@extends('adminlte::page')

@section('title', '📊 Reportes de Ventas')

@section('content_header')
    <h1 class="text-center">📊 Tablero de Control de Ventas</h1>
@stop

@section('content')
<div class="row">

    <!-- Card Ventas Totales -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="ventasTotales">0</h3>
                <p>Ventas Totales</p>
            </div>
            <div class="icon"><i class="fas fa-cash-register"></i></div>
        </div>
    </div>

    <!-- Card Clientes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="clientes">0</h3>
                <p>Clientes Registrados</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
        </div>
    </div>

    <!-- Card Productos Vendidos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="productosVendidos">0</h3>
                <p>Productos Vendidos</p>
            </div>
            <div class="icon"><i class="fas fa-box"></i></div>
        </div>
    </div>

    <!-- Card Facturas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="facturas">0</h3>
                <p>Facturas Electrónicas</p>
            </div>
            <div class="icon"><i class="fas fa-file-invoice"></i></div>
        </div>
    </div>

</div>

<hr>

<div class="row">
    <!-- Ventas por Día -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">📅 Ventas por Día</h3></div>
            <div class="card-body">
                <canvas id="chartDia"></canvas>
            </div>
        </div>
    </div>

    <!-- Ventas por Mes -->
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header"><h3 class="card-title">📆 Ventas por Mes</h3></div>
            <div class="card-body">
                <canvas id="chartMes"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Productos más vendidos -->
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">🥟 Productos Más Vendidos</h3></div>
            <div class="card-body">
                <canvas id="chartProducto"></canvas>
            </div>
        </div>
    </div>

    <!-- Comparativa tipo de clientes -->
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header"><h3 class="card-title">👥 Tipo de Clientes</h3></div>
            <div class="card-body">
                <canvas id="chartClientes"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("{{ route('reportes.data') }}")
        .then(response => response.json())
        .then(data => {
            // === Actualizar Cards ===
            document.getElementById('ventasTotales').textContent = data.ventasTotales;
            document.getElementById('clientes').textContent = data.clientes;
            document.getElementById('productosVendidos').textContent = data.productosVendidos;
            document.getElementById('facturas').textContent = data.facturas;

            // === Ventas por Día ===
            new Chart(document.getElementById('chartDia'), {
                type: 'line',
                data: {
                    labels: data.porDia.map(d => d.fecha),
                    datasets: [{
                        label: 'Ventas ($)',
                        data: data.porDia.map(d => d.total),
                        borderColor: 'blue',
                        fill: false
                    }]
                }
            });

            // === Ventas por Mes ===
            new Chart(document.getElementById('chartMes'), {
                type: 'bar',
                data: {
                    labels: data.porMes.map(m => m.mes),
                    datasets: [{
                        label: 'Ventas ($)',
                        data: data.porMes.map(m => m.total),
                        backgroundColor: 'rgba(0, 128, 0, 0.6)'
                    }]
                }
            });

            // === Productos Más Vendidos ===
            new Chart(document.getElementById('chartProducto'), {
                type: 'pie',
                data: {
                    labels: data.porProducto.map(p => p.producto.nombre),
                    datasets: [{
                        data: data.porProducto.map(p => p.cantidad),
                        backgroundColor: ['#FF5733','#FFC300','#28A745','#007BFF','#6F42C1']
                    }]
                }
            });

            // === Tipo de Clientes (Mostrador vs Registrados) ===
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
