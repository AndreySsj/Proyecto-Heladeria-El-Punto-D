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

// Conexión a la base de datos
$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1 LIMIT 6");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
//sb-3aeun32500534@personal.example.com
//IiDnpg^2
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Interfaz Grafica</title>
</head>
<body class="<?php echo $usuarioLogueado ? 'logged-in' : ''; ?>">
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
        


        <?php foreach($resultado as $row){ ?>
            <div class="imagen-texto">
                <?php
                $id = $row['id'];
                $imagen = "img/productos/" . $id . "/img1.png";

                if(!file_exists($imagen)){
                    $imagen = "img/noimagen.png";
                }
                ?>
                <img src="<?php echo $imagen; ?>" alt="img1" class="img1" onclick="mostrarFrame('superpuesto')">
                    <div class=" container-info-img">
                        <h2><?php echo $row['nombre']; ?></h2>
                        
                        <h2>$<?php echo number_format($row['precio'], 2, ".", ",");?></h2>

                        <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                    </div>
        
                    <!--<div class=" container-verproducto"  onclick="mostrarFrame('superpuesto')">
                        <h2>Ver producto</h2>
                    </div>-->

                    <div class=" container-verproducto"  onclick="">
                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>">Ver producto</a>
                    </div>


            </div>
        <?php } ?>

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
    <script src="js/iffe_log.js"></script>
    <script src="js/log.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/81581fb069.js"
    crossorigin="anonymous"></script>


    <script>
        function addProducto(id, token) {
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors',
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
        }
    </script>
</body>

</html>

