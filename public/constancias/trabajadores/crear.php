<?php
session_start();
$usuario = $_SESSION['nombre_usuario'];


if (!isset($usuario)) {
  header( 'location: ../../login/login.php');
} else {
  include('../../connect.php');
  include '../../contador_sesion.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/css/styles.css">
  <title>constancias</title>

</head>

<body class="ml-64">

    

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
      ?>

<main class="container min-h-scsreen p-8 ">



<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
  <h2 class="text-2xl font-bold text-gray-800">Panel de Generacion de Constancias de Trabajadores</h2>
</div>


  <!-- Botón de acción -->
  <div class="flex flex-wrap gap-4 mb-8">
 <!-- Botón Volver -->
                <a href="../../../public/constancias.php"
                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver
            </a>

            <a href="../../..\public\trabajadores\ag_trabajador.php" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Agregar Trabajador
    </a>

  </div>

  <!-- Contenedor de la tabla -->
  <div class="overflow-x-auto shadow-md sm:rounded-lg m-10 xl:m-4">





    <?php




// Configuración de paginación y búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Número de registros por página
$offset = ($page - 1) * $perPage;

// Construir consulta con búsqueda
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM trabajadores
  WHERE nombre LIKE ? 
  OR apellido LIKE ? 
  OR cedula LIKE ? 
  OR telefono LIKE ? 
  OR rol LIKE ? 
  OR CAST(id AS CHAR) LIKE ?
  ORDER BY nombre ASC 
  LIMIT ? OFFSET ?";

$stmt = $connect->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param(
    "ssssssii", 
    $searchTerm, 
    $searchTerm, 
    $searchTerm, 
    $searchTerm, 
    $searchTerm, 
    $searchTerm,
    $perPage, 
    $offset
);
$stmt->execute();
$result = $stmt->get_result();

// Obtener total de registros
$totalResult = $connect->query("SELECT FOUND_ROWS()");
$totalRows = $totalResult->fetch_row()[0];
$totalPages = ceil($totalRows / $perPage);




?><!-- Buscador -->
<div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <form method="GET" action="">
            <div class="flex items-center gap-4">
                <h3 class="text-xl font-semibold text-gray-800 flex-grow">Trabajadores</h3>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar Trabajadores..."
                    value="<?= htmlspecialchars($search) ?>"
                    class="w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <button 
                    type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                >
                    Buscar
                </button>
            </div>
        </form>
    </div>
</div>

<?php
    
    if (mysqli_num_rows($result) > 0) { ?>
      <!-- Tabla (solo se muestra si hay registros) -->
      <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
        <thead class="text-xs text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">Nombre</th>
            <th scope="col" class="px-6 py-3">Apellido</th>
            <th scope="col" class="px-6 py-3">Cédula</th>
            <th scope="col" class="px-6 py-3">Teléfono</th>
            <th scope="col" class="px-6 py-3">Rol</th>
            <th scope="col" class="px-6 py-3">Acciones</th>
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
                <a href="imprimir.php?id=<?= htmlspecialchars($row['id']) ?>" class="inline-flex items-center px-3 py-2 text-sm  tooltip bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class=" bg-blue-600 rounded-sm" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
          <g id="File / Cloud_Upload">
        <path id="Vector" d="M12 16V10M12 10L9 12M12 10L15 12M23 15C23 12.7909 21.2091 11 19 11C18.9764 11 18.9532 11.0002 18.9297 11.0006C18.4447 7.60802 15.5267 5 12 5C9.20335 5 6.79019 6.64004 5.66895 9.01082C3.06206 9.18144 1 11.3498 1 13.9999C1 16.7613 3.23858 19.0001 6 19.0001L19 19C21.2091 19 23 17.2091 23 15Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </g>
        </svg>
                </a>
              </td>
            </tr>



        
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="w-full bg-white p-8 text-center rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900">No hay registros disponibles</h3>
      </div>
    <?php } ?>



     <!-- Paginación -->
     <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-700">
                Mostrando <?= ($offset + 1) ?> a <?= min($offset + $perPage, $totalRows) ?> de <?= $totalRows ?> resultados
            </span>
            <div class="flex gap-2">
                <?php if($page > 1): ?>
                    <a 
                        href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>" 
                        class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50"
                    >
                        Anterior
                    </a>
                <?php endif; ?>

                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <a 
                        href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" 
                        class="px-3 py-1 rounded-md <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' ?>"
                    >
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <a 
                        href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>" 
                        class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50"
                    >
                        Siguiente
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$stmt->close();
?>
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

    <div id="tooltip-retiros" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
      <div class="flex items-center">
        <span class="text-white">Haz clic en el icono para imprimir la constancia.</span>
        <svg class="ml-2 bg-blue-600 p-2 rounded-sm" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
          <g id="File / Cloud_Upload">
        <path id="Vector" d="M12 16V10M12 10L9 12M12 10L15 12M23 15C23 12.7909 21.2091 11 19 11C18.9764 11 18.9532 11.0002 18.9297 11.0006C18.4447 7.60802 15.5267 5 12 5C9.20335 5 6.79019 6.64004 5.66895 9.01082C3.06206 9.18144 1 11.3498 1 13.9999C1 16.7613 3.23858 19.0001 6 19.0001L19 19C21.2091 19 23 17.2091 23 15Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </g>
        </svg>
      </div>
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

      <script src="../../../src/js/script.js"></script>
      <script src="../../../node_modules\flowbite\dist\flowbite.min.js"></script>
  
</body>
</html>

