<?php
require 'config/config.php';
require 'config/database.php';


// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtiene el nombre del usuario si está logueado
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Iniciar Sesión';
$usuarioLogueado = isset($_SESSION['nombre_usuario']);


$db = new Database();
$con = $db->conectar();
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

//print_r($_SESSION);

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}



//session_destroy();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Interfaz Grafica</title>
</head>
<body>
<header>
        <div class="container-header">
            <div class="container header">
                <div class="atencion-cliente">
                    <i class="fa-solid fa-headset"></i>
                    <div class="contenido-atencion-cliente">
                        <span class="text">Soporte al Cliente</span>
                        <span class="num">304-5670720</span>
                    </div>
                </div>
                
                <div class="container-logo">
                    <a href="index.html"><img src="img/Logo.png" alt="logoHeladeria" class="img-logo"></a>
                    <h1 class="logo"><a href="index.php">Heladeria el punto D</a></h1>
                </div>
                <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Iniciar Sesión';
                ?>
                
                <div class="container-usuario">
                <span class="usuario-nombre"><?php echo $nombreUsuario; ?></span>
                    <i class="fa-solid fa-user <?php echo $usuarioLogueado ? 'user-logged-in' : ''; ?>"></i>
                    <?php if (isset($_SESSION['nombre_usuario'])): ?>
                        <a class="logout" href="logout.php">Cerrar sesión</a>
                    <?php endif; ?>
                    <a href="checkout.php">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </a>
                    
                    <div class="contenido-carrito-compras">
                        <span class="text">Carrito</span>
                        <span  id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?> </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-navbar">
            <nav class="navbar container">
                <i class="fa-solid fa-bars"></i>
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="VentanaQuienesSomos.php">Quienes somos</a></li>
                    <li><a href="VentanaMenu.php">Menú</a></li>
                    <li><a href="VentanaContacto.php">Contactanos</a></li>
                </ul>

                
            </nav>


        </div>
    </header>

    <div class="imagenes">
            <!-- Nueva ventana emergente para el ícono de usuario -->
    <div id="usuario-superpuesto" class="superpuesto">
            
        <!--<button class="BotonCerrarLogin" onclick="cerrarUsuarioFrame()">X</button>-->

    <div class="container-formulario register"> 
        <div class="info">
            <div class="info-bienvenido">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para tener una mejor experiencia, porfavor Inicie Sesión con sus datos.</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div id="login-form" class="form-informacion">
            <div class="form-informacion-childs">
                <span class="material-symbols-outlined" onclick="cerrarUsuarioFrame()">
                        close
                </span>
                <h2>Crear una Cuenta</h2>
                <div class="iconos">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github' ></i>
                    <i class='bx bxl-linkedin' ></i>
                </div>
    
                <p>o usa tu e-mail para registrarte</p>
    
                <form class="form form-register" novalidate action="validar.php" method="post">
                    <div>
                        <label>
                            <i class='bx bx-user' ></i>
                            <input type="text" placeholder="Nombre Usuario" name="userName" >
                        </label>
                    </div>

                    <div>
                        <label>
                            <i class='bx bx-envelope' ></i>
                            <input type="email" placeholder="Correo Electronico" name="userEmail">
                        </label>
                    </div>

                    <div>
                        <label >
                            <i class='bx bx-lock-alt' ></i>
                            <input type="password" placeholder="Contraseña" name="userPassword">
                        </label>
                    </div>

    
                    <input type="submit" value="Registrarse">
                    <div id="alertaExito" class="alerta" style="display: none;">Te registraste correctamente</div>
                    <div id="alertaError" class="alerta" style="display: none;">Todos los campos son obligatorios</div>
                        
    
                </form>
            </div>
        </div>
    </div>






    <div id="login-form" class="container-formulario login hide">
        <div class="info">
            <div class="info-bienvenido">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Si aún no tiene una cuenta por favor registrese aquí.</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>
        </div>
        <div class="form-informacion">
            <div class="form-informacion-childs">
                <span class="material-symbols-outlined" onclick="cerrarUsuarioFrame()">
                        close
                </span>
                <h2>Iniciar Sesión</h2>
                <div class="iconos">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github' ></i>
                    <i class='bx bxl-linkedin' ></i>
                </div>
    
                <p>o Iniciar Sesión con una cuenta</p>
    
                <form class="form form-login" novalidate action="login.php" method="post">

                    <div>
                        <label>
                            <i class='bx bx-envelope' ></i>
                            <input type="email" placeholder="Correo Electronico" name="email_usuario">
                        </label>
                    </div>

                    <div>
                        <label >
                            <i class='bx bx-lock-alt' ></i>
                            <input type="password" placeholder="Contraseña" name="password_usuario">
                        </label>
                    </div>

                    <input type="submit" value="Iniciar Sesión">
                    <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
                        <div class="alerta-error">Todos los campos son obligatorios</div>
                    <?php endif; ?>
                    <?php if(isset($_GET['success']) && $_GET['success'] == 'true'): ?>
                        <div class="alerta-exito">Bienvenido</div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>




    

    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($lista_carrito == null){
                            echo '<tr><td colspan="5" class="text-center"><b>Lista vacia<b></td></tr>';
                        } else {

                            $total = 0;
                            foreach($lista_carrito as $producto){
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $cantidad = $producto['cantidad'];
                                $subtotal = $cantidad * $precio;
                                $total += $subtotal;
                            ?>
                        
                        <tr>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo MONEDA . number_format($precio,2,'.',',');?></td>
                            <td>
                                <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>"
                                size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                            </td>
                            <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2,'.',','); ?></div>
                            </td>
                            <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2,'.',',' ); ?></p>
                        </td>
                    </tr>

                    </tbody>
                <?php } ?>
                </table>
            </div>

            <?php if($lista_carrito != null){ ?>
                <div class="row">
                    <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <a href="javascript:void(0);" onclick="validarPago()" class="btn btn-primary btn-lg">Realizar pago</a>

                    </div>
                </div>
            <?php } ?>

        </div>
    </main>

    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el producto de la lista?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div> 

    <footer>
        <div class="footer">
            <div class="footer-logo">
                <a href="index.php">
                    <img src="img/Logo.png" alt="Logo de la empresa" class="logo-img">
                </a>

            </div>
            <div class="footer-info">
                <p>SIGUENOS EN NUESTRAS REDES SOCIALES</p>
                <span>Visitanos en calle 30 #8-69, Patios Centro, Los Patios</span>
            </div>
            <div class="footer-img">
                <a href="" target="_blank">
                    <img src="img/whatsapp.png" alt="logo whatsApp" class="social-icon">
                </a>
                <a href="https://www.facebook.com/heladeriaelpuntod?mibextid=LQQJ4d" target="_blank">
                    <img src="img/facebook.png" alt="logo facebook" class="social-icon" >
                </a>
                <a href="https://www.instagram.com/heladeriaelpuntod?igsh=NzRqNnBmOXc2M2Nr" target="_blank">
                    <img src="img/instagram.png" alt="logo instagram" class="social-icon" >
                </a>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="Menu.js"></script>
    <script src="js/cambiologins.js"></script>
    <script src="js/register.js"></script>
    <script src="js/iffe_log.js"></script>
    <script src="js/log.js"></script>
    <script src="https://kit.fontawesome.com/81581fb069.js"
    crossorigin="anonymous"></script>

    <script>
        function validarPago() {
            
            let nombreUsuario = document.querySelector('.usuario-nombre').textContent;

            
            if (nombreUsuario.trim() === 'Iniciar Sesión') {
                
                alert('Para realizar la compra, por favor inicia sesión con tu cuenta.');
            } else {
                
                window.location.href = 'pago.php';
            }
        }

    </script>

    <script>
        let eliminaModal = document.getElementById('eliminaModal');
        eliminaModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina');
        buttonElimina.value = id;
});

        function actualizaCantidad(cantidad, id) {
            let url = 'clases/actualizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'agregar');
            formData.append('id', id)
            formData.append('cantidad', cantidad)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors',
            }).then(response => response.json())
            .then(data => {
                if(data.ok){

                    let divsubtotal = document.getElementById('subtotal_' + id)
                    divsubtotal.innerHTML = data.sub

                    let total = 0.00
                    let list = document.getElementsByName('subtotal[]')

                    for(let i = 0; i < list.length; i++){
                        total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
                    }

                    total = new Intl.NumberFormat('en-us', {
                        minimumFractionDigits: 2
                    }).format(total)
                    document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total

                }
            })
        }

        function eliminar(){

            let botonElimina = document.getElementById('btn-elimina')
            let id = botonElimina.value

            let url = 'clases/actualizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'eliminar');
            formData.append('id', id)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors',
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    location.reload()
                }
            })
        }
    </script>



</body>

</html>