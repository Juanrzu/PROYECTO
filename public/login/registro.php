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
				<input type="text" name="nombre" id="nombre" maxlength="25"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su nombre">
				</div>

				<!-- Apellidos -->
				<div>
				<label for="apellido" class="block text-sm font-medium text-gray-700">Apellidos</label>
				<input type="text" name="apellido" id="apellido" maxlength="25"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su apellido">
				</div>

				<!-- Cédula -->
				<div class="col-span-1 sm:col-span-2">
				<label for="cedula" class="block text-sm font-medium text-gray-700">Cédula</label>
				<input type="number" name="cedula" id="cedula" maxlength="9"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su cédula">
				</div>

				<!-- Teléfono -->
				<div class="col-span-1 sm:col-span-2">
				<label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
				<div class="flex items-center gap-3 mt-2">
					<input type="text" name="telefono" id="telefono" maxlength="11"
					class="w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Teléfono">
				</div>
				</div>

				<!-- Correo -->
				<div class="col-span-1 sm:col-span-2">
				<label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
				<input type="text" name="correo" id="email" maxlength="100"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su correo">
				</div>

				<!-- Usuario -->
				<div>
				<label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
				<input type="text" name="usuario" id="usuario" maxlength="30"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su usuario">
				</div>

				<!-- Contraseña -->
				<div>
				<label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
				<input type="password" name="contraseña" id="contraseña" maxlength="50"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese la contraseña">
				</div>

				<!-- Pregunta 1 -->
				<div class="col-span-1 sm:col-span-2">
				<label for="p1" class="block text-sm font-medium text-gray-700">¿Cuál es el nombre de su madre o padre?</label>
				<input type="text" name="pregunta1" id="p1" maxlength="100"
					class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
					placeholder="Ingrese su respuesta">
				</div>

				<!-- Pregunta 2 -->
				<div class="col-span-1 sm:col-span-2">
				<label for="p2" class="block text-sm font-medium text-gray-700">¿Cuál es tu animal favorito?</label>
				<input type="text" name="pregunta2" id="p2" maxlength="100"
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
    document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('formulario');
    const btn = document.getElementById('registrar');
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cedula: document.getElementById('cedula'),
        telefono: document.getElementById('telefono'),
        email: document.getElementById('email'),
        usuario: document.getElementById('usuario'),
        contraseña: document.getElementById('contraseña'),
        pregunta1: document.getElementById('p1'),
        pregunta2: document.getElementById('p2')
    };

    const regex = {
        soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
        soloNumeros: /^\d+$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        contraseña: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/ // Al menos 1 mayúscula, 1 minúscula y 1 número
    };

    const LIMITES = {
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        cedula: { min: 7, max: 8 },
        telefono: { min: 10, max: 11 },
        email: { min: 5, max: 25 },
        usuario: { min: 5, max: 30 },
        contraseña: { min: 14, max: 25 },
        pregunta: { min: 2, max: 100 }
    };

    // Función para mostrar notificaciones (igual que antes)
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

    // Función de validación genérica
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

    // Validación específica para contraseña
    const validarContraseña = () => {
        const input = inputs.contraseña;
        const valor = input.value.trim();
        input.classList.remove('border-red-500');

        if (!valor) {
            return { valido: false, mensaje: "La contraseña no puede estar vacía" };
        }

        if (valor.length < LIMITES.contraseña.min) {
            return { valido: false, mensaje: `La contraseña debe tener al menos ${LIMITES.contraseña.min} caracteres` };
        }

        if (valor.length > LIMITES.contraseña.max) {
            return { valido: false, mensaje: `La contraseña no puede exceder los ${LIMITES.contraseña.max} caracteres` };
        }

        if (!regex.contraseña.test(valor)) {
            return { valido: false, mensaje: "La contraseña debe contener al menos una mayúscula, una minúscula y un número" };
        }

        return { valido: true };
    };

    // Evento de validación al hacer clic en el botón
    btn.addEventListener("click", (e) => {
        Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));

        // Validar todos los campos excepto la contraseña
        const validaciones = [
            { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, "Por favor, introduce un nombre válido (solo letras).") },
            { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, "Por favor, introduce un apellido válido (solo letras).") },
            { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, `La cédula debe contener entre ${LIMITES.cedula.min} y ${LIMITES.cedula.max} números.`) },
            { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, `El teléfono debe contener ${LIMITES.telefono.max} números.`) },
            { input: inputs.email, resultado: validarCampo(inputs.email, regex.email, LIMITES.email.min, LIMITES.email.max, `Por favor, introduce un correo electrónico válido. debe contener entre ${LIMITES.email.min} y ${LIMITES.email.max} números.`) },
            { input: inputs.usuario, resultado: validarCampo(inputs.usuario, null, LIMITES.usuario.min, LIMITES.usuario.max, `El nombre de usuario debe tener entre ${LIMITES.usuario.min} y ${LIMITES.usuario.max} caracteres.`) },
            { input: inputs.pregunta1, resultado: validarCampo(inputs.pregunta1, regex.soloLetras, LIMITES.pregunta.min, LIMITES.pregunta.max, "Por favor, introduce una respuesta válida para la pregunta de seguridad (solo letras).") },
            { input: inputs.pregunta2, resultado: validarCampo(inputs.pregunta2, regex.soloLetras, LIMITES.pregunta.min, LIMITES.pregunta.max, "Por favor, introduce una respuesta válida para la pregunta de seguridad (solo letras).") }
        ];

        // Validar primero todos los campos excepto contraseña
        for (const validacion of validaciones) {
            if (!validacion.resultado.valido) {
                e.preventDefault();
                validacion.input.classList.add('border-red-500');
                mostrarNotificacion(validacion.resultado.mensaje);
                return;
            }
        }

        // Luego validar la contraseña por separado
        const validacionContraseña = validarContraseña();
        if (!validacionContraseña.valido) {
            e.preventDefault();
            inputs.contraseña.classList.add('border-red-500');
            mostrarNotificacion(validacionContraseña.mensaje);
            return;
        }

        // Si todo está bien, mostrar mensaje de éxito
        mostrarNotificacion("Todos los campos son válidos. Formulario enviado correctamente.", "success");
    });

    // Validación en tiempo real para la contraseña (opcional)
    inputs.contraseña.addEventListener('input', () => {
        inputs.contraseña.classList.remove('border-red-500');
    });
});
  </script>
</body>

</html>



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

if (isset($_POST['registrar'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $telefono = trim($_POST['telefono']);
    $codigo = strval($_POST['codigo']);
    $codigo = ($codigo . $telefono);
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);
    $pregunta1 = strtolower(trim($_POST['pregunta1']));
    $pregunta2 = strtolower(trim($_POST['pregunta2']));
    $contraseña_cifrada = password_hash($contraseña, PASSWORD_ARGON2ID);
    $pregunta1_cifrada = password_hash($pregunta1, PASSWORD_ARGON2ID);
    $pregunta2_cifrada = password_hash($pregunta2, PASSWORD_ARGON2ID);

    // Configuración de límites y expresiones regulares
    $LIMITES = [
        'nombre' => ['min' => 2, 'max' => 25],
        'apellido' => ['min' => 2, 'max' => 25],
        'cedula' => ['min' => 7, 'max' => 8],
        'telefono' => ['min' => 10, 'max' => 11],
        'correo' => ['min' => 5, 'max' => 50],
        'usuario' => ['min' => 5, 'max' => 30],
        'contraseña' => ['min' => 14, 'max' => 25],
        'pregunta' => ['min' => 2, 'max' => 100],
    ];

    $regex = [
        'soloLetras' => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
        'soloNumeros' => '/^\d+$/',
        'email' => '/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
        'contraseña' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/' // Al menos 1 mayúscula, 1 minúscula y 1 número
    ];

    $errores = [];

    // Función para validar campos
    function validarCampo($valor, $regex = null, $limites, $campo) {
        if (empty($valor)) return "$campo no puede estar vacío.";
        if ($regex && !preg_match($regex, $valor)) return "Formato inválido en $campo.";
        if (strlen($valor) < $limites['min'] || strlen($valor) > $limites['max']) {
            return "$campo debe tener entre {$limites['min']} y {$limites['max']} caracteres.";
        }
        return null;
    }

    // Validar todos los campos
    $errores[] = validarCampo($nombre, $regex['soloLetras'], $LIMITES['nombre'], 'Nombre');
    $errores[] = validarCampo($apellido, $regex['soloLetras'], $LIMITES['apellido'], 'Apellido');
    $errores[] = validarCampo($cedula, $regex['soloNumeros'], $LIMITES['cedula'], 'Cédula');
    $errores[] = validarCampo($telefono, $regex['soloNumeros'], $LIMITES['telefono'], 'Teléfono');
    $errores[] = validarCampo($correo, $regex['email'], $LIMITES['correo'], 'Correo');
    $errores[] = validarCampo($usuario, null, $LIMITES['usuario'], 'Usuario');
    $errores[] = validarCampo($contraseña, $regex['contraseña'], $LIMITES['contraseña'], 'Contraseña');
    $errores[] = validarCampo($pregunta1, $regex['soloLetras'], $LIMITES['pregunta'], 'Pregunta 1');
    $errores[] = validarCampo($pregunta2, $regex['soloLetras'], $LIMITES['pregunta'], 'Pregunta 2');

    // Filtrar errores vacíos
    $errores = array_filter($errores);

    // Validaciones específicas
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `<span>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</span>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
                </script>";
        }
        exit();
    }
    if ($campo === 'nombre_usuario' && strtolower($valor) === 'admin') {
        echo "<script>
            const notificacion = document.createElement('div');
            notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
            notificacion.innerHTML = `<span>Ya se encuentra un usuario administrador ingresado</span>`;
            document.body.appendChild(notificacion);
            setTimeout(() => notificacion.remove(), 4000);
        </script>";
        exit();
    }
    // Validar unicidad de campos
    function validarUnicidad($connect, $campo, $valor, $mensaje) {
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE $campo = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $valor);
        $stmt->execute();
        $result = $stmt->get_result();
        $existe = $result->fetch_assoc()['total'] > 0;
        $stmt->close();

        if ($existe) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `<span>" . htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') . "</span>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
                </script>";
            exit();
        }
    }

    validarUnicidad($connect, 'nombre_usuario', $usuario, 'Este usuario ya existe.');
    validarUnicidad($connect, 'correo', $correo, 'Este correo ya está registrado.');
    validarUnicidad($connect, 'telefono', $telefono, 'Este teléfono ya está registrado.');
    validarUnicidad($connect, 'cedula', $cedula, 'Esta cédula ya está registrada.');

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuario (id, nombre, apellido, cedula, telefono, correo, nombre_usuario, contraseña, intentos_fallidos, estado, respuesta_seguridad1, respuesta_seguridad2) 
            VALUES ('', ?, ?, ?, ?, ?, ?, ?, 0, 'Activo', ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre, $apellido, $cedula, $codigo, $correo, $usuario, $contraseña_cifrada, $pregunta1_cifrada, $pregunta2_cifrada);
    $stmt->execute();

    // Registrar acción en la bitácora
    $sqlBitacora = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
    $stmtBitacora = $connect->prepare($sqlBitacora);
    $accion = "Se insertó un nuevo usuario.";
    $datosAccion = "nombre = $nombre, apellido = $apellido, cedula = $cedula, telefono = $codigo, correo = $correo, usuario = $usuario";
    $stmtBitacora->bind_param("sss", $accion, $datosAccion, $usuarioSesion);
    $stmtBitacora->execute();

    echo "<script>
        const notificacion = document.createElement('div');
        notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-green-100 text-green-700 border flex items-center';
        notificacion.innerHTML = `<span>Usuario registrado correctamente.</span>`;
        document.body.appendChild(notificacion);
        setTimeout(() => notificacion.remove(), 4000);
        </script>";
    echo "<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
}
?>