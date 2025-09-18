-- =========================================
-- TABLA: productos
-- =========================================
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    descripcion TEXT NULL
);

-- =========================================
-- TABLA: clientes
-- =========================================
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_documento VARCHAR(20) NULL,
    numero_documento VARCHAR(50) UNIQUE NULL,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(150) NULL,
    ciudad VARCHAR(100) NULL,
    telefono VARCHAR(50) NULL,
    es_mostrador BOOLEAN DEFAULT FALSE
);

-- =========================================
-- TABLA: metodos_pago
-- =========================================
CREATE TABLE metodo_pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- =========================================
-- TABLA: ventas
-- =========================================
CREATE TABLE venta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('mostrador','factura') NOT NULL,
    cliente_id INT NULL,
    metodo_pago_id INT NULL,
    total DECIMAL(12,2) NOT NULL,
    numero_factura VARCHAR(50) UNIQUE NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (metodo_pago_id) REFERENCES metodo_pago(id)
);

-- =========================================
-- TABLA: detalle_ventas
-- =========================================
CREATE TABLE detalle_venta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES venta(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

-- =========================================
-- TABLA: inventario_movimientos
-- =========================================
CREATE TABLE inventario_movimiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo ENUM('entrada','salida') NOT NULL,
    cantidad INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);
