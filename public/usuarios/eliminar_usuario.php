<?php
include './../connect.php';
   
    if (isset($_GET['eliminarid'])) {
    $passAdmin =$_POST['passAdmin'];
    $passUsser = $_POST['passUsser']; 
    $id = $_GET['eliminarid'];

    // Obtener información del estudiante y su representante
    $sql ="SELECT * FROM usuario WHERE nombre_usuario='admin'";
    $result = mysqli_query($connect, $sql);
    if ($result){
        $row= mysqli_fetch_assoc($result);
        $contraseñaAdmin= $row['contraseña'];
    }
    $sql2 ="SELECT * FROM usuario WHERE id=$id";
    $result2 = mysqli_query($connect, $sql2);
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
    $deleteusuarioSql = "DELETE FROM usuario WHERE id = $id";
    $deleteusuarioResult = mysqli_query($connect, $deleteusuarioSql);

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