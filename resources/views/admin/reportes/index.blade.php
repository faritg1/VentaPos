@extends('layouts.app')

@section('title', 'Reportes de Ventas')

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

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('reportes.data') }}")
            .then(response => response.json())
            .then(data => {
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

                new Chart(document.getElementById('chartMes'), {
                    type: 'bar',
                    data: {
                        labels: data.porMes.map(m => m.mes),
                        datasets: [{
                            label: 'Ventas ($)',
                            data: data.porMes.map(m => m.total),
                            backgroundColor: 'rgba(0,128,0,0.6)'
                        }]
                    }
                });

                new Chart(document.getElementById('chartProducto'), {
                    type: 'pie',
                    data: {
                        labels: data.porProducto.map(p => p.nombre),
                        datasets: [{
                            data: data.porProducto.map(p => p.cantidad),
                            backgroundColor: ['red','orange','yellow','green','blue','purple','cyan']
                        }]
                    }
                });
            })
            .catch(err => console.error("Error cargando datos:", err));
    });
    </script>
@endsection
