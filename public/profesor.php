<?php
  session_start();

  $usuario = $_SESSION['nombre_usuario'];

  if (!isset($usuario)) {
    header('location: login/login.php');
  } else{
    include('connect.php');
    include 'contador_sesion.php';
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/css/styles.css">
  <title>Profesor</title>

</head>

<body class="bg-ghost ml-64">
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
  <form method="post" id="formulario" class="w-full max-w-screen-sm rounded-md border border-gray-300 p-6 shadow-sm bg-white">
    <div class="grid grid-cols-1 gap-4">

      <!-- Nombre -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
               placeholder="Nombre del Profesor" maxlength="30" name="nombre" id="nombre" autocomplete="off">
      </div>

      <!-- Apellido -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
               placeholder="Apellido del Profesor" maxlength="30" name="apellido" id="apellido" autocomplete="off">
      </div>

      <!-- Cédula -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
               placeholder="Cédula" name="cedula" autocomplete="off" maxlength="30" id="cedula">
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
      
      <!-- Grado y Sección en fila para pantallas medianas/grandes -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
          <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="grado" required>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
          </select>
        </div>

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
        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" 
                class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
          Finalizar
        </button>
        <button type="button" onclick="regresarPaginaAnterior()" 
                class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
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
    const btn = document.getElementById('btn');
		const inputs = {
			nombre: document.getElementById('nombre'),
			apellido: document.getElementById('apellido'),
			cedula: document.getElementById('cedula')
		};

		const regex = {
			soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
			soloNumeros: /^\d+$/
		};

    const LIMITES = {
      nombre: { min: 1, max: 25 },
      apellido: { min: 1, max: 25 },
      cedula: { min: 7, max: 8 },
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
        { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, `El nombre debe ser válido.`) },
        { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, `El apellido debe ser válido.`) },
        { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, `Ingresa una Cedula valida.`) },
        { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, 1, LIMITES.nombre.max, `El nombre debe ser válido.`) },
				{ input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, 1, LIMITES.apellido.max, `El apellido debe ser válido y tener un máximo de ${LIMITES.apellido} caracteres.`) },
				{ input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula, LIMITES.cedula.max, `La cédula debe tener un máximo de 8 dígitos.`) },
      
      ];

			for (const validacion of validaciones) {
				if (!validacion.resultado.valido) {
          e.preventDefault();
					validacion.input.classList.add('border-red-500');
					mostrarNotificacion(validacion.resultado.mensaje);
					return;

				}
			}


		});
	});
</script>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
  // Sanitización y obtención de datos
  $nombre   = trim($_POST['nombre'] ?? '');
  $apellido = trim($_POST['apellido'] ?? '');
  $cedula   = trim($_POST['cedula'] ?? '');
  $grado    = trim($_POST['grado'] ?? '');
  $telefono = trim($_POST['telefono']);
  $codigo = trim($_POST['codigo']);
  $codigo = $codigo.$telefono; 
  $seccion  = strtoupper(trim($_POST['seccion'] ?? ''));
  $usuario  = $_SESSION['nombre_usuario'] ?? 'usuario_default';

  // Configuración de límites y expresiones regulares
  $LIMITES = [
    'nombre'   => ['min' => 1, 'max' => 25],
    'apellido' => ['min' => 1, 'max' => 25],
    'cedula'   => ['min' => 7, 'max' => 8],
    'telefono' => ['min' => 7, 'max' => 8],
    'grado'    => ['min' => 1, 'max' => 2],
    'seccion'  => ['min' => 1, 'max' => 1]
  ];
  $regex = [
    'soloLetras'  => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
    'soloNumeros' => '/^\d+$/'
  ];

  // Función para validar campos
  function validarCampo($valor, $regex = null, $limites = [], $campo = '') {
    if (empty($valor)) return "$campo no puede estar vacío.";
    if ($regex && !preg_match($regex, $valor)) return "Formato inválido en $campo.";
    if (isset($limites['min']) && strlen($valor) < $limites['min']) return "$campo debe tener al menos {$limites['min']} caracteres.";
    if (isset($limites['max']) && strlen($valor) > $limites['max']) return "$campo no puede exceder {$limites['max']} caracteres.";
    return null;
  }

  // Validaciones
  $errores = [];
  $errores[] = validarCampo($nombre,   $regex['soloLetras'],  $LIMITES['nombre'],   'Nombre');
  $errores[] = validarCampo($apellido, $regex['soloLetras'],  $LIMITES['apellido'], 'Apellido');
  $errores[] = validarCampo($cedula,   $regex['soloNumeros'], $LIMITES['cedula'],   'Cédula');
  $errores[] = validarCampo($telefono, $regex['soloNumeros'], $LIMITES['telefono'], 'Teléfono');
  $errores[] = validarCampo($grado,    null,                  $LIMITES['grado'],    'Grado');
  $errores[] = validarCampo($seccion,  $regex['soloLetras'],  $LIMITES['seccion'],  'Sección');
  $errores = array_filter($errores);

  // Validación de sección
  if (!in_array($seccion, ['A', 'B'])) {
    $errores[] = "La sección debe ser 'A' o 'B'.";
  }

  // Mostrar errores si existen
  if (!empty($errores)) {
    foreach ($errores as $error) {
      echo "<script>
        const notificacion = document.createElement('div');
        notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
        notificacion.innerHTML = `<div class='flex-shrink-0 mr-3 text-red-700'>
          <svg fill='#f00505' width='24px' height='24px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
            <path d='M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z'></path>
          </svg>
        </div>
        <div class='text-sm'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</div>`;
        document.body.appendChild(notificacion);
        setTimeout(() => notificacion.remove(), 4000);
      </script>";
    }
    exit();
  }

  // Obtener idgrado
  $sqlGrado = "SELECT id FROM grados WHERE nombre = ?";
  $stmt = $connect->prepare($sqlGrado);
  $stmt->bind_param("s", $grado);
  $stmt->execute();
  $resultGrado = $stmt->get_result();
  $rowGrado = $resultGrado->fetch_assoc();
  $idgrado = $rowGrado['id'] ?? null;

  // Obtener idseccion
  $sqlSeccion = "SELECT id FROM seccion WHERE nombre = ?";
  $stmt = $connect->prepare($sqlSeccion);
  $stmt->bind_param("s", $seccion);
  $stmt->execute();
  $resultSeccion = $stmt->get_result();
  $rowSeccion = $resultSeccion->fetch_assoc();
  $idseccion = $rowSeccion['id'] ?? null;

  if (!$idgrado || !$idseccion) {
    echo "<script>
      const notificacion = document.createElement('div');
      notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
      notificacion.innerHTML = `<span>Grado o sección inválidos.</span>`;
      document.body.appendChild(notificacion);
      setTimeout(() => notificacion.remove(), 4000);
    </script>";
    exit();
  }

  // Verificar si la cédula ya existe
  $sqlProfe = "SELECT * FROM profesor WHERE cedula = ?";
  $stmt = $connect->prepare($sqlProfe);
  $stmt->bind_param("s", $cedula);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    echo "<script>
      const notificacion = document.createElement('div');
      notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
      notificacion.innerHTML = `<span>La cédula ya está registrada.</span>`;
      document.body.appendChild(notificacion);
      setTimeout(() => notificacion.remove(), 4000);
    </script>";
    exit();
  }

  // Comprobar si el telefono ya existe
  $sqlprofe = "SELECT * FROM profesor WHERE telefono = ?";
  $stmt = $connect->prepare($sqlprofe);
  $stmt->bind_param("s", $codigo);
  $stmt->execute();
  $resultadoprofesor = $stmt->get_result();

  if ($resultadoprofesor->num_rows > 0) {
      echo "<script>
              const notificacion = document.createElement('div');
              notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
              notificacion.innerHTML = `<span>El telefono ya está registrado.</span>`;
              document.body.appendChild(notificacion);
              setTimeout(() => notificacion.remove(), 4000);
            </script>";
      exit();
  }

  // Verificar cantidad de profesores por grado y sección
  $sqlCount = "SELECT COUNT(*) AS total FROM profesor WHERE idgrado = ? AND idseccion = ?";
  $stmt = $connect->prepare($sqlCount);
  $stmt->bind_param("ii", $idgrado, $idseccion);
  $stmt->execute();
  $resultCount = $stmt->get_result();
  $rowCount = $resultCount->fetch_assoc();
  if (($rowCount['total'] ?? 0) >= 2) {
    echo "<script>
      const notificacion = document.createElement('div');
      notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
      notificacion.innerHTML = `<span>Ya hay 2 profesores asignados a este grado y sección.</span>`;
      document.body.appendChild(notificacion);
      setTimeout(() => notificacion.remove(), 4000);
    </script>";
    exit();
  }

  // Registrar en bitácora
  $sqlBitacora = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
  $stmt = $connect->prepare($sqlBitacora);
  $accion = "Se Insertó un nuevo profesor.";
  $datos_accion = "Informacion: nombre = $nombre, apellido = $apellido, cedula = $cedula, grado = $grado, seccion = $seccion";
  $stmt->bind_param("sss", $accion, $datos_accion, $usuario);
  $stmt->execute();

  // Insertar profesor
  
  $sql_insert = "INSERT INTO trabajadores (nombre, apellido, cedula, telefono, rol) VALUES (?, ?, ?, ?, ?)";
  $stmt = $connect->prepare($sql_insert);
  $rol ="Profesor";
  $stmt->bind_param("sssss", $nombre, $apellido, $cedula,$codigo, $rol);
  $result2 = $stmt->execute();


  $sqlInsert = "INSERT INTO profesor (nombre, apellido, cedula, telefono, idgrado, idseccion) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $connect->prepare($sqlInsert);
  $stmt->bind_param("ssssii", $nombre, $apellido, $cedula,$codigo ,$idgrado, $idseccion);
  $result = $stmt->execute();

  if ($result) {
    echo "<script>
      const notificacion = document.createElement('div');
      notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-green-100 text-green-700 border flex items-center';
      notificacion.innerHTML = `<span>Profesor registrado correctamente.</span>`;
      document.body.appendChild(notificacion);
      setTimeout(() => notificacion.remove(), 4000);
    </script>";
    echo "<script>window.location='ver_grado.php?gradonombre=$grado&seccion=$seccion'</script>";
  } else {
    die(mysqli_error($connect));
  }
}
?>
