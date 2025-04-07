<?php
include './../connect.php';
   
    if (isset($_GET['eliminarid'])) {
    $passAdmin =$_POST['passAdmin'];
    $passUsser = $_POST['passUsser']; 
    $id = $_GET['eliminarid'];





// Seleccionar la contraseña del admin
$sql = "SELECT contraseña FROM usuario WHERE nombre_usuario = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", "admin");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contraseñaAdmin = $row['contraseña'];
}
$stmt->close();

// Seleccionar los datos del usuario por ID
$sql2 = "SELECT * FROM usuario WHERE id = ?";
$stmt2 = $connect->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
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
$stmt2->close();

// Verificar contraseñas y eliminar usuario
if (password_verify($passAdmin, $contraseñaAdmin) && password_verify($passUsser, $contraseña)) {
    $deleteusuarioSql = "DELETE FROM usuario WHERE id = ?";
    $stmt3 = $connect->prepare($deleteusuarioSql);
    $stmt3->bind_param("i", $id);
    header("location: usuarios.php");
    
      
    }else {
    echo '<script>
    alert ("Datos incorrectos")
    </script>;';
    header("location: usuarios.php");
}
    }
      
       

?>