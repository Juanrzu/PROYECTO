<?php
session_start();
error_reporting(0);
ob_start();



include '../../connect.php';
$id=$_GET['id'];




$sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
representante.nombre as representante_nombre, representante.apellido as representante_apellido,
representante.cedula as representante_cedula, representante.telefono as representante_telefono,
representante.correo as representante_correo 
FROM estudiantes 
JOIN seccion ON estudiantes.idseccion = seccion.id 
JOIN grados ON estudiantes.idgrado = grados.id
JOIN representante On estudiantes.idrepresentante = representante.id
WHERE estudiantes.id=$id ";

$result = mysqli_query($connect, $sql);
$row=mysqli_fetch_assoc($result);
         $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $cen=$row['cen'];
         $nacimiento=$row['nacimiento'];
         $sexo=$row['sexo'];
         $representante=$row['representante_nombre'];
         $representante_apellido=$row['representante_apellido'];
         $cedula=$row['representante_cedula'];
         $telefono=$row['representante_telefono'];
         $correo=$row['representante_correo'];
         $grado=$row['grado_nombre'];
         $seccion=$row['seccion_nombre'];
         $idrepresentante = $row ['representante.id'];
         $nombre=strtoupper(trim($nombre));
         $apellido=strtoupper(trim($apellido));



         
?>

<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>constancias</title>

</head>
<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
    <div class="container mx-auto py-6">
        <!-- Cabecera -->
        <header class="flex justify-between items-center bg-gray-800 text-white p-4 rounded shadow-md">
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="w-24 h-auto">
            <div class="text-center">
                <h5 class="text-lg font-semibold uppercase">REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
                <h5 class="text-lg uppercase">E.P.N CESAR ARTEAGA CASTRO</h5>
                <h5 class="text-lg">CÓDIGO PLANTEL: 006568032</h5>
                <h5 class="text-lg">SANTA ANA DE CORO, ESTADO FALCÓN</h5>
            </div>
        </header>

        <!-- Contenido -->
        <main class="bg-white dark:bg-gray-800 mt-8 p-6 rounded shadow-md">
            <h4 class="text-xl font-bold text-center mb-4">Constancia de Aceptación</h4>
            <p class="text-justify leading-relaxed">
                Reciba un cordial saludo de parte del personal que labora en la E.P.N CESAR ARTEAGA CASTRO, ubicada en la Av. Los Orumos de la Ciudad de Coro, Municipio Miranda. Por medio de la presente me dirijo a usted para hacer de su conocimiento que el estudiante <b class="font-semibold"><?= $nombre . ' ' . $apellido ?></b>, C.E\C.I N° <b class="font-semibold"><?= $cen ?></b>, de ______ años de edad, fue inscrito(a) en este plantel para cursar el: <b class="font-semibold"><?= $grado ?></b> grado, Sección "<b class="font-semibold"><?= $seccion ?></b>" Año Escolar ______.
            </p>
            <p class="text-justify leading-relaxed mt-4">
                Representante: <b class="font-semibold"><?= $representante ?></b>, C.I N° <b class="font-semibold"><?= $cedula ?></b>.
            </p>
            <p class="text-justify leading-relaxed mt-4">
                CONSTANCIA QUE SE EXPIDE EN SANTA ANA DE CORO, A LOS ______ DÍAS DEL MES DE ______ DEL AÑO ______.
            </p>
            <div class="flex justify-end mt-6">
                <p>(Sello)</p>
            </div>
            <div class="text-center mt-6">
                <p>_________________</p>
                <p class="font-semibold">Directora</p>
            </div>
        </main>
    </div>

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
$dompdf->stream("Constancia_Aceptacion.pdf", array("Attachment" => false));
?>
