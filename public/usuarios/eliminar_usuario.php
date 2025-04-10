<?php
include './../connect.php';
session_start();
    if (isset($_GET['eliminarid'])) {
    $passAdmin =$_POST['passAdmin'];
    $passUsser = $_POST['passUsser']; 
    $id = $_GET['eliminarid'];
    $usuarioSeccion = $_SESSION['nombre_usuario'];

    // Obtener información del estudiante y su representante
    $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuarioSeccion);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result){
        $row= mysqli_fetch_assoc($result);
        $contraseñaAdmin= $row['contraseña'];
    }

    $sql2 = "SELECT * FROM usuario WHERE id = ?";
    $stmt2 = mysqli_prepare($connect, $sql2);
    mysqli_stmt_bind_param($stmt2, "i", $id);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);

    if ($result2) {
        $row2= mysqli_fetch_assoc($result2);
        $id = $row2['id'];
        $usuario = $row2['nombre_usuario'];  
        $contraseña = $row2['contraseña'];
        $estado = $row2['estado'];
        $pregunta1 = $row2['respuesta_seguridad1'];
        $pregunta2 = $row2['respuesta_seguridad2'];
        $nombre = $row2['nombre'];
        $apellido = $row2['apellido'];  
        $cedula = $row2['cedula'];
        $telefono = $row2['telefono'];
        $gmail = $row2['correo'];
    }
    if (password_verify($passAdmin, $contraseñaAdmin) && password_verify($passUsser, $contraseña)) {
         //ingresar insert en bitacora al eliminar estudiante
         $sql3 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
         $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cedula = $cedula, telefono = $telefono,  usuario = $usuario, estado = $estado";
         
         $stmt3 = $connect->prepare($sql3);
         $accion= "Se Elimino un usuario.";
         $stmt3->bind_param("sss", $accion, $datos_accion, $usuarioSeccion);
         $resultInsert2 = $stmt3->execute();
           //aqui termina




        $deleteusuarioSql = "DELETE FROM usuario WHERE id = ?";
        $stmt3 = mysqli_prepare($connect, $deleteusuarioSql);
        mysqli_stmt_bind_param($stmt3, "i", $id);
       mysqli_stmt_execute($stmt3);
        

        // Redireccionar
    
        header("location: usuarios.php");
    }else {
    echo '<script>
    alert ("Datos incorrectos")
    </script>;';
    header("location: usuarios.php");
}
    }
      
       

?>