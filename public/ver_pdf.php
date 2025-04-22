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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Escolar - E.P.N "Cesar Arteaga Castro"</title>
    <style>
    /* Estilos generales para el documento */
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.5;
        color: #333;
        margin: 0;
        padding: 0;
        background-color: #fff;
    }

    /* Encabezado institucional */
    .header {
        background-color: #2c3e50;
        color: white;
        padding: 20px 0;
        text-align: center;
        border-bottom: 3px solid #e74c3c;
        margin-bottom: 30px;
    }

    .header img {
        height: 80px;
        margin-bottom: 15px;
    }

    .header h5 {
        margin: 5px 0;
        font-weight: normal;
    }

    .header h5:first-child {
        font-weight: bold;
        font-size: 1.2em;
    }

    /* Títulos de sección */
    .section-title {
        background-color: #f8f9fa;
        color: #2c3e50;
        padding: 8px 15px;
        margin: 25px 0 15px 0;
        border-left: 4px solid #e74c3c;
        font-size: 1.1em;
        font-weight: bold;
    }

    /* Tablas */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        font-size: 11px;
        page-break-inside: avoid;
    }

    th {
        background-color: #f8f9fa;
        color: #2c3e50;
        text-align: left;
        padding: 10px 8px;
        border-bottom: 2px solid #ddd;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8em;
        letter-spacing: 0.5px;
    }

    td {
        padding: 8px;
        border-bottom: 1px solid #eee;
        vertical-align: top;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Mensaje cuando no hay datos */
    .no-data {
        text-align: center;
        color: #7f8c8d;
        font-style: italic;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 4px;
        margin: 20px 0;
    }

    /* Pie de página */
    .footer {
        text-align: center;
        font-size: 0.8em;
        color: #7f8c8d;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    /* Estilos específicos para impresión */
    @media print {
        body {
            font-size: 12pt;
            padding: 0;
            margin: 0;
        }
        
        .header {
            padding: 15px 0;
            margin-bottom: 20px;
        }
        
        table {
            font-size: 5px;
        }
        
        th, td {
            padding: 6px 4px;
        }
        
        .no-print {
            display: none;
        }
        
        @page {
            size: A4;
            margin: 1cm;
        }
    }
</style>
</head>
<body class="bg-white text-gray-800">
    <!-- Encabezado institucional -->
    <header class="header">
        <div style="display: flex; align-items: center; justify-content: center;">
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="logo">
            <div >
                <h5>REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
                <h5>E.P.N "CESAR ARTEAGA CASTRO"</h5>
                <h5>SANTA ANA DE CORO, ESTADO FALCÓN</h5>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main>
        <!-- Sección de Docentes -->
        <section>
            <h2 class="section-title">Docentes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Grado</th>
                        <th>Sección</th>
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
                    $stmt->bind_param("si", $seccion, $grado);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>'.htmlspecialchars($row['nombre']).'</td>
                                <td>'.htmlspecialchars($row['apellido']).'</td>
                                <td>'.htmlspecialchars($row['cedula']).'</td>
                                <td>'.htmlspecialchars($row['grado_nombre']).'</td>
                                <td>'.htmlspecialchars($row['seccion_nombre']).'</td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="no-data">No hay docentes registrados</td></tr>';
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Sección de Estudiantes -->
            <h2 class="section-title">Estudiantes del Grado <?php echo htmlspecialchars($_GET['gradonombre']); ?> Sección <?php echo htmlspecialchars(strtoupper(trim($_GET['seccion']))); ?></h2>
            
            <table >
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>C.E.N</th>
                        <th>Nacimiento</th>
                        <th>Sexo</th>
                        <th>Representante</th>
                        <th>C.I Representante</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
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
                    $stmt->bind_param("si", $seccion, $grado);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>'.htmlspecialchars($row['nombre']).'</td>
                                <td>'.htmlspecialchars($row['apellido']).'</td>
                                <td>'.htmlspecialchars($row['cen']).'</td>
                                <td>'.htmlspecialchars($row['nacimiento']).'</td>
                                <td>'.htmlspecialchars($row['sexo']).'</td>
                                <td>'.htmlspecialchars($row['representante_nombre']).'</td>
                                <td>'.htmlspecialchars($row['cedularepre']).'</td>
                                <td>'.htmlspecialchars($row['telefono']).'</td>
                                <td>'.htmlspecialchars($row['correo']).'</td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9" class="no-data">No hay estudiantes registrados</td></tr>';
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <p>Sistema de Gestión Escolar - E.P.N "Cesar Arteaga Castro"</p>
        <p>Documento generado el <?php echo date('d/m/Y H:i:s'); ?></p>
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