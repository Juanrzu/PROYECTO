<?php
session_start();
$usuario = $_SESSION['nombre_usuario'];
include 'connect.php';
$id=$_GET['eliminarid'];
$sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
        FROM profesor 
        JOIN seccion ON profesor.idseccion = seccion.id 
        JOIN grados ON profesor.idgrado = grados.id 
        WHERE profesor.id = ?";

$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $cedula = $row['cedula'];
    $seccion = $row['idseccion'];
    $grado = $row['idgrado'];
    $volver = $row['grado_nombre'];
    $volver2 = $row['seccion_nombre'];
}



$sql_grado_exist = "SELECT * FROM grados WHERE id = ?";
$stmt_grado = $connect->prepare($sql_grado_exist);
$stmt_grado->bind_param("i", $grado);
$stmt_grado->execute();
$result_grado_exist = $stmt_grado->get_result();

$sql_seccion_exist = "SELECT * FROM seccion WHERE id = ?";
$stmt_seccion = $connect->prepare($sql_seccion_exist);
$stmt_seccion->bind_param("s", $seccion);
$stmt_seccion->execute();
$result_seccion_exist = $stmt_seccion->get_result();


$row_grado = $result_grado_exist->fetch_assoc();
$gradoNombre = $row_grado['nombre'];
$row_seccion = $result_seccion_exist->fetch_assoc();
$seccionNombre = $row_seccion['nombre'];

 //ingresar insert en bitacora al eliminar profesor
 $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
 $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cedula = $cedula, grado = $gradoNombre, seccion = $seccionNombre";
 
 $stmt2 = $connect->prepare($sql2);
 $accion= "Se Elimino un profesor.";
 $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
 $resultInsert2 = $stmt2->execute();
   //aqui termina

if(isset($_GET['eliminarid'])){
    $id=$_GET['eliminarid'];
    $sql = "DELETE FROM profesor WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        //echo "Se ha eliminado al alumno"
        header('location:ver_grado.php? gradonombre= '.$volver.' && seccion= '.$volver2.'');
    }else{
        die (mysqli_error($connect));
    }
}
?>