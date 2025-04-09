<?php

session_start();
error_reporting(0);
$usuarioSesion = $_SESSION['nombre_usuario'];
if ($usuarioSesion == null || $usuarioSesion == '') {
	header('location: ./../login/login.php');
	die();
}
include './../connect.php';
include '../contador_sesion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usuarios</title>
	<link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">

</head>

<body class="bg-ghost">
	<div class="container-lg w-full h-full">

		<div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
			<div role="status">
				<svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
					<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
				</svg>
				<span class="sr-only">Loading...</span>
			</div>
		</div>

		<?php
    if ($usuarioSesion == "admin" || $usuarioSesion == "Admin") {
        include('../header_admin.php');
    } else {
        include('../header.php');
    }
    ?>

		<main class="w-full flex justify-center items-center xl:px-56 mt-8">


		<form method="POST" class="w-full max-w-screen-sm rounded-xl p-4 py-8 shadow-lg bg-gray-50 mx-auto" id="formulario">
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

				<!-- Nombres -->
				<div>
				<label for="nombre" class="block text-sm font-medium text-gray-700">Nombres</label>
				<input type="text" name="nombre" id="nombre"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su nombre">
				</div>

				<!-- Apellidos -->
				<div>
				<label for="apellido" class="block text-sm font-medium text-gray-700">Apellidos</label>
				<input type="text" name="apellido" id="apellido"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su apellido">
				</div>

				<!-- Cédula -->
				<div class="col-span-1 sm:col-span-2">
				<label for="cedula" class="block text-sm font-medium text-gray-700">Cédula</label>
				<input type="number" name="cedula" id="cedula"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su cédula">
				</div>

				<!-- Teléfono -->
				<div class="col-span-1 sm:col-span-2">
				<label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
				<div class="flex items-center gap-3 mt-2">
					<select name="codigo" id="codigo" class="rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
					<option value="0268">0268</option>
					<option value="0414">0414</option>
					<!-- Más opciones -->
					</select>
					<input type="text" name="telefono" id="telefono"
					class="w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Teléfono" maxlength="7">
				</div>
				</div>

				<!-- Correo -->
				<div class="col-span-1 sm:col-span-2">
				<label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
				<input type="text" name="correo" id="email"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su correo">
				</div>

				<!-- Usuario -->
				<div>
				<label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
				<input type="text" name="usuario" id="usuario"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su usuario">
				</div>

				<!-- Contraseña -->
				<div>
				<label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
				<input type="password" name="contraseña" id="contraseña"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese la contraseña">
				</div>

				<!-- Pregunta 1 -->
				<div class="col-span-1 sm:col-span-2">
				<label for="p1" class="block text-sm font-medium text-gray-700">¿Cuál es el nombre de su madre o padre?</label>
				<input type="text" name="pregunta1" id="p1"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su respuesta">
				</div>

				<!-- Pregunta 2 -->
				<div class="col-span-1 sm:col-span-2">
				<label for="p2" class="block text-sm font-medium text-gray-700">¿Cuál es tu animal favorito?</label>
				<input type="text" name="pregunta2" id="p2"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su respuesta">
				</div>
			</div>

			<!-- Botones -->
			<div class="mt-6 flex flex-col sm:flex-row gap-3">
				<button type="submit" name="registrar" id="registrar"
				class="w-full sm:w-auto px-4 py-3 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
				Registrar
				</button>
				<button type="button" onclick="window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'"
				class="w-full sm:w-auto px-4 py-3 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
				Regresar
				</button>
			</div>
			</form>



	</main>


	
	<footer class="flex justify-between items-center w-full px-8 py-4">
		<p class="demin">Todos Los derechos reservados 2024</p>
		<a class="btn bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
			<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512">
				<path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
				Licencia Creative Commons
			</svg>
		</a>
	</footer>
	</div>
	<script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
	<script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>



	<script>
		const form = document.getElementById('formulario');
		const btn = document.getElementById('registrar');
		const nombre = document.getElementById('nombre');
		const apellido = document.getElementById('apellido');
		const cedula = document.getElementById('cedula');
		const telefono = document.getElementById('telefono');
		const email = document.getElementById('email');
		const usuario = document.getElementById('usuario');
		const pass = document.getElementById('contraseña');
		const p1 = document.getElementById('p1');
		const p2 = document.getElementById('p2');





		form.addEventListener("submit", (e) => {


			const regexCedula = /[-._!"`'#%&,:;<>=@{}~\$\(\)\*\+\/\\\?\[\]\^\|]+/;
			const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
			var error = "";
			var msg = document.createElement("div");




			if (nombre.value == "" || apellido.value == "" || cedula.value == "" || usuario.value == "" || telefono.value == "" || pass.value == "" || p1.value == "" || p2.value == "") {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Los campos no pueden estar vacios</p> 
                                            </div>`;
				nombre.classList.add('is-invalid');
				nombre.classList.remove('is-valid');

				apellido.classList.add('is-invalid');
				apellido.classList.remove('is-valid');

				cedula.classList.add('is-invalid');
				cedula.classList.remove('is-valid');

				usuario.classList.add('is-invalid');
				usuario.classList.remove('is-valid');

				telefono.classList.add('is-invalid');
				telefono.classList.remove('is-valid');

				pass.classList.add('is-invalid');
				pass.classList.remove('is-valid');

				p1.classList.add('is-invalid');
				p1.classList.remove('is-valid');

				p2.classList.add('is-invalid');
				p2.classList.remove('is-valid');

			} else {
				nombre.classList.remove('is-invalid');
				nombre.classList.add('is-valid');
				apellido.classList.remove('is-invalid');
				apellido.classList.add('is-valid');
				cedula.classList.remove('is-invalid');
				cedula.classList.add('is-valid');
				usuario.classList.remove('is-invalid');
				usuario.classList.add('is-valid');
				telefono.classList.remove('is-invalid');
				telefono.classList.add('is-valid');
				pass.classList.remove('is-invalid');
				pass.classList.add('is-valid');
				p1.classList.remove('is-invalid');
				p1.classList.add('is-valid');
				p2.classList.remove('is-invalid');
				p2.classList.add('is-valid');

			}

			if (!regexEmail.test(email.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">ingrese un correo valido</p> 
                                            </div>`;
				email.classList.add('is-invalid');
				email.classList.remove('is-valid');
			} else {
				email.classList.add('is-valid');
				email.classList.remove('is-invalid');
			}

			if (!regex.test(nombre.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese un Nombre con caracteres validos</p> 
                            </div>`;
				nombre.classList.add('is-invalid');
				nombre.classList.remove('is-valid');
			} else {
				nombre.classList.add('is-valid');
				nombre.classList.remove('is-invalid');
			}

			if (!regex.test(apellido.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese un Apellido con caracteres validos</p> 
                            </div>`;
				apellido.classList.add('is-invalid');
				apellido.classList.remove('is-valid');
			} else {
				apellido.classList.add('is-valid');
				apellido.classList.remove('is-invalid');
			}

			if (regexCedula.test(cedula.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese una Cedula con caracteres validos</p> 
                            </div>`;
				cedula.classList.add('is-invalid');
				cedula.classList.remove('is-valid');
			} else {

				if (cedula.value.length < 7) {
					error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">la Cedula debe contener mas caracteres</p> 
                            </div>`;
					cedula.classList.add('is-invalid');
					cedula.classList.remove('is-valid');
				} else {
					if (cedula.value.length > 8) {
						error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                <p class=" text-[11px] ghost pb-1">la Cedula debe contener menos caracteres</p> 
                                </div>`;
						cedula.classList.add('is-invalid');
						cedula.classList.remove('is-valid');
					} else {
						cedula.classList.add('is-valid');
						cedula.classList.remove('is-invalid');
					}
				}
			}

			if (!regex.test(usuario.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese un Usuario con caracteres validos</p> 
                            </div>`;
				usuario.classList.add('is-invalid');
				usuario.classList.remove('is-valid');
			} else {
				usuario.classList.add('is-valid');
				usuario.classList.remove('is-invalid');
			}

			if (regexCedula.test(telefono.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese un Telefono con caracteres validos</p> 
                            </div>`;
				telefono.classList.add('is-invalid');
				telefono.classList.remove('is-valid');
			} else {
				if (telefono.value.length < 7) {
					error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">el Telefono debe contener mas caracteres</p> 
                                            </div>`;
					telefono.classList.add('is-invalid');
					telefono.classList.remove('is-valid');
				} else {
					if (telefono.value.length > 7) {
						error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">el Telefono debe contener menos caracteres</p> 
                                            </div>`;
						telefono.classList.add('is-invalid');
						telefono.classList.remove('is-valid');
					} else {
						telefono.classList.add('is-valid');
						telefono.classList.remove('is-invalid');
					}
				}
			}

			if (!regex.test(p1.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">La pregunta 1 no debe contener numeros</p> 
                                            </div>`;
				p1.classList.add('is-invalid');
				p1.classList.remove('is-valid');
			} else {
				p1.classList.add('is-valid');
				p1.classList.remove('is-invalid');
			}

			if (!regex.test(p2.value)) {
				error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">La pregunta 2 no debe contener numeros</p> 
                                            </div>`;
				p2.classList.add('is-invalid');
				p2.classList.remove('is-valid');
			} else {
				p2.classList.add('is-valid');
				p2.classList.remove('is-invalid');
			}



			if (usuario.classList.contains("is-invalid") || contraseña.classList.contains("is-invalid") || nombre.classList.contains("is-invalid") || pass.classList.contains("is-invalid") || cedula.classList.contains("is-invalid") || telefono.classList.contains("is-invalid") || email.classList.contains("is-invalid") || p1.classList.contains("is-invalid") || p2.classList.contains("is-invalid")) {
				msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-blue-500 rounded-xl font-bold w-56 md:w-80">${error}</div>`;
				document.body.appendChild(msg);

				// Selecciona el elemento div que deseas eliminar
				var elemento = msg;

				// Configura el timeout para eliminar el div después de 5 segundos (5000 milisegundos)
				setTimeout(function() {
					msg = ""
					elemento.remove();
				}, 4500);



				e.preventDefault();
				e.stopPropagation();
			}



		});
	</script>
</body>

</html>



<?php


if (isset($_POST['registrar'])) {

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$telefono = $_POST['telefono'];
	$codigo = strval($_POST['codigo']);
	$codigo = ($codigo . $telefono);
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];
	$pregunta1 = strtolower($_POST['pregunta1']);
	$pregunta2 = strtolower($_POST['pregunta2']);
	$contraseña_cifrada = password_hash($contraseña, PASSWORD_ARGON2ID);
	$pregunta1_cifrada = password_hash($pregunta1, PASSWORD_ARGON2ID);
	$pregunta2_cifrada = password_hash($pregunta2, PASSWORD_ARGON2ID);


	if (empty($nombre) || empty($apellido) || empty($cedula) || empty($codigo) || empty($correo) || empty($usuario) || empty($contraseña) || empty($pregunta1) || empty($pregunta2)) {




		echo '<script>						
				var msg = document.createElement("div");

							msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
									<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Los campos no pueden estar vacios</p> 
                                    </div>
							</div>`;

			                                var elemento = msg;
                                            setTimeout(function() {
                                                elemento.remove();
                                            }, 4000);
			document.body.appendChild(msg);

		</script>';
		exit;
	}
	// Verificar usuario 
	//preparar sentencia 1
	// Verificar usuario 
			
	
	
// Funciones auxiliares
function mostrarError($mensaje) {
    echo '<script> 
        var msg = document.createElement("div");
        msg.innerHTML = `<div class="fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
            <div class="flex justify-start items-center border-b-2 border-gray-300 pb-2">
                <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505">
                    <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
                </svg>
                <p class="text-[11px] ghost pb-1">'.$mensaje.'</p> 
            </div>
        </div>`;
        
        setTimeout(() => msg.remove(), 4000);
        document.body.appendChild(msg);
    </script>';
    exit;
}

function validarCampoUnico($connect, $campo, $valor, $mensajeError) {
    $stmt = $connect->prepare("SELECT COUNT(*) as total FROM usuario WHERE $campo = ?");
    $stmt->bind_param("s", $valor);
    $stmt->execute();
    $result = $stmt->get_result();
    $existe = $result->fetch_assoc()['total'] > 0;
    $stmt->close();
    
    if ($existe) {
        mostrarError($mensajeError);
    }
}

// Validación de campos recibidos (deberías incluir esto)
/*
$usuario = $_POST['usuario'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$cedula = $_POST['cedula'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';
*/

// Validaciones de formato
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    mostrarError("Ingrese un Correo válido");
}

if (!is_numeric($telefono)) {
    mostrarError("El teléfono solo debe contener números");
}

if (strlen($telefono) != 7) {
    mostrarError("El teléfono debe tener exactamente 7 dígitos");
}

if (strlen($cedula) < 8 || strlen($cedula) > 9) {
    mostrarError("La cédula debe tener entre 8 y 9 caracteres");
}

if (strlen($contraseña) < 16) {
    mostrarError("La contraseña debe tener al menos 16 caracteres");
}

// Validaciones de unicidad
validarCampoUnico($connect, 'nombre_usuario', $usuario, "Este usuario ya existe");
validarCampoUnico($connect, 'correo', $correo, "Este correo ya está registrado");
validarCampoUnico($connect, 'telefono', $telefono, "Este teléfono ya está en uso");
validarCampoUnico($connect, 'cedula', $cedula, "Esta cédula ya está registrada");

// Si llegamos aquí, todas las validaciones pasaron
// Puedes continuar con el registro del usuario


  //ingresar insert en bitacora
  $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
  $stmt2 = $connect->prepare($sql2);
  $accion = "Se Insertó un nuevo Usuario.";
  $datos_accion = "nombre = $nombre, apellido = $apellido, cedula = $cedula, codigo = $codigo, correo = $correo, usuario= $usuario";
  $stmt2->bind_param("sss", $accion, $datos_accion, $usuarioSesion);
  $resultInsert2 = $stmt2->execute();
  
  //aqui termina

		//preparar sentencia 5

		$sqlusuario = "INSERT INTO usuario (id, nombre, apellido, cedula, telefono, correo, nombre_usuario, contraseña, intentos_fallidos, estado, respuesta_seguridad1, respuesta_seguridad2) 
		VALUES ('', ?, ?, ?, ?, ?, ?, ?, 0, 'Activo', ?, ?)";
		$stmt = $connect->prepare($sqlusuario);
		$stmt->bind_param("sssssssss", $nombre, $apellido, $cedula, $codigo, $correo, $usuario, $contraseña_cifrada, $pregunta1_cifrada, $pregunta2_cifrada);
		$stmt->execute();
		echo "<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
		
		
		$stmt->close();
		//fin
		
	}


?>