<?php
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
if (empty($_SESSION['nombre_usuario'])) {
    header('Location: ../../login/login.php');
    exit();
}

$usuario = $_SESSION['nombre_usuario'];

// Incluir archivos necesarios
require_once '../../connect.php';
require_once '../contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores</title>
<link rel="stylesheet" href="../../src/css/styles.css"></head>

<body class="ml-64">

    

        <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
            <div role="status">
                <svg class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        <main class="flex justify-center items-center xl:px-56 mt-8">
            <?php if (!empty($error)) : ?>
                <p class="text-danger"><?php echo $error[0]; ?></p>
            <?php endif; ?>
            <form method="POST" class="w-96 rounded-xl p-6 py-8 shadow-lg bg-white" id="formulario">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nombre del trabajador" name="nombre" id="nombre" autocomplete="off" maxlength="25" >
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Apellidos del trabajador" name="apellido" id="apellido" autocomplete="off" maxlength="25" >
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Cédula</label>
                    <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ingrese la cédula" name="cedula" autocomplete="off" id="cedula" maxlength="25" >
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <div class="flex">
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Teléfono" name="telefono" autocomplete="off" maxlength="11" id="telefono" >
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Rol</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Rol" name="rol" autocomplete="off" maxlength="25" id="rol" >
                </div>
                    <!-- Botones -->
    <div class="flex flex-col sm:flex-row gap-3 mt-4">
        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
            Agregar
        </button>
        <button type="button" onclick="regresarPaginaAnterior()" 
                class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
            Regresar
        </button>
    </div>

                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sistema</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">¿Está seguro que quiere registrar este trabajador?</p>
                            </div>
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="default-modal" type="submit" name="registrar" id="btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sí</button>
                                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script>
        function regresarPaginaAnterior() {
            window.history.back();

        }

        document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('formulario');
    const btn = document.getElementById('btn');
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cedula: document.getElementById('cedula'),
        telefono: document.getElementById('telefono'),
        rol: document.getElementById('rol')
    };

    const regex = {
        soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
        soloNumeros: /^\d+$/
    };

    const LIMITES = {
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        cedula: { min: 7, max: 8 },
        telefono: { min: 10, max: 11 },
        rol: { min: 2, max: 25 }
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
        { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, "Nombre inválido") },
        { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, "Apellido inválido") },
        { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, "Cédula inválida") },
        { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, "Teléfono inválido") },
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
        });
</script>
<script src="../../src/js/script.js"></script>
<script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    // Sanitización de entrada
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $telefono = trim($_POST['telefono']);
    $codigo = trim($_POST['codigo']);
    $codigo_completo = $codigo . $telefono;
    $rol = trim($_POST['rol']);
    $errores = [];

    // Configuración de límites y expresiones regulares
    $LIMITES = [
        'nombre' => ['min' => 2, 'max' => 25],
        'apellido' => ['min' => 2, 'max' => 25],
        'cedula' => ['min' => 7, 'max' => 8],
        'telefono' => ['min' => 10, 'max' => 11],
        'rol' => ['min' => 2, 'max' => 25]
    ];

    $regex = [
        'soloLetras' => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
        'soloNumeros' => '/^\d+$/'
    ];

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
    $errores[] = validarCampo($rol, $regex['soloLetras'], $LIMITES['rol'], 'Rol');

    // Filtrar errores vacíos
    $errores = array_filter($errores);

    // Verificar duplicados
    if (empty($errores)) {
        $sql_verificar = "SELECT * FROM trabajadores WHERE cedula = ? OR telefono = ?";
        $stmt = $connect->prepare($sql_verificar);
        $stmt->bind_param("ss", $cedula, $codigo_completo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($row = $resultado->fetch_assoc()) {
            if ($row['cedula'] === $cedula) {
                $errores[] = "Ya existe un trabajador con esta cédula.";
            }
            if ($row['telefono'] === $codigo_completo) {
                $errores[] = "Este teléfono ya está registrado con otro trabajador.";
            }
        }
    }

    // Mostrar errores si existen
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `<div class='text-sm'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</div>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
            </script>";
        }
        exit();
    }

    // Registro en la bitácora
    $sql_bitacora = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
    $datos_accion = "Información: nombre = $nombre, apellido = $apellido, cédula = $cedula, teléfono = $codigo_completo, rol = $rol";
    $accion = "Se agregó a un trabajador.";
    $stmt_bitacora = $connect->prepare($sql_bitacora);
    $stmt_bitacora->bind_param("sss", $accion, $datos_accion, $usuario);
    $stmt_bitacora->execute();

    // Inserción en la tabla trabajadores
    $sql_insert = "INSERT INTO trabajadores (nombre, apellido, cedula, telefono, rol) VALUES (?, ?, ?, ?, ?)";
    if (!$connect) {
        die("<script>console.error('Database connection failed: " . htmlspecialchars(mysqli_connect_error(), ENT_QUOTES, 'UTF-8') . "');</script>");
    }
    $stmt_insert = $connect->prepare($sql_insert);
    if (!$stmt_insert) {
        die("<script>console.error('Statement preparation failed: " . htmlspecialchars($connect->error, ENT_QUOTES, 'UTF-8') . "');</script>");
    }
    $stmt_insert->bind_param("sssss", $nombre, $apellido, $cedula, $codigo_completo, $rol);
    $resultInsert = $stmt_insert->execute();
    if (!$resultInsert) {
        echo "<script>console.error('SQL execution failed: " . htmlspecialchars($stmt_insert->error, ENT_QUOTES, 'UTF-8') . "');</script>";
        echo "<script>console.error('Query: " . htmlspecialchars($sql_insert, ENT_QUOTES, 'UTF-8') . "');</script>";
        echo "<script>console.error('Parameters: nombre=$nombre, apellido=$apellido, cedula=$cedula, telefono=$codigo_completo, rol=$rol');</script>";
        exit();
    }

    if ($resultInsert) {
        echo "<script>
            const notificacion = document.createElement('div');
            notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-green-100 text-green-700 border flex items-center';
            notificacion.innerHTML = `<div class='text-sm'>Trabajador registrado correctamente.</div>`;
            document.body.appendChild(notificacion);
            setTimeout(() => notificacion.remove(), 4000);
            window.location='trabajadores.php';
        </script>";
    } else {
        echo "<script>
            const notificacion = document.createElement('div');
            notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
            notificacion.innerHTML = `<div class='text-sm'>Error al registrar el trabajador: " . htmlspecialchars($connect->error, ENT_QUOTES, 'UTF-8') . "</div>`;
            document.body.appendChild(notificacion);
            setTimeout(() => notificacion.remove(), 4000);
        </script>";
    }
}
?>