<?php
ob_start(); // Iniciar buffer de salida
session_start();

$usuario = $_SESSION['nombre_usuario'];

if (!isset($usuario)) {
    header("location: login.php");
    exit(); // Añadir exit después de header
} else {
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
            
            <table class="w-full border-collapse" style="page-break-inside: avoid;">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="text-left py-2 px-3 border border-gray-400 text-xs font-bold">Nombre</th>
                        <th class="text-left py-2 px-3 border border-gray-400 text-xs font-bold">Apellido</th>
                        <th class="text-left py-2 px-3 border border-gray-400 text-xs font-bold">Cédula</th>
                        <th class="text-left py-2 px-3 border border-gray-400 text-xs font-bold">Grado</th>
                        <th class="text-left py-2 px-3 border border-gray-400 text-xs font-bold">Sección</th>
                    </tr>
                </thead>
                <tbody>
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
                                <td class="py-2 px-3 border border-gray-300 text-xs">'.htmlspecialchars($row['nombre']).'</td>
                                <td class="py-2 px-3 border border-gray-300 text-xs">'.htmlspecialchars($row['apellido']).'</td>
                                <td class="py-2 px-3 border border-gray-300 text-xs">'.htmlspecialchars($row['cedula']).'</td>
                                <td class="py-2 px-3 border border-gray-300 text-xs">'.htmlspecialchars($row['grado_nombre']).'</td>
                                <td class="py-2 px-3 border border-gray-300 text-xs">'.htmlspecialchars($row['seccion_nombre']).'</td>
                            </tr>';
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
            
            <table class="w-full border-collapse" style="page-break-inside: avoid;">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">#</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">Nombres</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">Apellidos</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">C.E.N</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">Sexo</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">Representante</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">C.I</th>
                        <th class="text-left py-2 px-2 border border-gray-400 text-xs font-bold">Teléfono</th>
                    </tr>
                </thead>
                <tbody>
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
                    $counter = 1;
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td class="py-2 px-2 border border-gray-300 text-xs text-center">'.$counter++.'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['nombre']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['apellido']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['cen']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['sexo']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['representante_nombre']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['cedularepre']).'</td>
                                <td class="py-2 px-2 border border-gray-300 text-xs">'.htmlspecialchars($row['telefono']).'</td>
                            </tr>';
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

// Ruta relativa recomendada
require_once __DIR__ . '/pdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

try {
    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array('isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();
    $dompdf->stream("Estudiantes.pdf", array("Attachment" => false));
    
} catch (Exception $e) {
    echo "Error al generar PDF: " . $e->getMessage();
}
?>