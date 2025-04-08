<?php
include './../../connect.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/output.css">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>Recuperar Contraseña</title>
</head>

<script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>

<body class="bg-login" id="body">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-6xl flex flex-col md:flex-row rounded-xl shadow-2xl bg-[url('http://localhost/dashboard/Proyecto/src/wave-bg.png')] bg-no-repeat bg-cover bg-right-bottom overflow-hidden">
            <!-- Carousel Section -->
            <div class="hidden md:block md:w-1/2  p-8">
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
                    <button type="button" class="absolute top-1/2 left-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/80 hover:bg-white" data-carousel-prev>
                        <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button type="button" class="absolute top-1/2 right-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-blue-600/80 hover:bg-blue-600" data-carousel-next>
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2 p-8 ml-20">
            <form id="formulario" class="space-y-6" method="POST">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900">Recuperar Contraseña</h2>
        <p class="mt-2 text-gray-600">Ingrese sus datos para restablecer su contraseña</p>
    </div>

    <!-- Usuario -->
    <div>
        <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
        <div class="mt-1">
            <input id="usuario" name="usuario" type="text" 
                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su usuario"
                maxlength="20" 
                oninput="updateCounter('usuario', 20)">
           
        </div>
    </div>

    <!-- Preguntas de Seguridad -->
    <div>
        <label for="p1" class="block text-sm font-medium text-gray-700">¿Cuál es el nombre de su madre o padre?</label>
        <div class="mt-1">
            <input id="p1" name="pregunta1" type="text" 
                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su respuesta"
                maxlength="50"
                oninput="updateCounter('p1', 50)">
            
        </div>
    </div>

    <div>
        <label for="p2" class="block text-sm font-medium text-gray-700">¿Cuál es su animal favorito?</label>
        <div class="mt-1">
            <input id="p2" name="pregunta2" type="text"  
                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese su respuesta"
                maxlength="50"
                oninput="updateCounter('p2', 50)">
           
        </div>
    </div>

    <!-- Nueva Contraseña -->
    <div>
        <label for="contraseña" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
        <div class="mt-1">
            <input id="contraseña" name="contraseña" type="password" 
                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                placeholder="Ingrese la nueva contraseña (mínimo 8 caracteres)"
                maxlength="30"
                oninput="updateCounter('contraseña', 30)">
        </div>
    </div>

    <div class="flex items-center justify-between">
        <a href="http://localhost/dashboard/Proyecto/public/login/login.php" 
           class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">
            ¿Ya tiene una cuenta? Inicie sesión
        </a>
    </div>

    <div>
        <button type="submit" id="btn" name="registrar"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
            Cambiar Contraseña
        </button>
    </div>
</form>
            </div>
        </div>
    </div>
</body>

<script>
// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del formulario
    const form = document.getElementById('formulario');
    const btn = document.getElementById('btn');
    const usuario = document.getElementById('usuario');
    const pregunta1 = document.getElementById('p1');
    const pregunta2 = document.getElementById('p2');
    const nuevaContraseña = document.getElementById('contraseña');

    // Configuración de límites
    const LIMITES = {
        usuario: 20,
        p1: 50,
        p2: 50,
        contraseña: {
            max: 30,
            min: 8
        }
    };

    // Expresiones regulares para validación
    const REGEX = {
        usuario: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/,
        contraseña: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/ // Al menos 1 mayúscula, 1 minúscula y 1 número
    };

    // Notificaciones mejoradas
    const notificaciones = {
        mostrar: (mensaje, tipo = 'error') => {
            // Eliminar notificaciones existentes para evitar acumulación
            const notificacionesExistentes = document.querySelectorAll('.custom-notification');
            notificacionesExistentes.forEach(notif => notif.remove());

            const icono = tipo === 'error' ? 
                `<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
                </svg>` : 
                `<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
                </svg>`;
            
            const color = tipo === 'error' ? 
                'bg-red-100 border-red-400 text-red-700' : 
                'bg-green-100 border-green-400 text-green-700';
            
            const notificacion = document.createElement('div');
            notificacion.className = `custom-notification fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center z-50`;
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

    // Función para actualizar el contador de caracteres con mejor feedback visual
    function updateCounter(inputElement, maxLength) {
        const currentLength = inputElement.value.length;
        const counterElement = document.getElementById(`${inputElement.id}-counter`);
        
        if (counterElement) {
            counterElement.textContent = `${currentLength}/${maxLength}`;
            
            // Cambiar color según el porcentaje de uso
            const percentage = (currentLength / maxLength) * 100;
            if (percentage >= 90) {
                counterElement.classList.add('text-red-500');
                counterElement.classList.remove('text-yellow-500', 'text-gray-500');
            } else if (percentage >= 70) {
                counterElement.classList.add('text-yellow-500');
                counterElement.classList.remove('text-red-500', 'text-gray-500');
            } else {
                counterElement.classList.add('text-gray-500');
                counterElement.classList.remove('text-red-500', 'text-yellow-500');
            }
        }
        
        // Cambiar estilos del input si se acerca al límite
        if (currentLength >= maxLength) {
            inputElement.classList.add('border-red-500');
            inputElement.classList.remove('border-gray-300');
            notificaciones.mostrar(`${inputElement.id} ha excedido el límite de caracteres (${maxLength})`);
        } else {
            inputElement.classList.remove('border-red-500');
            inputElement.classList.add('border-gray-300');
        }
    }

    // Validación de campos mejorada
    function validarCampos() {
        let errores = [];
        
        // Validar campos vacíos
        if (!usuario.value.trim()) {
            errores.push('El campo usuario no puede estar vacío');
            usuario.classList.add('border-red-500');
        } else {
            usuario.classList.remove('border-red-500');
        }
        
        if (!pregunta1.value.trim()) {
            errores.push('Debe responder la primera pregunta de seguridad');
            pregunta1.classList.add('border-red-500');
        } else {
            pregunta1.classList.remove('border-red-500');
        }
        
        if (!pregunta2.value.trim()) {
            errores.push('Debe responder la segunda pregunta de seguridad');
            pregunta2.classList.add('border-red-500');
        } else {
            pregunta2.classList.remove('border-red-500');
        }
        
        if (!nuevaContraseña.value.trim()) {
            errores.push('Debe ingresar una nueva contraseña');
            nuevaContraseña.classList.add('border-red-500');
        } else {
            nuevaContraseña.classList.remove('border-red-500');
        }
        
        // Validar formato usuario
        if (usuario.value.trim() && !REGEX.usuario.test(usuario.value)) {
            errores.push('Ingrese un usuario con caracteres válidos (solo letras y espacios)');
            usuario.classList.add('border-red-500');
        }
        
        // Validar nueva contraseña
        if (nuevaContraseña.value.trim()) {
            if (nuevaContraseña.value.length < LIMITES.contraseña.min) {
                errores.push(`La contraseña debe tener al menos ${LIMITES.contraseña.min} caracteres`);
                nuevaContraseña.classList.add('border-red-500');
            } else if (!REGEX.contraseña.test(nuevaContraseña.value)) {
                errores.push('La contraseña debe contener al menos una mayúscula, una minúscula y un número');
                nuevaContraseña.classList.add('border-red-500');
            } else if (nuevaContraseña.value.length > LIMITES.contraseña.max) {
                errores.push(`La contraseña no puede exceder los ${LIMITES.contraseña.max} caracteres`);
                nuevaContraseña.classList.add('border-red-500');
            }
        }
        
        return errores;
    }

    // Inicializar contadores
    function inicializarContadores() {
        updateCounter(usuario, LIMITES.usuario);
        updateCounter(pregunta1, LIMITES.p1);
        updateCounter(pregunta2, LIMITES.p2);
        updateCounter(nuevaContraseña, LIMITES.contraseña.max);
    }

    // Event listeners para actualización en tiempo real
    function configurarEventListeners() {
        usuario.addEventListener('input', () => updateCounter(usuario, LIMITES.usuario));
        pregunta1.addEventListener('input', () => updateCounter(pregunta1, LIMITES.p1));
        pregunta2.addEventListener('input', () => updateCounter(pregunta2, LIMITES.p2));
        nuevaContraseña.addEventListener('input', () => updateCounter(nuevaContraseña, LIMITES.contraseña.max));
        
        // Prevenir espacios en la contraseña
        nuevaContraseña.addEventListener('keypress', (e) => {
            if (e.key === ' ') {
                e.preventDefault();
                notificaciones.mostrar('La contraseña no puede contener espacios');
            }
        });
    }

    // Manejar envío del formulario
    form.addEventListener("submit", (e) => {
        
        
        const errores = validarCampos();
        
        if (errores.length > 0) {
            // Mostrar solo el primer error
            notificaciones.mostrar(errores[0]);
            
            // Enfocar el primer campo con error
            const firstErrorField = document.querySelector('.border-red-500');
            if (firstErrorField) firstErrorField.focus();
            e.preventDefault();
            e.stopPropagation();
        } 
    });

    // Inicializar
    inicializarContadores();
    configurarEventListeners();
});
</script>
</body>
<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])) {
    // Conexión a la base de datos
    include '../../connect.php';
    
    // Función para mostrar mensajes de error estandarizados
    function mostrarError($mensaje) {
        echo '<div class="custom-notification fixed bottom-4 right-4 px-4 py-3 rounded bg-red-100 border-red-400 text-red-700 shadow-lg border flex items-center z-50">
                <div class="flex-shrink-0 mr-3">
                    <svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
                </svg>
                </div>
        
                <p class="text-sm">'.htmlspecialchars($mensaje).'</p>
              </div>';
    }

    // Validar y sanitizar entradas
    $usuario = trim($_POST['usuario'] ?? '');
    $pregunta1 = trim(strtolower($_POST['pregunta1'] ?? ''));
    $pregunta2 = trim(strtolower($_POST['pregunta2'] ?? ''));
    $nueva_contraseña = $_POST['contraseña'] ?? '';

    // Validar campos vacíos
    if (empty($usuario)) {
        mostrarError('El campo usuario no puede estar vacío');
        exit;
    }
    if (empty($pregunta1)) {
        mostrarError('Debe responder la primera pregunta de seguridad');
        exit;
    }
    if (empty($pregunta2)) {
        mostrarError('Debe responder la segunda pregunta de seguridad');
        exit;
    }
    if (empty($nueva_contraseña)) {
        mostrarError('Debe ingresar una nueva contraseña');
        exit;
    }

    // Validar fortaleza de la contraseña
    if (strlen($nueva_contraseña) < 8) {
        mostrarError('La contraseña debe tener al menos 8 caracteres');
        exit;
    }
    if (!preg_match('/[A-Z]/', $nueva_contraseña)) {
        mostrarError('La contraseña debe contener al menos una letra mayúscula');
        exit;
    }
    if (!preg_match('/[a-z]/', $nueva_contraseña)) {
        mostrarError('La contraseña debe contener al menos una letra minúscula');
        exit;
    }
    if (!preg_match('/[0-9]/', $nueva_contraseña)) {
        mostrarError('La contraseña debe contener al menos un número');
        exit;
    }

    // Consulta preparada para verificar el usuario
    $sql = "SELECT respuesta_seguridad1, respuesta_seguridad2 FROM usuario WHERE nombre_usuario = ?";
    $stmt = $connect->prepare($sql);
    
    if (!$stmt) {
        mostrarError('Error en la preparación de la consulta: ' . $connect->error);
        exit;
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        mostrarError('Usuario no encontrado');
        $stmt->close();
        exit;
    }

    $row = $result->fetch_assoc();
    $stmt->close();

    // Verificar respuestas de seguridad
    if (!password_verify($pregunta1, $row['respuesta_seguridad1']) || 
        !password_verify($pregunta2, $row['respuesta_seguridad2'])) {
        mostrarError('Las respuestas de seguridad no coinciden');
        exit;
    }

    // Actualizar contraseña con hash seguro
    $opciones = [
        'memory_cost' => 1<<17, // 128MB
        'time_cost'   => 4,
        'threads'     => 3,
    ];
    
    $contraseña_cifrada = password_hash($nueva_contraseña, PASSWORD_ARGON2ID, $opciones);
    
    $update_sql = "UPDATE usuario SET contraseña = ? WHERE nombre_usuario = ?";
    $stmt = $connect->prepare($update_sql);
    
    if (!$stmt) {
        mostrarError('Error en la preparación de la actualización: ' . $connect->error);
        exit;
    }

    $stmt->bind_param("ss", $contraseña_cifrada, $usuario);
    
    if ($stmt->execute()) {
        // Redirección con JavaScript para evitar problemas de headers
        echo '<script> 
                setTimeout(function() {
                    window.location.href = "http://localhost/dashboard/Proyecto/public/login/login.php";
                }, 1500);
              </script>';
        
        // Mensaje de éxito (opcionalmente podrías mostrarlo antes de redirigir)
        echo '<div class="success mt-2 px-2 py-4 text-center bg-green-500 rounded-xl">
                <svg fill="#4BB543" width="40px" height="26px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
                </svg>
                <p class="mx-auto text-xs">Contraseña actualizada correctamente. Redirigiendo...</p>
              </div>';
    } else {
        mostrarError('Error al actualizar la contraseña: ' . $connect->error);
    }
    
    $stmt->close();
    $connect->close();
}
?>
</html>
