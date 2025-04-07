<?php
session_start();
error_reporting(error_level: 0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
	header(header: 'location: ./../login/login.php');
	die();
}
include './../connect.php';


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];

    // Obtener información del estudiante y su representante
    $sql = "SELECT trabajadores.*, rol.nombre as rol_nombre
    FROM trabajadores
    JOIN rol ON trabajadores.idrol = rol.id  
    WHERE trabajadores.id = $id";
    $result = mysqli_query($connect, $sql);
    $row= mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $telefono = $row['telefono'];
         $cedula=$row['cedula'];
         $rol = $row['rol_nombre']; 


         if(isset($_GET['eliminarid'])){
            $id=$_GET['eliminarid'];
            $sql="delete from trabajadores where id=$id";
            $result=mysqli_query($connect,$sql);
            if($result){
                //echo "Se ha eliminado al profesor"
                header('location:trabajadores.php');
            }else{
                die (mysqli_error($connect));
            }
        }
    }
         
 
?>