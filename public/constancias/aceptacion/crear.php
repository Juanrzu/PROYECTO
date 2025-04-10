<?php
session_start();
$usuario = $_SESSION['nombre_usuario'];


if (!isset($usuario)) {
  header("location: ../../login.php");
} else {
  include('../../connect.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>constancias</title>

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
        include('../../header_admin.php');
      } else {
        include('../../header.php');
      }

      $grado = $_GET['gradonombre'];
      $seccion = $_GET['seccion'];

      $secc = strtoupper(trim($seccion));

      ?>

<main class="mb-4 xl:px-56 mt-8">
    <div class="overflow-x-auto shadow-md sm:rounded-lg m-10 xl:m-4">
        <table class="w-full text-md text-left rtl:text-right text-black dark:text-gray-400">
            <thead class="text-xs text-black uppercase bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-4 py-3">Nombres</th>
                    <th scope="col" class="px-4 py-3">Apellidos</th>
                    <th scope="col" class="px-4 py-3">C.E.N</th>
                    <th scope="col" class="px-4 py-3">Nacimiento</th>
                    <th scope="col" class="px-4 py-3">Sexo</th>
                    <th scope="col" class="px-4 py-3">Representante</th>
                    <th scope="col" class="px-4 py-3">C.I Representante</th>
                    <th scope="col" class="px-4 py-3">Teléfono</th>
                    <th scope="col" class="px-4 py-3">Correo Electrónico</th>
                    <th scope="col" class="px-4 py-3">Grado</th>
                    <th scope="col" class="px-4 py-3">Sección</th>
                    <th scope="col" class="px-4 py-3 bg-blue-400 dark:bg-blue-800 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $secc = strtoupper(trim($seccion));
                $sql = "SELECT estudiantes.*, seccion.nombre AS seccion_nombre, grados.nombre AS grado_nombre, 
                            representante.nombre AS representante_nombre, representante.cedula AS cedularepre, 
                            representante.telefono AS telefono, representante.correo AS correo
                        FROM estudiantes 
                        JOIN seccion ON estudiantes.idseccion = seccion.id 
                        JOIN grados ON estudiantes.idgrado = grados.id
                        JOIN representante ON estudiantes.idrepresentante = representante.id
                        WHERE seccion.nombre = '$secc' AND grados.nombre = $grado
                        ORDER BY estudiantes.nombre ASC";

                $result = mysqli_query($connect, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50">
                            <td class="px-4 py-3">' . htmlspecialchars($row['nombre']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['apellido']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['cen']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['nacimiento']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['sexo']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['representante_nombre']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['cedularepre']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['telefono']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['correo']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['grado_nombre']) . '</td>
                            <td class="px-4 py-3">' . htmlspecialchars($row['seccion_nombre']) . '</td>
                            <td class="px-4 py-3 text-center">
                                <a href="imprimir.php?id=' . htmlspecialchars($row['id']) . '" class="text-blue-600 hover:text-blue-800 rounded-md px-3 py-2 transition hover:bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr>
                        <td colspan="12" class="px-4 py-3 text-center text-sm text-gray-500">No se encontraron estudiantes para este grado y sección.</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Botón flotante -->
    <button data-tooltip-target="tooltip" type="button"
        class="fixed right-2 bottom-16 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-medium text-sm px-4 py-3 shadow-md transition hover:-translate-y-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none">
            <path d="M12 20H12.01" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16"
                stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
        </svg>
    </button>

    <!-- Tooltip -->
    <div id="tooltip" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
        <p>Haz click para descargar constancia.</p>
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</main>


      <footer class="flex justify-between items-center w-full px-8 py-4 mt-[20%]">
        <p class="demin">Todos Los derechos reservados 2024</p>
        <a class="btn bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512">
            <path
              d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
            Licencia Creative Commons
          </svg>
        </a>
      </footer>
    </div>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
    <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
  </body>

</html>