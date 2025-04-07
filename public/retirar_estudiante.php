<?php
include 'connect.php';
session_start();

$usuario = $_SESSION['nombre_usuario'];


if (isset($_GET['eliminarid'])) {
    $id = $_GET['eliminarid'];
    $motivo = trim($_POST['motivo']); // Sanitizar entrada
    
    // Obtener información del estudiante y su representante
    $sql ="SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
    representante.nombre as representante_nombre,
    representante.apellido as representante_apellido,
    representante.cedula as representante_cedula, representante.telefono as representante_telefono,
    representante.correo as representante_correo 
    FROM estudiantes 
    JOIN seccion ON estudiantes.idseccion = seccion.id 
    JOIN grados ON estudiantes.idgrado = grados.id
    JOIN representante On estudiantes.idrepresentante = representante.id
    WHERE estudiantes.id=$id ";
    $result = mysqli_query($connect, $sql);
    
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
            $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES ('Se Retiró un estudiante.', 
            'Informacion: nombre = $nombre, apellido = $apellido , cen = $cen , nacimiento = $nacimiento, sexo = $sexo , grado = $gradoNombe, seccion = $seccionNombre, 
            representante = $repreUnido , cedula representante = $cedularepre, telefono = $telefono , correo = $correo, motivo = $motivo ', 
            '$usuario')";
            $resultInsert2 = mysqli_query(mysql: $connect, query: $sql2);
            //aqui terminas

            //ingresar insert en estudiantes retirados
            $sql3 = "INSERT INTO retiro_estudiantes (nombre, apellido, cen, nacimiento, 
            sexo, grado, seccion, representante, representante_apellido, cedula_repre, telefono, correo, motivo) 
            VALUES ('$nombre','$apellido','$cen','$nacimiento','$sexo',
            '$gradoNombre','$seccionNombre','$representanteNombre','$representanteApellido','$cedularepre','$telefono','$correo','$motivo')";


            $resultInsert3 = mysqli_query(mysql: $connect, query: $sql3);


            //aqui termina


            // Contar cuántos estudiantes están asociados al representante
            $countSql = "SELECT COUNT(*) AS total FROM estudiantes WHERE idrepresentante = $representante_id";
            $countResult = mysqli_query($connect, $countSql);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalEstudiantes = $countRow['total'];

            // Eliminar de la tabla estudiante estudiante
            $deleteEstudianteSql = "DELETE FROM estudiantes WHERE id = $id";
            $deleteEstudianteResult = mysqli_query($connect, $deleteEstudianteSql);

            if ($deleteEstudianteResult) {
            // Si solo hay un estudiante asociado al representante, eliminar al representante
            if ($totalEstudiantes == 1) {
            $deleteRepresentanteSql = "DELETE FROM representante WHERE id = $representante_id";
            $deleteRepresentanteResult = mysqli_query($connect, $deleteRepresentanteSql);

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