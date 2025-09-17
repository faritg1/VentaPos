<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // === Totales para las cards ===
        $ventasTotales     = Venta::sum('total');
        $clientes          = DB::table('cliente')->count();
        $productosVendidos = DetalleVenta::sum('cantidad');

        // ⚠️ Ajuste: ya no existe "requiere_factura" en la tabla venta
        $facturas          = Venta::where('tipo', 'factura')->count();

        // === Tipo de clientes (mostrador vs registrados) ===
        $mostrador   = DB::table('cliente')->where('es_mostrador', true)->count();
        $registrados = DB::table('cliente')->where('es_mostrador', false)->count();

        // === Respuesta JSON ===
        return response()->json([
            'ventasTotales'     => $ventasTotales,
            'clientes'          => $clientes,
            'productosVendidos' => $productosVendidos,
            'facturas'          => $facturas,
            'porDia'            => $ventasPorDia,
            'porMes'            => $ventasPorMes,
            'porProducto'       => $ventasPorProducto,
            'tipoClientes'      => [
                'mostrador'   => $mostrador,
                'registrados' => $registrados,
            ],
        ]);
    }
}
