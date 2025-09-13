# Requerimientos del Sistema POS

## POS (Punto de Venta)

- Solo se venden empanadas y papas, de cualquier sabor.
- Venta de mostrador: se pueden comprar varios productos en una sola transacción.
- El POS debe minimizar la cantidad de clics necesarios para realizar una venta.
- Al realizar una compra, si el cliente solicita factura, se debe validar si el cliente existe en la base de datos; si no existe, se debe crear automáticamente.
- Rutas configuradas:
  - `/pos` para el punto de venta.
  - `/admin` para la administración.

## /admin

### Gestión de Productos

- No se puede eliminar un producto si existe al menos una venta asociada a ese producto.

### Gestión de Clientes

- Visualización de clientes con datos básicos necesarios para la generación de facturas.
- No se puede eliminar un cliente que haya realizado al menos una venta.
- El usuario administrador puede eliminar, editar y crear clientes.
- Desde el POS solo se permite crear clientes (no editar ni eliminar).

### Informe de Ventas

- Generar informes de ventas por producto, por día, mes y año.
- El informe debe ser práctico, visual, atractivo y creativo.