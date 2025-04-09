<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['nombre_usuario']) || empty($_SESSION['nombre_usuario'])) {
    header('Location: ./../login/login.php');
    exit();
}

$usuario = $_SESSION['nombre_usuario'];

require_once './../connect.php';
require_once '../contador_sesion.php';

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
        if ($usuario == "admin" || $usuario == "Admin") {
            include('../header_admin.php');
        } else {
            include('../header.php');
        }
        ?>

        <main class="w-full flex justify-center items-center xl:px-56 mt-8">

        <div class="w-full flex justify-center items-center xl:px-56 mt-8">

        <form method="POST" class="w-full max-w-screen-sm rounded-xl p-4 py-8 shadow-lg bg-gray-50 mx-auto" id="formulario">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres</label>
                <input type="text" name="nombre" id="nombre"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su nombre" maxlength="30">
            </div>

            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellidos</label>
                <input type="text" name="apellido" id="apellido"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su apellido" maxlength="30">
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label for="cedula" class="block text-sm font-medium text-gray-700">Cédula</label>
                <input type="number" name="cedula" id="cedula"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su cédula" maxlength="8">
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <div class="flex items-center gap-3 mt-2">
                <select name="codigo" id="codigo" class="rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="0268">0268</option>
                    <option value="0414">0414</option>
                    </select>
                <input type="text" name="telefono" id="telefono"
                    class="w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                    placeholder="Teléfono" maxlength="9">
                </div>
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="text" name="correo" id="email"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su correo" maxlength="50">
            </div>

            <div>
                <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input type="text" name="usuario" id="usuario"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su usuario" maxlength="20">
            </div>

            <div>
                <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese la contraseña" maxlength="30">
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label for="p1" class="block text-sm font-medium text-gray-700">¿Cuál es el nombre de su madre o padre?</label>
                <input type="text" name="pregunta1" id="p1"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su respuesta" maxlength="50">
            </div>

            <div class="col-span-1 sm:col-span-2">
                <label for="p2" class="block text-sm font-medium text-gray-700">¿Cuál es tu animal favorito?</label>
                <input type="text" name="pregunta2" id="p2"
                class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su respuesta" maxlength="50">
            </div>
            </div>

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
        </div>
        </main>


        
        <footer class="bg-white shadow mt-12">
            <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-600 text-sm">Todos los derechos reservados © 2024</p>
            <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="mt-2 md:mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-800 transition-colors duration-200" fill="currentColor" viewBox="0 0 512 512">
                <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
                </svg>
            </a>
            </div>
        </footer>
    </div>
    <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", () => {
		const form = document.getElementById('formulario');
		const inputs = {
			nombre: document.getElementById('nombre'),
			apellido: document.getElementById('apellido'),
			cedula: document.getElementById('cedula'),
			telefono: document.getElementById('telefono'),
			email: document.getElementById('email'),
			usuario: document.getElementById('usuario'),
			contraseña: document.getElementById('contraseña'),
			p1: document.getElementById('p1'),
			p2: document.getElementById('p2')
		};

		const regex = {
			soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
			soloNumeros: /^\d+$/,
			email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
			contraseña: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/
		};

		const LIMITES = {
			nombre: 30,
			apellido: 30,
			cedula: 8,
			telefono: {
				max: 8,
				min: 7
			},
			email: 50,
			usuario: 20,
			contraseña: {
				max: 30,
				min: 14
			},
			p1: 50,
			p2: 50
		};

		const mostrarNotificacion = (mensaje, tipo = 'error') => {
			const sanitizeHTML = (str) => {
				const temp = document.createElement('div');
				temp.textContent = str;
				return temp.innerHTML;
			};

			const icono = tipo === 'error' ?
				`<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
				</svg>` :
				`<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
				</svg>`;

			const color = tipo === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';

			document.querySelectorAll('.notificacion').forEach(el => el.remove());

			const notificacion = document.createElement('div');
			notificacion.className = `notificacion fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center`;
			notificacion.innerHTML = `
				<div class="flex-shrink-0 mr-3">${icono}</div>
				<div class="text-sm">${sanitizeHTML(mensaje)}</div>
			`;

			document.body.appendChild(notificacion);

			setTimeout(() => {
				notificacion.classList.add('opacity-0', 'transition-opacity', 'duration-500');
				setTimeout(() => notificacion.remove(), 500);
			}, 4000);
		};

		const validarCampo = (input, regex = null, minLength = 0, maxLength = Infinity, mensaje = null) => {
			const valor = input.value.trim();
			input.classList.remove('border-red-500');

			if (!valor) {
				return { valido: false, mensaje: mensaje || `El campo ${input.id} no puede estar vacío` };
			}

			if (regex && !regex.test(valor)) {
				return { valido: false, mensaje: mensaje || `Formato inválido para ${input.id}` };
			}

			if (valor.length < minLength) {
				return { valido: false, mensaje: mensaje || `${input.id} debe tener al menos ${minLength} caracteres` };
			}

			if (valor.length > maxLength) {
				return { valido: false, mensaje: mensaje || `${input.id} no puede exceder los ${maxLength} caracteres` };
			}

			return { valido: true };
		};

		form.addEventListener("submit", (e) => {
			e.preventDefault();

			Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));

			const validaciones = [
				{ input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, 1, LIMITES.nombre, `El nombre debe ser válido y tener un máximo de ${LIMITES.nombre} caracteres.`) },
				{ input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, 1, LIMITES.apellido, `El apellido debe ser válido y tener un máximo de ${LIMITES.apellido} caracteres.`) },
				{ input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula, LIMITES.cedula, `La cédula debe tener exactamente ${LIMITES.cedula} dígitos.`) },
				{ input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, `El teléfono debe tener entre ${LIMITES.telefono.min} y ${LIMITES.telefono.max} dígitos.`) },
				{ input: inputs.email, resultado: validarCampo(inputs.email, regex.email, 1, LIMITES.email, `El correo debe ser válido y tener un máximo de ${LIMITES.email} caracteres.`) },
				{ input: inputs.usuario, resultado: validarCampo(inputs.usuario, /^[A-Za-z0-9\s]+$/, 1, LIMITES.usuario, `El usuario debe ser válido y tener un máximo de ${LIMITES.usuario} caracteres.`) },
				{ input: inputs.contraseña, resultado: validarCampo(inputs.contraseña, regex.contraseña, LIMITES.contraseña.min, LIMITES.contraseña.max, `La contraseña debe tener entre ${LIMITES.contraseña.min} y ${LIMITES.contraseña.max} caracteres, incluyendo al menos una mayúscula, una minúscula, un número.`) },
				{ input: inputs.p1, resultado: validarCampo(inputs.p1, regex.soloLetras, 1, LIMITES.p1, `La respuesta debe ser válida y tener un máximo de ${LIMITES.p1} caracteres.`) },
				{ input: inputs.p2, resultado: validarCampo(inputs.p2, regex.soloLetras, 1, LIMITES.p2, `La respuesta debe ser válida y tener un máximo de ${LIMITES.p2} caracteres.`) }
			];

			for (const validacion of validaciones) {
				if (!validacion.resultado.valido) {
					validacion.input.classList.add('border-red-500');
					mostrarNotificacion(validacion.resultado.mensaje);
					return;
				}
			}

			mostrarNotificacion('Formulario enviado correctamente', 'success');
			form.submit(); // Descomentar para enviar el formulario
		});
	});
</script>
</html>

<?php

function mostrar_mensaje($mensaje, $tipo = 'error') {
    $color_clase = ($tipo === 'error') ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';
    $icono_svg = '';

    if ($tipo === 'error') {
        $icono_svg = '<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
                        </svg>';
    } elseif ($tipo === 'success') {
        $icono_svg = '<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
                        </svg>';
    }

    echo '<script>
        var msg = document.createElement("div");
        msg.innerHTML = ` <div class="fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ' . $color_clase . ' border flex items-center">
                            <div class="flex-shrink-0 mr-3">' . $icono_svg . '</div>
                            <div class="text-sm">' . htmlspecialchars($mensaje) . '</div>
                            </div>`;
        document.body.appendChild(msg);
        setTimeout(function() {
            msg.remove();
        }, 4000);
    </script>';
    exit();
}

if (isset($_POST['registrar'])) {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $codigo_telefono = $_POST['codigo'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];

    // Validaciones en el servidor (redundantes con el JS, pero importantes por seguridad)
    if (empty($nombre) || empty($apellido) || empty($cedula) || empty($telefono) || empty($correo) || empty($usuario) || empty($contraseña) || empty($pregunta1) || empty($pregunta2)) {
        mostrar_mensaje("Todos los campos son obligatorios.");
    }

    if (!preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/', $nombre)) {
        mostrar_mensaje("El nombre solo puede contener letras y espacios.");
    }

    if (!preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/', $apellido)) {
        mostrar_mensaje("El apellido solo puede contener letras y espacios.");
    }

    if (!preg_match('/^[0-9]{7,8}$/', $cedula)) {
        mostrar_mensaje("La cédula debe contener entre 7 y 8 dígitos numéricos.");
    }

    if (!preg_match('/^[0-9]{7}$/', $telefono)) {
        mostrar_mensaje("El teléfono debe contener 7 dígitos numéricos.");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        mostrar_mensaje("El correo electrónico no es válido.");
    }

    if (strlen($usuario) > 20) {
        mostrar_mensaje("El usuario no puede tener más de 20 caracteres.");
    }

    if (strlen($contraseña) < 14 || strlen($contraseña) > 30 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $contraseña)) {
        mostrar_mensaje("La contraseña debe tener entre 14 y 30 caracteres y contener al menos una mayúscula, una minúscula y un número.");
    }

    if (strlen($pregunta1) > 50) {
        mostrar_mensaje("La respuesta a la pregunta 1 no puede tener más de 50 caracteres.");
    }

    if (strlen($pregunta2) > 50) {
        mostrar_mensaje("La respuesta a la pregunta 2 no puede tener más de 50 caracteres.");
    }

    // Verificar si el usuario ya existe
    $stmt_check = $connect->prepare("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = ?");
    $stmt_check->bind_param("s", $usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        mostrar_mensaje("El usuario ya existe. Por favor, elija otro nombre de usuario.");
        $stmt_check->close();
    } else {
        $stmt_check->close();

        // Hash de la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        // Preparar la inserción del nuevo usuario
        $stmt_insert = $connect->prepare("INSERT INTO usuario (nombre, apellido, cedula, codigo_telefono, telefono, correo, nombre_usuario, contraseña, pregunta1, pregunta2, estado, intentos_fallidos, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Activo', 0, 'usuario')");
        $stmt_insert->bind_param("ssssssssss", $nombre, $apellido, $cedula, $codigo_telefono, $telefono, $correo, $usuario, $hashed_password, $pregunta1, $pregunta2);

        if ($stmt_insert->execute()) {
            mostrar_mensaje("Usuario registrado correctamente.", 'success');
            // Puedes redirigir al usuario a otra página aquí si es necesario
            // header('Location: alguna_pagina.php');
            // exit();
        } else {
            mostrar_mensaje("Error al registrar el usuario: " . $stmt_insert->error);
        }

        $stmt_insert->close();
    }

    $connect->close();
}

?>