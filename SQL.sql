-- =========================================
-- TABLA: productos
-- =========================================
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    descripcion TEXT NULL
);

-- =========================================
-- TABLA: clientes
-- =========================================
CREATE TABLE clientes (
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
CREATE TABLE metodos_pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- =========================================
-- TABLA: ventas
-- (unificamos ventas de mostrador y con factura)
-- =========================================
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('mostrador','factura') NOT NULL,
    cliente_id INT NULL,
    metodo_pago_id INT NULL,
    total DECIMAL(12,2) NOT NULL,
    numero_factura VARCHAR(50) UNIQUE NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (metodo_pago_id) REFERENCES metodos_pago(id)
);

-- =========================================
-- TABLA: detalle_ventas
-- =========================================
CREATE TABLE detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- =========================================
-- TABLA: inventario_movimientos
-- (entradas y salidas de stock)
-- =========================================
CREATE TABLE inventario_movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo ENUM('entrada','salida') NOT NULL,
    cantidad INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
