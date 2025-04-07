<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}
include '../connect.php';


	if(isset($_POST['registrar'])){

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$correo = $_POST['correo'];
		$usuario = $_POST['usuario'];
		$contraseña = $_POST['contraseña'];
		$pregunta1 = $_POST['pregunta1'];
		$pregunta2 = $_POST['pregunta2'];
		$contraseña_cifrada = password_hash($contraseña, PASSWORD_ARGON2ID);
		$pregunta1_cifrada=password_hash($pregunta1, PASSWORD_ARGON2ID);
		$pregunta2_cifrada=password_hash($pregunta2, PASSWORD_ARGON2ID);

		if (empty($nombre) || empty($apellido) || empty($cedula) || empty($telefono) || empty($correo) || empty($usuario) || empty($contraseña) || empty($pregunta1) || empty($pregunta2)) {
			echo "Por favor, complete todos los campos del formulario.";
			?><div class="container-link">
			<p><a href="../../usuarios/usuarios.php">Reintentar</a></p>
		</div>
			<?php
			exit; // Detiene la ejecución del script si hay campos vacíos
		}
		session_start();

		
		
		

		$sqlempleado = "INSERT INTO empleado (id, nombre,apellido,cedula,telefono,correo) 
						VALUES ('','$nombre','$apellido','$cedula','$telefono','$correo')";
		
		$ejecutar = mysqli_query ($connect,$sqlempleado);

		$queryempleado = "SELECT id FROM empleado WHERE cedula = '$cedula'";
        $resultempleado = mysqli_query($connect, $queryempleado);
		$rowempleado = mysqli_fetch_assoc($resultempleado);
        $idempleado = $rowempleado['id'];
		
		$sqlusuario = "INSERT INTO usuario (nombre,contraseña,estado, pregunta1, pregunta2, idempleado) 
						VALUES ('$usuario','$contraseña_cifrada', 'Activo', '$pregunta1_cifrada', '$pregunta2_cifrada', '$idempleado')";
		$ejecutar2 = mysqli_query ($connect,$sqlusuario);

	


		

		header('location:./usuarios/usuarios.php');
	}

?>