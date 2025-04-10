<?php
session_start();
ob_start();
error_reporting(0);

// Validar que el usuario esté autenticado
$usuario = $_SESSION['nombre_usuario'] ?? '';
if (empty($usuario)) {
    header('Location: ../../login/login.php');
    die();
}

// Conectar a la base de datos
require_once '../../connect.php';

// Validar y sanitizar el parámetro 'id'
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("ID inválido o ausente");
}

// Preparar consulta SQL para evitar inyección
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

$stmt = mysqli_prepare($connect, $query);
if ($stmt) {
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

// Formatear los datos para mostrarlos
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
    <title>Constancia de Aceptación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <!-- Cabecera -->
        <header class="d-flex justify-content-between align-items-center bg-dark text-white p-3 rounded">
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="img-fluid" style="width: 15%;">
            <div class="text-center">
                <h5>REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
                <h5>E.P.N CESAR ARTEAGA CASTRO</h5>
                <h5>CÓDIGO PLANTEL: 006568032</h5>
                <h5>SANTA ANA DE CORO, ESTADO FALCÓN</h5>
            </div>
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="img-fluid" style="width: 15%;">
        </header>

        <!-- Contenido -->
        <main class="my-4 text-center">
            <h4>Constancia de Aceptación</h4>
            <p>
                Reciba un cordial saludo de parte del personal que labora en la E.P.N CESAR ARTEAGA CASTRO, ubicada en la Av. Los Orumos de la Ciudad de Coro, Municipio Miranda. Por medio de la presente me dirijo a usted para hacer de su conocimiento que el estudiante <b><?= $nombre . ' ' . $apellido ?></b>, C.E\C.I N° <b><?= $cen ?></b>, de ______ años de edad, fue inscrito(a) en este plantel para cursar el: <b><?= $grado ?></b> grado, Sección "<b><?= $seccion ?></b>" Año Escolar ______.
            </p>
            <p>
                Representante: <b><?= $representante ?></b>, C.I N° <b><?= $cedula ?></b>.
            </p>
            <p>
                CONSTANCIA QUE SE EXPIDE EN SANTA ANA DE CORO, A LOS ______ DÍAS DEL MES DE ______ DEL AÑO ______.
            </p>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$html = ob_get_clean();

// Generar PDF usando Dompdf
require_once 'C:\xampp\htdocs\dashboard\Proyecto\pdf\dompdf\autoload.inc.php';

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
