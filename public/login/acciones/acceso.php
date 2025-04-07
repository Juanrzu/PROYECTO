<?php

include '../../connect.php';
session_start();

$usuario = $_POST['usuario'];
$contraseña_ingresada = $_POST['contraseña'];

if (empty($usuario) || empty($contraseña_ingresada)) {
    echo"<footer>

    <div class='container_title btn btn-danger'>
    <h5 class='title-h1'>Los datos no pueden estar vacios</h5>
    </div>

    </footer>";
    
    exit; // Detiene la ejecución del script si hay campos vacíos
}

$q = "SELECT COUNT(*) as contar, empleado.nombre as empleado_nombre, 
empleado.apellido as empleado_apellido, empleado.cedula as empleado_cedula,
empleado.telefono as empleado_telefono, empleado.correo as empleado_gmail, 
usuario.contraseña as contraseña_hash
FROM usuario  
JOIN empleado ON usuario.idempleado = empleado.id
WHERE usuario.nombre= '$usuario'";

$consulta = mysqli_query($connect, $q);
$array = mysqli_fetch_assoc($consulta);

if ($array['contar'] > 0) {
    $nombre = $array['empleado_nombre'];
    $apellido = $array['empleado_apellido'];
    $cedula = $array['empleado_cedula'];
    $telefono = $array['empleado_telefono'];
    $gmail = $array['empleado_gmail'];
    $contraseña_hash = $array['contraseña_hash'];

    // Verificar la contraseña ingresada con la contraseña cifrada almacenada
    if (password_verify($contraseña_ingresada, $contraseña_hash)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['cedula'] = $cedula;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['gmail'] = $gmail;
        $_SESSION['contraseña'] = $contraseña_ingresada;

        header("location: ../../display.php");
    } else {
        echo "Error al acceder, contraseña incorrecta";
        echo "<a href='../login.php'> Reintentar</a>";
    }
} else {
    echo "Error al acceder, usuario no encontrado";
    echo "<a href='../login.php'> Reintentar</a>";
}
?>