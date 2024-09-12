<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo 'Error al procesar la peticion';
    exit;
}else{
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if($sql->fetchColumn() > 0){
            $sql = $con->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $dir_images = 'img/productos/'.$id.'/';


        }
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    }else{
        echo 'Error al procesar la peticion';
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
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
                    <i class="fa-solid fa-user"></i>
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


        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <img src="img/productos/<?php echo $id; ?>/img1.png" alt="" class="d-block w-100" id="imagen">
                </div>
                <div class="col-md-6 order-md-2">
                    <div class="container-infodetails">
                        <h2 class="nombre-producto"><?php echo $nombre;?></h2>
                        <h2><?php echo MONEDA . number_format($precio, 2, '.',',') ;?></h2>
                        <p class="lead">
                            <?php echo $descripcion; ?>
                        </p>

                        <div class="boton d-grid gap-3 col-10 mx-auto">
                        
                        
                        <button class="xdea btn btn-outline-primary" style="background-color: #f8cef9; border-color: #c878f6; color: black;" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>

                            
                            
                        </div>
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
    

    <script src="index.js"></script>
    <script src="js/cambiologins.js"></script>
    <script src="js/register.js"></script>
    <script src="js/iffe_log.js"></script>
    <script src="js/log.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>