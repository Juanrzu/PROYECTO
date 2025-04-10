<?php
include '../../connect.php';

// Obtener y sanear los parámetros desde GET
$seccionInput = filter_input(INPUT_GET, 'seccion', FILTER_SANITIZE_STRING);
$gradoInput   = filter_input(INPUT_GET, 'grado', FILTER_SANITIZE_STRING);

// Verificar que se reciban los filtros necesarios
if (!$seccionInput || !$gradoInput) {
    die("Parámetros insuficientes.");
}

$secc  = strtoupper(trim($seccionInput));
$grado = trim($gradoInput);

// Preparamos la consulta para prevenir inyecciones SQL
$query = "SELECT 
            estudiantes.*, 
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
          WHERE seccion.nombre = ? AND grados.nombre = ?
          ORDER BY estudiantes.nombre ASC";

if (!$stmt = mysqli_prepare($connect, $query)) {
    die("Error en la preparación de la consulta: " . mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt, "ss", $secc, $grado);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Estudiantes</title>
  <!-- Se incluye Tailwind CSS a través de CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
  <main class="mb-4 xl:px-56 mt-8">
    <div class="overflow-x-auto shadow-md sm:rounded-lg -z-10 m-10 xl:m-4">
      <table class="w-full text-md text-left rtl:text-right text-black dark:text-gray-400">
        <thead class="text-xs text-black uppercase dark:text-gray-400">
          <tr>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Nombres</th>
            <th scope="col" class="px-3 py-2">Apellidos</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">C.E.N</th>
            <th scope="col" class="px-3 py-2">Nacimiento</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sexo</th>
            <th scope="col" class="px-3 py-2">Representante</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">C.I Representante</th>
            <th scope="col" class="px-3 py-2">Teléfono</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Correo Electrónico</th>
            <th scope="col" class="px-3 py-2">Grado</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sección</th>
            <th scope="col" class="px-3 py-2 bg-blue-400 dark:bg-blue-800"></th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && mysqli_num_rows($result) > 0): ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="border-b border-gray-900 dark:border-gray-700">
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['nombre']) ?></td>
                  <td class="px-3 py-2"><?= htmlspecialchars($row['apellido']) ?></td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['cen']) ?></td>
                  <td class="px-3 py-2"><?= htmlspecialchars($row['nacimiento']) ?></td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['sexo']) ?></td>
                  <td class="px-3 py-2"><?= htmlspecialchars($row['representante_nombre']) ?></td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['cedularepre']) ?></td>
                  <td class="px-3 py-2"><?= htmlspecialchars($row['telefono']) ?></td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['correo']) ?></td>
                  <td class="px-3 py-2"><?= htmlspecialchars($row['grado_nombre']) ?></td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800"><?= htmlspecialchars($row['seccion_nombre']) ?></td>
                  <td class="px-3 py-2 bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                    <button class="w-full">
                      <a href="imprimir.php?id=<?= $row['id'] ?>" class="px-3 py-2 block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                          <g id="File / Cloud_Upload">
                            <path id="Vector" d="M12 16V10M12 10L9 12M12 10L15 12M23 15C23 12.7909 21.2091 11 19 11C18.9764 11 18.9532 11.0002 18.9297 11.0006C18.4447 7.60802 15.5267 5 12 5C9.20335 5 6.79019 6.64004 5.66895 9.01082C3.06206 9.18144 1 11.3498 1 13.9999C1 16.7613 3.23858 19.0001 6 19.0001L19 19C21.2091 19 23 17.2091 23 15Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </g>
                        </svg>
                      </a>
                    </button>
                  </td>
                </tr>
              <?php endwhile; ?>
          <?php else: ?>
                <tr>
                  <td colspan="12" class="px-3 py-2 text-center">No se encontraron registros.</td>
                </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Botón fijo con tooltip -->
    <button data-tooltip-target="tooltip" type="button"
      class="fixed right-2 bottom-16 ghost rounded-full font-medium text-sm px-4 py-2.5 text-center outline outline-1 outline-black">
      <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
        <path d="M12 20H12.01" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="#323232" stroke-width="2" stroke-linecap="round" />
      </svg>
    </button>

    <div id="tooltip" role="tooltip"
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium ghost transition-opacity duration-300 bg-gray-800 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      <p class="flex items-center">
        Haz click en 
        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line">
          <path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;" />
          <path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;" />
        </svg>
        para entrar los grados
      </p>
      <p class="flex items-center mt-2">
        Haz click en 
        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 -0.5 21 21" version="1.1">
          <title>delete [#1487]</title>
          <desc>Created with Sketch.</desc>
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Dribbble-Light-Preview" transform="translate(-179 -360)" fill="#FF0000">
              <g id="icons" transform="translate(56 160)">
                <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]"></path>
              </g>
            </g>
          </g>
        </svg>
        para entrar los grados
      </p>
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
  </main>
</body>
</html>
<?php
// Cerramos el statement para liberar recursos
mysqli_stmt_close($stmt);
?>
