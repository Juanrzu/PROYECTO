<?php
  session_start();

  $usuario = $_SESSION['nombre_usuario'];

  if (!isset($usuario)) {
    header("location: login.php");
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
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Profesor</title>

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

  
    <main class=" flex justify-center items-center xl:px-56 mt-8">
              <form method="post" id="formulario" class="w-80 rounded-xl p-4 py-8 shadow-lg bg-gray-100" novalidate>
                  <div class="mb-2">
                      <label>Nombre</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg"  placeholder="Nombre del Profesor" maxlength="30" name="nombre" id="nombre" autocomplete="off">
                  </div>
                  <div class="mb-2">
                      <label>Apellido</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg"  placeholder="Apellido del Profesor" maxlength="30" name="apellido" id="apellido" autocomplete="off">
                  </div>
                  <div class="mb-2">
                      <label>Cedula</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Cedula" name="cedula" autocomplete="off" maxlength="30" id="cedula" >
                  </div>
                  <div class="mb-2">
                      <label>Grado</label>
                  <select class="form-control form-control w-full mt-2 rounded-lg" name="grado"  required>
                      <option value=1>1</option>
                      <option value=2>2</option>
                      <option value=3>3</option>
                      <option value=4>4</option>
                      <option value=5>5</option>
                      <option value=6>6</option>
                  </select>
                </div>
                <div class="mb-2">
                      <label>Seccion</label>
                  <select class="form-control form-control w-full mt-2 rounded-lg" name="seccion"  required>
                      <option value="A">A</option>
                      <option value="B">B</option>
                  </select>
                </div>
                  <div class="mb-2">
                  <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">FINALIZAR</button>
                  </div>
                  <div class="mb-2">
                        <button type="button" onclick="regresarPaginaAnterior()" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" id="btn-modal">Regresar a la página anterior</button>
                    </div>

                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Sistema
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    ¿Esta Seguro Que Quiere Registrar Un Profesor?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="default-modal" type="submit" name="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SI</button>
                                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">no</button>
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
			nombre: 29,
			apellido: 29,
			cedula: 8,
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

		form.addEventListener("submit", (e) => {
			e.preventDefault();

			Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));

			const validaciones = [
				{ input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, 1, LIMITES.nombre, `El nombre debe ser válido y tener un máximo de ${LIMITES.nombre} caracteres.`) },
				{ input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, 1, LIMITES.apellido, `El apellido debe ser válido y tener un máximo de ${LIMITES.apellido} caracteres.`) },
				{ input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula, LIMITES.cedula, `La cédula debe tener exactamente ${LIMITES.cedula} dígitos.`) },
      ];

			for (const validacion of validaciones) {
				if (!validacion.resultado.valido) {
					validacion.input.classList.add('border-red-500');
					mostrarNotificacion(validacion.resultado.mensaje);
					return;
				}
			}

			mostrarNotificacion('Formulario enviado correctamente', 'success');
			form.submit(); // Descomentar para enviar el formulario
		});
	});
</script>

</body>
</html>

<?php

if (isset($_POST['submit'])){
  $nombre= $_POST['nombre'];
  $apellido= $_POST['apellido'];
  $cedula= $_POST['cedula'];
  $grado=$_POST['grado'];
  $seccion=$_POST['seccion'];
  $seccion= strtoupper($seccion);
  $volver=$grado;
  $volver2=$seccion;
  $error=[];

  if (empty($nombre) || empty($apellido) || empty($cedula) || empty($grado) || empty($seccion)) {
    echo "<footer class='error'>
    <div class='container_title btn btn-danger'>
        <h5 class='title-h1'>Los datos no pueden estar vacios</h5>
    </div>

</footer>";
      
    exit();
  }
  //Verificar Sección
  if (empty($error)) {
    if ($seccion === 'A' || $seccion === 'B' ) {
      
      $sqlgrado = "SELECT id FROM grados WHERE nombre = ?";
      $stmt = $connect->prepare($sqlgrado);
      $stmt->bind_param("s", $grado);
      $stmt->execute();
      $resultgrado = $stmt->get_result();
      $rowgrado = $resultgrado->fetch_assoc();
      $idgrado = $rowgrado['id'];

  
      $sqlseccion = "SELECT id FROM seccion WHERE nombre = ?";
      $stmt = $connect->prepare($sqlseccion);
      $stmt->bind_param("s", $seccion);
      $stmt->execute();
      $resultseccion = $stmt->get_result();
      $rowseccion = $resultseccion->fetch_assoc();
      $idseccion = $rowseccion['id'];
      
      }
    }
    $sqlprofe = "SELECT * FROM profesor WHERE cedula = ?";
    $stmt = $connect->prepare($sqlprofe); 
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $resultadoprofesor = $stmt->get_result();
    

    // Verificar si la consulta devuelve resultados
    if (mysqli_num_rows($resultadoprofesor) > 0) {
    echo "<footer class='error'>
    <div class='container_title btn btn-danger'>
        <h5>La cedula ya se encuentra registrada a otro profesor</h5>
    </div>

</footer>";
exit;
  } 
 // Consulta para contar cuántos profesores hay asignados a un grado y sección específicos
  $sql_count = "SELECT COUNT(*) AS total FROM profesor WHERE idgrado = ? AND idseccion = ?";
  $stmt = $connect->prepare($sql_count);
  $stmt->bind_param("ii", $idgrado, $idseccion);
  $stmt->execute();
  $result_count = $stmt->get_result();
  $row_count = $result_count->fetch_assoc();
  $total_profesores = $row_count['total'];


 // Verificar si ya hay 2 profesores asignados a este grado y sección
 if ($total_profesores >= 2) {
     echo "<footer class='error'>
             <div class='container_title btn btn-danger'>
                 <h5>Ya hay 2 profesores asignados a este grado y sección</h5>
             </div>
         </footer>";
     exit();
 }
 
      $sql = "INSERT INTO profesor (nombre, apellido, cedula, idgrado, idseccion) VALUES (?, ?, ?, ?, ?)";
      $stmt = $connect->prepare($sql);
      $stmt->bind_param("sssii", $nombre, $apellido, $cedula, $idgrado, $idseccion);
      $result = $stmt->execute();
      
      if($result){
 
         echo"<script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2'</script>";
      }else{
          die (mysqli_error($connect));
      } 
  }



  


?>