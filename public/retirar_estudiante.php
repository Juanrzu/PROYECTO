<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];
    $motivo = trim($_POST['motivo']); // Sanitizar entrada
    
    // Obtener información del estudiante y su representante
    $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre,
    representante.nombre as representante_nombre,
    representante.apellido as representante_apellido,
    representante.cedula as representante_cedula, representante.telefono as representante_telefono,
    representante.correo as representante_correo 
    FROM estudiantes 
    JOIN seccion ON estudiantes.idseccion = seccion.id 
    JOIN grados ON estudiantes.idgrado = grados.id
    JOIN representante ON estudiantes.idrepresentante = representante.id
    WHERE estudiantes.id=?";
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
        $representante_id=$row['idrepresentante'];
        $representanteNombre=$row['representante_nombre'];
        $representanteApellido=$row['representante_apellido'];
        $cedularepre=$row['representante_cedula'];
        $telefono=$row['representante_telefono'];
        $correo=$row['representante_correo'];
        $grado=$row['idgrado'];
        $seccion=$row['idseccion'];
        $gradoNombre=$row['grado_nombre'];
        $seccionNombre=$row['seccion_nombre'];


          //ingresar insert en bitacora al eliminar estudiante
          $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
          $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cen = $cen, nacimiento = $nacimiento, sexo = $sexo, grado = $gradoNombe, seccion = $seccionNombre, representante = $repreUnido, cedula representante = $cedularepre, telefono = $telefono, correo = $correo, motivo = $motivo";
          $stmt2 = $connect->prepare($sql2);
          $stmt2->bind_param("sss", 'Se Retiró un estudiante.', $datos_accion, $usuario);
          $resultInsert2 = $stmt2->execute();
            //aqui terminas

            //ingresar insert en estudiantes retirados
            $sql3 = "INSERT INTO retiro_estudiantes (nombre, apellido, cen, nacimiento, sexo, grado, seccion, representante, representante_apellido, cedula_repre, telefono, correo, motivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt3 = $connect->prepare($sql3);
            $stmt3->bind_param("sssssssssssss", $nombre, $apellido, $cen, $nacimiento, $sexo, $gradoNombre, $seccionNombre, $representanteNombre, $representanteApellido, $cedularepre, $telefono, $correo, $motivo);
            $resultInsert3 = $stmt3->execute();


            //aqui termina


            // Contar cuántos estudiantes están asociados al representante
            $countSql = "SELECT COUNT(*) AS total FROM estudiantes WHERE idrepresentante = ?";
            $stmt_count = $connect->prepare($countSql);
            $stmt_count->bind_param("i", $representante_id);
            $stmt_count->execute();
            $countResult = $stmt_count->get_result();
            $countRow = $countResult->fetch_assoc();
            $totalEstudientes = $countRow['total'];

            // Eliminar de la tabla estudiante estudiante
            $deleteEstudianteSql = "DELETE FROM estudiantes WHERE id = ?";
            $stmt_delete = $connect->prepare($deleteEstudianteSql);
            $stmt_delete->bind_param("i", $id);
            $deleteEstudianteResult = $stmt_delete->execute();

            if ($deleteEstudianteResult) {
            // Si solo hay un estudiante asociado al representante, eliminar al representante
            if ($totalEstudiantes == 1) {
              $deleteRepresentanteSql = "DELETE FROM representante WHERE id = ?";
              $stmt = $connect->prepare($deleteRepresentanteSql);
              $stmt->bind_param("i", $representante_id);
              $deleteRepresentanteResult = $stmt->execute();
              

            if (!$deleteRepresentanteResult) {
            die(mysqli_error($connect));
            }
            }

            // Redireccionar
            $volver = $row['grado_nombre'];
            $volver2 = $row['seccion_nombre'];
            header("location: ver_grado.php?gradonombre=$volver&seccion=$volver2");
            } else {
            die(mysqli_error($connect));
            }
            } else {
            die(mysqli_error($connect));
            }
            }
            ?>