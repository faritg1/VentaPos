<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\MetodoPago;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // Mostrar la vista del POS
    public function index()
    {
        $producto = Producto::all();
        $metodo_pago = MetodoPago::all();

        return view('pos.index', compact('producto', 'metodo_pago'));
    }

    // Registrar la venta
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Si el cliente requiere factura
            $clienteId = null;
            if ($request->has('requiere_factura') && $request->requiere_factura == "1") {
                $cliente = Cliente::firstOrCreate(
                    ['numero_documento' => $request->numero_documento],
                    [
                        'tipo_documento' => $request->tipo_documento,
                        'nombre' => $request->nombre,
                        'direccion' => $request->direccion,
                        'ciudad' => $request->ciudad,
                        'telefono' => $request->telefono,
                        'es_mostrador' => false
                    ]
                );
                $clienteId = $cliente->id;
            }

            // Crear la venta
            $venta = Venta::create([
                'tipo' => $request->requiere_factura ? 'factura' : 'mostrador',
                'cliente_id' => $clienteId,
                'metodo_pago_id' => $request->metodo_pago_id,
                'total' => 0
            ]);

            $total = 0;

            foreach ($request->producto as $prod) {
                $producto = Producto::findOrFail($prod['id']);

                if ($producto->cantidad < $prod['cantidad']) {
                    throw new \Exception("No hay suficiente stock de {$producto->nombre}");
                }

                $subtotal = $producto->precio * $prod['cantidad'];
                $total += $subtotal;

                // Insertar detalle
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $prod['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal
                ]);

                // Actualizar inventario
                $producto->decrement('cantidad', $prod['cantidad']);
            }

            $venta->update(['total' => $total]);

            DB::commit();
            return redirect()->route('pos.index')->with('success', 'Venta registrada con éxito');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
