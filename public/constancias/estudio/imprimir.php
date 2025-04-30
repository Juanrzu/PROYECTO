<?php
session_start();
ob_start();

// Configuración de entorno: habilitar/deshabilitar el reporte de errores
error_reporting(0); // Cambiar a error_reporting(E_ALL); en entornos de desarrollo

// Verificar si el usuario está autenticado
if (empty($_SESSION['nombre_usuario'])) {
    header('Location: ../../login/login.php');
    exit();
}

// Incluir la conexión a la base de datos
require_once '../../connect.php';

// Validar y sanitizar el parámetro 'id'
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Parámetro 'ID' inválido o ausente");
}

// Preparar la consulta para evitar inyección SQL
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
        die("Estudiante no encontrado.");
    }
    mysqli_stmt_close($stmt);
} else {
    die("Error en la consulta.");
}

// Formatear los datos extraídos de la base de datos
$nombre = strtoupper(trim($row['nombre']));
$apellido = strtoupper(trim($row['apellido']));
$cen = htmlspecialchars($row['cen']);
$nacimiento = htmlspecialchars($row['nacimiento']);
$sexo = htmlspecialchars($row['sexo']);
$representante = htmlspecialchars($row['representante_nombre']);
$representante_apellido = htmlspecialchars($row['representante_apellido']);
$cedula = htmlspecialchars($row['representante_cedula']);
$telefono = htmlspecialchars($row['representante_telefono']);
$correo = htmlspecialchars($row['representante_correo']);
$grado = htmlspecialchars($row['grado_nombre']);
$seccion = htmlspecialchars($row['seccion_nombre']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Estudio</title>
    <!-- Usando Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <!-- Encabezado -->
    <header class="d-flex justify-content-between align-items-center bg-dark text-white p-3 rounded">
        <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="img-fluid" style="width: 15%; height: auto;">
        <div class="text-center">
            <h5>REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
            <h5>E.P.N CESAR ARTEAGA CASTRO</h5>
            <h5>CÓDIGO PLANTEL: 006568032</h5>
            <h5>SANTA ANA DE CORO, ESTADO FALCÓN</h5>
        </div>
    </header>

    <!-- Contenido del documento -->
    <main class="my-4">
        <h4 class="text-center">Constancia de Estudio</h4>
        <p class="text-center">
            Reciba un cordial saludo de parte del personal que labora en la E.P.N CESAR ARTEAGA CASTRO, ubicada en la Av. los Orumos de la Ciudad de Coro, Municipio Miranda. Por medio de la presente, se hace de su conocimiento que el estudiante <strong><?php echo "$nombre $apellido"; ?></strong>, C.E\C.I N° <strong><?php echo $cen; ?></strong>, de ______ años de edad, fue inscrito(a) en este plantel para cursar el <strong><?php echo $grado; ?></strong> grado, Sección <strong><?php echo $seccion; ?></strong>, para el año escolar __________.
        </p>
        <p class="text-center">
            Representante: <strong><?php echo $representante; ?></strong>, C.I N° <strong><?php echo $cedula; ?></strong>.
        </p>
        <p class="text-center">
            CONSTANCIA QUE SE EXPIDE EN SANTA ANA DE CORO, A LOS ______ DÍAS DEL MES DE ______ DEL AÑO ____.
        </p>
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$html = ob_get_clean();

// Generar PDF usando Dompdf
require_once '../../pdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream("Constancia_Estudio.pdf", array("Attachment" => false));
?>

