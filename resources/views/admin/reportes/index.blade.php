@extends('adminlte::page')  

@section('content')
<h1>📊 Reportes de Ventas</h1>

<div style="width: 80%; margin: auto;">
    <h3>Ventas por Día (últimos 7 días)</h3>
    <canvas id="chartDia"></canvas>
</div>

<div style="width: 80%; margin: auto; margin-top: 40px;">
    <h3>Ventas por Mes (últimos 6 meses)</h3>
    <canvas id="chartMes"></canvas>
</div>

<div style="width: 80%; margin: auto; margin-top: 40px;">
    <h3>Productos Más Vendidos</h3>
    <canvas id="chartProducto"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("{{ route('reportes.data') }}")
        .then(response => response.json())
        .then(data => {
            // === Ventas por Día ===
            const ctxDia = document.getElementById('chartDia').getContext('2d');
            new Chart(ctxDia, {
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
            const ctxMes = document.getElementById('chartMes').getContext('2d');
            new Chart(ctxMes, {
                type: 'bar',
                data: {
                    labels: data.porMes.map(m => m.mes),
                    datasets: [{
                        label: 'Ventas ($)',
                        data: data.porMes.map(m => m.total),
                        backgroundColor: 'green'
                    }]
                }
            });

            // === Productos Más Vendidos ===
            const ctxProd = document.getElementById('chartProducto').getContext('2d');
            new Chart(ctxProd, {
                type: 'pie',
                data: {
                    labels: data.porProducto.map(p => p.producto.nombre),
                    datasets: [{
                        data: data.porProducto.map(p => p.cantidad),
                        backgroundColor: ['red','orange','yellow','green','blue']
                    }]
                }
            });
        });
});
</script>
@endsection
