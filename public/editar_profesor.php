<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];

if ($usuario == null || $usuario == '') {
    header('location:login/login.php');
    die();
}

include 'connect.php';
include 'contador_sesion.php';

$id = $_GET['editarid'];

// Consulta para obtener los datos del profesor
$sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
        FROM profesor 
        JOIN seccion ON profesor.idseccion = seccion.id 
        JOIN grados ON profesor.idgrado = grados.id 
        WHERE profesor.id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $cedula = $row['cedula'];
    $grado = $row['grado_nombre'];
    $seccion = $row['seccion_nombre'];
    $volver = $grado;
    $volver2 = $seccion;
}
  //guardar datos viejos
  $nombre_anterior = $nombre;
  $apellido_anterior = $apellido;
  $cedula_anterior = $cedula;
  $nacimiento_anterior = $nacimiento;
  $grado_anterior = $grado;
  $seccion_anterior = $seccion;
  //fin
 
 
 
 $stmt->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>

<body class="bg-ghost">
    <div class="container-lg w-full flex flex-col">
        <main class="w-full flex justify-center items-center xl:px-56 mt-8">
            <form method="post" id="formulario" class="w-full max-w-screen-sm rounded-md border border-gray-300 p-6 shadow-sm bg-white">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                               placeholder="Nombre del Profesor" maxlength="25" name="nombre" id="nombre" autocomplete="off" value="<?php echo htmlspecialchars($nombre); ?>" >
                    </div>

                    <!-- Apellido -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                        <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                               placeholder="Apellido del Profesor" maxlength="25" name="apellido" id="apellido" autocomplete="off" value="<?php echo htmlspecialchars($apellido); ?>" >
                    </div>

                    <!-- Cédula -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
                        <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                               placeholder="Cédula" name="cedula" id="cedula" autocomplete="off" maxlength="25" value="<?php echo htmlspecialchars($cedula); ?>" >
                    </div>

                    <!-- Grado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
                        <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="grado" >
                            <option value="1" <?php echo $grado == "1" ? "selected" : ""; ?>>1</option>
                            <option value="2" <?php echo $grado == "2" ? "selected" : ""; ?>>2</option>
                            <option value="3" <?php echo $grado == "3" ? "selected" : ""; ?>>3</option>
                            <option value="4" <?php echo $grado == "4" ? "selected" : ""; ?>>4</option>
                            <option value="5" <?php echo $grado == "5" ? "selected" : ""; ?>>5</option>
                            <option value="6" <?php echo $grado == "6" ? "selected" : ""; ?>>6</option>
                        </select>
                    </div>

                    <!-- Sección -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sección</label>
                        <select class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="seccion" >
                            <option value="A" <?php echo $seccion == "A" ? "selected" : ""; ?>>A</option>
                            <option value="B" <?php echo $seccion == "B" ? "selected" : ""; ?>>B</option>
                        </select>
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
    const btn = document.getElementById('btn');
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cedula: document.getElementById('cedula'),
        grado: document.getElementById('grado'),
        seccion: document.getElementById('seccion')
    };

    const regex = {
        soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
        soloNumeros: /^\d+$/
    };

    const LIMITES = {
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        cedula: { min: 7, max: 8 }
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
            { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, `El nombre debe ser válido.`) },
            { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, `El apellido debe ser válido.`) },
            { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, `La cédula debe ser válida.`) }
        ];

        for (const validacion of validaciones) {
            if (!validacion.resultado.valido) {
                e.preventDefault();
                validacion.input.classList.add('border-red-500');
                mostrarNotificacion(validacion.resultado.mensaje);
                return;
            }
        }

        // Validar grado
        const gradoValido = ['1', '2', '3', '4', '5', '6'].includes(inputs.grado.value);
        if (!gradoValido) {
            e.preventDefault();
            inputs.grado.classList.add('border-red-500');
            mostrarNotificacion('Seleccione un grado válido.');
            return;
        }

        // Validar sección
        const seccionValida = ['A', 'B'].includes(inputs.seccion.value.toUpperCase());
        if (!seccionValida) {
            e.preventDefault();
            inputs.seccion.classList.add('border-red-500');
            mostrarNotificacion('Seleccione una sección válida.');
            return;
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
    $cedula_nueva = trim($_POST['cedula']);
    $grado = trim($_POST['grado']);
    $seccion = strtoupper(trim($_POST['seccion']));
    $errores = [];

    // Expresiones regulares
    $regex = [
        'soloLetras' => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
        'soloNumeros' => '/^\d+$/'
    ];

    // Validaciones
    if (empty($nombre) || !preg_match($regex['soloLetras'], $nombre) || strlen($nombre) < 2 || strlen($nombre) > 25) {
        $errores[] = "El nombre debe contener solo letras y tener entre 2 y 25 caracteres.";
    }

    if (empty($apellido) || !preg_match($regex['soloLetras'], $apellido) || strlen($apellido) < 2 || strlen($apellido) > 25) {
        $errores[] = "El apellido debe contener solo letras y tener entre 2 y 25 caracteres.";
    }

    if (empty($cedula_nueva) || !preg_match($regex['soloNumeros'], $cedula_nueva) || strlen($cedula_nueva) < 7 || strlen($cedula_nueva) > 8) {
        $errores[] = "La cédula debe contener solo números y tener entre 7 y 8 dígitos.";
    }

    if (empty($grado) || !in_array($grado, ['1', '2', '3', '4', '5', '6'])) {
        $errores[] = "El grado seleccionado no es válido.";
    }

    if (empty($seccion) || !in_array($seccion, ['A', 'B'])) {
        $errores[] = "La sección debe ser 'A' o 'B'.";
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

    // Verificar existencia de grado y sección
    $sql_grado_exist = "SELECT id FROM grados WHERE nombre = ?";
    $stmt_grado = $connect->prepare($sql_grado_exist);
    $stmt_grado->bind_param("s", $grado);
    $stmt_grado->execute();
    $result_grado_exist = $stmt_grado->get_result();

    $sql_seccion_exist = "SELECT id FROM seccion WHERE nombre = ?";
    $stmt_seccion = $connect->prepare($sql_seccion_exist);
    $stmt_seccion->bind_param("s", $seccion);
    $stmt_seccion->execute();
    $result_seccion_exist = $stmt_seccion->get_result();

    if ($result_grado_exist->num_rows > 0 && $result_seccion_exist->num_rows > 0) {
        $row_grado = $result_grado_exist->fetch_assoc();
        $grado_id = $row_grado['id'];

        $row_seccion = $result_seccion_exist->fetch_assoc();
        $seccion_id = $row_seccion['id'];

        // Verificar si la nueva cédula ya existe en otro profesor
        $sql_verificar_profesor = "SELECT * FROM profesor WHERE cedula = ? AND id != ?";
        $stmt_verificar = $connect->prepare($sql_verificar_profesor);
        $stmt_verificar->bind_param("si", $cedula_nueva, $id);
        $stmt_verificar->execute();
        $resultado_profesor = $stmt_verificar->get_result();

        if ($resultado_profesor->num_rows > 0) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `<div class='text-sm'>La cédula ingresada ya está registrada en otro profesor.</div>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
            </script>";
            exit();
        }

        $sql_count = "SELECT COUNT(*) AS total FROM profesor 
        WHERE idgrado = ? AND idseccion = ? 
        AND id != ?"; // Excluye el profesor actual

        $stmt_count = $connect->prepare($sql_count);
        $stmt_count->bind_param("iii", $grado_id, $seccion_id, $id); // Añade el tercer parámetro
        $stmt_count->execute();
        $result_count = $stmt_count->get_result();
        $row_count = $result_count->fetch_assoc();
        $total_profesores = $row_count['total'];

        // Actualizar profesor
        $sql = "UPDATE profesor SET nombre = ?, apellido = ?, cedula = ?, idgrado = ?, idseccion = ? WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssiii", $nombre, $apellido, $cedula_nueva, $grado_id, $seccion_id, $id);
         //preparar datos para bitacora
                 //agregar datos a la bitacora
                 $cambios = [];
            
                 if ($apellido_anterior != $apellido) {
                     $cambios[] = "Apellido anterior = $apellido_anterior, Apellido actualizado = $apellido";
                 }
                 if ($nombre_anterior != $nombre) {
                     $cambios[] = "Nombre anterior = $nombre_anterior, Nombre actualizado = $nombre";
                 }
                 if ($cedula_anterior != $cedula) {
                     $cambios[] = "Cedula anterior = $cen_anterior, Cedula actualizado = $cedula";
                 }           
                 if ($grado_anterior != $grado) {
                     $cambios[] = "Grado anterior = $grado_anterior, Grado actualizado = $grado";
                 }
                 if ($seccion_anterior != $seccion) {
                     $cambios[] = "Sección anterior = $seccion_anterior, Sección actualizada = $seccion";
                 }
         
                     // Unir todos los cambios en un string
                     $datos_accion = implode(", ", $cambios);
                     $datos_accion = "Cambios: " . $datos_accion;
     
     
                     //ingresar insert en bitacora
                     $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
                     $stmt2 = $connect->prepare($sql2);
                     $accion = "Se actualizaron los datos de un profesor.";
                     $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
                     $resultInsert2 = $stmt2->execute();
                     
                     //aqui termina

        if ($stmt->execute()) {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-green-100 text-green-700 border flex items-center';
                notificacion.innerHTML = `<div class='text-sm'>Profesor actualizado correctamente.</div>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
                window.location='ver_grado.php?gradonombre=$volver&seccion=$volver2';
            </script>";
        } else {
            echo "<script>
                const notificacion = document.createElement('div');
                notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                notificacion.innerHTML = `<div class='text-sm'>Error al actualizar el profesor.</div>`;
                document.body.appendChild(notificacion);
                setTimeout(() => notificacion.remove(), 4000);
            </script>";
        }
    }
}
?>