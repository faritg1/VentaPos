# Sistema de Punto de Venta (POS) - VentaPos

Este es un sistema de Punto de Venta (POS) desarrollado en Laravel, diseñado específicamente para la venta de empanadas y papas. El sistema cuenta con una interfaz de venta rápida (`/pos`) y un panel de administración (`/admin`) para la gestión de productos, clientes y reportes.

## ✨ Características Principales

- **Punto de Venta Rápido:** Interfaz optimizada para minimizar clics, con búsqueda de productos y cálculo de totales en tiempo real.
- **Gestión de Clientes:** Permite ventas a un "Cliente de Mostrador" por defecto, búsqueda de clientes existentes por documento y registro de nuevos clientes sin salir de la vista del POS.
- **Gestión de Stock:** El stock de los productos se descuenta automáticamente con cada venta.
- **Panel de Administración:** Integrado con [Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) para una gestión sencilla.
- **Interfaz Dinámica:** Uso de JavaScript y SweetAlert2 para una experiencia de usuario fluida y moderna.

---

## 📋 Requisitos Previos

Asegúrate de tener instalado el siguiente software en tu sistema:

- PHP >= 8.1
- Composer
- Servidor web (XAMPP, WAMP, MAMP, etc.)
- Base de datos (MySQL / MariaDB)
- Node.js y NPM (Opcional, para la gestión de assets de frontend)

---

## 🚀 Guía de Instalación

Sigue estos pasos para poner en marcha el proyecto en tu entorno local.

**1. Clonar el Repositorio**
```bash
git clone <URL_DEL_REPOSITORIO> VentaPos
cd VentaPos
```

**2. Instalar Dependencias de PHP**
Instala todas las librerías necesarias definidas en `composer.json`.
```bash
composer install
```

**3. Configurar el Entorno**
Copia el archivo de ejemplo `.env.example` a un nuevo archivo llamado `.env`.
```bash
copy .env.example .env
```
Genera una nueva clave de aplicación para tu proyecto.
```bash
php artisan key:generate
```

**4. Configurar la Base de Datos**
Abre el archivo `.env` y modifica las siguientes líneas con los datos de tu base de datos (los valores por defecto de XAMPP suelen ser los siguientes):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=VentaPos
DB_USERNAME=root
DB_PASSWORD=
```
**Importante:** Asegúrate de crear una base de datos vacía con el nombre que definiste (ej. `VentaPos`).

**5. Crear la Estructura de la Base de Datos**
Importa el archivo `SQL.sql` que contiene la estructura de todas las tablas necesarias para el proyecto. Puedes hacerlo desde una herramienta como phpMyAdmin o desde la línea de comandos.

**6. Instalar el Panel de Administración (AdminLTE)**
Este proyecto utiliza `jeroennoten/laravel-adminlte`. Instálalo con los siguientes comandos:
```bash
# 1. Requerir el paquete
composer require jeroennoten/laravel-adminlte

# 2. Publicar los assets y la configuración
php artisan adminlte:install
```

**7. Iniciar el Servidor**
¡Listo! Ahora puedes iniciar el servidor de desarrollo de Laravel.
```bash
php artisan serve
```
El sistema estará disponible en `http://127.0.0.1:8000`.

---

## 📁 Estructura del Proyecto

- `app/Http/Controllers`: Contiene la lógica de negocio para las peticiones (ej. `PosController`, `VentaController`).
- `app/Models`: Modelos de Eloquent que interactúan con la base de datos (ej. `Producto`, `Cliente`, `Venta`).
- `app/Listeners`: Manejadores de eventos, como el que personaliza el menú de AdminLTE (`BuildPosMenu`).
- `config`: Archivos de configuración, incluyendo `adminlte.php` para el panel.
- `database`: Contiene las migraciones y seeders (si se usaran).
- `public`: Carpeta pública del servidor. Los assets de los paquetes se publican en `public/vendor`.
- `resources/views`: Contiene todas las vistas Blade del proyecto.
  - `resources/views/pos`: Vistas para el punto de venta.
  - `resources/views/admin`: Vistas para el panel de administración.
- `routes/web.php`: Define todas las rutas web de la aplicación.
- `SQL.sql`: Archivo con la estructura inicial de la base de datos.