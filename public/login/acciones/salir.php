<?php
include('../../connect.php');
session_start();
$usuario = $_SESSION['nombre_usuario'];

//Agregar cierre de sesion en bitacora
$accion_datos= "Sesion cerrada";
$sql2 = "INSERT INTO bitacora (accion, usuario, datos_accion) VALUES (CONCAT('Se ha cerrado la sesión'), '$usuario', '$accion_datos')";

$resultInsert2 = mysqli_query(mysql: $connect, query: $sql2);
// fin
session_destroy();

header("location: ../login.php");
exit();

?>
