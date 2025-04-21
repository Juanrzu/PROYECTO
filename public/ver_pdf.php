<?php
  session_start();

  $usuario = $_SESSION['nombre_usuario'];

  if (!isset($usuario)) {
    header("location: login/login.php");
  } else{
    include('connect.php');
    include 'contador_sesion.php';
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Profesor</title>

</head>

<body class="bg-white text-gray-800">
    <!-- Encabezado -->
    <header class="flex items-center justify-between bg-gray-800 text-white px-6 py-4 mb-8">
        <div class="header-title text-xl md:text-3xl">
            <h1>E.P.N "Cesar Arteaga Castro"</h1>
        </div>
        <div class="text-sm text-gray-300">
            <?php echo date('d/m/Y'); ?>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="px-6">
        <!-- Sección de Docentes -->
        <section class="mb-12">
            <h2 class="text-xl font-bold mb-4 text-gray-700 border-b pb-2">Docentes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php 
                        $grado = $_GET['gradonombre'];
                        $seccion = strtoupper(trim($_GET['seccion']));
                        
                        $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
                                FROM profesor 
                                JOIN seccion ON profesor.idseccion = seccion.id 
                                JOIN grados ON profesor.idgrado = grados.id 
                                WHERE seccion.nombre = ? AND grados.nombre = ?";
                        
                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("ss", $seccion, $grado);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['apellido']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['cedula']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['grado_nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['seccion_nombre']).'</td>
                                </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No hay docentes registrados</td></tr>';
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Sección de Estudiantes -->
        <section>
            <h2 class="text-xl font-bold mb-4 text-gray-700 border-b pb-2">Estudiantes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.E.N</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nacimiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Representante</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">C.I Representante</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
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
                                WHERE seccion.nombre = ? AND grados.nombre = ?";
                        
                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("ss", $seccion, $grado);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['apellido']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['cen']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['nacimiento']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['sexo']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['representante_nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['cedularepre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['telefono']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['correo']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['grado_nombre']).'</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.htmlspecialchars($row['seccion_nombre']).'</td>
                                </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500">No hay estudiantes registrados</td></tr>';
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="mt-12 px-6 py-4 text-xs text-gray-500 border-t">
        <p>Generado el <?php echo date('d/m/Y H:i:s'); ?></p>
    </footer>
</body>
</html>