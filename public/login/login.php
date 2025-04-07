<?php
	include('./../connect.php');
	session_start();

	?>

<!-- hola -->

	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
		<title>Login</title>
	</head>
	<script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
	<body class="bg-login" id="body">

		<div class="container-lg w-full max-w-7xl flex justify-center items-center h-full mx-auto">
			<main class=" w-full flex justify-center items-center p-8">

				<div class="container-login h-[35em] bg-white md:bg-[url(http://localhost/dashboard/Proyecto/src/wave-bg.png)] bg-no-repeat bg-center bg-cover w-full space-y-6 p-4 rounded-xl drop-shadow-2xl flex justify-center items-center flex-col md:flex-row">

				<div id="default-carousel" class="w-full relative hidden md:block" data-carousel="slide">
					<!-- Carousel wrapper -->
					<div class="relative w-full overflow-hidden rounded-lg md:h-96">
						<!-- Item 1 -->
						<div class="hidden duration-900 ease-in-out" data-carousel-item>
							<div class="absolute w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 flex justify-center items-center flex-col x">

								<img src="http://localhost/dashboard/Proyecto/src/escudo.png" class="w-44" alt="...">
								<div class="container-text">
									<h2 class="w-full text-xl font-bold text-center text-pretty">E.P.N Cesar Arteaga Castro</h2>
								</div>
							</div>
						</div>
						<!-- Item 2 -->
						<div class="hidden duration-900 ease-in-out" data-carousel-item>
							<img src="http://localhost/dashboard/Proyecto/src/timeline.png" class="absolute block h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
						</div>
						<!-- Item 3 -->
						<div class="hidden duration-900 ease-in-out" data-carousel-item>
							<img src="http://localhost/dashboard/Proyecto/src/3.png" class="absolute block h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
						</div>
					</div>
					<!-- Slider indicators -->
					<div class="absolute z-30 flex -translate-x-1/2 translate-y-10  bottom-5 left-1/2 space-x-3  rtl:space-x-reverse">
						<button type="button" class="bg-white w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
						<button type="button" class="bg-white w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
						<button type="button" class="bg-white w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
					</div>
					<!-- Slider controls -->
					<button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
						<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-800/30 group-hover:bg-gray-400 dark:group-hover:bg-gray-800/60 group-focus:ring-4">
							<svg class="w-4 h-4 text-black dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
							</svg>
							<span class="sr-only">Previous</span>
						</span>
					</button>
					<button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
						<span class="inline-flex items-center justify-center w-10 h-10 rounded-full c-principal dark:bg-gray-800/30 group-hover:bg-gray-400 dark:group-hover:bg-gray-800/60 group-focus:ring-4">
							<svg class="w-4 h-4 text-black dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
							</svg>
							<span class="sr-only">Next</span>
						</span>
					</button>
				</div>


					<form class="w-full h-full md:ml-8 md:w-1/2" id="formulario" method="POST">
						<h2 class="text-xl font-semibold w-full text-center">BIENVENIDO!</h2>
						<div>
							<label for="usuario" class="block text-sm font-medium leading-6">Usuario</label>

							<div class="mt-2 relative">
								<svg class="absolute right-0 bottom-0 text-gray-600" width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g id="User / User_Square">
											<path id="Vector" d="M17 21C17 18.2386 14.7614 16 12 16C9.23858 16 7 18.2386 7 21M17 21H17.8031C18.921 21 19.48 21 19.9074 20.7822C20.2837 20.5905 20.5905 20.2837 20.7822 19.9074C21 19.48 21 18.921 21 17.8031V6.19691C21 5.07899 21 4.5192 20.7822 4.0918C20.5905 3.71547 20.2837 3.40973 19.9074 3.21799C19.4796 3 18.9203 3 17.8002 3H6.2002C5.08009 3 4.51962 3 4.0918 3.21799C3.71547 3.40973 3.40973 3.71547 3.21799 4.0918C3 4.51962 3 5.08009 3 6.2002V17.8002C3 18.9203 3 19.4796 3.21799 19.9074C3.40973 20.2837 3.71547 20.5905 4.0918 20.7822C4.5192 21 5.07899 21 6.19691 21H7M17 21H7M12 13C10.3431 13 9 11.6569 9 10C9 8.34315 10.3431 7 12 7C13.6569 7 15 8.34315 15 10C15 11.6569 13.6569 13 12 13Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</g>
									</g>
								</svg>
								<input name="usuario" type="text" id="usuario" placeholder="Ingrese el usuario" class=" rounded-md border-0 px-2 py-1.5 w-full  drop-shadow-2xl ring-1 ring-inset ring-gray-300 placeholder:text-principal focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6 outline outline-2 outline-gray-400">
							</div>
						</div>

						<div class="mt-4">
							<label for="contraseña" class="block text-sm font-medium leading-6">Contraseña</label>

							<div class="mt-2 relative">
								<svg class="absolute right-0 bottom-0 text-gray-600" width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g id="Interface / Lock">
											<path id="Vector" d="M9.23047 9H7.2002C6.08009 9 5.51962 9 5.0918 9.21799C4.71547 9.40973 4.40973 9.71547 4.21799 10.0918C4 10.5196 4 11.0801 4 12.2002V17.8002C4 18.9203 4 19.4801 4.21799 19.9079C4.40973 20.2842 4.71547 20.5905 5.0918 20.7822C5.5192 21 6.07902 21 7.19694 21H16.8031C17.921 21 18.48 21 18.9074 20.7822C19.2837 20.5905 19.5905 20.2842 19.7822 19.9079C20 19.4805 20 18.9215 20 17.8036V12.1969C20 11.079 20 10.5192 19.7822 10.0918C19.5905 9.71547 19.2837 9.40973 18.9074 9.21799C18.4796 9 17.9203 9 16.8002 9H14.7689M9.23047 9H14.7689M9.23047 9C9.10302 9 9 8.89668 9 8.76923V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V8.76923C15 8.89668 14.8964 9 14.7689 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</g>
									</g>
								</svg>
								<input type="password" name="contraseña" id="contraseña" placeholder="Igrese la contraseña" class="block w-full rounded-md border-0 px-2 py-1.5 drop-shadow-2xl ring-1 ring-inset ring-gray-300 placeholder:text-principal focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6 outline outline-2 outline-gray-400">
							</div>
						</div>

						<!-- Inicio de Captcha-->
						<div class="mt-4">
						<tr>
							<td><img src="../captcha/captcha.php"></td>
							<td><input type="text" name="captcha"  id="captcha" placeholder="Igrese el captcha" required ></td><br>
							<td><button id="btn_recargar">Recargar</button></td>
						</tr>
						</div>		
					<!-- Fin del Captcha---->

						<div class="text-sm mt-2">
							<a href="http://localhost\dashboard\Proyecto\public\login\acciones\recuperar_clave.php" class="font-semibold text-xs hover:text-blue-400 shadow-sm">¿Ha Olvidado Su Contraseña?</a>
						</div>
						<div class="mt-4">
							<button type="submit" name="registrar" id="btn" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6  drop-shadow-xl bg-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 outline outline-2 outline-gray-400">Iniciar sesion</button>
						</div>
					</form>

				</div>
			</main>
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
                                            <p class=" text-xs text-principal pb-1">Los campos no pueden estar vacios</p> 
                                            </div>`;
					usuario.classList.add('invalid');
					contraseña.classList.add('invalid');

				} else {
					if (!regex.test(usuario.value)) {
						error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs text-principal pb-1">ingrese un usuario con caracteres validos</p> 
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