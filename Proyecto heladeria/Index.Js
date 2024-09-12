function mostrarFrame(id) {
    var frame = document.getElementById(id);
    frame.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function cerrarFrame(id) {
    var frame = document.getElementById(id);
    frame.style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.querySelector('.fa-user').addEventListener('click', function() {
    var usuarioFrame = document.getElementById('usuario-superpuesto');
    usuarioFrame.classList.add('active');
    document.body.style.overflow = 'hidden';
});

function cerrarUsuarioFrame() {
    var usuarioFrame = document.getElementById('usuario-superpuesto');
    usuarioFrame.classList.remove('active');
    document.body.style.overflow = 'auto';
}

document.querySelector('.fa-basket-shopping').addEventListener('click', function() {
    var CarritoFrame = document.getElementById('Carrito-superpuesto');
    CarritoFrame.classList.add('active');
    document.body.style.overflow = 'hidden'; // Deshabilitar el scroll en el body
});

// Función para cerrar la ventana emergente del usuario
function CerrarCarritoFrame(){
    var CarritoFrame = document.getElementById('Carrito-superpuesto');
    CarritoFrame.classList.remove('active');
    document.body.style.overflow = 'auto'; // Habilitar el scroll en el body
}


// Seleccionamos todos los contenedores con la clase 'container-barrafija'
const contenedores = document.querySelectorAll('.container2-info');

// Función para controlar la selección de checkboxes
function controlarCheckboxes() {
    let checkboxes = document.querySelectorAll('.checkbox');
    let checkedCount = 0;

    // Listener para cada checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // Contamos los checkboxes seleccionados
            checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

            // Si se han marcado más de 3, desmarcamos el nuevo checkbox y mostramos un mensaje
            if (checkedCount > 3) {
                checkbox.checked = false;
            }

            // Actualizar el precio total después de modificar la selección
            actualizarPrecioTotal();
        });
    });
}

// Función para actualizar el precio total
function actualizarPrecioTotal() {
    contenedores.forEach(contenedor => {
        const checkboxes = contenedor.querySelectorAll('.checkbox');
        const numeroProducto = contenedor.querySelector('.numero-producto');
        const textoPrecio = contenedor.querySelector('.texto1');
        const cantidad = parseInt(numeroProducto.textContent) || 0;
        const precioUnitario = 6000;
        const precioAdicional = 4000;

        // Calculamos el precio adicional basado en los checkboxes marcados
        let totalCheckbox = Array.from(checkboxes).reduce((acc, checkbox) => acc + (checkbox.checked ? precioAdicional : 0), 0);
        let precioActual = cantidad * precioUnitario + totalCheckbox;
        textoPrecio.textContent = `$${precioActual.toLocaleString()}`;
    });
}

// Iteramos sobre cada contenedor
contenedores.forEach((contenedor) => {
    // Seleccionamos los elementos dentro de cada contenedor
    const minusIcon = contenedor.querySelector('.bx-minus-circle');
    const plusIcon = contenedor.querySelector('.bx-plus-circle');
    const numeroProducto = contenedor.querySelector('.numero-producto');

    // Inicializamos la cantidad y el precio base
    let cantidad = 0;
    let limite = 10;

    // Función para actualizar la visualización de la cantidad
    function actualizarCantidad() {
        numeroProducto.textContent = `${cantidad}`;
    }

    // Agregamos los event listeners
    minusIcon.addEventListener('click', () => {
        if (cantidad > 0) {
            cantidad--;
            actualizarCantidad();
            actualizarPrecioTotal();
        }
    });

    plusIcon.addEventListener('click', () => {
        if (cantidad < limite) {
            cantidad++;
            actualizarCantidad();
            actualizarPrecioTotal();
        }
    });
});

// Inicializamos la funcionalidad de los checkboxes
controlarCheckboxes();
