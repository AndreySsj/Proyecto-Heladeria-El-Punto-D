<?php
// Inicia la sesión
session_start();

// Conectar a la base de datos
require 'php/conexion_db.php';
require 'php/register_db.php';


// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recibir los datos del formulario
    $username = trim($_POST['nombre_usuario']);
    $email = trim($_POST['email_usuario']);
    $password = trim($_POST['userPassword']);

    // Validar que no estén vacíos
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'Todos los campos son obligatorios.';
        header('Location: index.php');
        exit;
    }

    // Validar que el email no exista ya en la base de datos
    $sql = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['error'] = 'Este correo electrónico ya está registrado.';
        header('Location: register_db.php');
        exit;
    }

    // Encriptar la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios(nombre_usuario, email_usuario, password_usuario) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $passwordHash);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Te registraste correctamente. Por favor, inicia sesión.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Ocurrió un error al registrar el usuario. Intenta nuevamente.';
        header('Location: register_db.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Acceso no autorizado.';
    header('Location: register_db.php');
    exit;
}
