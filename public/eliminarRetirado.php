<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];

    
    // Obtener información del estudiante y su representante
    $sql = "SELECT * FROM retiro_estudiantes  WHERE id = ?";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
        $cen=$row['cen'];
        $nacimiento=$row['nacimiento'];
        $sexo=$row['sexo'];
        $representante=$row['representante'];
        $representanteApellido=$row['representante_apellido'];
        $cedularepre=$row['cedula_repre'];
        $telefono=$row['telefono'];
        $correo=$row['correo'];
        $grado=$row['grado'];
        $seccion=$row['seccion'];
        $motivo = $row['motivo'];


          //ingresar insert en bitacora al eliminar estudiante
          $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
          $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cen = $cen, nacimiento = $nacimiento, sexo = $sexo, grado = $grado, seccion = $seccion, representante = $representante, Apellido del representante = $representanteApellido, cedula representante = $cedularepre, telefono = $telefono, correo = $correo, motivo = $motivo";
          
          $stmt2 = $connect->prepare($sql2);
          $accion= "Se Elimino un estudiante de la tabla retirados.";
          $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
          $resultInsert2 = $stmt2->execute();
            //aqui termina

    

        // Eliminar al estudiante
        $deleteEstudianteSql = "DELETE FROM retiro_estudiantes WHERE id = ?";
        $stmt = $connect->prepare($deleteEstudianteSql);
        $stmt->bind_param("i", $id);
        $deleteEstudianteResult = $stmt->execute();
        

   

            // Redireccionar
           
            header("location: estudiantes_retirados.php");
        } else {
            die(mysqli_error($connect));
        }
    } else {
        die(mysqli_error($connect));
    }

?>