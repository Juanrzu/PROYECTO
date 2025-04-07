	<?php
	include('./../connect.php');
	session_start();

	?>

	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
		<title>Login</title>
	</head>

	<body class="bg-login" id="body">

		<div class="container-lg w-full h-full">
			<header class="header-login w-full flex items-center justify-between px-4 py-8">

				<div class="container_title text-xl lg:text-3xl">
					<h1 class="title-h1 ghost">E.P.N "Cesar Arteaga Castro"</h1>
				</div>

				<div class="container-escudo bg-slate-300 rounded-full">
					<img class=" object-cover w-16 h-16" src="http://localhost/dashboard/Proyecto/src/escudo.png" alt="">
				</div>
			</header>
			<main class="h-screen w-full flex justify-center items-center flex-col">

				<form class="space-y-6 rounded-xl p-4 py-8 mx-20 drop-shadow-lg bg-gray-500 bg-opacity-80" id="formulario" method="POST">
					<div>
						<label for="usuario" class="block text-sm font-medium leading-6 dim">Usuario</label>

						<div class="mt-2">
							<input name="usuario" type="text" id="usuario" placeholder="Ingrese el usuario" class="block w-full rounded-md border-0 px-2 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-gray-500 sm:text-sm sm:leading-6">
						</div>
					
						<label for="contraseña" class="block text-sm font-medium leading-6 dim">Contraseña</label>

						<div class="mt-2 ">
							<input type="password" name="contraseña" id="contraseña" placeholder="Igrese la contraseña" class="block w-full rounded-md border-0 px-2 py-1.5   shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-gray-500 sm:text-sm sm:leading-6">
						</div>

					<!-- Inicio de Captcha-->
						<div class="mt-2">
						<tr>
							<td><img src="../captcha/captcha.php"></td>
							<td><input type="text" name="captcha"  id="captcha" placeholder="Igrese el captcha" required ></td><br>
							<td><button id="btn_recargar">Recargar</button></td>
						</tr>
						</div>		
					<!-- Fin del Captcha---->
					</div>
				
					<div class="text-sm">
						<a href="http://localhost\dashboard\Proyecto\public\login\acciones\recuperar_clave.php" class="font-semibold text-xs tx-blue-500 hover:text-blue-800">Ha olvidado su contraseña?</a>
					</div>
					<div>
						<button type="submit" name="registrar" id="btn" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-400 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Iniciar sesion</button>
					</div>

				</form>
			</main>

			<footer class="flex justify-between items-center mx-4 py-8">
				<p class="ghost">Todos Los derechos reservados 2024</p>
				<a class="btn bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512">
						<path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
						Licencia Creative Commons
					</svg>
				</a>
			</footer>
		</div>

	<script>
			const form = document.getElementById('formulario');
			const btn = document.getElementById('btn');
			const usuario = document.getElementById('usuario');
			const contraseña = document.getElementById('contraseña');




			form.addEventListener("submit", (e) => {
				const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
				var error = "";
				var msg = document.createElement("div");


				if (usuario.value == "" || contraseña.value == "") {
					error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost pb-1">Los campos no pueden estar vacios</p> 
                                            </div>`;
					usuario.classList.add('invalid');
					contraseña.classList.add('invalid');

				} else {
					if (!regex.test(usuario.value)) {
						error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost pb-1">ingrese un usuario con caracteres validos</p> 
                                            </div>`;
						usuario.classList.add('invalid')
					} else {
						usuario.classList.remove('invalid');
						usuario.classList.add('valid');
						
					}
				}



				if (usuario.classList.contains("invalid") || contraseña.classList.contains("invalid")) {
					msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">${error}</div>`;
					document.body.appendChild(msg);

					// Selecciona el elemento div que deseas eliminar
					var elemento = msg;

					// Configura el timeout para eliminar el div después de 5 segundos (5000 milisegundos)
					setTimeout(function() {
						msg = ""
						elemento.remove();
					}, 4000);



					e.preventDefault();
					e.stopPropagation();
				}
			})
		</script>
		<?php

			if (isset($_POST['registrar'])) {
				// Obtener datos del formulario
				$usuario = $_POST['usuario'];
				$contraseña_ingresada = $_POST['contraseña'];
				$captcha_input = $_POST['captcha'];
				
				// Verificar si el usuario y la contraseña no están vacíos
				if (empty($usuario) || empty($contraseña_ingresada || empty($captcha_input))) {
					echo '<script>						
				var msg = document.createElement("div");

							msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
									<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost pb-1">Los campos no pueden estar vacios</p> 
                                    </div>
							</div>`;

			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
			document.body.appendChild(msg);

		</script>';
					exit(); // Detiene la ejecución del script si hay campos vacíos
				}
				// Verificar el captcha primero
				if ($captcha_input !== $_SESSION["captcha"]) {
					echo '<script>						
									var msg = document.createElement("div");
									msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
											<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            	<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
												<p class="text-xs ghost pb-1">Captcha no valido</p> 
                                    		</div>
									</div>`;

			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
											document.body.appendChild(msg);
									</script>'; exit;
						}
				//seleccionar datos de usuario

				$q = "SELECT * FROM usuario WHERE nombre_usuario = ?";
				$stmt = $connect->prepare($q);
				
				if (!$stmt) {
					die("Error al preparar la consulta: " . $connect->error);
				}
				$stmt->bind_param("s", $usuario);
				$stmt->execute();
				$result = $stmt->get_result();
				$array = $result->fetch_assoc();
				$stmt->close();

				//fin

				if ($array) {
					$usuario = $array['nombre_usuario'];
					$contraseña = $array['contraseña'];
					$estado = $array['estado'];
					$intentos_fallidos = $array['intentos_fallidos'];

					if (password_verify($contraseña_ingresada, $contraseña)) {

						if ($estado == "Inactivo") {
							echo '<script>						
									var msg = document.createElement("div");
									msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
											<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            	<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
												<p class="text-xs ghost pb-1">Este Usuario esta inactivo, contacte con el administrador</p> 
                                    		</div>
									</div>`;

			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
											document.body.appendChild(msg);
									</script>'; exit;
						}

						$_SESSION['nombre_usuario'] = $usuario;
						$intentos_fallidos = 0;
						//actualizar intentos fallidos





						//fin
						$update_query = "UPDATE usuario SET intentos_fallidos = 0  WHERE nombre_usuario = '$usuario'";
						mysqli_query($connect, $update_query);
						echo "<script> window.location='http://localhost/dashboard/Proyecto/public/display.php'</script>";

						//ingresar inicio de sesion en bitacora
						
							$accion = "Se ha iniciado la sesión";
						
							$sql2 = "INSERT INTO bitacora (accion, usuario) VALUES (?, ?)";
							$stmt = $connect->prepare($sql2);

							if (!$stmt) {
								die("Error al preparar la consulta: " . $connect->error);
							}

							$stmt->bind_param("ss", $accion, $usuario);
							$resultInsert2 = $stmt->execute();

							if (!$resultInsert2) {
								die("Error al ejecutar la consulta: " . $stmt->error);
							}

							$stmt->close();
							die();

						//fin
					}
					if ($estado == "Inactivo") {
						echo '<script>						
				var msg = document.createElement("div");

							msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
									<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost pb-1">Este Usuario esta desactivado</p> 
                                    </div>
							</div>`;
			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
			document.body.appendChild(msg);
		</script>'; exit;

					} else {
						$intentos_fallidos++;
						if ($intentos_fallidos >= 3) {

							$update_query = "UPDATE usuario SET estado = 'Inactivo', intentos_fallidos = 0  WHERE nombre_usuario = '$usuario'";
							mysqli_query($connect, $update_query);
							echo '<script>						
											var msg = document.createElement("div");

														msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
																<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
																		<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
																		<p class=" text-xs ghost pb-1">Ya ha usado muchos intentos. Usuario bloqueado, contacte con el administrador</p> 
																</div>
														</div>`;
																		var elemento = msg;
																		setTimeout(function() {
																			elemento.remove();
																		}, 4000);
										document.body.appendChild(msg);
									</script>'; 
									exit;
						} else {
							echo '<script>						
											var msg = document.createElement("div");

														msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
																<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
																		<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
																		<p class=" text-xs ghost pb-1">La contraseña es incorrecta</p> 
																</div>
														</div>`;
																		var elemento = msg;
																		setTimeout(function() {
																			elemento.remove();
																		}, 4000);
										document.body.appendChild(msg);
									</script>'; 
									
						}
						// Actualizar el número de intentos fallidos en la base de datos
	$update = "UPDATE usuario SET intentos_fallidos = $intentos_fallidos WHERE nombre_usuario = '$usuario'";
	mysqli_query($connect, $update);
					}
				} else { // Usuario no encontrado
					echo '<script>						
				var msg = document.createElement("div");

							msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
									<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost pb-1">Este Usuario no existe</p> 
                                    </div>
							</div>`;
			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
			document.body.appendChild(msg);
		</script>'; exit;
				}
			}

			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] :'';
			$nombre = isset($_POST['codigo ']) ? $_POST['codigo'] :'';
			
			if($nombre== '' || $codigo = ''){
				echo "Debe llenar todos los datos del captcha";
				exit();
			}
			
			$captcha = sha1($codigo);
			
			if($codigoverificacion != $captcha){
				$_SESSION['codigo_verificacion'] = '';
				echo "El código de verificacion es incorrecto";
				exit();
			}

			
			?> 


	</body>

	</html>