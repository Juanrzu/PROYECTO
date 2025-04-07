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
                            <input id="usuario" name="usuario" type="text" required 
                                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                                placeholder="Ingrese su usuario">
                        </div>
                    </div>

                    <!-- Preguntas de Seguridad -->
                    <div>
                        <label for="p1" class="block text-sm font-medium text-gray-700">¿Cuál es el nombre de su madre o padre?</label>
                        <div class="mt-1">
                            <input id="p1" name="pregunta1" type="text" required 
                                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                                placeholder="Ingrese su respuesta">
                        </div>
                    </div>

                    <div>
                        <label for="p2" class="block text-sm font-medium text-gray-700">¿Cuál es su animal favorito?</label>
                        <div class="mt-1">
                            <input id="p2" name="pregunta2" type="text" required 
                                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                                placeholder="Ingrese su respuesta">
                        </div>
                    </div>

                    <!-- Nueva Contraseña -->
                    <div>
                        <label for="contraseña" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                        <div class="mt-1">
                            <input id="contraseña" name="contraseña" type="password" required 
                                class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400"
                                placeholder="Ingrese la nueva contraseña">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="http://localhost/dashboard/Proyecto/public/login/login.php" class="text-sm font-medium text-blue-600 hover:text-blue-500">
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
    // Función para mostrar notificaciones
    function mostrarNotificacion(mensaje, tipo = 'error') {
        const icono = tipo === 'error' ? 
            `<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"/>
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

    // Validación del formulario
    document.getElementById('formulario').addEventListener('submit', function(e) {
        const usuario = document.getElementById('usuario');
        const p1 = document.getElementById('p1');
        const p2 = document.getElementById('p2');
        const contraseña = document.getElementById('contraseña');
        const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/;
        let errores = [];
        
        // Validar campos vacíos
        if (!usuario.value.trim()) errores.push('El campo usuario no puede estar vacío');
        if (!p1.value.trim()) errores.push('La respuesta a la pregunta 1 no puede estar vacía');
        if (!p2.value.trim()) errores.push('La respuesta a la pregunta 2 no puede estar vacía');
        if (!contraseña.value.trim()) errores.push('La nueva contraseña no puede estar vacía');
        
        // Validar formato de campos
        if (usuario.value.trim() && !regex.test(usuario.value)) {
            errores.push('El usuario solo puede contener letras y espacios');
            usuario.classList.add('border-red-500');
        } else {
            usuario.classList.remove('border-red-500');
        }
        
        if (p1.value.trim() && !regex.test(p1.value)) {
            errores.push('La respuesta a la pregunta 1 solo puede contener letras y espacios');
            p1.classList.add('border-red-500');
        } else {
            p1.classList.remove('border-red-500');
        }
        
        if (p2.value.trim() && !regex.test(p2.value)) {
            errores.push('La respuesta a la pregunta 2 solo puede contener letras y espacios');
            p2.classList.add('border-red-500');
        } else {
            p2.classList.remove('border-red-500');
        }
        
        // Validar longitud mínima de contraseña
        if (contraseña.value.trim() && contraseña.value.length < 8) {
            errores.push('La nueva contraseña debe tener al menos 8 caracteres');
            contraseña.classList.add('border-red-500');
        } else {
            contraseña.classList.remove('border-red-500');
        }
        
        // Si hay errores, mostrar el primero y prevenir el envío
        if (errores.length > 0) {
            e.preventDefault();
            mostrarNotificacion(errores[0]);
            
            // Enfocar el primer campo con error
            if (!usuario.value.trim() || !regex.test(usuario.value)) {
                usuario.focus();
            } else if (!p1.value.trim() || !regex.test(p1.value)) {
                p1.focus();
            } else if (!p2.value.trim() || !regex.test(p2.value)) {
                p2.focus();
            } else if (!contraseña.value.trim() || contraseña.value.length < 8) {
                contraseña.focus();
            }
        }
    });
    </script>
</body>






        <?php
            // Verifica si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Conexión a la base de datos (ajusta los detalles según tu configuración)
                include '../../connect.php';

                // Recibir datos del formulario
                $usuario = $_POST['usuario'];
                $pregunta1 = strtolower($_POST['pregunta1']);
                $pregunta2 = strtolower($_POST['pregunta2']);
                $nueva_contraseña = $_POST['contraseña'];


            if(isset($_POST['registrar'])){


                if (empty($usuario) || empty($pregunta1) || empty($pregunta2) || empty($nueva_contraseña)) {
                    echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Los campos no puede estar vacios</p>
						</div>';
                        exit;
                }
            }
                //preparar sentencia 1
                // Consulta para verificar las respuestas de seguridad
                $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                
                //fin
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $pregunta1_bd = $row['respuesta_seguridad1'];
                    $pregunta2_bd = $row['respuesta_seguridad2'];
                    

                // Verificar las respuestas de seguridad y actualizar la contraseña
                if (password_verify($pregunta1, $pregunta1_bd) && password_verify($pregunta2, $pregunta2_bd)) {

                    //preparar sentencia 2
                    // Las respuestas coinciden, actualiza la contraseña
            
                    $contraseña_cifrada = password_hash($nueva_contraseña, PASSWORD_ARGON2ID);
                    $update_sql = "UPDATE usuario SET contraseña = ? WHERE nombre_usuario = ?";
                    $stmt = $connect->prepare($update_sql);
                    $stmt->bind_param("ss", $contraseña_cifrada, $usuario);
                    if ($stmt->execute() === TRUE) {
                    
                    echo"<script> window.location='http://localhost/dashboard/Proyecto/public/login/login.php'</script>";
                    
                    }
                    else {

                        echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">La contraseña es incorrecta</p>
						</div>'. $connect->error;
                    } $stmt->close();
                     //fin
                } else {
                    echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Una de las respuesta es incorrecta</p>
						</div>';
                }
                    } else {
                echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Usuario no encontrado</p>
						</div>';
                }
            }

    ?>
</body>
</html>
