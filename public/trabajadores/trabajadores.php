<?php

session_start();
error_reporting(0);

if (!isset($_SESSION['nombre_usuario']) || empty($_SESSION['nombre_usuario'])) {
  header('Location: ./../login/login.php');
  exit();
}

$usuario = $_SESSION['nombre_usuario'];

require_once './../connect.php';
require_once '../contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Trabajadores</title>
</head>

<body class="bg-ghost">
  <div class="container-lg w-full flex flex-col">
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
    if ($usuario == "admin" || $usuario == "Admin" ) {
      include('../header_admin.php');
    } else {
      include('../header.php');
    }
    ?>

<main class="container h-screen mx-auto px-4 py-8">
  <!-- Botón de acción -->
  <div class="flex flex-wrap gap-4 mb-8">
    <a href="ag_trabajador.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Agregar Trabajador
    </a>
  </div>

  <!-- Contenedor de la tabla -->
  <div class="overflow-x-auto shadow-md sm:rounded-lg m-10 xl:m-4">
    <?php
    $sql = "SELECT * FROM trabajadores";
    $result = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($result) > 0): ?>
      <!-- Tabla (solo se muestra si hay registros) -->
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">Nombre</th>
            <th scope="col" class="px-6 py-3">Apellido</th>
            <th scope="col" class="px-6 py-3">Cédula</th>
            <th scope="col" class="px-6 py-3">Teléfono</th>
            <th scope="col" class="px-6 py-3">Rol</th>
            <th scope="col" class="px-6 py-3">Editar</th>
            <th scope="col" class="px-6 py-3">Borrar</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50">
              <td class="px-6 py-4"><?= htmlspecialchars($row['id']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($row['nombre']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($row['apellido']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($row['cedula']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($row['telefono']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($row['rol']) ?></td>
              <td class="px-6 py-4">
                <a href="editar_trabajador.php?editarid=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                  </svg>
                </a>
              </td>
              <td class="px-6 py-4">
                <a href="eliminar_trabajador.php?eliminarid=<?= $row['id'] ?>" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <!-- Mensaje cuando no hay datos -->
      <div class="w-full bg-white p-8 text-center rounded-lg shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay trabajadores registrados</h3>
        <p class="mt-2 text-sm text-gray-500">Actualmente no hay ningún trabajador en el sistema.</p>
        <div class="mt-6">
          <a href="ag_trabajador.php" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Agregar Primer Trabajador
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>
    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
        <p class="text-gray-600 text-sm">Todos los derechos reservados © 2024</p>
        <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="mt-2 md:mt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-800 transition-colors duration-200" fill="currentColor" viewBox="0 0 512 512">
            <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
            </svg>
        </a>
        </div>
    </footer>
  </div>
  <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
  <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
</body>

</html>