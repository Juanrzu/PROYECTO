<?php
include './../connect.php';
    $id = $_GET['eliminarid'];

    // Obtener información del estudiante y su representante
    $sql ="SELECT * FROM usuario WHERE id=$id";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $row= mysqli_fetch_assoc($result);
        $id = $row['id'];
        $usuario = $row['nombre_usuario'];  
        $contraseña = $row['contraseña'];
        $estado = $row['estado'];
        $pregunta1 = $row['respuesta_seguridad1'];
        $pregunta2 = $row['respuesta_seguridad2'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];  
        $cedula = $row['cedula'];
        $telefono = $row['telefono'];
        $gmail = $row['correo'];


      
        $deleteusuarioSql = "DELETE FROM usuario WHERE id = $id";
        $deleteusuarioResult = mysqli_query($connect, $deleteusuarioSql);
    
            // Redireccionar
        
            header("location: usuarios.php");
        } else {
            die(mysqli_error($connect));
        }

?>