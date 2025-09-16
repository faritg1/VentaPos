<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\MetodoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // ADMIN: historial de ventas
    public function index()
    {
        $ventas = Venta::with('cliente', 'detalles.producto', 'metodoPago')->latest()->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    // ADMIN: detalle de venta
    public function show($id)
    {
        $venta = Venta::with('cliente', 'detalles.producto', 'metodoPago')->findOrFail($id);
        return view('admin.ventas.show', compact('venta'));
    }

    // POS: crear venta
    public function create()
    {
        $productos = Producto::all();
        $metodosPago = MetodoPago::all();
        return view('ventas.create', compact('productos', 'metodosPago'));
    }

    // POS: guardar venta
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. Validar cliente si es factura
            $cliente_id = null;
            if ($request->tipo === 'factura') {
                $cliente = Cliente::firstOrCreate(
                    ['numero_documento' => $request->numero_documento],
                    [
                        'tipo_documento' => $request->tipo_documento,
                        'nombre' => $request->nombre,
                        'direccion' => $request->direccion,
                        'ciudad' => $request->ciudad,
                        'telefono' => $request->telefono,
                    ]
                );
                $cliente_id = $cliente->id;
            }

            // 2. Crear venta
            $venta = Venta::create([
                'tipo' => $request->tipo,
                'cliente_id' => $cliente_id,
                'metodo_pago_id' => $request->metodo_pago_id,
                'total' => $request->total,
                'numero_factura' => $request->tipo === 'factura' ? uniqid('FAC-') : null,
            ]);

            // 3. Guardar detalle
            foreach ($request->productos as $item) {
                if ($item['cantidad'] > 0) {
                    $producto = Producto::find($item['id']);
                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $producto->precio,
                        'subtotal' => $producto->precio * $item['cantidad'],
                    ]);
                    // Restar inventario
                    $producto->cantidad -= $item['cantidad'];
                    $producto->save();
                }
            }

            DB::commit();
            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}