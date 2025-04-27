<?php
session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}

$grado = $_GET['gradonombre'];
$seccion = $_GET['seccion'];



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

<body class="bg-gray-50 ml-64">


    

  <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <!-- Header Dinámico -->
    <?php
    if ($usuario == "admin" || $usuario == "Admin") {
      include('./header_admin.php');
    } else {
      include('./header.php');
    }
    ?>

    <main class="container min-h-screen p-8 ">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">
            Panel Integral de Estudiantes - 
            <span ><?= htmlspecialchars($grado) ?></span>
            <span >Sección</span>
            <span ><?= htmlspecialchars($seccion) ?></span>
        </h2>
        
    </div>




      <!-- Botones de Acción -->
      <div class="flex flex-wrap gap-4 mb-8">
      <?php
      
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

          echo '<a href="ver_pdf.php?gradonombre='.$grado.'&&seccion='.$seccion.'" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
          </svg>
          Descargar PDF
          </a>';
      ?>
      </div>




      <!-- Buscador Mejorado -->
<div class="rounded-xl shadow-md overflow-hidden mb-6 bg-white ">
    <div class="px-6 py-4  flex flex-col md:flex-row md:items-center gap-4">
    
            <input type="hidden" name="gradonombre" value="<?= htmlspecialchars($grado) ?>">
            <input type="hidden" name="seccion" value="<?= htmlspecialchars($seccion) ?>">
            <h3 class="text-xl font-semibold flex-grow">Profesores</h3>
    </div>
</div>
    <!-- Tabla de Profesores -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10">
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
                    $stmt->bind_param("ss", $secc, $grado);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['apellido']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['cedula']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['grado_nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['seccion_nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 flex justify-center space-x-2">
                                        <a href="editar_profesor.php?editarid='.$row['id'].'" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200" title="Editar profesor">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                            </svg>
                                        </a>
                                        <button type="button" 
                                            class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200"
                                            data-modal-target="modal-eliminar-profesor-'.$row['id'].'" 
                                            data-modal-toggle="modal-eliminar-profesor-'.$row['id'].'"
                                            title="Eliminar profesor">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal Eliminar Profesor -->
                                <div id="modal-eliminar-profesor-'.$row['id'].'" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="flex items-center justify-between p-4 border-b rounded-t">
                                                <h3 class="text-lg font-semibold text-gray-900">Confirmar Eliminación</h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="modal-eliminar-profesor-'.$row['id'].'">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form method="POST" action="eliminar_profesor.php?eliminarid='.$row['id'].'">
                                                <div class="p-4">
                                                    <p class="text-base text-gray-600">¿Está seguro que desea eliminar permanentemente a <span class="font-bold">'.htmlspecialchars($row['nombre']).' '.htmlspecialchars($row['apellido']).'</span>?</p>
                                                    <p class="mt-2 text-sm text-red-600">Esta acción no se puede deshacer.</p>
                                                </div>
                                                <div class="flex items-center p-4 border-t space-x-2">
                                                    <button type="submit" name="registrar" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                        Sí, Eliminar
                                                    </button>
                                                    <button type="button" data-modal-hide="modal-eliminar-profesor-'.$row['id'].'" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    } else {
                        echo '<tr>
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                No se encontraron profesores registrados para este grado y sección.
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



      <?php
      
      
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Número de registros por página
$offset = ($page - 1) * $perPage;


    $sql = "SELECT SQL_CALC_FOUND_ROWS estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
        representante.nombre as representante_nombre, representante.cedula as cedularepre, 
        representante.telefono as telefono, representante.correo as correo
        FROM estudiantes  
        JOIN seccion ON estudiantes.idseccion = seccion.id 
        JOIN grados ON estudiantes.idgrado = grados.id
        JOIN representante ON estudiantes.idrepresentante = representante.id
        WHERE (estudiantes.nombre LIKE ? 
            OR estudiantes.apellido LIKE ? 
            OR estudiantes.cen LIKE ? 
            OR representante.cedula LIKE ? 
            OR representante.telefono LIKE ? 
            OR representante.correo LIKE ?)
        AND seccion.nombre = ?
        AND grados.nombre = ?
        ORDER BY estudiantes.nombre ASC
        LIMIT ? OFFSET ?";
    
    $stmt = $connect->prepare($sql);
    $searchTerm = "%$search%";
    $secc = strtoupper(trim($seccion));
    $stmt->bind_param("sssssssiii", 
        $searchTerm, 
        $searchTerm, 
        $searchTerm, 
        $searchTerm, 
        $searchTerm, 
        $searchTerm,
        $secc,
        $grado,
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



<!-- Buscador Mejorado -->
<div class="rounded-xl shadow-md overflow-hidden mb-6 bg-white ">
    <div class="px-6 py-4  flex flex-col md:flex-row md:items-center gap-4">
        <form method="GET" action="" class="flex flex-col md:flex-row md:items-center w-full gap-4">
            <input type="hidden" name="gradonombre" value="<?= htmlspecialchars($grado) ?>">
            <input type="hidden" name="seccion" value="<?= htmlspecialchars($seccion) ?>">
            <h3 class="text-xl font-semibold flex-grow">Estudiantes</h3>
            <div class="flex flex-grow max-w-lg relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por nombre, apellido, CEN, CI representante..."
                    value="<?= htmlspecialchars($search) ?>"
                    class="w-full px-4 py-2 rounded-l-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 text-gray-800 placeholder-gray-400 transition duration-150 ease-in-out shadow-sm"
                    autocomplete="off"
                >
                <button 
                    type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-r-lg hover:bg-green-700 transition-colors flex items-center gap-2"
                    title="Buscar"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke="currentColor" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" stroke="currentColor" stroke-linecap="round"/>
                    </svg>
                    <span class="hidden md:inline">Buscar</span>
                </button>
            </div>
            <?php if (!empty($search)): ?>
                <a href="?gradonombre=<?= urlencode($grado) ?>&seccion=<?= urlencode($seccion) ?>" 
                   class="ml-2 px-3 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors text-sm flex items-center gap-1"
                   title="Limpiar búsqueda">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Limpiar
                </a>
            <?php endif; ?>
        </form>
    </div>
    <?php if (!empty($search)): ?>
        <div class="px-6 py-2 bg-blue-100 text-blue-800 text-sm">
            Resultados para: <span class="font-semibold"><?= htmlspecialchars($search) ?></span>
        </div>
    <?php endif; ?>
</div>

      <!-- Tabla de Estudiantes con scroll responsivo -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="overflow-auto h-full">
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
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Formatear fechas para mejor visualización
            $fecha_nacimiento = date('d/m/Y', strtotime($row['nacimiento']));
            $telefono_formateado = !empty($row['telefono']) ? 
                preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1-$2-$3', $row['telefono']) : 
                'No registrado';
            
            echo '
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <!-- Datos del estudiante -->
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['nombre']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['apellido']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['cen']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.$fecha_nacimiento.'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['sexo']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['representante_nombre']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['cedularepre']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.$telefono_formateado.'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['correo']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['grado_nombre']).'</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">'.htmlspecialchars($row['seccion_nombre']).'</td>
                
                <!-- Acciones -->
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                    <div class="flex justify-center space-x-2">
                        <!-- Botón Editar -->
                        <a href="editar.php?editarid='.$row['id'].'" 
                           class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-200"
                           title="Editar estudiante">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </a>
                        
                        <!-- Botón Retirar -->
                        <button type="button" 
                                class="text-yellow-600 hover:text-yellow-900 p-2 rounded-full hover:bg-yellow-50 transition-colors duration-200"
                                data-modal-target="modal-retirar-'.$row['id'].'" 
                                data-modal-toggle="modal-retirar-'.$row['id'].'"
                                title="Retirar estudiante">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        
                        <!-- Botón Eliminar -->
                        <button type="button" 
                                class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-200"
                                data-modal-target="modal-eliminar-'.$row['id'].'" 
                                data-modal-toggle="modal-eliminar-'.$row['id'].'"
                                title="Eliminar estudiante">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    
        
                </td>
            </tr>
            
            
            <!-- Modal Retirar -->
                    <div id="modal-retirar-'.$row['id'].'" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="flex items-center justify-between p-4 border-b rounded-t">
                                    <h3 class="text-lg font-semibold text-gray-900">Retirar Estudiante</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="modal-retirar-'.$row['id'].'">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                    </button>
                                </div>
                              <form method="POST" id="formulario-'.$row['id'].'" action="retirar_estudiante.php?eliminarid='.$row['id'].'">
                                  <div class="p-4 space-y-4">
                                        <p class="text-base text-gray-600">Por favor indique el motivo del retiro:</p>
                                        <div class="mb-4">
                                            <textarea name="motivo" id="motivo-retirar-'.$row['id'].'" rows="3" class="w-full motivo px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-4 border-t space-x-2">
                                        <button type="submit" name="registrar" id="btn" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                            Confirmar Retiro
                                        </button>
                                        <button type="button" data-modal-hide="modal-retirar-'.$row['id'].'" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Eliminar -->
                    <div id="modal-eliminar-'.$row['id'].'" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="flex items-center justify-between p-4 border-b rounded-t">
                                    <h3 class="text-lg font-semibold text-gray-900">Confirmar Eliminación</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="modal-eliminar-'.$row['id'].'">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                    </button>
                                </div>
                                <form method="POST" action="eliminar.php?eliminarid='.$row['id'].'" ">
                                    <div class="p-4">
                                        <p class="text-base text-gray-600">¿Está seguro que desea eliminar permanentemente a <span class="font-bold">'.htmlspecialchars($row['nombre']).' '.htmlspecialchars($row['apellido']).'</span>?</p>
                                        <p class="mt-2 text-sm text-red-600">Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="flex items-center p-4 border-t space-x-2">
                                        <button type="submit" name="registrar" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            Sí, Eliminar
                                        </button>
                                        <button type="button" data-modal-hide="modal-eliminar-'.$row['id'].'" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    



                    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const form = document.getElementById("formulario-'.$row['id'].'");
                        const btn = document.getElementById("btn");
                        const inputs = {
                            motivo: document.getElementById("motivo-retirar-'.$row['id'].'"),
                        };

                        const regex = {
                            soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/
                        };

                        const LIMITES = {
                            motivo: { min: 2, max: 25 },
                        };

                        const mostrarNotificacion = (mensaje, tipo = "error") => {
                            const sanitizeHTML = (str) => {
                                const temp = document.createElement("div");
                                temp.textContent = str;
                                return temp.innerHTML;
                            };

                            const icono = tipo === "error" ?
                                `<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
                                </svg>` :
                                `<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
                                </svg>`;

                            const color = tipo === "error" ? "bg-red-100 border-red-400 text-red-700" : "bg-green-100 border-green-400 text-green-700";

                            document.querySelectorAll(".notificacion").forEach(el => el.remove());

                            const notificacion = document.createElement("div");
                            notificacion.className = `notificacion fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center z-50`;
                            notificacion.innerHTML = `
                                <div class="flex-shrink-0 mr-3">${icono}</div>
                                <div class="text-sm">${sanitizeHTML(mensaje)}</div>
                            `;

                            document.body.appendChild(notificacion);

                            setTimeout(() => {
                                notificacion.classList.add("opacity-0", "transition-opacity", "duration-500");
                                setTimeout(() => notificacion.remove(), 500);
                            }, 4000);
                        };

                        const validarCampo = (input, regex = null, minLength = 0, maxLength = Infinity, mensaje = null) => {
                            const valor = input.value.trim();
                            input.classList.remove("border-red-500");

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
                            // Limpiar errores previos
                            Object.values(inputs).forEach(input => input.classList.remove("border-red-500"));

                            // Validaciones
                            const validaciones = [
                                { input: inputs.motivo, resultado: validarCampo(inputs.motivo, regex.soloLetras, LIMITES.motivo.min, LIMITES.motivo.max, "Motivo inválido") }
                            ];

                            // Verificar si hay errores
                            const errores = validaciones.filter(v => !v.resultado.valido);

                            if (errores.length > 0) {
                                e.preventDefault(); // Detener el envío si hay errores
                                errores[0].input.classList.add("border-red-500");
                                mostrarNotificacion(errores[0].resultado.mensaje);
                            }
                            // Si no hay errores, el formulario se enviará automáticamente
                        });
                    });
                    </script>



                    ';


                    
        }
    } else {
        echo '<tr>
                <td colspan="12" class="px-4 py-6 text-center text-sm text-gray-500">
                    No se encontraron estudiantes registrados
                </td>
              </tr>';
    }
    ?>
</tbody>        
</table>

    <!-- Paginación -->
    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-700">
                Mostrando <?= ($offset + 1) ?> a <?= min($offset + $perPage, $totalRows) ?> de <?= $totalRows ?> resultados
            </span>
            <div class="flex gap-1">
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
            <span>Haz clic en el icono de editar para modificar la información.</span>
            </div>
            <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
            </svg>
            <span>Haz clic en el icono de retirar para marcar a un estudiante como retirado, deberas indicar el motivo.</span>
            </div>
            <div class="flex items-center">
            <svg class="w-4 h-4 mr-2 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>Haz clic en el icono de eliminar para eliminar un registro de forma permanente.</span>
            </div>
            <div class="tooltip-arrow" data-popper-arrow></div>
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
 

  <!-- Scripts -->
  <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
  <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
</body>
</html>