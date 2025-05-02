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
    $sql = "SELECT * FROM trabajadores WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row= mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $telefono = $row['telefono'];
         $cedula=$row['cedula'];
         $rol = $row['rol']; 


         if(isset($_GET['eliminarid'])){
            $id=$_GET['eliminarid'];

        //ingresar insert en bitacora 
        $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
        $stmt2 = $connect->prepare($sql2);
        $accion= "Se elimino un trabajador.";
        $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cedula = $cedula, telefono = $telefono, rol = $rol";
        $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
        $resultInsert2 = $stmt2->execute();
        //aqui termina

        if (strcasecmp(trim($rol), 'profesor') == 0) {  
            $sql = "DELETE FROM profesor WHERE cedula = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("s", $cedula);
            $stmt->execute();
        }
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