<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                DB::raw('DATE(created_at) as fecha'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->get();

        // Ventas por mes (últimos 6 meses)
        $ventasPorMes = Venta::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // Productos más vendidos (los 5 primeros)
        $ventasPorProducto = DetalleVenta::select(
                'producto_id',
                DB::raw('SUM(cantidad) as cantidad')
            )
            ->with('producto:id,nombre') // Traemos solo id y nombre
            ->groupBy('producto_id')
            ->orderByDesc('cantidad')
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'nombre' => $item->producto->nombre ?? 'Desconocido',
                    'cantidad' => $item->cantidad,
                ];
            });

        return response()->json([
            'porDia' => $ventasPorDia,
            'porMes' => $ventasPorMes,
            'porProducto' => $ventasPorProducto,
        ]);
    }
}
