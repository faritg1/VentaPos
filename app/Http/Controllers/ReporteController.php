<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ReporteController extends Controller
{
    /**
     * Vista principal de reportes
     */
    public function index()
    {
        return view('admin.reportes.index');
    }

    /**
     * API JSON para gráficos y estadísticas
     */
    public function data()
    {
        return Cache::remember('reportes.data', 60, function () {

            // === Ventas por día (últimos 7 días) ===
            $ventasPorDia = Venta::select(
                    DB::raw('DATE(fecha) as fecha'),
                    DB::raw('SUM(total) as total')
                )
                ->groupBy('fecha')
                ->orderBy('fecha', 'desc')
                ->limit(7)
                ->get();

            // === Ventas por mes (últimos 6 meses) ===
            $ventasPorMes = Venta::select(
                    DB::raw('DATE_FORMAT(fecha, "%Y-%m") as mes'),
                    DB::raw('SUM(total) as total')
                )
                ->groupBy('mes')
                ->orderBy('mes', 'desc')
                ->limit(6)
                ->get();

            // === Productos más vendidos (Top 5) ===
            $ventasPorProducto = DB::table('detalle_venta')
                ->join('producto', 'detalle_venta.producto_id', '=', 'producto.id')
                ->select(
                    'producto.nombre as label',
                    DB::raw('SUM(detalle_venta.cantidad) as value')
                )
                ->groupBy('producto.id', 'producto.nombre')
                ->orderByDesc('value')
                ->limit(5)
                ->get();

            // === Totales (ventas y facturas) ===
            $totales = Venta::selectRaw('
                    SUM(total) as ventasTotales,
                    COUNT(CASE WHEN tipo = "factura" THEN 1 END) as facturas
                ')
                ->first();

            // === Clientes (mostrador y registrados) ===
            $clientes = DB::table('cliente')->selectRaw('
                    COUNT(*) as total,
                    SUM(CASE WHEN es_mostrador = 1 THEN 1 ELSE 0 END) as mostrador,
                    SUM(CASE WHEN es_mostrador = 0 THEN 1 ELSE 0 END) as registrados
                ')
                ->first();

            // === Productos vendidos ===
            $productosVendidos = DetalleVenta::sum('cantidad');

            return [
                'ventasTotales'     => $totales->ventasTotales ?? 0,
                'clientes'          => $clientes->total ?? 0,
                'productosVendidos' => $productosVendidos ?? 0,
                'facturas'          => $totales->facturas ?? 0,
                'porDia'            => $ventasPorDia,
                'porMes'            => $ventasPorMes,
                'porProducto'       => $ventasPorProducto,
                'tipoClientes'      => [
                    'mostrador'   => $clientes->mostrador ?? 0,
                    'registrados' => $clientes->registrados ?? 0,
                ],
            ];
        });
    }
}
