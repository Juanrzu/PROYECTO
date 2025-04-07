<?php

include '../../connect.php';
session_start();

$usuario = $_POST['usuario'];
$contraseña_ingresada = $_POST['contraseña'];
$captcha_input = $_POST['captcha'];

// Verificar si hay campos vacíos
if (empty($usuario) || empty($contraseña_ingresada) || empty($captcha_input)) {
    echo "<footer>
            <div class='container_title btn btn-danger'>
                <h5 class='title-h1'>Los datos no pueden estar vacíos</h5>
            </div>
          </footer>";
    exit; // Detiene la ejecución si hay campos vacíos
}

// Verificar el captcha primero
if ($captcha_input !== $_SESSION["captcha"]) {
    echo "Error al acceder, captcha incorrecto";
    echo "<a href='../login.php'> Reintentar</a>";
    exit; // Detiene la ejecución si el captcha es incorrecto
}

// Si el captcha es correcto, consultar la base de datos
$q = "SELECT COUNT(*) as contar, empleado.nombre as empleado_nombre, 
empleado.apellido as empleado_apellido, empleado.cedula as empleado_cedula,
empleado.telefono as empleado_telefono, empleado.correo as empleado_gmail, 
usuario.contraseña as contraseña_hash
FROM usuario  
JOIN empleado ON usuario.idempleado = empleado.id
WHERE usuario.nombre = ?";

$stmt = $connect->prepare($q);
$stmt->bind_param("s", $usuario); // Usar para evitar inyecciones SQL
$stmt->execute();
$result = $stmt->get_result();
$array = $result->fetch_assoc();

if ($array['contar'] > 0) {
    $nombre = $array['empleado_nombre'];
    $apellido = $array['empleado_apellido'];
    $cedula = $array['empleado_cedula'];
    $telefono = $array['empleado_telefono'];
    $gmail = $array['empleado_gmail'];
    $contraseña_hash = $array['contraseña_hash'];

    // Verificar la contraseña ingresada con la contraseña cifrada almacenada
    if (password_verify($contraseña_ingresada, $contraseña_hash)) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['cedula'] = $cedula;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['gmail'] = $gmail;
        
        header("location: ../../display.php");
    } else {
        echo "Error al acceder, contraseña incorrecta";
        echo "<a href='../login.php'> Reintentar</a>";
    }
} else {
    echo "Error al acceder, usuario no encontrado";
    echo "<a href='../login.php'> Reintentar</a>";
}

$stmt->close();
?>
