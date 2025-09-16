<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    // Página principal de reportes
    public function index()
    {
        return view('admin.reportes.index');
    }

    // API JSON para gráficos
    public function data()
    {
        // Ventas por día (últimos 7 días)
        $ventasPorDia = Venta::select(
                DB::raw('DATE(fecha) as fecha'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->limit(7)
            ->get();

        // Ventas por mes (últimos 6 meses)
        $ventasPorMes = Venta::select(
                DB::raw('DATE_FORMAT(fecha, "%Y-%m") as mes'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->limit(6)
            ->get();

        // Ventas por producto (los 5 más vendidos)
        $ventasPorProducto = DetalleVenta::select(
                'producto_id',
                DB::raw('SUM(cantidad) as cantidad')
            )
            ->groupBy('producto_id')
            ->with('producto')
            ->orderByDesc('cantidad')
            ->limit(5)
            ->get();

        return response()->json([
            'porDia' => $ventasPorDia,
            'porMes' => $ventasPorMes,
            'porProducto' => $ventasPorProducto,
        ]);
    }
}
