<?php
session_start();
error_reporting(0);
$usuarioSeccion = $_SESSION['nombre_usuario'];
if ($usuarioSeccion == null || $usuarioSeccion == '' || ($usuarioSeccion != 'admin' && $usuarioSeccion != 'Admin')) {
    header('location: ../login/login.php');
    die();
}
include '../connect.php';
include '../contador_sesion.php';

$id = $_GET['editarid'];
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
$correo = $row['correo'];
$intentos_fallidos = $row['intentos_fallidos'];


 //guardar datos viejos
 $nombre_anterior = $nombre;
 $usuario_anterior = $usuario;
 $apellido_anterior = $apellido;
 $cedula_anterior = $cedula;
 $telefono_anterior = $telefono;
 $estado_anterior = $estado;
 $correo_anterior = $correo;
 //fin 
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
<link rel="stylesheet" href="../../src/css/styles.css">
</head>

<body class="bg-gray-50">
    <!-- Loading Screen -->
    <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 z-50"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <?php
    if ($usuarioSeccion == "admin" || $usuarioSeccion == "Admin") {
        include('../header_admin.php');
    } else {
        header('location: ../display.php');
        include('../header.php');
    }
    ?>

    <main class="container mx-auto px-4 py-8">
        <form method="post" class="w-full max-w-screen-sm mx-auto rounded-md border border-gray-300 p-6 shadow-sm bg-white" id="formulario" novalidate>
            <div class="mb-6 border-b border-gray-200 pb-4">
            <h3 class="text-xl font-semibold text-gray-800">Editar Usuario</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <!-- Nombres -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Nombres de usuario" name="usuario" id="usuario" autocomplete="off" maxlength="25" value="<?php echo $usuario; ?>" required>
                    </div>

                    <!-- Nombres -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombres</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Nombres del usuario" name="nombre" id="nombre" autocomplete="off" maxlength="25" value="<?php echo $nombre; ?>" required>
                    </div>

                    <!-- Apellidos -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellidos</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Apellidos del usuario" name="apellido" id="apellido" autocomplete="off" maxlength="25" value="<?php echo $apellido; ?>" required>
                    </div>

            <!-- Cédula -->
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Cédula del usuario" name="cedula" id="cedula" value="<?php echo $cedula; ?>" maxlength="8">
            </div>

                        <!-- Teléfono -->
                        <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Teléfono" name="telefono" autocomplete="off" maxlength="11" id="telefono" value="<?php echo $telefono; ?>" required>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                        <input type="email" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Correo" name="correo" id="email" maxlength="25" autocomplete="off" value="<?php echo $correo; ?>" required>
                    </div>

            <!-- Estado -->
            <div>
                <label class="text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select class=" w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="estado" id="estado">
                <option value="Activo" <?php echo $estado == "Activo" ? "selected" : ""; ?>>Activo</option>
                <option value="Inactivo" <?php echo $estado == "Inactivo" ? "selected" : ""; ?>>Inactivo</option>
                </select>
            </div>
            </div>

           <!-- Botones -->
        <div class="col-span-2 mt-6 flex flex-col sm:flex-row gap-3 ">
                    <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        Finalizar
                    </button>
                    <button type="button" onclick="regresarPaginaAnterior()" class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
                        Regresar
                    </button>
                </div>
    </div>

                <!-- Modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <div class="relative bg-white rounded-md shadow-md border border-gray-300">
                            <div class="flex items-center justify-between p-4 border-b border-gray-300">
                                <h3 class="text-lg font-semibold text-gray-700">Confirmación</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 space-y-4">
                                <p class="text-sm text-gray-600">¿Está seguro que quiere editar este usuario?</p>
                            </div>
                            <div class="flex items-center p-4 border-t border-gray-300">
                                <button data-modal-hide="default-modal" type="submit" name="submit" id="btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                    Confirmar
                                </button>
                                <button data-modal-hide="default-modal" type="button" class="px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </main>

</body>
</html>
<script>
              function regresarPaginaAnterior() {
              window.history.back();
                  }
            </script>
                <script src="../../src/js/script.js"></script>
                <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
<script>


    const form = document.getElementById('formulario');
    const btn = document.getElementById('btn');
    const inputs = {
        usuario: document.getElementById('usuario'),
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cedula: document.getElementById('cedula'),
        telefono: document.getElementById('telefono'),
        correo: document.getElementById('email'),
    };

    const regex = {
        soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
        soloNumeros: /^\d+$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    };

    const LIMITES = {
        usuario: { min: 2, max: 25 },
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        cedula: { min: 7, max: 8 },
        telefono: { min: 10, max: 11 },
        correo: { min: 5, max: 25 }
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
            return { valido: false, mensaje: mensaje || `El campo ${input.id} no puede estar vacíossssssssssss` };
        }

        if (regex && !regex.test(valor)) {
            return { valido: false, mensaje: mensaje || `Formato inválido para ${input.id}ss` };
        }

        if (valor.length < minLength) {
            return { valido: false, mensaje: mensaje || `${input.id} debe tener al menos ${minLength} caracteressssss` };
        }

        if (valor.length > maxLength) {
            return { valido: false, mensaje: mensaje || `${input.id} no puede exceder los ${maxLength} caracteresssss` };
        }

        return { valido: true };
    };

    form.addEventListener("submit", (e) => {


    // Limpiar errores previos
    Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));
    
    // Validaciones
    const validaciones = [
        { input: inputs.usuario, resultado: validarCampo(inputs.usuario, regex.soloLetras, LIMITES.usuario.min, LIMITES.usuario.max, "El usuario debe contener solo letras y tener entre 2 y 25 caracteres.") },
        { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, "El nombre debe contener solo letras y tener entre 2 y 25 caracteres.") },
        { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, "El apellido debe contener solo letras y tener entre 2 y 25 caracteres.") },
        { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, "La cédula debe contener solo números y tener entre 7 y 8 dígitos.") },
        { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, "El teléfono debe contener solo números y tener entre 10 y 11 dígitos.") },
        { input: inputs.correo, resultado: validarCampo(inputs.correo, regex.email, LIMITES.correo.min, LIMITES.correo.max, "El correo debe ser válido y tener entre 5 y 25 caracteres.") }
    ];

    // Verificar si hay errores
    const errores = validaciones.filter(v => !v.resultado.valido);
    
    if (errores.length > 0) {
        e.preventDefault(); // Detener el envío si hay errores
        errores[0].input.classList.add('border-red-500');
        mostrarNotificacion(errores[0].resultado.mensaje);
    }else{
        form.submit();
    }
    // Si no hay errores, el formulario se enviará automáticamente
});
</script>




<?php
if (isset($_POST['submit'])) {
    // Recibir datos del formulario
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $estado = trim($_POST['estado']);

    // Configuración de límites y expresiones regulares
    $LIMITES = [
        'usuario' => ['min' => 2, 'max' => 25],
        'nombre' => ['min' => 2, 'max' => 25],
        'apellido' => ['min' => 2, 'max' => 25],
        'cedula' => ['min' => 7, 'max' => 8],
        'telefono' => ['min' => 10, 'max' => 11],
        'correo' => ['min' => 5, 'max' => 50],
    ];

    $regex = [
        'soloLetras' => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
        'soloNumeros' => '/^\d+$/',
        'email' => '/^[^\s@]+@[^\s@]+\.[^\s@]+$/'
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
    $errores[] = validarCampo($usuario, $regex['soloLetras'], $LIMITES['usuario'], 'Usuario');
    $errores[] = validarCampo($nombre, $regex['soloLetras'], $LIMITES['nombre'], 'Nombre');
    $errores[] = validarCampo($apellido, $regex['soloLetras'], $LIMITES['apellido'], 'Apellido');
    $errores[] = validarCampo($cedula, $regex['soloNumeros'], $LIMITES['cedula'], 'Cédula');
    $errores[] = validarCampo($telefono, $regex['soloNumeros'], $LIMITES['telefono'], 'Teléfono');
    $errores[] = validarCampo($correo, $regex['email'], $LIMITES['correo'], 'Correo Electrónico');

    // Filtrar errores vacíos
    $errores = array_filter($errores);

    // Verificar usuario existente 
    $sql_verificar_usuario = "SELECT id FROM usuario WHERE nombre_usuario = ? AND id != ?";
    $stmt_usuario = $connect->prepare($sql_verificar_usuario);
    $stmt_usuario->bind_param("si", $usuario, $id);
    $stmt_usuario->execute();
    if ($stmt_usuario->get_result()->num_rows > 0) {
        $errores[] = "Este usuario ya se encuentra registrado.";
    }
    $stmt_usuario->close();

    // Verificar cédula existente 
    $sql_verificar_cedula = "SELECT id FROM usuario WHERE cedula = ? AND id != ?";
    $stmt_cedula = $connect->prepare($sql_verificar_cedula);
    $stmt_cedula->bind_param("si", $cedula, $id);
    $stmt_cedula->execute();
    if ($stmt_cedula->get_result()->num_rows > 0) {
        $errores[] = "La cédula ya se encuentra registrada.";
    }
    $stmt_cedula->close();

    // Verificar teléfono existente 
    $sql_verificar_telefono = "SELECT id FROM usuario WHERE telefono = ? AND id != ?";
    $stmt_telefono = $connect->prepare($sql_verificar_telefono);
    $stmt_telefono->bind_param("si", $telefono, $id);
    $stmt_telefono->execute();
    if ($stmt_telefono->get_result()->num_rows > 0) {
        $errores[] = "El teléfono ya se encuentra registrado.";
    }
    $stmt_telefono->close();

    // Verificar correo existente 
    $sql_verificar_correo = "SELECT id FROM usuario WHERE correo = ? AND id != ?";
    $stmt_correo = $connect->prepare($sql_verificar_correo);
    $stmt_correo->bind_param("si", $correo, $id);
    $stmt_correo->execute();
    if ($stmt_correo->get_result()->num_rows > 0) {
        $errores[] = "Este correo ya se encuentra registrado.";
    }
    $stmt_correo->close();

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

    // Preparar bitácora de cambios
    $cambios = [];
    if ($usuario_anterior != $usuario) {
        $cambios[] = "Usuario anterior = $usuario_anterior, Usuario actualizado = $usuario";
    }
    if ($nombre_anterior != $nombre) {
        $cambios[] = "Nombre anterior = $nombre_anterior, Nombre actualizado = $nombre";
    }
    if ($apellido_anterior != $apellido) {
        $cambios[] = "Apellido anterior = $apellido_anterior, Apellido actualizado = $apellido";
    }
    if ($cedula_anterior != $cedula) {
        $cambios[] = "Cédula anterior = $cedula_anterior, Cédula actualizada = $cedula";
    }
    if ($telefono_anterior != $telefono) {
        $cambios[] = "Teléfono anterior = $telefono_anterior, Teléfono actualizado = $telefono";
    }
    if ($correo_anterior != $correo) {
        $cambios[] = "Correo anterior = $correo_anterior, Correo actualizado = $correo";
    }
    if ($estado_anterior != $estado) {
        $cambios[] = "Estado anterior = $estado_anterior, Estado actualizado = $estado";
    }

    $datos_accion = $cambios ? "Cambios: " . implode(", ", $cambios) : "Sin cambios relevantes";

    // Insertar en bitácora
    $sql_bitacora = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
    $stmt_bitacora = $connect->prepare($sql_bitacora);
    $accion = "Se actualizó un usuario.";
    $stmt_bitacora->bind_param("sss", $accion, $datos_accion, $usuarioSeccion);
    $stmt_bitacora->execute();
    $stmt_bitacora->close();

    // Actualizar usuario
    if ($estado == "Activo") {
        $sql_update = "UPDATE usuario SET 
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
        $stmt = $connect->prepare($sql_update);
        $stmt->bind_param(
            "ssssssssi",
            $nombre,
            $apellido,
            $cedula,
            $telefono,
            $correo,
            $usuario,
            $contraseña,
            $estado,
            $id
        );
    } else {
        $sql_update = "UPDATE usuario SET 
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
        $stmt = $connect->prepare($sql_update);
        $stmt->bind_param(
            "sssssssisi",
            $nombre,
            $apellido,
            $cedula,
            $telefono,
            $correo,
            $usuario,
            $contraseña,
            $intentos_fallidos,
            $estado,
            $id
        );
    }

    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>window.location='usuarios.php'</script>";
        exit;
    } else {
        die(mysqli_error($connect));
    }
}
?>
