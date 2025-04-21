<?php
session_start();

$usuario = $_SESSION['nombre_usuario'];

if (!isset($usuario)) {
    header('location: login/login.php');
} else {
    include('connect.php');
    include 'contador_sesion.php';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>estudiantes</title>
</head>

<body class="bg-gray-100">
  <div class="container-lg w-full flex flex-col px-8 py-4">

    <!-- Loading Spinner -->
    <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 bg-opacity-75">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
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

    <main class="flex justify-center items-center xl:px-56 mt-8">
      <?php if (!empty($error)): ?>
        <p class="text-red-500 mb-4"><?php echo $error[0]; ?></p>
      <?php endif; ?>

    <form method="post" class="w-full max-w-screen-sm rounded-md border border-gray-300 p-6 shadow-sm bg-white" id="formulario" novalidate>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        
        <!-- Nombres -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nombres</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Nombres del Alumno" name="nombre" id="nombre" autocomplete="off" maxlength="20" >
        </div>

        <!-- Apellidos -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Apellidos</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Apellidos del Alumno" name="apellido" id="apellido" autocomplete="off" maxlength="20" >
        </div>

        <!-- C.E.N -->
        <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">C.E.N</label>
        <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="C.E.N" name="cen" autocomplete="off" id="cen" maxlength="25" >
        </div>

        <!-- Nacimiento -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nacimiento</label>
        <input type="date" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
             name="nacimiento" id="nacimiento" autocomplete="off" >
        </div>

        <!-- Sexo -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Sexo</label>
        <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="sexo" >
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
        </div>

        <!-- Representante -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Representante</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Nombre del Representante" name="representante" id="representante-nombre" maxlength="25" autocomplete="off" >
        </div>

        <!-- Apellido del representante -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido del representante</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Apellido del Representante" name="representante_apellido" id="representante-apellido" maxlength="25" autocomplete="off" >
        </div>

        <!-- C.I Representante -->
        <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">C.I Representante</label>
        <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Cédula del Representante" name="cedularepre" id="cedula" maxlength="12" autocomplete="off" >
        </div>

        <!-- Teléfono -->
        <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
        <div class="flex items-center gap-3">
          <select class="px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="codigo" id="codigo" >
            <option value="0268">0268</option>
            <option value="0414">0414</option>
            <option value="0424">0424</option>
            <option value="0416">0416</option>
            <option value="0426">0426</option>
            <option value="0412">0412</option>
          </select>
          <input type="text" class="flex-1 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
               placeholder="Teléfono" name="telefono" autocomplete="off" maxlength="7" id="telefono" >
        </div>
        </div>

        <!-- Correo Electrónico -->
        <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
        <input type="email" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
             placeholder="Correo" name="correo" id="email" maxlength="50" autocomplete="off" >
        </div>

        <!-- Grado y Sección -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
        <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="grado" >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
        </select>
        </div>

        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Sección</label>
        <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="seccion" >
          <option value="A">A</option>
          <option value="B">B</option>
        </select>
        </div>
      </div>

      <!-- Botones -->
      <div class="mt-6 flex flex-col sm:flex-row gap-3">
        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" 
            class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
        Finalizar
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
            <p class="text-sm text-gray-600">¿Está seguro que quiere registrar este alumno?</p>
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

    <script>
      function regresarPaginaAnterior() {
        window.history.back();
      }
    </script>
    <script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
  </div>
</body>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('formulario');
    const btn = document.getElementById('btn');
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cen: document.getElementById('cen'),
        nacimiento: document.getElementById('nacimiento'),
        sexo: document.querySelector('select[name="sexo"]'),
        representante: document.getElementById('representante-nombre'),
        representanteApellido: document.getElementById('representante-apellido'),
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
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        cen: { min: 1, max: 25 },
        representante: { min: 2, max: 25 },
        representanteApellido: { min: 2, max: 25 },
        cedula: { min: 6, max: 12 },
        telefono: { min: 7, max: 7 },
        correo: { min: 5, max: 50 }
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

  

    btn.addEventListener("click", (e) => {
        Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));

        const validaciones = [
            { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, "Nombre inválido") },
            { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, "Apellido inválido") },
            { input: inputs.cen, resultado: validarCampo(inputs.cen, regex.soloNumeros, LIMITES.cen.min, LIMITES.cen.max, "C.E.N inválido") },
            { input: inputs.nacimiento, resultado: validarFechaNacimiento(inputs.nacimiento) },
            { input: inputs.representante, resultado: validarCampo(inputs.representante, regex.soloLetras, LIMITES.representante.min, LIMITES.representante.max, "Nombre del representante inválido") },
            { input: inputs.representanteApellido, resultado: validarCampo(inputs.representanteApellido, regex.soloLetras, LIMITES.representanteApellido.min, LIMITES.representanteApellido.max, "Apellido del representante inválido") },
            { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, "Cédula inválida") },
            { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, "Teléfono inválido") },
            { input: inputs.correo, resultado: validarCampo(inputs.correo, regex.email, LIMITES.correo.min, LIMITES.correo.max, "Correo electrónico inválido") }
        ];

        for (const validacion of validaciones) {
            if (!validacion.resultado.valido) {
                e.preventDefault();
                validacion.input.classList.add('border-red-500');
                mostrarNotificacion(validacion.resultado.mensaje);
                return;
            }
        }

        form.submit();
    });
});
</script>
</html>

<?php

if (isset($_POST['submit'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cen = trim($_POST['cen']);
    $nacimiento = trim($_POST['nacimiento']);
    $sexo = strtoupper(trim($_POST['sexo']));
    $representante = trim($_POST['representante']);
    $representante_apellido = trim($_POST['representante_apellido']);
    $cedularepre = trim($_POST['cedularepre']);
    $telefono = trim($_POST['telefono']);
    $codigo = trim($_POST['codigo']);
    $codigo = $codigo.$telefono; 
    $correo = trim($_POST['correo']);
    $grado = trim($_POST['grado']);
    $seccion = strtoupper(trim($_POST['seccion']));
    $usuario = $_SESSION['nombre_usuario'] ?? 'usuario_default'; // Usuario por defecto para bitácora

    // Configuración de límites y expresiones regulares
    $LIMITES = [
        'nombre' => ['min' => 2, 'max' => 25],
        'apellido' => ['min' => 2, 'max' => 25],
        'cen' => ['min' => 1, 'max' => 25],
        'representante' => ['min' => 2, 'max' => 25],
        'representante_apellido' => ['min' => 2, 'max' => 25],
        'cedularepre' => ['min' => 6, 'max' => 12],
        'telefono' => ['min' => 7, 'max' => 8],
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
    $errores[] = validarCampo($nombre, $regex['soloLetras'], $LIMITES['nombre'], 'Nombre');
    $errores[] = validarCampo($apellido, $regex['soloLetras'], $LIMITES['apellido'], 'Apellido');
    $errores[] = validarCampo($cen, $regex['soloNumeros'], $LIMITES['cen'], 'C.E.N');
    $errores[] = validarCampo($representante, $regex['soloLetras'], $LIMITES['representante'], 'Nombre del Representante');
    $errores[] = validarCampo($representante_apellido, $regex['soloLetras'], $LIMITES['representante_apellido'], 'Apellido del Representante');
    $errores[] = validarCampo($cedularepre, $regex['soloNumeros'], $LIMITES['cedularepre'], 'Cédula del Representante');
    $errores[] = validarCampo($telefono, $regex['soloNumeros'], $LIMITES['telefono'], 'Teléfono');
    $errores[] = validarCampo($correo, $regex['email'], $LIMITES['correo'], 'Correo Electrónico');

  

    // Validar grado y sección
    if (!in_array($grado, ['1', '2', '3', '4', '5', '6'])) {
        $errores[] = "El grado seleccionado no es válido.";
    }
    if (!in_array($seccion, ['A', 'B'])) {
        $errores[] = "La sección debe ser 'A' o 'B'.";
    }

    // Validaciones específicas de estudiante.php
    if ($cen === $cedularepre) {
        $errores[] = "La cédula del estudiante no puede ser igual a la del representante.";
    }

    // Verificar si el C.E.N ya está registrado
    $sql_verificar_estudiante = "SELECT * FROM estudiantes WHERE cen = ?";
    $stmt = $connect->prepare($sql_verificar_estudiante);
    $stmt->bind_param("s", $cen);
    $stmt->execute();
    $resultado_estudiante = $stmt->get_result();
    if ($resultado_estudiante->num_rows > 0) {
        $errores[] = "Ya existe un estudiante registrado con este C.E.N.";
    }

    // Verificar si el representante ya existe
    $sql_verificar_representante = "SELECT id FROM representante WHERE cedula = ?";
    $stmt = $connect->prepare($sql_verificar_representante);
    $stmt->bind_param("s", $cedularepre);
    $stmt->execute();
    $resultado_representante = $stmt->get_result();
    if ($resultado_representante->num_rows > 0) {
        $rowRepre = $resultado_representante->fetch_assoc();
        $idRepre = $rowRepre['id'];
    } else {
        // Validar si el teléfono o correo ya están registrados
        $sql_verificar_telefono = "SELECT * FROM representante WHERE telefono = ?";
        $stmt = $connect->prepare($sql_verificar_telefono);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errores[] = "El teléfono ya está registrado con otro representante.";
        }

        $sql_verificar_correo = "SELECT * FROM representante WHERE correo = ?";
        $stmt = $connect->prepare($sql_verificar_correo);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errores[] = "El correo ya está registrado con otro representante.";
        }
    }

    // Filtrar errores vacíos
    $errores = array_filter($errores);

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

    // Continuar con la lógica de inserción en la base de datos...
     // El representante no existe, insertarlo y obtener su nuevo ID
     $queryInsertRepre = "INSERT INTO representante (nombre, apellido, cedula, telefono, correo) VALUES (?, ?, ?, ?, ?)";
     $stmt = $connect->prepare($queryInsertRepre);
     $stmt->bind_param("sssss", $representante, $representante_apellido, $cedularepre, $codigo, $correo);
     $resultInsertRepre = $stmt->execute();
     
     if (!$resultInsertRepre) {
         die("Error al insertar el nuevo representante: " . mysqli_error($connect));
     }

     $idRepre = mysqli_insert_id($connect);
 
 if (!is_numeric($telefono)) {
     $errores[] = "El teléfono debe ser ingresado con numeros";

 } elseif (strlen($codigo) > 12) {
     $errores[] = "El número de teléfono es muy largo";
 } elseif (strlen($codigo) < 11) {
     $errores[] = "El número de teléfono es muy corta";
 }

 if (!is_numeric($cedularepre)) {
     $errores[] = "La cédula del representante debe ser ingresado con numeros";

 } elseif (strlen($codigo) > 12) {
     $errores[] = "El número de teléfono es muy largo";
 } elseif (strlen($codigo) < 11) {
     $errores[] = "El número de teléfono es muy corta";
 }


 // Obtener el ID del grado
 $queryGrado = "SELECT id FROM grados WHERE nombre = ?";
 $stmt = $connect->prepare($queryGrado);
 $stmt->bind_param("s", $grado);
 $stmt->execute();
 $resultGrado = $stmt->get_result();
 if (!$resultGrado) {
     die("Error al obtener el ID del grado: " . mysqli_error($connect));
 }

 $rowGrado = $resultGrado->fetch_assoc();
 $idgrado = $rowGrado['id'];
 

 // Obtener el ID de la sección
 $querySeccion = "SELECT id FROM seccion WHERE nombre = ?";
 $stmt = $connect->prepare($querySeccion);
 $stmt->bind_param("s", $seccion);
 $stmt->execute();
 $resultSeccion = $stmt->get_result();

 if (!$resultSeccion) {
     die("Error al obtener el ID de la sección: " . $stmt->error);
 }

 $rowSeccion = $resultSeccion->fetch_assoc();
 $idseccion = $rowSeccion['id'];


 // Inserción en la tabla de estudiantes
 $sql = "INSERT INTO estudiantes (nombre, apellido, cen, nacimiento, sexo, idgrado, idseccion, idrepresentante) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt = $connect->prepare($sql);
 $stmt->bind_param("sssssiii", $nombre, $apellido, $cen, $nacimiento, $sexo, $idgrado, $idseccion, $idRepre);
 $resultInsert = $stmt->execute();
 
  
 //ingresar insert en bitacora
 $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
 $stmt2 = $connect->prepare($sql2);
 $accion = "Se Insertó un nuevo estudiante.";
 $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cen = $cen, nacimiento = $nacimiento, sexo = $sexo, grado = $grado, seccion = $seccion, representante = $representante, Apellido del representante = $representante_apellido, cedula representante = $cedularepre, telefono = $codigo, correo = $correo";
 $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
 $resultInsert2 = $stmt2->execute();
 
 //aqui termina


 if ($resultInsert) {
     $volver = $grado; // Assign the appropriate value for $volver
     $volver2 = $seccion; // Assign the appropriate value for $volver2
     echo "<script> window.location='ver_grado.php?gradonombre=$volver&seccion=$volver2'</script>";
 } else {
     die(mysqli_error($connect));
 }

}

?>
