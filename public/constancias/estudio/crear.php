<?php
session_start();
include('../../connect.php');

$usuario = $_SESSION['nombre_usuario'];

// Incluimos el header según el usuario
if ($usuario === "admin" || $usuario === "Admin") {
    include('../../header_admin.php');
} else {
    include('../../header.php');
    include '../../contador_sesion.php';
}

// Obtenemos y saneamos los parámetros de la URL
$grado   = isset($_GET['gradonombre']) ? trim($_GET['gradonombre']) : "";
$seccion = isset($_GET['seccion'])     ? trim($_GET['seccion'])     : "";

if (empty($grado) || empty($seccion)) {
    die("Faltan parámetros necesarios.");
}

$secc = strtoupper($seccion);

// Recordar: Aquí se debe haber incluido la conexión (por ejemplo, a través de header o previamente)
// Si no, se debe hacer:
// include('../../connect.php');

// CONSTRUCCIÓN DE LA CONSULTA (se utiliza la misma consulta, pues las dos ramas eran idénticas)
// IMPORTANTE: Se usan comillas simples en la comparación de grado, ya que es un string.
$sql = "SELECT estudiantes.*, 
               seccion.nombre AS seccion_nombre, 
               grados.nombre AS grado_nombre, 
               representante.nombre AS representante_nombre, 
               representante.cedula AS cedularepre, 
               representante.telefono AS telefono, 
               representante.correo AS correo
        FROM estudiantes  
        JOIN seccion ON estudiantes.idseccion = seccion.id 
        JOIN grados ON estudiantes.idgrado = grados.id
        JOIN representante ON estudiantes.idrepresentante = representante.id
        WHERE seccion.nombre = '$secc' AND grados.nombre = '$grado'
        ORDER BY estudiantes.nombre ASC";

$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>constancias</title>

</head>

<body>
<main class="my-8 px-4 md:px-8 lg:px-56">
  <div class="overflow-x-auto shadow-lg rounded-lg mx-auto my-4">
    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
      <thead class="text-xs text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
        <tr>
          <th scope="col" class="px-4 py-2">Nombres</th>
          <th scope="col" class="px-4 py-2">Apellidos</th>
          <th scope="col" class="px-4 py-2">C.E.N</th>
          <th scope="col" class="px-4 py-2">Nacimiento</th>
          <th scope="col" class="px-4 py-2">Sexo</th>
          <th scope="col" class="px-4 py-2">Representante</th>
          <th scope="col" class="px-4 py-2">C.I Representante</th>
          <th scope="col" class="px-4 py-2">Teléfono</th>
          <th scope="col" class="px-4 py-2">Correo Electrónico</th>
          <th scope="col" class="px-4 py-2">Grado</th>
          <th scope="col" class="px-4 py-2">Sección</th>
          <th scope="col" class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="even:bg-gray-50 dark:even:bg-gray-700">
              <td class="px-4 py-2"><?= htmlspecialchars($row['nombre']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['apellido']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['cen']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['nacimiento']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['sexo']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['representante_nombre']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['cedularepre']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['telefono']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['correo']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['grado_nombre']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['seccion_nombre']) ?></td>
              <td class="px-4 py-2">
                <button class="w-full bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors ease-in-out duration-200">
                  <a href="imprimir.php?id=<?= $row['id'] ?>" class="block p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                      <g id="File / Cloud_Upload">
                        <path id="Vector" d="M12 16V10M12 10L9 12M12 10L15 12M23 15C23 12.7909 21.2091 11 19 11C18.9764 11 18.9532 11.0002 18.9297 11.0006C18.4447 7.60802 15.5267 5 12 5C9.20335 5 6.79019 6.64004 5.66895 9.01082C3.06206 9.18144 1 11.3498 1 13.9999C1 16.7613 3.23858 19.0001 6 19.0001L19 19C21.2091 19 23 17.2091 23 15Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </svg>
                  </a>
                </button>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="12" class="px-4 py-2 text-center">No se encontraron registros.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <!-- Botón fijo con tooltip -->
  <button data-tooltip-target="tooltip" type="button" class="fixed right-4 bottom-16 bg-blue-500 hover:bg-blue-600 text-white rounded-full p-3 shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none">
      <path d="M12 20H12.01" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
    </svg>
  </button>
  <div id="tooltip" role="tooltip" class="absolute z-20 invisible px-3 py-2 text-sm bg-gray-800 text-white rounded shadow-lg opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
    <p class="flex items-center">
      Haz click en 
      <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="25" height="25" viewBox="0 0 24 24" id="edit-alt">
        <path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="stroke-width: 2;"></path>
        <path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;"></path>
      </svg> para entrar los grados
    </p>
    <p class="flex items-center mt-2">
      Haz click en 
      <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 -0.5 21 21" version="1.1">
        <title>delete [#1487]</title>
        <desc>Created with Sketch.</desc>
        <g id="Page-1" fill="none" fill-rule="evenodd">
          <g transform="translate(-179 -360)" fill="#FF0000">
            <g transform="translate(56 160)">
              <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z"></path>
            </g>
          </g>
        </g>
      </svg> para entrar los grados
    </p>
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
</main>

</body>
</html>