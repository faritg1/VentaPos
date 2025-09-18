@extends('adminlte::page')

@section('title', '📊 Reportes')

@section('content_header')
    <h1 class="fw-bold text-primary">
        <i class="fas fa-chart-line me-2"></i> Panel de Reportes
    </h1>
@stop

@section('content')
<div class="row">
    <!-- Ventas Totales -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success shadow">
            <div class="inner">
                <h3 id="ventasTotales">0</h3>
                <p>Ventas Totales</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>

    <!-- Clientes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info shadow">
            <div class="inner">
                <h3 id="clientes">0</h3>
                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Productos vendidos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow">
            <div class="inner">
                <h3 id="productosVendidos">0</h3>
                <p>Productos Vendidos</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>

    <!-- Facturas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger shadow">
            <div class="inner">
                <h3 id="facturas">0</h3>
                <p>Facturas</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Ventas por día -->
    <div class="col-lg-6">
        <div class="card card-primary shadow">
            <div class="card-header">📅 Ventas por Día</div>
            <div class="card-body">
                <canvas id="chartDia"></canvas>
            </div>
        </div>
    </div>

    <!-- Ventas por mes -->
    <div class="col-lg-6">
        <div class="card card-success shadow">
            <div class="card-header">📆 Ventas por Mes</div>
            <div class="card-body">
                <canvas id="chartMes"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Productos más vendidos -->
    <div class="col-lg-6">
        <div class="card card-warning shadow">
            <div class="card-header">🔥 Top 5 Productos</div>
            <div class="card-body">
                <canvas id="chartProducto"></canvas>
            </div>
        </div>
    </div>

    <!-- Clientes -->
    <div class="col-lg-6">
        <div class="card card-info shadow">
            <div class="card-header">👥 Clientes</div>
            <div class="card-body">
                <canvas id="chartClientes"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// === Formato moneda COP ===
function formatoCOP(valor) {
    return new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
        minimumFractionDigits: 0
    }).format(valor);
}

document.addEventListener("DOMContentLoaded", () => {
    fetch("{{ route('reportes.data') }}")
        .then(res => res.json())
        .then(data => {
            // === Totales ===
            document.getElementById('ventasTotales').innerText = formatoCOP(data.ventasTotales);
            document.getElementById('clientes').innerText = data.clientes;
            document.getElementById('productosVendidos').innerText = data.productosVendidos;
            document.getElementById('facturas').innerText = data.facturas;

            // === Gráfica Ventas por Día ===
            new Chart(document.getElementById('chartDia'), {
                type: 'line',
                data: {
                    labels: data.porDia.map(v => v.fecha),
                    datasets: [{
                        label: 'Ventas por Día',
                        data: data.porDia.map(v => v.total),
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (ctx) => formatoCOP(ctx.raw)
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: (val) => formatoCOP(val)
                            }
                        }
                    }
                }
            });

            // === Gráfica Ventas por Mes ===
            new Chart(document.getElementById('chartMes'), {
                type: 'bar',
                data: {
                    labels: data.porMes.map(v => v.mes),
                    datasets: [{
                        label: 'Ventas por Mes',
                        data: data.porMes.map(v => v.total),
                        backgroundColor: '#28a745'
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (ctx) => formatoCOP(ctx.raw)
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: (val) => formatoCOP(val)
                            }
                        }
                    }
                }
            });

            // === Gráfica Productos más vendidos ===
            new Chart(document.getElementById('chartProducto'), {
                type: 'pie',
                data: {
                    labels: data.porProducto.map(p => p.label),
                    datasets: [{
                        data: data.porProducto.map(p => p.value),
                        backgroundColor: ['#FF5733','#FFC300','#28A745','#007BFF','#6F42C1']
                    }]
                }
            });

            // === Gráfica Clientes ===
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
