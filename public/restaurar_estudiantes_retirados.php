<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];
    
    // Obtener información del estudiante y su representante
    $sql = "SELECT * FROM retiro_estudiantes WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);  // "i" para integer (si id es numérico)
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
        $cen=$row['cen'];
        $nacimiento=$row['nacimiento'];
        $sexo=$row['sexo'];
        $representanteNombre=$row['representante'];
        $representanteApellido=$row['representante_apellido'];
        $cedularepre=$row['cedula_repre'];
        $telefono=$row['telefono'];
        $correo=$row['correo'];
        $grado=$row['grado'];
        $seccion=$row['seccion'];

        // Obtener el ID del grado y seccion
            $queryGrado = "SELECT id FROM grados WHERE nombre = ?";
            $stmt = $connect->prepare($queryGrado);
            $stmt->bind_param("s", $grado);
            $stmt->execute();
            $resultGrado = $stmt->get_result();
        

            if (!$resultGrado) {
                die("Error al obtener el ID del grado: " . mysqli_error($connect));
            }

            $rowGrado = $resultGrado->fetch_assoc();
            $idgrado = $rowGrado['id'];
            

          
            $querySeccion = "SELECT id FROM seccion WHERE nombre = ?";
            $stmt = $connect->prepare($querySeccion);
            $stmt->bind_param("s", $seccion);
            $stmt->execute();
            $resultSeccion = $stmt->get_result();


            if (!$resultSeccion) {
                die("Error al obtener el ID de la sección: " . mysqli_error($connect));
            }
            $rowSeccion = $resultSeccion->fetch_assoc();
            $idseccion = $rowSeccion['id'];

        //aqui termina

          /*/ingresar insert en bitacora al eliminar estudiante
            $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
            $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cen = $cen, nacimiento = $nacimiento, sexo = $sexo, grado = $grado, seccion = $seccion, representante = $representanteNombre, Apellido del representante = $representanteApellido, cedula representante = $cedularepre, telefono = $telefono, correo = $correo";

            $stmt = $connect->prepare($sql2);
            $stmt->bind_param("sss", 'Se restauró un estudiante.', $datos_accion, $usuario);
            $stmt->execute();

            /*/


        // Verificar si se encuentra ingresado el representante
            $selectRepresentante = "SELECT * FROM `representante` WHERE cedula = ?";
            $stmt_select = $connect->prepare($selectRepresentante);
            $stmt_select->bind_param("s", $cedularepre);
            $stmt_select->execute();
            $resultselect = $stmt_select->get_result();
            
            if ($resultselect->num_rows == 0) {
                $insertRepresentanteSql = "INSERT INTO `representante` (`nombre`, `apellido`, `cedula`, `telefono`, `correo`) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert = $connect->prepare($insertRepresentanteSql);
                $stmt_insert->bind_param("sssss", $representanteNombre, $representanteApellido, $cedularepre, $telefono, $correo);
                
                if (!$stmt_insert->execute()) {
                    die("Error en la inserción: " . $connect->error);
                }
                
                $stmt_select->execute();
                $resultselect = $stmt_select->get_result();
            }
        

            // Obtener la id del representante
            $rowrepre = mysqli_fetch_assoc($resultselect);
            $representanteId = $rowrepre['id'];

                           
          //aqui termina
          

          //insertar en estudiantes
          $sql3 = "INSERT INTO `estudiantes`(`nombre`, `apellido`, `cen`, `nacimiento`, `sexo`, `idgrado`, `idseccion`, `idrepresentante`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($sql3);
            $stmt->bind_param("sssssiii", $nombre, $apellido, $cen, $nacimiento, $sexo, $idgrado, $idseccion, $representanteId);
            $resultInsert3 = $stmt->execute();
 
          //aqui termina

          //eliminar de los estudiantes retirados
            $sql4 = "DELETE FROM retiro_estudiantes WHERE id = ?";
            $stmt = $connect->prepare($sql4);
            $stmt->bind_param("i", $id);
            $resultInsert4 = $stmt->execute();

          //aqui termina

            // Redireccionar
            $volver = $row['grado_nombre'];
            $volver2 = $row['seccion_nombre'];
            header("location: estudiantes_retirados.php");
        } else {
            die(mysqli_error($connect));
        }
       } else {
        die(mysqli_error($connect));
    }

?>