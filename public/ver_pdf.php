<?php
  session_start();
  error_reporting(0);
  ob_start();

  $usuario = $_SESSION['nombre_usuario'];
  if (!isset($usuario)) {
    header("location: login/login.php");
  } else{
    include('connect.php');
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Profesor</title>

</head>

<body class="bg-white text-gray-800" style="font-family: 'Arial', sans-serif;">
    <!-- Encabezado simplificado para PDF -->
    <header class="bg-gray-800 text-white p-4 rounded shadow-md">
        <div class="container mx-auto flex items-center justify-center">
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="w-24 h-auto mr-4">
            <div class="text-center">
                <h5 class="text-lg font-semibold uppercase">REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
                <h5 class="text-lg uppercase">E.P.N "CESAR ARTEAGA CASTRO"</h5>
                <h5 class="text-lg">SANTA ANA DE CORO, ESTADO FALCÓN</h5>
            </div>
        </div>
    </header>

    <!-- Contenido principal optimizado para PDF -->
    <main class="px-2">
        <!-- Sección de Docentes optimizada -->
        <section class="mb-10">
            <h2 class="text-lg font-bold mb-3 bg-gray-100 px-3 py-2 rounded">Docentes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
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
                        $stmt->bind_param("si", $seccion, $grado);
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
                    } else {
                        echo '<tr><td colspan="5" class="py-2 px-3 border border-gray-300 text-xs text-center italic">No hay docentes registrados</td></tr>';
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Sección de Estudiantes optimizada para PDF -->
        <section>
            <h2 class="text-lg font-bold mb-3 bg-gray-100 px-3 py-2 rounded">Estudiantes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
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
                        $stmt->bind_param("si", $seccion, $grado);
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
                    } else {
                        echo '<tr><td colspan="8" class="py-2 px-2 border border-gray-300 text-xs text-center italic">No hay estudiantes registrados</td></tr>';
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Pie de página para PDF -->
    <footer class="mt-8 pt-4 border-t border-gray-300 text-center text-xs text-gray-600">
        <p>Sistema de Gestión Escolar - E.P.N "Cesar Arteaga Castro"</p>
        <p>Documento generado el <?php echo date('d/m/Y H:i:s'); ?></p>
    </footer>

    <style>
        @media print {
            body {
                font-size: 10pt;
                padding: 0.5cm;
            }
            table {
                font-size: 9pt;
            }
            h1, h2 {
                color: #000 !important;
            }
            .bg-gray-200 {
                background-color: #f0f0f0 !important;
                
            }
            .border, .border-gray-300, .border-gray-400 {
                border-color: #ddd !important;
            }
        }
    </style>

    <!-- Pie de página -->
    <footer class="mt-12 px-6 py-4 text-xs text-gray-500 border-t">
        <p>Generado el <?php echo date('d/m/Y H:i:s'); ?></p>
    </footer>
</body>
</html>
<?php
$html = ob_get_clean();

// Generar PDF usando Dompdf
require_once 'D:\Programas\Xammp\htdocs\dashboard\proyecto\pdf\dompdf\autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream("Constancia_Aceptacion.pdf", array("Attachment" => false));
?>