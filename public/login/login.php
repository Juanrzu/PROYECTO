<?php

session_start();
error_reporting(0);

require_once './../connect.php';


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
	<script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
	<body class="bg-login" id="body">

	<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl flex flex-col md:flex-row rounded-xl shadow-2xl bg-[url('http://localhost/dashboard/Proyecto/src/wave-bg.png')] bg-no-repeat bg-cover bg-right-bottom overflow-hidden">
        <!-- Carousel Section -->
        <div class="hidden md:block md:w-1/2 p-8">
            <div id="default-carousel" class="h-full relative" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-full overflow-hidden rounded-lg">
                    <!-- Item 1 -->
                    <div class="hidden duration-900 ease-in-out" data-carousel-item>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <img src="http://localhost/dashboard/Proyecto/src/escudo.png" class="w-44" alt="Escudo de la institución">
                            <h2 class="mt-4 text-xl font-bold text-center text-gray-800">E.P.N Cesar Arteaga Castro</h2>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-900 ease-in-out" data-carousel-item>
                        <img src="http://localhost/dashboard/Proyecto/src/timeline.png" class="absolute inset-0 w-full h-full object-contain" alt="Línea de tiempo">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-900 ease-in-out" data-carousel-item>
                        <img src="http://localhost/dashboard/Proyecto/src/3.png" class="absolute inset-0 w-full h-full object-contain" alt="Imagen informativa">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30 flex space-x-3">
                    <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-1/2 left-[-1em] transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/80 hover:bg-white" data-carousel-prev>
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </button>
                <button type="button" class="absolute top-1/2 right-[-2em] transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-blue-600/80 hover:bg-blue-600" data-carousel-next>
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-3/5 p-8 md:p-12">
            <form id="formulario" method="POST" class="space-y-6">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Bienvenido!</h2>
                    <p class="mt-2 text-gray-600">Inicie sesión para continuar</p>
                </div>

                <!-- Campo de Usuario -->
                <div>
                    <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
                    <div class="mt-1 relative">
                        <input name="usuario" type="text" id="usuario" 
                            class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                            placeholder="Ingrese su usuario" maxlength="20" oninput="updateCounter('usuario', 20)">
                    </div>
                </div>

                <!-- Campo de Contraseña -->
                <div>
                    <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <div class="mt-1 relative">
                        <input type="password" name="contraseña" id="contraseña" 
                            class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                            placeholder="Ingrese su contraseña" maxlength="30" oninput="updateCounter('contraseña', 30)">
                    </div>
                </div>

                <!-- CAPTCHA mejorado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Verificación CAPTCHA</label>
                    <div class="mt-2 flex items-center gap-3">
                        <div class="flex-1 border rounded-md p-1 bg-gray-50">
                            <img src="../captcha/captcha.php" class="w-full h-16 object-contain">
                        </div>
                        <button type="button" id="btn_recargar" onclick="recargarCaptcha()" class="p-2 text-gray-600 hover:text-blue-500 transition-colors rounded-md hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <input type="text" name="captcha" id="captcha" 
                        class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                        placeholder="Ingrese el código CAPTCHA" maxlength="6" oninput="updateCounter('captcha', 6)">
                </div>

                <!-- Enlace de recuperación -->
                <div class="flex items-center justify-between">
                    <a href="http://localhost/dashboard/Proyecto/public/login/acciones/recuperar_clave.php" 
                        class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">
                        ¿Olvidó su contraseña?
                    </a>
                </div>

                <!-- Botón de envío -->
                <div>
                    <button type="submit" name="registrar" id="btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<script>
    document.getElementById('btn_recargar').addEventListener('click', function() {
    const captchaImg = document.querySelector('.bg-gray-50 img');
    // Agregamos un parámetro de tiempo para evitar cache
    captchaImg.src = '../captcha/captcha.php?' + new Date().getTime();
});
const form = document.getElementById('formulario');
const btn = document.getElementById('btn');
const usuario = document.getElementById('usuario');
const captchaInput = document.getElementById('captcha'); 
const contraseña = document.getElementById('contraseña');
const $minCaracteres = 14;

// Configuración de límites
const LIMITES = {
  usuario: 20,
  contraseña: {
            max: 30,
            min: 14
        },
  captcha: 6
};

// Notificaciones
const notificaciones = {
  mostrar: (mensaje, tipo = 'error') => {
    const icono = tipo === 'error' ? 
      `<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
      </svg>` : 
      `<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
      </svg>`;
    
    const color = tipo === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';
    
    const notificacion = document.createElement('div');
    notificacion.className = `fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center`;
    notificacion.innerHTML = `
      <div class="flex-shrink-0 mr-3">${icono}</div>
      <div class="text-sm">${mensaje}</div>
    `;
    
    document.body.appendChild(notificacion);
    
    setTimeout(() => {
      notificacion.classList.add('opacity-0', 'transition-opacity', 'duration-500');
      setTimeout(() => notificacion.remove(), 500);
    }, 4000);
  }
};


// Validación de campos
function validarCampos() {
    const regexUsuario = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
    let errores = [];
    
    // Validar campos vacíos
    if (!usuario.value.trim()) errores.push('El campo usuario no puede estar vacío');
    if (!contraseña.value.trim()) errores.push('El campo contraseña no puede estar vacío');
    if (!captchaInput.value.trim()) errores.push('El campo CAPTCHA no puede estar vacío');
    
    // Validar formato usuario
    if (usuario.value.trim() && !regexUsuario.test(usuario.value)) {
        errores.push('Ingrese un usuario con caracteres válidos');
        usuario.classList.add('border-red-500');
    } else {
        usuario.classList.remove('border-red-500');
    }
    
    // Validar longitud de contraseña
    if (contraseña.value.trim() && contraseña.value.length < $minCaracteres) {
        errores.push(`La contraseña debe tener al menos ${$minCaracteres} caracteres`);
        contraseña.classList.add('border-red-500');
    } else {
        contraseña.classList.remove('border-red-500');

		// Validar nueva contraseña
        if (contraseña.value.trim()) {
            if (contraseña.value.length < LIMITES.contraseña.min) {
                errores.push(`La contraseña debe tener al menos ${LIMITES.contraseña.min} caracteres`);
                contraseña.classList.add('border-red-500');
            } else if (!REGEX.contraseña.test(contraseña.value)) {
                errores.push('La contraseña debe contener al menos una mayúscula, una minúscula y un número');
                contraseña.classList.add('border-red-500');
            } else if (contraseña.value.length > LIMITES.contraseña.max) {
                errores.push(`La contraseña no puede exceder los ${LIMITES.contraseña.max} caracteres`);
                contraseña.classList.add('border-red-500');
            }
        }
    }
    
    return errores;
}

// Función para actualizar el contador de caracteres
function updateCounter(inputId, maxLength) {
    const input = document.getElementById(inputId);
    const currentLength = input.value.length;
    
    // Cambiar estilos si se acerca al límite
    if (currentLength >= maxLength) {
        input.classList.add('border-red-500', 'text-red-500');
        input.classList.remove('border-gray-300', 'text-black');
        notificaciones.mostrar(`${inputId} ha excedido el límite de caracteres (${maxLength})`);
    } else {
        input.classList.remove('border-red-500', 'text-red-500');
        input.classList.add('border-gray-300', 'text-black');
    }
}


// Inicializar contadores al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    updateCounter('usuario', LIMITES.usuario);
    updateCounter('contraseña', LIMITES.contraseña);
    updateCounter('captcha', LIMITES.captcha);
    
});

// Manejar envío del formulario
form.addEventListener("submit", (e) => {
    const errores = validarCampos();
    
    if (errores.length > 0) {
        e.preventDefault();
        e.stopPropagation();
        
        // Mostrar solo el primer error para no saturar al usuario
        notificaciones.mostrar(errores[0]);
        
        // Enfocar el primer campo con error
        if (!usuario.value.trim() || !/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/.test(usuario.value)) {
            usuario.focus();
        } else if (!contraseña.value.trim() || contraseña.value.length < $minCaracteres) {
            contraseña.focus();
        } else if (!captchaInput.value.trim()) {
            captchaInput.focus();
        }
    }
});
</script>
		
		
<?php 

function mostrar_notificacion_php($mensaje, $tipo = 'error') {
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

    echo '<div class="fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ' . $color_clase . ' border flex items-center">
            <div class="flex-shrink-0 mr-3">' . $icono_svg . '</div>
            <div class="text-sm">' . htmlspecialchars($mensaje) . '</div>
          </div>
          <script>
            setTimeout(() => {
              const notificacion = document.querySelector(\'.fixed.bottom-4.right-4\');
              if (notificacion) {
                notificacion.classList.add(\'opacity-0\', \'transition-opacity\', \'duration-500\');
                setTimeout(() => notificacion.remove(), 500);
              }
            }, 4000);
          </script>';
}

if (isset($_POST['registrar'])) {
	// Obtener datos del formulario
	$usuario = $_POST['usuario'];
	$contraseña_ingresada = $_POST['contraseña'];
	$captcha_input = $_POST['captcha'];
	$limiteUsuario = 20;
	$limiteContraseña = 30;

	// Verificar si el usuario, la contraseña y el captcha no están vacíos
	if (empty($usuario) || empty($contraseña_ingresada) || empty($captcha_input)) {
		mostrar_notificacion_php("Los campos no pueden estar vacíos");
		exit();
	}

	if (strlen($usuario) > $limiteUsuario) {
		mostrar_notificacion_php("El Usuario no debe pasar los 20 caracteres");
		exit();
	}

	if (strlen($contraseña_ingresada) > $limiteContraseña) {
		mostrar_notificacion_php("La contraseña no debe pasar los 30 caracteres");
		exit();
	}

	// Verificar el captcha primero
	if (!isset($_SESSION["captcha"]) || $captcha_input !== $_SESSION["captcha"]) {
		mostrar_notificacion_php("Captcha no válido");
		exit();
	}

	// Preparar selección de datos de usuario
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

	if ($array) {
		$usuario_db = $array['nombre_usuario'];
		$contraseña_db = $array['contraseña'];
		$estado = $array['estado'];
		$intentos_fallidos = $array['intentos_fallidos'];

		if (password_verify($contraseña_ingresada, $contraseña_db)) {
			if ($estado == "Inactivo") {
				mostrar_notificacion_php("Este Usuario está inactivo, contacte con el administrador");
				exit();
			}

			$_SESSION['nombre_usuario'] = $usuario_db;
			$intentos_fallidos = 0;

			// Actualizar intentos fallidos
			$update_query = "UPDATE usuario SET intentos_fallidos = 0 WHERE nombre_usuario = ?";
			$stmt = $connect->prepare($update_query);

			if (!$stmt) {
				die("Error al preparar la consulta: " . $connect->error);
			}

			$stmt->bind_param("s", $usuario_db);
			$stmt->execute();
			$stmt->close();

			// Registrar inicio de sesión en bitácora
			$accion = "Se ha iniciado la sesión";
			$sql2 = "INSERT INTO bitacora (accion, usuario) VALUES (?, ?)";
			$stmt = $connect->prepare($sql2);

			if (!$stmt) {
				die("Error al preparar la consulta: " . $connect->error);
			}

			$stmt->bind_param("ss", $accion, $usuario_db);
			$stmt->execute();
			$stmt->close();

			echo "<script> window.location='http://localhost/dashboard/Proyecto/public/display.php'</script>";
			exit();
		} else {
			if ($estado == "Inactivo") {
				mostrar_notificacion_php("Este Usuario está desactivado");
				exit();
			} else {
				$intentos_fallidos++;
				if ($intentos_fallidos >= 3) {
					// Bloquear usuario
					$update_query = "UPDATE usuario SET estado = ?, intentos_fallidos = ? WHERE nombre_usuario = ?";
					$stmt = $connect->prepare($update_query);

					if (!$stmt) {
						die("Error al preparar la consulta: " . $connect->error);
					}

					$cambiarEstado = "Inactivo";
					$intentos_fallidos_reset = 0;
					$stmt->bind_param("sis", $cambiarEstado, $intentos_fallidos_reset, $usuario_db);
					$stmt->execute();
					$stmt->close();

					mostrar_notificacion_php("Ya ha usado muchos intentos. Usuario bloqueado, contacte con el administrador");
					exit();
				} else {
					mostrar_notificacion_php("La contraseña es incorrecta");

					// Actualizar intentos fallidos
					$update = "UPDATE usuario SET intentos_fallidos = ? WHERE nombre_usuario = ?";
					$stmt = $connect->prepare($update);

					if (!$stmt) {
						die("Error al preparar la consulta: " . $connect->error);
					}

					$stmt->bind_param("is", $intentos_fallidos, $usuario_db);
					$stmt->execute();
					$stmt->close();
				}
			}
		}
	} else {
		mostrar_notificacion_php("Este Usuario no existe");
		exit();
	}
}



