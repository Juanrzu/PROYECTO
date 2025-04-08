<?php
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