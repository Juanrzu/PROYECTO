<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '' || ($usuario != 'admin' && $usuario != 'Admin')) {
    header('location: ../login/login.php');
    die();
}
include '../connect.php';
include '../contador_sesion.php';

   $id=$_GET['editarid'];
   //preparar sentencia 1
   $sql = "SELECT * FROM usuario WHERE id = ?";
   $stmt = $connect->prepare($sql);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $result = $stmt->get_result();
   $row = $result->fetch_assoc();
   
       $usuario = $row['nombre_usuario'];  
       $contraseña = $row['contraseña'];
       $estado = $row['estado'];
       $nombre = $row['nombre'];
       $apellido = $row['apellido'];  
       $cedula = $row['cedula'];
       $telefono = $row['telefono'];
       $gmail = $row['correo'];
       $intentos_fallidos= $row['intentos_fallidos'];

//fin
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
	<link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>

<body>
 
    <div class="container-all">
        <!-- Mostrar el mensaje de error aquí con echo -->
    <?php if (!empty($error)) : ?>
        <p class="text-danger"><?php echo $error[0]; ?></p>
    <?php endif; ?>
       
        <main class="container-sm">
        

        <form method="post" class="col-4  mx-auto" id="formulario" novalidate>
            <div class="mb-3">
                <label>Usuario</label>
                <input type="text" class="form-control" placeholder="Nombre de usuario" name="usuario" id="usuario" autocomplete="off" value=<?php echo "$usuario"; ?> required >
            </div>
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre del Usuario" name="nombre" id="nombre" autocomplete="off" value=<?php echo "$nombre"; ?> required>
            </div>
            <div class="mb-3">
                <label>Apellido</label>
                <input type="text" class="form-control" placeholder="Apellido del Usuario" name="apellido" id="apellido" autocomplete="off" value=<?php echo "$apellido"; ?> required>
            </div>
            <div class="mb-3">
                <label>Cedula</label>
                <input type="int" class="form-control" placeholder="Cedula del Usuario" name="cedula" id="cedula" autocomplete="off" value=<?php echo "$cedula"; ?> required>
            </div>
            <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Telefono del Usuario" name="telefono" id="telefono" autocomplete="off" value=<?php echo "$telefono"; ?> required>          
                
            </div>
            <div class="mb-3">
                <label>Correo Electronico</label>
                <input type="email" class="form-control" placeholder="Correo del Usuario" name="gmail" id="email" autocomplete="off" value=<?php echo "$gmail"; ?> required>
            </div>
            <div class="mb-3">
            <label>Estado (<b>presione abajo para desplegar las opciones</b>)</label>
                <select class="form-control" name="estado">
                    <?php if ($estado == "Activo"){?>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    <?php     
                        }else{
                        ?>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Activo">Activo</option>
                        <?php
                        }?>
                </select>

            </div>
            <div class="container-error text-danger mb-3">

            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Finalizar</button>
            </div>
            <div class="mb-3">
                        <button type="button" onclick="window.location='http:localhost/dashboard/Proyecto/public/display.php'" class="btn btn-primary">Regresar a la página anterior</button></div>
                     
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title fs-5" id="exampleModalLabel"></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <span>esta seguro que quiere editar a este usuario?</span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary" name="submit">Si</button>
                            </div>
                          </div>
                        </div>
                      </div>
            </div>
        </form>

    </main>
</div>    
</body>

  <script src="http://localhost/dashboard/Proyecto/src/bootstrap/js/bootstrap.min.js"></script>
  <script src="http://localhost/dashboard/Proyecto/src/js/validacion-register-edit.js"></script>

</html>



<?php
        
        if (isset($_POST['submit'])){
            $usuario = $_POST['usuario']; 
            $estado = $_POST['estado'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];  
            $cedula = $_POST['cedula'];
            $telefono = $_POST['telefono'];
            $codigo= strval($_POST['codigo']);
            $codigo = ($codigo . $telefono);
            $correo = $_POST['gmail'];
     
            if (empty($usuario) || empty($estado) || empty($nombre) || empty($apellido) || empty($cedula) || empty($codigo) || empty($correo)) {
                
                echo "<div >
                    <div class='container_title btn btn-danger'>
                        <h5 class='title-h1'>Los datos no pueden estar vacios</h5>
                    </div>
            
                </div>";
                exit;
            
            }

           // Verificar usuario existente 
                $sql_verificar_usuario = "SELECT * FROM usuario WHERE nombre_usuario = ? AND id != ?";
                $stmt_usuario = $connect->prepare($sql_verificar_usuario);
                $stmt_usuario->bind_param("si", $usuario, $id);
                $stmt_usuario->execute();
                if ($stmt_usuario->get_result()->num_rows > 0) {
                    $errores[] = "Este usuario ya se encuentra registrado";
                }
                $stmt_usuario->close();

                // Verificar cédula existente 
                $sql_verificar_cedula = "SELECT * FROM usuario WHERE cedula = ? AND id != ?";
                $stmt_cedula = $connect->prepare($sql_verificar_cedula);
                $stmt_cedula->bind_param("si", $cedula, $id);
                $stmt_cedula->execute();
                if ($stmt_cedula->get_result()->num_rows > 0) {
                    $errores[] = "La cédula ya se encuentra registrada";
                }
                $stmt_cedula->close();

                // Verificar teléfono existente 
                $sql_verificar_telefono = "SELECT * FROM usuario WHERE telefono = ? AND id != ?";
                $stmt_telefono = $connect->prepare($sql_verificar_telefono);
                $stmt_telefono->bind_param("si", $codigo, $id);
                $stmt_telefono->execute();
                if ($stmt_telefono->get_result()->num_rows > 0) {
                    $errores[] = "El teléfono ya se encuentra registrado";
                }
                $stmt_telefono->close();

                // Verificar correo existente 
                $sql_verificar_correo = "SELECT * FROM usuario WHERE correo = ? AND id != ?";
                $stmt_correo = $connect->prepare($sql_verificar_correo);
                $stmt_correo->bind_param("si", $correo, $id);
                $stmt_correo->execute();
                if ($stmt_correo->get_result()->num_rows > 0) {
                    $errores[] = "Este correo ya se encuentra registrado";
                }
                $stmt_correo->close();

            
                if(!empty($errores)){
                    echo "<div >
                            <div class='container_title btn btn-danger'>
                            
                                <h5>Se encontraron los siguientes errores:</h5>";
                    echo "<ul>";
                    foreach($errores as $error){
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>
                        </div>";
                    exit;
                }
           
                //sentencia 2
                if ($estado == "Activo"){
                    $sql1 = "UPDATE usuario SET 
                                nombre = ?, 
                                apellido = ?, 
                                cedula = ?, 
                                telefono = ?, 
                                correo = ?, 
                                nombre_usuario = ?, 
                                contraseña = ?,
                                intentos_fallidos = 0, 
                                estado = ? 
                            WHERE id = ?";

                    $stmt = $connect->prepare($sql1);
                    if ($stmt) {
                        $stmt->bind_param("ssssssssi", 
                            $nombre, 
                            $apellido, 
                            $cedula, 
                            $codigo, 
                            $gmail, 
                            $usuario, 
                            $contraseña,
                            $estado, 
                            $id
                        );}
    
            
                    if ($$stmt->execute()) {
                        echo"<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
                        $stmt->close();
                    } else {
                        die(mysqli_error($connect));
                    }
                }
                //sentencia 3
                if  ($estado == "Inactivo"){

                        $sql1 = "UPDATE usuario SET 
                            nombre = ?, 
                            apellido = ?, 
                            cedula = ?, 
                            telefono = ?, 
                            correo = ?, 
                            nombre_usuario = ?, 
                            contraseña = ?,
                            intentos_fallidos = ?, 
                            estado = ? 
                        WHERE id = ?";

                $stmt = $connect->prepare($sql1);
                    if ($stmt) {
                        $stmt->bind_param("ssssssssi", 
                            $nombre, 
                            $apellido, 
                            $cedula, 
                            $codigo, 
                            $gmail, 
                            $usuario, 
                            $contraseña,
                            $intentos_fallidos,
                            $estado,
                            $id
                        );}
                

        
                if ($stmt->execute()) {
                    echo"<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
                    $stmt->close();
                } else {
                    die(mysqli_error($connect));
                }
            } 
        }


       ?>
