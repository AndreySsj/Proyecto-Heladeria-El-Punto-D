<?php
// Inicia la sesión
session_start();

// Conectar a la base de datos
require 'php/conexion_db.php';

// Recibir los datos del formulario
$email = trim($_POST['email_usuario']);
$password = trim($_POST['password_usuario']);

// Validar que no estén vacíos
if (empty($email) || empty($password)) {
    echo '
    <script>
        alert("Todos los campos son obligatorios.");
        window.location.href = "index.php";
    </script>
    ';
    exit;
}

// Verificar que el email y la contraseña existan en la base de datos
$sql = "SELECT id, password_usuario, nombre_usuario FROM usuarios WHERE email_usuario = ? LIMIT 1";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    // El email existe, ahora verificamos la contraseña
    mysqli_stmt_bind_result($stmt, $idUsuario, $storedPassword, $nombreUsuario);
    mysqli_stmt_fetch($stmt);

    if ($password === $storedPassword) {
        // Las credenciales son correctas
        $_SESSION['id_usuario'] = $idUsuario; // Guardar el ID del usuario en la sesión
        $_SESSION['nombre_usuario'] = $nombreUsuario; // Guardar el nombre del usuario en la sesión
        $_SESSION['email_usuario'] = $email; // Guardar el email en la sesión

        echo '
        <script>
            alert("Inicio de sesión exitoso.");
            window.location.href = "index.php";
        </script>
        ';
        exit;
    } else {
        // La contraseña es incorrecta
        echo '
        <script>
            alert("Contraseña incorrecta.");
            window.history.back();
        </script>
        ';
        exit;
    }
} else {
    // El email no se encontró en la base de datos
    echo '
    <script>
        alert("No se encontró una cuenta con ese correo electrónico.");
        window.history.back();
    </script>
    ';
    exit;
}

// Cerrar la sentencia y la conexión a la base de datos
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
