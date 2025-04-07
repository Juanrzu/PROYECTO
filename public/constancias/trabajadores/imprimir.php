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


$sql = "SELECT trabajadores.*, rol.nombre as rol_nombre
FROM trabajadores
JOIN rol ON trabajadores.idrol = rol.id  
WHERE trabajadores.id = $id";

$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($result);
    $nombre=$row['nombre'];
     $apellido=$row['apellido'];
     $telefono = $row['telefono'];
     $cedula=$row['cedula'];
     $rol = $row['rol_nombre'];
     $nombre=strtoupper(trim($nombre));
     $apellido=strtoupper(trim($apellido));
     $rol=strtoupper(trim($rol));
     ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/constancias/styles.css">
</head>

<body>
  <div class="d-flex flex-column flex-shrink-0" style="height: 100vh; justify-content: flex-start; align-items: stretch;">
  <header class="d-flex align-items-center bg-dark text-white px-4 py-2" style="justify-content: space-between; align-items: center;">
  <div class="encabezado" style="text-align: center;">
     <h5> REPÚBLICA BOLIVARIANA DE VENEZUELA</h5>
     <h5>  MINISTERIO DEL PODER POPILAR PARA LA EDUCACION</h5>
     <h5>  E.P.N CESAR ARTEAGA CASTRO</h5>
     <h5> CODIGO DEA: : OD01601114</h5>
     <h5> RIF: J-006568032</h5>
    <br>
    <br>
    <br>

  </div>

  <div class="titulo" style="text-align: center;">
  <h4>Constancia de Trabajo </h4><br>
  </div>

  <div class="texto" 
  style="text-align: center; 
  line-height: 2;">
  <p>Quien suscribe, LICDA. GIANNA FERRO portadora de la Cédula de Identidad N° 15.238.553, en mi condición de Directora de la 
    Escuela Primaria Nacional "Cesar Arteaga Castro". Código de Plantel 006568032, que funciona en la Av. los Orumos con calle Ali Primera, Sector San Bosco del Municipio Miranda, Estado Falcón. Por medio de la presente, hace constar que él Ciudadano: <b><?php echo "$nombre $apellido" ?></b>.  
    Titular de la Cedula de Identidad N° <b><?php echo "$cedula"; ?></b>. 
    Labora en este plantel como personal: <b><?php echo "$rol" ?>:</b>. 
     desde el________ hasta la presente fecha__________<p>

      
 <p> Constancia que se expide a petición de parte interesada en Santa Ana de Coro a los ______ días del mes de:______ del año _____</p>


  <div class="titulo" style="text-align: right;">
  <p>(Sello)</p><br>
  </div>

  <div class="titulo" style="text-align: center;">
  <p>_______________ </p>
  <p>Directora</p>
</div>
  
</header>


</html>

<?php
$html = ob_get_clean();

require_once 'D:\Programas\Xammp\htdocs\dashboard\Proyecto\pdf\dompdf\autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isHtml5ParserEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait ');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>