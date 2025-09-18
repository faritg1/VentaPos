@extends('adminlte::page')

@section('title', 'Punto de Venta')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-cash-register"></i> Punto de Venta (POS)</h1>
@stop

@section('content')
<div class="row">
    <!-- Columna Izquierda: Selección de Productos -->
    <div class="col-md-7">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-box-open"></i> Productos Disponibles</h3>
            </div>
            <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row">
                    @forelse($productos as $producto)
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-muted">Stock: {{ $producto->cantidad }}</p>
                                    <p class="card-text h4 text-success">${{ number_format($producto->precio, 0) }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                     <button class="btn btn-success btn-block add-product-btn"
                                            data-id="{{ $producto->id }}"
                                            data-nombre="{{ $producto->nombre }}"
                                            data-precio="{{ $producto->precio }}"
                                            data-stock="{{ $producto->cantidad }}">
                                        <i class="fas fa-plus-circle"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-exclamation-triangle"></i> No hay productos con stock disponible.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Columna Derecha: Carrito y Venta -->
    <div class="col-md-5">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Resumen de Venta</h3>
            </div>
            <div class="card-body">
                <!-- Cliente -->
                <div class="form-group">
                    <label for="cliente">Cliente</label>
                    {{-- Campo de Búsqueda --}}
                    <div class="input-group mb-2">
                        <input type="text" id="search-client-doc" class="form-control" placeholder="Buscar por N° Documento...">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" id="search-client-btn">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                    {{-- Selector de Cliente --}}
                    <div class="input-group">
                        <select name="cliente_id" id="cliente_id" class="form-control">
                            <option value="1" selected>Venta de Mostrador</option>
                            <!-- Aquí se cargarán los clientes dinámicamente -->
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="add-client-btn" title="Agregar Nuevo Cliente"><i class="fas fa-user-plus"></i></button>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Método de Pago -->
                <div class="form-group">
                    <label for="metodo_pago_id">Método de Pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-control">
                        @foreach($metodosPago as $metodo)
                            <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Carrito de Compras -->
                <div id="cart-items" style="min-height: 200px;">
                    <p class="text-center text-muted">Agregue productos a la venta</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="font-weight-bold">Total:</h3>
                    <h3 class="font-weight-bold" id="cart-total">$0</h3>
                </div>
                <button class="btn btn-primary btn-lg btn-block mt-3" id="process-sale-btn" disabled>
                    <i class="fas fa-check-circle"></i> Procesar Venta
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel"><i class="fas fa-user-plus"></i> Registrar Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="client-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de Documento</label>
                                <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="NIT">NIT</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento">Número de Documento</label>
                                <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo o Razón Social</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="save-client-btn">Guardar Cliente</button>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- INICIALIZACIÓN ---
    const cart = {};
    const addProductButtons = document.querySelectorAll('.add-product-btn');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const processSaleBtn = document.getElementById('process-sale-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // --- LÓGICA PARA EL MODAL DE CLIENTES ---
    const addClientBtn = document.getElementById('add-client-btn');
    const saveClientBtn = document.getElementById('save-client-btn');
    const clientModal = $('#clientModal'); // Usamos jQuery para el modal de Bootstrap
    const clientForm = document.getElementById('client-form');
    const clientSelect = document.getElementById('cliente_id');

    const searchClientBtn = document.getElementById('search-client-btn');
    const searchClientDocInput = document.getElementById('search-client-doc');

    searchClientBtn.addEventListener('click', buscarCliente);
    // Permitir buscar también al presionar Enter en el input
    searchClientDocInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Evita que el formulario se envíe si estuviera dentro de uno
            buscarCliente();
        }
    });

    function buscarCliente() {
        const numeroDocumento = searchClientDocInput.value.trim();
        if (!numeroDocumento) {
            Swal.fire('Campo vacío', 'Por favor, ingresa un número de documento para buscar.', 'warning');
            return;
        }

        // Muestra un indicador de carga
        Swal.fire({
            title: 'Buscando...',
            text: 'Consultando la base de datos.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        // Usamos la URL de la nueva ruta que crearemos
        fetch(`/pos/clientes/buscar/${numeroDocumento}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.client) {
                    const client = data.client;
                    const clientSelect = document.getElementById('cliente_id');

                    // Verificar si el cliente ya está en la lista para no duplicarlo
                    if (!clientSelect.querySelector(`option[value="${client.id}"]`)) {
                        const newOption = new Option(`${client.nombre} (${client.numero_documento})`, client.id, true, true);
                        clientSelect.appendChild(newOption);
                    }
                    
                    // Seleccionar el cliente encontrado
                    clientSelect.value = client.id;
                    searchClientDocInput.value = ''; // Limpiar el campo de búsqueda

                    Swal.fire('Cliente Encontrado', `Cliente "${client.nombre}" seleccionado.`, 'success');
                } else {
                    // Si no se encuentra el cliente
                    Swal.fire({
                        icon: 'error',
                        title: 'Cliente no encontrado',
                        text: `No se encontró ningún cliente con el documento "${numeroDocumento}".`,
                        footer: '<a href="#" id="swal-create-client-link">¿Deseas registrarlo ahora?</a>'
                    });
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                Swal.fire('Error', 'Ocurrió un problema al intentar buscar el cliente.', 'error');
            });
    }

    // Listener para el enlace de crear cliente desde el SweetAlert de error
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'swal-create-client-link') {
            e.preventDefault();
            document.getElementById('add-client-btn').click(); // Simula un clic en el botón de agregar
        }
    });

    // Abrir el modal
    addClientBtn.addEventListener('click', function() {
        clientForm.reset(); // Limpiar el formulario
        clientModal.modal('show');
    });

    // Guardar el cliente
    saveClientBtn.addEventListener('click', function() {
        // Crear un objeto FormData para recolectar los datos del formulario
        const formData = new FormData(clientForm);
        const clientData = Object.fromEntries(formData.entries());

        // Simple validación en frontend
        if (!clientData.numero_documento || !clientData.nombre) {
            Swal.fire('Campos requeridos', 'El número de documento y el nombre son obligatorios.', 'warning');
            return;
        }

        fetch("{{ route('pos.client.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(clientData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Crear la nueva opción para el select
                const newOption = new Option(data.client.nombre, data.client.id, true, true);
                clientSelect.appendChild(newOption);
                
                clientModal.modal('hide');
                Swal.fire('Éxito', 'Cliente registrado y seleccionado correctamente.', 'success');
            } else {
                // Manejar errores de validación u otros
                const errorMessages = Object.values(data.errors || {}).join('\n');
                throw new Error(errorMessages || data.error || 'No se pudo guardar el cliente.');
            }
        })
        .catch(error => {
            Swal.fire('Error', error.message, 'error');
        });
    });

    // --- EVENT LISTENER PARA AGREGAR PRODUCTOS ---
    addProductButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const precio = parseFloat(this.dataset.precio);
            const stock = parseInt(this.dataset.stock);

            if (cart[id]) {
                if (cart[id].cantidad < stock) {
                    cart[id].cantidad++;
                } else {
                    Swal.fire('Stock insuficiente', `No puedes agregar más de ${stock} unidades de ${nombre}.`, 'warning');
                }
            } else {
                cart[id] = { nombre, precio, cantidad: 1, stock };
            }
            updateCart();
        });
    });

    // --- FUNCIÓN PRINCIPAL PARA RENDERIZAR EL CARRITO ---
    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let total = 0;

        if (Object.keys(cart).length === 0) {
            cartItemsContainer.innerHTML = '<p class="text-center text-muted">Agregue productos a la venta</p>';
            processSaleBtn.disabled = true;
        } else {
            const table = document.createElement('table');
            table.className = 'table table-sm';
            table.innerHTML = `
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-center" style="width: 90px;">Cant.</th>
                        <th class="text-right">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>`;
            
            const tbody = table.querySelector('tbody');

            for (const id in cart) {
                const item = cart[id];
                const subtotal = item.cantidad * item.precio;
                total += subtotal;

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.nombre}</td>
                    <td class="text-center">
                        <input type="number" class="form-control form-control-sm text-center quantity-input" 
                               value="${item.cantidad}" 
                               min="1" 
                               max="${item.stock}" 
                               data-id="${id}"
                               required>
                    </td>
                    <td class="text-right">$${subtotal.toLocaleString('es-CO')}</td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-danger remove-item-btn" data-id="${id}">&times;</button>
                    </td>
                `;
                tbody.appendChild(tr);
            }
            cartItemsContainer.appendChild(table);
            processSaleBtn.disabled = false;
        }

        cartTotalElement.textContent = `$${total.toLocaleString('es-CO')}`;
        
        // Volver a registrar los listeners para los elementos recién creados
        addCartEventListeners();
    }

    // --- FUNCIÓN PARA REGISTRAR LISTENERS EN EL CARRITO ---
    function addCartEventListeners() {
        // Botones de eliminar
        document.querySelectorAll('.remove-item-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                delete cart[id];
                updateCart();
            });
        });

        // Inputs de cantidad
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.dataset.id;
                let newQuantity = parseInt(this.value);
                const stock = parseInt(this.max);

                if (isNaN(newQuantity) || newQuantity < 1) {
                    newQuantity = 1;
                }
                if (newQuantity > stock) {
                    newQuantity = stock;
                    Swal.fire('Stock insuficiente', `El máximo para este producto es ${stock}.`, 'warning');
                }
                
                cart[id].cantidad = newQuantity;
                updateCart();
            });
        });
    }

    // --- LÓGICA PARA PROCESAR LA VENTA ---
    processSaleBtn.addEventListener('click', function() {
        if (Object.keys(cart).length === 0) {
            Swal.fire('Carrito Vacío', 'Agrega productos antes de procesar la venta.', 'warning');
            return;
        }

        Swal.fire({
            title: '¿Confirmar Venta?',
            text: `Total a pagar: ${cartTotalElement.textContent}`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar venta',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                sendSaleData();
            }
        });
    });

    // --- FUNCIÓN PARA ENVIAR DATOS AL BACKEND ---
    function sendSaleData() {
        const saleData = {
            cliente_id: document.getElementById('cliente_id').value,
            metodo_pago_id: document.getElementById('metodo_pago_id').value, // <-- Añadir esta línea
            productos: Object.keys(cart).map(id => ({
                id: id,
                cantidad: cart[id].cantidad
            }))
        };

        Swal.fire({
            title: 'Procesando...',
            text: 'Registrando la venta, por favor espera.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('pos.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(saleData)
        })
        .then(response => {
            if (!response.ok) {
                // Si el servidor responde con un error (4xx, 5xx), obtenemos el JSON
                return response.json().then(err => { throw new Error(err.error || 'Error del servidor') });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Venta Registrada!',
                    text: data.success,
                }).then(() => {
                    // Recargar la página para limpiar el estado del POS
                    window.location.href = "{{ route('pos.index') }}";
                });
            } else {
                // Esto es por si el servidor responde 200 OK pero con un error lógico
                throw new Error(data.error || 'Ocurrió un error desconocido.');
            }
        })
        .catch(error => {
            console.error('Error en la petición:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error en la Venta',
                text: error.message
            });
        });
    }
});
</script>
@endpush