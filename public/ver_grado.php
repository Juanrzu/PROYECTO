<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}
include 'connect.php';
include 'contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Estudiantes</title>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen flex flex-col">

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Header Dinámico -->
    <?php
    if ($usuario == "admin" || $usuario == "Admin") {
      include('./header_admin.php');
    } else {
      include('./header.php');
    }
    ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <!-- Botones de Acción -->
      <div class="flex flex-wrap gap-4 mb-8">
        <?php
        $grado = $_GET['gradonombre'];
        $seccion = $_GET['seccion'];
        
        echo '<a href="ver_pdf.php?gradonombre='.$grado.'&seccion='.$seccion.'" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Descargar PDF
              </a>';
        
        echo '<a href="http://localhost/dashboard/Proyecto/public/profesor.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Agregar Profesor
              </a>';
        
        echo '<a href="http://localhost/dashboard/Proyecto/public/estudiante.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Agregar Estudiante
              </a>';
        ?>
      </div>

      <!-- Tabla de Profesores -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-gray-800">Profesores</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
              $secc = strtoupper(trim($seccion));
              $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
                      FROM profesor 
                      JOIN seccion ON profesor.idseccion = seccion.id 
                      JOIN grados ON profesor.idgrado = grados.id 
                      WHERE seccion.nombre = ? AND grados.nombre = ?
                      ORDER BY profesor.nombre ASC";
              
              $stmt = $connect->prepare($sql);
              $stmt->bind_param("si", $secc, $grado);
              $stmt->execute();
              $result = $stmt->get_result();
              
              if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr class="hover:bg-gray-50">
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['apellido'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['cedula'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['grado_nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['seccion_nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex justify-center space-x-2">
                            <a href="editar_profesor.php?editarid='.$row['id'].'" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                              </svg>
                            </a>
                            <a href="eliminar_profesor.php?eliminarid='.$row['id'].'" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                              </svg>
                            </a>
                          </td>
                        </tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Tabla de Estudiantes -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-gray-800">Estudiantes</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.E.N</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nacimiento</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Representante</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.I Representante</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
              $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                      representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                      representante.telefono as telefono, representante.correo as correo
                      FROM estudiantes  
                      JOIN seccion ON estudiantes.idseccion = seccion.id 
                      JOIN grados ON estudiantes.idgrado = grados.id
                      JOIN representante ON estudiantes.idrepresentante = representante.id
                      WHERE seccion.nombre = ? AND grados.nombre = ?
                      ORDER BY estudiantes.nombre ASC";
              
              $stmt = $connect->prepare($sql);
              $stmt->bind_param("si", $secc, $grado);
              $stmt->execute();
              $result = $stmt->get_result();
              
              if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr class="hover:bg-gray-50">
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['apellido'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['cen'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['nacimiento'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['sexo'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['representante_nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['cedularepre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['telefono'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['correo'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['grado_nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$row['seccion_nombre'].'</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex justify-center space-x-2">
                            <a href="editar.php?editarid='.$row['id'].'" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                              </svg>
                            </a>
                                  <td class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200"> 
                            <form method="POST" action="retirar_estudiante.php?eliminarid=' .$row['id'] . '">
                                <button type="button" class="w-full" data-modal-target="modal-retirar-' . $row['id']  . '" data-modal-toggle="modal-retirar-' . $row['id']  . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                              </svg>
                                </button>
                    
                                <div id="modal-retirar-' . $row['id'] . '" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                                    <div class="relative p-4 max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                                            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sistema</h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-retirar-' . $row['id']  . '">
                                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div class="p-4 md:p-5 space-y-4">
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">¿Dinos el motivo?</p>
                                                <div class="mb-2">
                                                    <input type="text" class="w-full mt-2 rounded-lg" name="motivo" id="motivo-retirar-' . $row['id']  . '" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" name="registrar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Retirar</button>
                                                <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="modal-retirar-' . $id . '">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    
                        <td class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200">
                            <form method="POST" action="eliminar.php?eliminarid=' . $row['id'] . '">
                                <button type="button" class="w-full" data-modal-target="modal-eliminar-' . $row['id'] . '" data-modal-toggle="modal-eliminar-' . $row['id'] . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                              </svg>
                                </button>
                    
                                <div id="modal-eliminar-' . $row['id'] . '" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                                    <div class="relative p-4 max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                                            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sistema</h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-eliminar-' . $row['id'] . '">
                                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div class="p-4 md:p-5 space-y-4">
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">¿Esta seguro?</p>
                                            </div>
                                            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" name="registrar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sí</button>
                                                <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="modal-eliminar-' .$row['id'] . '">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-600 text-sm mb-4 md:mb-0">Todos los derechos reservados <?= date('Y') ?></p>
          <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="inline-flex items-center gap-2 bg-gray-50 hover:bg-gray-100 rounded-full px-4 py-2 transition-colors duration-200 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
              <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
            </svg>
            <span>Licencia Creative Commons</span>
          </a>
        </div>
      </div>
    </footer>
  </div>

  <!-- Scripts -->
  <script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
  <script>
    // Ocultar loading overlay cuando la página cargue
    window.addEventListener('load', function() {
      document.getElementById('loading-overlay').style.display = 'none';
    });

    // Funciones de confirmación
    function confirmRetirar(id) {
      if (confirm('¿Está seguro que desea retirar este estudiante?')) {
        window.location.href = 'retirar_estudiante.php?eliminarid=' + id;
      }
    }

    function confirmEliminar(id) {
      if (confirm('¿Está seguro que desea eliminar permanentemente este estudiante?')) {
        window.location.href = 'eliminar.php?eliminarid=' + id;
      }
    }
  </script>
</body>
</html>