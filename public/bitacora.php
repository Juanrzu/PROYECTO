<?php

session_start();
error_reporting(error_level: 0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header(header: 'location: login/login.php');
  die();
}
include 'connect.php';
include 'contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/css/styles.css">
  <title>Bitacora</title>
</head>

<body class="ml-64">
  <div class="container-lg w-full flex flex-col">
    <!-- Pantalla de carga -->
    <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-black-200 animate-spin dark:text-black-600 fill-blue-600 z-50" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <!-- Header -->
    <?php
    if ($usuario == "admin" || $usuario == "Admin") {
      include('header_admin.php');
    } else {
      include('header.php');
    }
    ?>

    <!-- Contenido principal -->
    <main class="container min-h-screen p-8">
      <!-- Encabezado y controles -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
      <h2 class="text-2xl font-bold text-gray-800">Registro Histórico de Operaciones</h2>
        </div>

      <!-- Tabla de Bitácora -->
      <div class="bg-white rounded-xl shadow-md">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-xl font-semibold text-black-800">Historial de Acciones</h3>
      </div>
      <!-- Agregado scroll responsive con max-height -->
      <div class="overflow-auto max-h-96">
        <?php
        $sql = "SELECT * FROM bitacora ORDER BY fecha_hora DESC";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && mysqli_num_rows($result) > 0): ?>
          <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Acción</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Fecha y Hora</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Usuario</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Detalles</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500"><?= htmlspecialchars($row['accion']) ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500"><?= htmlspecialchars($row['fecha_hora']) ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500"><?= htmlspecialchars($row['usuario']) ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
              <!-- Botón para abrir el modal -->
              <button 
                type="button" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                onclick="document.getElementById('modal-accion-<?= htmlspecialchars($row['id']) ?>').classList.remove('hidden')"
              >
                Ver detalles
              </button>

              <!-- Modal -->
              <div id="modal-accion-<?= htmlspecialchars($row['id']) ?>" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col dark:bg-gray-800">
    <!-- Header -->
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-white">Detalles de la acción</h3>
    </div>
    
    <!-- Contenido con scroll (¡Aquí está la barra!) -->
    <div class="p-4 overflow-y-auto">  <!-- `overflow-y-auto` activa la barra solo cuando el contenido excede la altura -->
      <div class="space-y-3">
        <?php
        // Parseo mejorado de datos (incluye trim() y validación)
        $pares = array_filter(explode(',', $row['datos_accion']));
        foreach ($pares as $par) {
          $partes = explode('=', $par, 2); // Limita a 2 partes para valores con "=" incluido
          if (count($partes) === 2) {
            $clave = trim($partes[0]);
            $valor = trim($partes[1]);
            echo '
            <div class="grid grid-cols-3 gap-2 text-sm">
              <div class="font-medium text-gray-800 dark:text-gray-300">' . htmlspecialchars($clave) . '</div>
              <div class="col-span-2 text-gray-500 dark:text-gray-200 break-all">' . htmlspecialchars($valor) . '</div>
            </div>';
          }
        }
        ?>
      </div>
    </div>
    
    <!-- Footer -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
      <button
        onclick="document.getElementById('modal-accion-<?= htmlspecialchars($row['id']) ?>').classList.add('hidden')"
        class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600"
      >
        Cerrar
      </button>
    </div>
  </div>
</div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
          </table>
        <?php else: ?>
          <!-- Mensaje cuando no hay registros -->
          <div class="w-full bg-white p-8 text-center rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-black-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="mt-4 text-lg font-medium text-black-900">No hay registros en la bitácora</h3>
          <p class="mt-2 text-sm text-black-500">No se han registrado acciones en el sistema aún.</p>
          </div>
        <?php endif; 
        $stmt->close();
        ?>
      </div>
      </div>
    </main>

    <!-- Botón de Ayuda -->
    <button data-tooltip-target="tooltip-bitacora" type="button" class="fixed right-6 bottom-14 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-colors duration-200 outline-none focus:ring-4 focus:ring-blue-300">
      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
        <path d="M12 20H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      </svg>
    </button>

    <div id="tooltip-bitacora" role="tooltip" class="absolute z-10 invisible inline-block px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-lg opacity-0 tooltip dark:bg-gray-700">
      <p>Esta tabla muestra el historial de acciones realizadas en el sistema.</p>
      <p class="mt-2">Cada registro incluye la acción realizada, la fecha y hora, y el usuario que la ejecutó.</p>
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
      <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
        <p class="text-black-600 text-sm">Todos los derechos reservados © <?= date('Y') ?></p>
        <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="mt-2 md:mt-0" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black-600 hover:text-black-800 transition-colors duration-200" fill="currentColor" viewBox="0 0 512 512">
            <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
          </svg>
        </a>
      </div>
    </footer>
  </div>

  <script src="../src/js/script.js"></script>
  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>