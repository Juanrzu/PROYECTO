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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>

    <body class="ml-64">
    <!-- Loading Screen -->
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
    if ($usuario == "admin" || $usuario == "Admin") {
        include('../header_admin.php');
    } else {
        header('location: ../display.php'); 
        include('../header.php');
    }
    ?>

    <main class="container min-h-screen p-8 ">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
    <h2 class="text-3xl font-bold text-gray-800">Panel de Consulta Integral de Usuarios</h2>
  </div>




        <!-- Botones de acción -->
        <div class="flex flex-wrap gap-4 mb-8">
            <a href="../login/registro.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Agregar Usuario
            </a>
            <a href="actualizar_preguntas.php" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Actualizar Preguntas
            </a>
        </div>

        

        <?php
// Configuración de paginación y búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Número de registros por página
$offset = ($page - 1) * $perPage;

// Construir consulta con búsqueda
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario 
        WHERE nombre_usuario LIKE ? 
        OR nombre LIKE ? 
        OR apellido LIKE ? 
        OR cedula LIKE ? 
        OR telefono LIKE ? 
        OR correo LIKE ?
        ORDER BY nombre_usuario ASC 
        LIMIT ? OFFSET ?";

$stmt = $connect->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ssssssii", 
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
?>

<!-- Buscador -->
<div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <form method="GET" action="">
            <div class="flex items-center gap-4">
                <h3 class="text-xl font-semibold text-gray-800 flex-grow">Gestión de Usuarios</h3>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar usuarios..."
                    value="<?= htmlspecialchars($search) ?>"
                    class="w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Buscar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de Usuarios -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $usuario_row = $row['nombre_usuario'];
                        $estado = $row['estado'];
                        $nombre = $row['nombre'];
                        $apellido = $row['apellido'];
                        $cedula = $row['cedula'];
                        $telefono = $row['telefono'];
                        $gmail = $row['correo'];
                ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $id; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $usuario_row; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo ($estado == 'Activo') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                            <?php echo $estado; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $nombre; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $apellido; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $cedula; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $telefono; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $gmail; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex justify-center space-x-2">
                            <!-- Botón para editar usuario -->
                            <a href="editar_usuario.php?editarid=<?php echo $id; ?>" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200" title="Editar">
                                <!-- Icono SVG de editar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            </a>
                            <?php if ($usuario_row != 'admin' && $usuario_row != 'Admin') { ?>
                            <!-- Botón para eliminar usuario -->
                            <button data-modal-target="modal-eliminar-<?php echo $id; ?>" data-modal-toggle="modal-eliminar-<?php echo $id; ?>" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200" title="Eliminar">
                                <!-- Icono SVG de eliminar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php if ($usuario_row != 'admin' && $usuario_row != 'Admin') { ?>
                <div id="modal-eliminar-<?php echo $id; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Eliminar Usuario</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-eliminar-<?php echo $id; ?>">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Cerrar</span>
                                </button>
                            </div>
                            <form method="POST" action="eliminar_usuario.php?eliminarid=<?php echo $id; ?>">
                                <div class="p-4 md:p-5">
                                    <p class="text-gray-700 mb-4">Por favor, ingrese las contraseñas necesarias para continuar:</p>
                                    <div class="mb-4">
                                        <label for="passAdmin-<?php echo $id; ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña del Admin</label>
                                        <input type="password" name="passAdmin" id="passAdmin-<?php echo $id; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="passUsser-<?php echo $id; ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña del Usuario</label>
                                        <input type="password" name="passUsser" id="passUsser-<?php echo $id; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" name="eliminar" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Eliminar</button>
                                    <button type="button" data-modal-hide="modal-eliminar-<?php echo $id; ?>" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="9" class="px-6 py-4 text-center text-gray-500">No se encontraron usuarios</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    
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

        <!-- Botón de Ayuda -->
        <button data-tooltip-target="tooltip" type="button" class="fixed right-6 bottom-14 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-colors duration-200 outline-none focus:ring-4 focus:ring-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
            <path d="M12 20H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <div id="tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-lg opacity-0 tooltip dark:bg-gray-700">
            <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <span>Haz clic aquí para editar la información de un usuario.</span>
            </div>
            <div class="flex items-center">
            <svg class="w-4 h-4 mr-2 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>Haz clic aquí para eliminar un usuario de forma permanente.</span>
            </div>
            <div class="tooltip-arrow" data-popper-arrow></div>
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

    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
    <script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
    <?php if (isset($_SESSION['error'])): ?>
    <script>alert('<?php echo $_SESSION['error']; ?>')</script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
    </body>

</html>


