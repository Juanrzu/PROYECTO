<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'] ?? '';
if (empty($usuario)) {
  header('Location: ./login/login.php');
  exit();
}
include 'connect.php';
include 'contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estudiantes Retirados</title>
  <!-- Usar protocolo relativo para los recursos -->
  <link rel="stylesheet" href="/dashboard/Proyecto/src/css/styles.css">
  <!-- Preconexión para mejorar rendimiento -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Favicon -->
  <link rel="icon" href="/dashboard/Proyecto/src/img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-gray-100">
<div class="container-lg w-full flex flex-col">
    <!-- Pantalla de carga -->
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

  <?php include($usuario === "admin" || $usuario === "Admin" ? './header_admin.php' : './header.php'); ?>
  
  <main class="container h-screen mx-auto px-2 md:px-20 py-8">
    <!-- Encabezado y controles -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
      <h1 class="text-2xl font-bold text-gray-800">Gestión de Estudiantes Retirados</h1>
    </div>

    <!-- Tabla de Estudiantes Retirados -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

      

      
            <?php
            $sql = "SELECT * FROM retiro_estudiantes ORDER BY fecha_hora DESC";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                echo '<div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.E.N</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nacimiento</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Representante</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.I Rep.</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">motivo</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">';
                while ($row = $result->fetch_assoc()) {
                  $id = $row['id'];
                  $fecha = date('d/m/Y', strtotime($row['fecha_hora']));
                  echo '<tr class="hover:bg-gray-50 transition-colors duration-150">
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' . htmlspecialchars($row['nombre']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['apellido']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['cen']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['nacimiento']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['sexo']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['representante'] . ' ' . $row['representante_apellido']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['cedula_repre']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['telefono']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['grado']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['seccion']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $fecha . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($row['motivo']) . '</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex justify-center space-x-2">
                            <a href="editar_estudiante_retirado.php?editarid=' . $id . '" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200" title="Editar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                              </svg>
                            </a>
                            <form method="POST" action="restaurar_estudiantes_retirados.php?eliminarid=' . $id . '" class="inline">
                              <button type="submit" class="text-green-600 hover:text-green-900 p-2 rounded-full hover:bg-green-50 transition-colors duration-200" title="Restaurar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                              </button>
                            </form>
                          </td>
                        </tr>';
                }
                echo '</tbody>
          </table>
        </div>';
              } else {
              echo '<div class="w-full bg-white p-8 text-center rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No hay estudiantes registrados</h3>
            <p class="mt-2 text-sm text-gray-500">No se encontraron estudiantes para este grado y sección.</p>
            <div class="mt-6">
              <a href="http://localhost/dashboard/Proyecto/public/estudiante.php" class="inline-flex items-center px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white font-medium rounded-lg shadow transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Agregar Primer Estudiante
              </a>
            </div>
          </div>';
            }
            $stmt->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Botón de Ayuda -->
    <button data-tooltip-target="tooltip-retiros" type="button" class="fixed right-6 bottom-14 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
        <line x1="12" y1="17" x2="12.01" y2="17"></line>
      </svg>
    </button>

    <div id="tooltip-retiros" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
      <div class="flex items-center mb-2">
        <svg class="w-4 h-4 mr-2 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
        <span>Editar información del estudiante retirado</span>
      </div>
      <div class="flex items-center">
        <svg class="w-4 h-4 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
        </svg>
        <span>Restaurar estudiante al sistema</span>
      </div>
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white shadow mt-12">
    <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
      <p class="text-gray-600 text-sm">Todos los derechos reservados © <?php echo date('Y'); ?></p>
      <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="mt-2 md:mt-0" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-800 transition-colors duration-200" fill="currentColor" viewBox="0 0 512 512">
          <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
        </svg>
      </a>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="/dashboard/Proyecto/src/js/script.js"></script>
  <script src="/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
</div>

</body>
</html>