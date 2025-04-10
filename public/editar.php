<?php
session_start();
$usuario = $_SESSION['nombre_usuario'];

if (!isset($usuario)) {
    header("location: login.php");
    die();
} else {
    include('connect.php');
    include 'contador_sesion.php';
}



$id = isset($_GET['editarid']) ? intval($_GET['editarid']) : 0;
if ($id === 0) {
    echo "<script>alert('ID inválido.'); window.location.href = 'index.php';</script>";
    exit();
}
// Consulta para obtener los datos del estudiante
$sql = "SELECT estudiantes.*, 
        representante.nombre AS representante_nombre, 
        representante.apellido AS representante_apellido,
        representante.cedula AS representante_cedula, 
        representante.telefono AS representante_telefono,
        representante.correo AS representante_correo,
        representante.id AS representante_id
        FROM estudiantes 
        JOIN representante ON estudiantes.idrepresentante = representante.id
        WHERE estudiantes.id = ?";

$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $cen = $row['cen'];
    $nacimiento = $row['nacimiento'];
    $sexo = $row['sexo'];
    $representante = $row['representante_nombre'];
    $representante_apellido = $row['representante_apellido'];
    $cedula = $row['representante_cedula'];
    $telefono = $row['representante_telefono'];
    $correo = $row['representante_correo'];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>Editar Estudiante</title>
</head>

<body class="bg-ghost">
<div class="container-lg w-full flex flex-col">

<div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700">
  <div role="status">
    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
if ($usuario == "admin" || $usuario == "Admin") {
  include('./header_admin.php');
} else {
  include('./header.php');
}

?>
        <main class="w-full flex justify-center items-center xl:px-56 mt-8">
           <!-- filepath: d:\Programas\Xammp\htdocs\dashboard\proyecto\public\editar.php -->
<form method="post" id="formulario" class="w-full max-w-screen-sm rounded-md border border-gray-300 p-6 shadow-sm bg-white" novalidate>
    <div class="grid grid-cols-1 gap-4">
        
        <!-- Nombres -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombres</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Nombres del Alumno" name="nombre" id="nombre" autocomplete="off" maxlength="30" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </div>

        <!-- Apellidos -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Apellidos</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Apellidos del Alumno" name="apellido" id="apellido" autocomplete="off" maxlength="30" value="<?php echo htmlspecialchars($apellido); ?>" required>
        </div>

        <!-- C.E.N -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">C.E.N</label>
            <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="C.E.N" name="cen" id="cen" autocomplete="off" maxlength="25" value="<?php echo htmlspecialchars($cen); ?>" required>
        </div>

        <!-- Nacimiento -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nacimiento</label>
            <input type="date" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                   name="nacimiento" id="nacimiento" autocomplete="off" value="<?php echo htmlspecialchars($nacimiento); ?>" required>
        </div>

        <!-- Sexo -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sexo</label>
            <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="sexo" required>
                <option value="Masculino" <?php echo $sexo == "Masculino" ? "selected" : ""; ?>>Masculino</option>
                <option value="Femenino" <?php echo $sexo == "Femenino" ? "selected" : ""; ?>>Femenino</option>
            </select>
        </div>

        <!-- Representante -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Representante</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Nombre del Representante" name="representante" id="representante-nombre" maxlength="30" autocomplete="off" value="<?php echo htmlspecialchars($representante); ?>" required>
        </div>

        <!-- Apellido del Representante -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido del Representante</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Apellido del Representante" name="representante_apellido" id="representante-apellido" maxlength="30" autocomplete="off" value="<?php echo htmlspecialchars($representante_apellido); ?>" required>
        </div>

        <!-- C.I Representante -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">C.I Representante</label>
            <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Cédula del Representante" name="cedularepre" id="cedula" maxlength="12" autocomplete="off" value="<?php echo htmlspecialchars($cedula); ?>" required>
        </div>

        <!-- Teléfono -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
            <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Teléfono" name="telefono" id="telefono" maxlength="7" autocomplete="off" value="<?php echo htmlspecialchars($telefono); ?>" required>
        </div>

        <!-- Correo Electrónico -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
            <input type="email" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                   placeholder="Correo" name="correo" id="email" maxlength="50" autocomplete="off" value="<?php echo htmlspecialchars($correo); ?>" required>
        </div>

        <!-- Grado -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
            <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="grado" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>

        <!-- Sección -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sección</label>
            <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="seccion" required>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>
    </div>

    <!-- Botones -->
    <div class="flex flex-col sm:flex-row gap-3 mt-4">
        <button type="button"  data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
            Guardar Cambios
        </button>
        <button type="button" onclick="regresarPaginaAnterior()" 
                class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
            Regresar
        </button>
    </div>

    <!-- Modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
      <div class="relative p-4 max-h-full">
        <div class="relative bg-white rounded-md shadow-md border border-gray-300">
          <div class="flex items-center justify-between p-4 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-700">Confirmación</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="default-modal">
              <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
          </div>
          <div class="p-4 space-y-4">
            <p class="text-sm text-gray-600">¿Está seguro que quiere registrar este profesor?</p>
          </div>
          <div class="flex items-center p-4 border-t border-gray-300">
            <button data-modal-hide="default-modal" type="submit" name="submit" id="btn" 
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
              Confirmar
            </button>
            <button data-modal-hide="default-modal" type="button" 
                    class="px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
              Cancelar
            </button>
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
    </script>
    <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('formulario');
            const btn = document.getElementById('btn')
            const inputs = {
                nombre: document.getElementById('nombre'),
                apellido: document.getElementById('apellido'),
                cen: document.getElementById('cen'),
                nacimiento: document.getElementById('nacimiento'),
                sexo: document.querySelector('select[name="sexo"]'),
                representante: document.getElementById('representante-nombre'),
                representante_apellido: document.getElementById('representante-apellido'),
                cedula: document.getElementById('cedula'),
                telefono: document.getElementById('telefono'),
                correo: document.getElementById('email'),
                grado: document.querySelector('select[name="grado"]'),
                seccion: document.querySelector('select[name="seccion"]')
            };

            const regex = {
                soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
                soloNumeros: /^\d+$/,
                email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            };

            const LIMITES = {
                nombre: { min: 2, max: 30 },
                apellido: { min: 2, max: 30 },
                cen: { min: 1, max: 25 },
                telefono: { min: 7, max: 15 },
                cedula: { min: 7, max: 8 },
                correo: { max: 50 }
            };

            const mostrarNotificacion = (mensaje, tipo = 'error') => {
                const color = tipo === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';
                const notificacion = document.createElement('div');
                notificacion.className = `fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center`;
                notificacion.innerHTML = `<div class="text-sm">${mensaje}</div>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
            };

            const validarCampo = (input, regex = null, minLength = 0, maxLength = Infinity, mensaje = null) => {
                const valor = input.value.trim();
                if (!valor) return { valido: false, mensaje: mensaje || `El campo ${input.name} no puede estar vacío.` };
                if (regex && !regex.test(valor)) return { valido: false, mensaje: mensaje || `Formato inválido para ${input.name}.` };
                if (valor.length < minLength) return { valido: false, mensaje: mensaje || `${input.name} debe tener al menos ${minLength} caracteres.` };
                if (valor.length > maxLength) return { valido: false, mensaje: mensaje || `${input.name} no puede exceder los ${maxLength} caracteres.` };
                return { valido: true };
            };

            btn.addEventListener("click", (e) => {
                const validaciones = [
                    { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max) },
                    { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max) },
                    { input: inputs.cen, resultado: validarCampo(inputs.cen, regex.soloNumeros, LIMITES.cen.min, LIMITES.cen.max) },
                    { input: inputs.nacimiento, resultado: validarCampo(inputs.nacimiento, null, 1, Infinity, 'Debe ingresar una fecha válida.') },
                    { input: inputs.representante, resultado: validarCampo(inputs.representante, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max) },
                    { input: inputs.representante_apellido, resultado: validarCampo(inputs.representante_apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max) },
                    { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max) },
                    { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max) },
                    { input: inputs.correo, resultado: validarCampo(inputs.correo, regex.email, 1, LIMITES.correo.max) }
                ];

                for (const validacion of validaciones) {
                    if (!validacion.resultado.valido) {
                        e.preventDefault();
                        mostrarNotificacion(validacion.resultado.mensaje);
                        validacion.input.classList.add('border-red-500');
                        return;
                    } else {
                        validacion.input.classList.remove('border-red-500');
                    }
                }
            });
        });
    </script>
</body>
</html>


<?php

if (isset($_POST['submit'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cen = trim($_POST['cen']);
    $nacimiento = trim($_POST['nacimiento']);
    $sexo = trim($_POST['sexo']);

    $errores = [];

    // Validaciones
    if (empty($nombre) || strlen($nombre) < 2 || strlen($nombre) > 30) {
        $errores[] = "El nombre debe tener entre 2 y 30 caracteres.";
    }

    if (empty($apellido) || strlen($apellido) < 2 || strlen($apellido) > 30) {
        $errores[] = "El apellido debe tener entre 2 y 30 caracteres.";
    }

    if (empty($cen) || !is_numeric($cen)) {
        $errores[] = "El C.E.N debe ser un número válido.";
    }

    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `
                  <div class='flex-shrink-0 mr-3 text-red-700'>
                    <svg fill='#f00505' width='24px' height='24px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
                      <path d='M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z'></path>
                    </svg>
                  </div>
                  <div class='text-sm'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</div>
                `;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
                </script>";
        }
        exit();
    }

    // Actualizar en la base de datos
    $sql = "UPDATE estudiantes SET nombre = ?, apellido = ?, cen = ?, nacimiento = ?, sexo = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $cen, $nacimiento, $sexo, $id);
    if ($stmt->execute()) {
        echo "<script>
            const notificacion = document.createElement('div');
            notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-green-100 text-green-700 border flex items-center';
            notificacion.innerHTML = `
              <div class='flex-shrink-0 mr-3 text-green-700'>
                <svg fill='#4BB543' width='24px' height='24px' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                  <path d='M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z'/>
                </svg>
              </div>
              <div class='text-sm'>Estudiante actualizado correctamente.</div>
            `;
            document.body.appendChild(notificacion);

            window.history.go(-2);
            </script>";
    } else {
        echo "<script>
            const notificacion = document.createElement('div');
            notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
            notificacion.innerHTML = `<span>Error al actualizar el estudiante.</span>`;
            document.body.appendChild(notificacion);
            setTimeout(() => notificacion.remove(), 4000);
            </script>";
    }
}

?>