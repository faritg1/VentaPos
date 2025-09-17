<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    // Vista principal de reportes
    public function index()
    {
        return view('admin.reportes.index');
    }

    // API JSON para gráficos
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
        $ventasPorProducto = DetalleVenta::select(
                'producto_id',
                DB::raw('SUM(cantidad) as cantidad')
            )
            ->groupBy('producto_id')
            ->with('producto:id,nombre') // traer solo id y nombre del producto
            ->orderByDesc('cantidad')
            ->limit(5)
            ->get();

        // === Totales para las cards ===
        $ventasTotales = Venta::sum('total');
        $clientes = DB::table('clientes')->count();
        $productosVendidos = DetalleVenta::sum('cantidad');
        $facturas = Venta::where('requiere_factura', true)->count();

        // === Tipo de clientes (mostrador vs registrados) ===
        $mostrador = DB::table('clientes')->where('es_mostrador', true)->count();
        $registrados = DB::table('clientes')->where('es_mostrador', false)->count();

        return response()->json([
            'ventasTotales'    => $ventasTotales,
            'clientes'         => $clientes,
            'productosVendidos'=> $productosVendidos,
            'facturas'         => $facturas,
            'porDia'           => $ventasPorDia,
            'porMes'           => $ventasPorMes,
            'porProducto'      => $ventasPorProducto,
            'tipoClientes'     => [
                'mostrador'   => $mostrador,
                'registrados' => $registrados
            ]
        ]);
    }
}
