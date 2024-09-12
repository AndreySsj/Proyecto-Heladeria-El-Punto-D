<?php 
require 'php/conexion_db.php';
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1 LIMIT 6");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtiene el nombre del usuario si está logueado
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Iniciar Sesión';
$usuarioLogueado = isset($_SESSION['nombre_usuario']);

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesContacto.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Interfaz Grafica</title>
</head>
<body>
<header>
        <div class="container-header">
            <div class="container header">

                
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

    <div class="form-contacto">
        <h1>CONTACTATE CON NOSOTROS</h1>
        <p class="parrafo">Contáctenos sobre cualquier cosa relacionada con nuestra empresa o nuestros servicios. Haremos todo lo posible por darle respuesta a la brevedad</p>
        <form action="VentanaContacto.php" method="post">

            <label class="parrafo2" for="nombre">Nombre: </label>
            <input type="text" id="nombre" placeholder="Escribe tu nombre" name="nombre_usuario"  required>

            <label class="parrafo2" for="correo">E-mail: </label>
            <input type="email" id="correo" placeholder="hello087@gmail.com" name="email_usuario"  required>

            <label class="parrafo2" for="telefono">Telefono: </label>
            <input type="number" id="telefono" placeholder="Escribe tu numero telefonico" name="telefono"  required>

            <label class="parrafo2" for="mensaje">Mensaje: </label>
            <textarea  id="mensaje" placeholder="Deja aqui tu mensaje..." name="mensaje"  required></textarea>

            <button class="btn" type="submit" >Enviar</button>
        </form>
    </div>

    <div class="container">
        <div class="cuadro">
            <h1 class="tittle">Datos de Contacto</h1>
            <p class="direccion">Calle 30#8-69,Patio Centro, Los Patios</p>
            <div class="contacto">
                <p>+57 304 5670727</p>
                <p>@heladeriaelpuntoD</p>
                <p>@heladeriaelpuntoD</p>
            </div>
            <div class="img-contacto">
                <a href="https://www.instagram.com/heladeriaelpuntod?igsh=NzRqNnBmOXc2M2Nr" target="_blank">
                    <img src="img/instagram.png" alt="logo instagram" class="social-icon">
                </a>
                <a href="https://www.facebook.com/heladeriaelpuntod?mibextid=LQQJ4d" target="_blank">
                    <img src="img/facebook.png" alt="logo facebook" class="social-icon">
                </a> 
                <a href="" target="_blank">
                    <img src="img/whatsapp.png" alt="logo whatsapp" class="social-icon">
                </a>
            </div>
        </div>
        <div class="cuadro2">
            <h1 class="tittle">Horario de Atencion</h1>
            <div class="contacto2">
                <p>Lunes 3:00 - 9:00 p.m</p>
                <p>Martes 3:00 - 9:00 p.m</p>
                <p>Miercoles 3:00 - 9:00 p.m</p>
                <p>Jueves 3:00 - 9:00 p.m</p>
                <p>Viernes 3:00 - 9:00 p.m</p>
                <p>Sabado 3:00 - 9:00 p.m</p>
                <p>Domingo 3:00 - 9:00 p.m</p>
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
    <script src="Menu.js"></script>
    <script src="js/cambiologins.js"></script>
    <script src="js/register.js"></script>
    <script src="js/log.js"></script>
    <script src="https://kit.fontawesome.com/81581fb069.js"
    crossorigin="anonymous"></script>
</body>

<?php 

    if(isset($_POST['nombre_usuario'])){

        $nombre = $_POST['nombre_usuario'];
        $correo = $_POST['email_usuario'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];

        $sqlinsert = $con->prepare("INSERT INTO contacto (nombre_usuario, email_usuario, telefono, mensaje) VALUES (?,?,?,?)");
        $sqlinsert->execute([$nombre, $correo, $telefono, $mensaje]);
    }
    unset($_SESSION['nombre_usuario']);

?>
</html>