<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];
    
    // Obtener información del estudiante y su representante
     $sql = "SELECT * FROM retiro_estudiantes WHERE id='$id' ";
    $result = mysqli_query($connect, $sql);
    
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
            $queryGrado = "SELECT id FROM grados WHERE nombre = '$grado'";
            $resultGrado = mysqli_query($connect, $queryGrado);

            if (!$resultGrado) {
                die("Error al obtener el ID del grado: " . mysqli_error($connect));
            }

            $rowGrado = mysqli_fetch_assoc($resultGrado);
            $idgrado = $rowGrado['id'];

          
            $querySeccion = "SELECT id FROM seccion WHERE nombre = '$seccion'";
            $resultSeccion = mysqli_query($connect, $querySeccion);

            if (!$resultSeccion) {
                die("Error al obtener el ID de la sección: " . mysqli_error($connect));
            }
            $rowSeccion = mysqli_fetch_assoc($resultSeccion);
            $idseccion = $rowSeccion['id'];

        //aqui termina

          //ingresar insert en bitacora al eliminar estudiante
            $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES ('Se restauró un estudiante.', 
            'Informacion: nombre = $nombre, apellido = $apellido , cen = $cen , nacimiento = $nacimiento, sexo = $sexo , grado = $grado, seccion = $seccion, 
            representante = $representanteNombre , Apellido del representante = $representanteApellido , cedula representante = $cedularepre, telefono = $telefono , correo = $correo', 
            '$usuario')";
            $resultInsert2 = mysqli_query(mysql: $connect, query: $sql2);
            //aqui termina


        // Verificar si se encuentra ingresado el representante
            $selectRepresentante = "SELECT * FROM `representante` WHERE cedula = '$cedularepre'";

            $resultselect = mysqli_query($connect, $selectRepresentante);

            if (mysqli_num_rows($resultselect) == 0) { 
               
                $insertRepresentanteSql = "INSERT INTO `representante` (`nombre`, `apellido`, `cedula`, `telefono`, `correo`) 
                                            VALUES ('$representanteNombre', '$representanteApellido', '$cedularepre', '$telefono', '$correo')";

                $insertRepresentanteResult = mysqli_query($connect, $insertRepresentanteSql);

                if (!$insertRepresentanteResult) {
                    
                    die("Error en la inserción: " . mysqli_error($connect));
                }

              
                $resultselect = mysqli_query($connect, $selectRepresentante);
            }

            // Obtener la id del representante
            $rowrepre = mysqli_fetch_assoc($resultselect);
            $representanteId = $rowrepre['id'];

                           
          //aqui termina
          

          //insertar en estudiantes
          $sql3="INSERT INTO `estudiantes`(`nombre`, `apellido`, `cen`, `nacimiento`, `sexo`, `idgrado`, `idseccion`, `idrepresentante`) 
                 VALUES ('$nombre','$apellido','$cen','$nacimiento','$sexo','$idgrado','$idseccion','$representanteId')";
          $resultInsert3 = mysqli_query(mysql: $connect, query: $sql3);
          //aqui termina

          //eliminar de los estudiantes retirados
          $sql4="DELETE FROM retiro_estudiantes WHERE id = '$id' ";
          $resultInsert4 = mysqli_query(mysql: $connect, query: $sql4);
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