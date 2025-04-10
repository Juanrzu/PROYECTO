<?php
session_start();
ob_start();

// Habilitar reporte de errores solo durante el desarrollo (modificar según entorno)
// error_reporting(E_ALL);
error_reporting(0);

// Verificar si el usuario está autenticado
if (empty($_SESSION['nombre_usuario'])) {
    header('Location: ../../login/login.php');
    exit();
}

require_once '../../connect.php';

// Validar que el parámetro 'id' esté presente y sea numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido");
}

$id = (int) $_GET['id'];

// Preparar la consulta para evitar inyecciones SQL
$query = "SELECT 
    e.*, 
    s.nombre AS seccion_nombre, 
    g.nombre AS grado_nombre, 
    r.nombre AS representante_nombre, 
    r.apellido AS representante_apellido,
    r.cedula AS representante_cedula, 
    r.telefono AS representante_telefono,
    r.correo AS representante_correo 
FROM estudiantes e
JOIN seccion s ON e.idseccion = s.id 
JOIN grados g ON e.idgrado = g.id
JOIN representante r ON e.idrepresentante = r.id
WHERE e.id = ?";

if ($stmt = mysqli_prepare($connect, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
        die("No se encontró el estudiante");
    }
    mysqli_stmt_close($stmt);
} else {
    die("Error en la consulta");
}

// Procesar y formatear los datos
$nombre = strtoupper(trim($row['nombre']));
$apellido = strtoupper(trim($row['apellido']));
$cen = $row['cen'];
$nacimiento = $row['nacimiento'];
$sexo = $row['sexo'];
$representante = $row['representante_nombre'];
$representante_apellido = $row['representante_apellido'];
$cedula = $row['representante_cedula'];
$telefono = $row['representante_telefono'];
$correo = $row['representante_correo'];
$grado = $row['grado_nombre'];
$seccion = $row['seccion_nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Estudio</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/constancias/estudio/styles.css">
</head>
<body>
  <div class="d-flex flex-column flex-shrink-0" style="height: 100vh;">
      <header class="d-flex align-items-center bg-dark text-white px-4 py-2 justify-content-between">
         <div class="prueba">
            <img class="imagen" src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" style="width: 15%; height: 9%;">
            <img class="imagen2" src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" style="width: 15%; height: 9%;">
         </div>
         <div class="encabezado text-center">
            <h5>REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
            <h5>E.P.N CESAR ARTEAGA CASTRO</h5>
            <h5>CÓDIGO PLANTEL: 006568032</h5>
            <h5>SANTA ANA DE CORO, ESTADO FALCÓN</h5>
         </div>
         <div class="titulo text-center">
            <h4>Constancia de Estudio</h4>
         </div>
      </header>
      <div class="texto text-center my-4" style="line-height: 1.5;">
         <p>
            Reciba un cordial saludo de parte del personal que labora en la E.P.N CESAR ARTEAGA CASTRO, ubicada en la Av. los Orumos de la Ciudad de Coro, Municipio Miranda. Por medio de la presente, se hace de su conocimiento que el estudiante <strong><?php echo htmlspecialchars("$nombre $apellido"); ?></strong> C.E\C.I N° <strong><?php echo htmlspecialchars($cen); ?></strong>, de _____ años de edad, fue inscrito(a) en este plantel para cursar el <strong><?php echo htmlspecialchars($grado); ?></strong> grado, Sección <strong><?php echo htmlspecialchars($seccion); ?></strong> para el año escolar __________.
         </p>
         <p>
            Representante: <strong><?php echo htmlspecialchars($representante); ?></strong>, C.I N° <strong><?php echo htmlspecialchars($cedula); ?></strong>.
         </p>
         <p>
            CONSTANCIA QUE SE EXPIDE EN SANTA ANA DE CORO, A LOS ______ DÍAS DEL MES DE ______ DEL AÑO ____.
         </p>
      </div>
  </div>
</body>
</html>
<?php
$html = ob_get_clean();

// Configuración y generación del PDF usando Dompdf
require_once 'C:\xampp\htdocs\dashboard\Proyecto\pdf\dompdf\autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set('isHtml5ParserEnabled', true);
$dompdf->setOptions($options);

$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>
