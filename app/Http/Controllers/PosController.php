<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\MetodoPago; // <-- 1. Importar el modelo
use Illuminate\Support\Facades\DB;
use Throwable; // Importar Throwable para un mejor manejo de excepciones
use Illuminate\Support\Facades\Validator; // Importar el Facade Validator
class PosController extends Controller
{
    public function index()
    {
        $productos = Producto::where('cantidad', '>', 0)->orderBy('nombre')->get();
        $metodosPago = MetodoPago::all(); // <-- 2. Obtener los métodos de pago

        // 3. Pasarlos a la vista
        return view('pos.index', compact('productos', 'metodosPago'));
    }

    public function store(Request $request)
    {
        // Validar que lleguen productos
        $validated = $request->validate([
            'cliente_id' => 'required|integer|exists:cliente,id',
            'metodo_pago_id' => 'required|integer|exists:metodo_pago,id', // <-- Validar método de pago
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|integer|exists:producto,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalVenta = 0;
            $clienteId = $validated['cliente_id'];
            $esFactura = $clienteId != 1; // Asumimos que el ID 1 es "Venta de Mostrador"

            // 1. Crear la Venta
            $venta = Venta::create([
                'tipo' => $esFactura ? 'factura' : 'mostrador',
                'cliente_id' => $clienteId,
                'metodo_pago_id' => $validated['metodo_pago_id'], // <-- Usar el valor validado
                'total' => 0, // Se actualizará al final
                'fecha' => now()
            ]);

            // 2. Procesar cada producto del carrito
            foreach ($validated['productos'] as $prod) {
                $producto = Producto::find($prod['id']);

                // Doble validación de stock (seguridad)
                if ($producto->cantidad < $prod['cantidad']) {
                    throw new \Exception("Stock insuficiente para el producto: {$producto->nombre}");
                }

                $subtotal = $producto->precio * $prod['cantidad'];
                $totalVenta += $subtotal;

                // 3. Crear el Detalle de la Venta
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $prod['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal // <-- Añadir esta línea
                ]);

                // 4. Actualizar el stock del producto
                $producto->decrement('cantidad', $prod['cantidad']);
            }

            // 5. Actualizar el total en la Venta
            $venta->update(['total' => $totalVenta]);

            DB::commit();
            
            // Devolver una respuesta JSON en lugar de redirigir
            return response()->json(['success' => 'Venta registrada con éxito. ID: ' . $venta->id]);

        } catch (Throwable $e) {
            DB::rollBack();
            // Devolver una respuesta JSON de error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'numero_documento' => 'required|string|max:20|unique:cliente,numero_documento',
            'tipo_documento' => 'required|string|max:10',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $cliente = Cliente::create($validator->validated());

            return response()->json(['success' => true, 'client' => $cliente]);

        } catch (Throwable $e) {
            return response()->json(['success' => false, 'error' => 'Error interno del servidor al crear el cliente.'], 500);
        }
    }

    public function searchClient($numeroDocumento)
    {
        $cliente = Cliente::where('numero_documento', $numeroDocumento)->first();

        if ($cliente) {
            return response()->json(['success' => true, 'client' => $cliente]);
        }

        return response()->json(['success' => false, 'message' => 'Cliente no encontrado.']);
    }
}