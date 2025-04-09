<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];

    
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
    WHERE estudiantes.id = ?";
    
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
        $repreUnido=$representanteNombre . $representanteApellido;


          //ingresar insert en bitacora al eliminar estudiante
          $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
          $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cen = $cen, nacimiento = $nacimiento, sexo = $sexo, grado = $grado, seccion = $seccion, representante = $representanteNombre, Apellido del representante = $representanteApellido, cedula representante = $cedularepre, telefono = $telefono, correo = $correo";
          
          $stmt2 = $connect->prepare($sql2);
          $accion= "Se Elimino un estudiante.";
          $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
          $resultInsert2 = $stmt2->execute();
            //aqui termina

    
        // Contar cuántos estudiantes están asociados al representante
        $countSql = "SELECT COUNT(*) AS total FROM estudiantes WHERE idrepresentante = ?";
        $stmt = $connect->prepare($countSql);
        $stmt->bind_param("i", $representante_id);
        $stmt->execute();
        $countResult = $stmt->get_result();
        $countRow = $countResult->fetch_assoc();
        $totalEstudiantes = $countRow['total'];

        // Eliminar al estudiante
        $deleteEstudianteSql = "DELETE FROM estudiantes WHERE id = ?";
        $stmt = $connect->prepare($deleteEstudianteSql);
        $stmt->bind_param("i", $id);
        $deleteEstudianteResult = $stmt->execute();
        

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