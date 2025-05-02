<?php
session_start();
ob_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == ''){
      header('location:../login/login.php');
      die();
}
include '../../connect.php';
$id=$_GET['id'];


$sql = "SELECT * FROM trabajadores WHERE id = $id";

$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($result);
    $nombre=$row['nombre'];
     $apellido=$row['apellido'];
     $telefono = $row['telefono'];
     $cedula=$row['cedula'];
     $rol = $row['rol'];
     $nombre=strtoupper(trim($nombre));
     $apellido=strtoupper(trim($apellido));
     $rol=strtoupper(trim($rol));
     ?>

<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>constancias</title>

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="container mx-auto py-6">
        <!-- Cabecera -->
        <header class="flex justify-between items-center bg-gray-800 text-white p-4 rounded shadow-md">
            <img src="http://localhost/dashboard/Proyecto/src/escudo_contancias.jpg" alt="Escudo" class="w-24 h-auto">
            <div class="text-center">
                <h5 class="text-lg font-semibold">REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
                <h5 class="text-lg">MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN</h5>
                <h5 class="text-lg">E.P.N CESAR ARTEAGA CASTRO</h5>
                <h5 class="text-lg">CÓDIGO DEA: OD01601114</h5>
                <h5 class="text-lg">RIF: J-006568032</h5>
            </div>
        </header>

        <!-- Contenido -->
        <main class="bg-white dark:bg-gray-800 mt-8 p-6 rounded shadow-md">
            <h4 class="text-center text-xl font-bold mb-4">Constancia de Trabajo</h4>
            <p class="text-justify leading-relaxed">
                Quien suscribe, LICDA. GIANNA FERRO, portadora de la Cédula de Identidad N° 15.238.553, en mi condición de Directora de la Escuela Primaria Nacional "Cesar Arteaga Castro", Código de Plantel 006568032, que funciona en la Av. Los Orumos con calle Ali Primera, Sector San Bosco del Municipio Miranda, Estado Falcón. Por medio de la presente, hace constar que el ciudadano: <b><?= $nombre . ' ' . $apellido ?></b>, titular de la Cédula de Identidad N° <b><?= $cedula ?></b>, labora en este plantel como personal: <b><?= $rol ?></b>, desde el ______ hasta la presente fecha ______.
            </p>
            <p class="text-justify leading-relaxed mt-4">
                Constancia que se expide a petición de parte interesada en Santa Ana de Coro, a los ______ días del mes de ______ del año ______.
            </p>
            <div class="flex justify-end mt-6">
                <p>(Sello)</p>
            </div>
            <div class="text-center mt-6">
                <p>_________________</p>
                <p>Directora</p>
            </div>
        </main>
    </div>

    <!-- Generador del PDF -->
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
$dompdf->stream("Constancia_trabajadores.pdf", array("Attachment" => false));
?>


    
</body>

</html>