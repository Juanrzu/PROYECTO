<?php
session_start();
ob_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == ''){
      header('location:../../login/login.php');
      die();
      
}
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
<html lang="en">

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>constancias</title>

</head>
<body>
  <div class="d-flex flex-column flex-shrink-0" style="height: 100vh; justify-content: flex-start; align-items: stretch;">
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

  <div class="titulo" style="text-align: center;">
  <h4>Constancia de Inscripcion </h4><br>
  </div>

  <div class="texto" 
  style="text-align: center; 
  line-height: 1.5;">
  <p>Quien suscribe, LICDA. GIANNA FERRO titular de la Cédula de Identidad N° 15.238.553, en mi carácter de Directora de la 
    Escuela Primaria Nacional Cesar Arteaga Castro, ubicada en la Av. los Orumos de esta Ciudad, por medio de la presente, hace constar que él o la estudiante: <b><?php echo "$nombre $apellido" ?></b>.  
    C.E y/o C.I N°  <b><?php echo "$cen"; ?></b>. 
    De:_____ años de edad, FUE INSCRITO(A) en este plantel para cursar el:<b><?php echo "$grado"; ?></b> grado,
    Sección"<b><?php echo "$seccion"; ?></b>" Año Escolar______<p>
     
  
   <p>Representante:  <b><?php echo "$representante"; ?></b>
      C.I.N:   <b><?php echo "$cedularepre"; ?></b> <p>
      
 <p> CONSTANCIA QUE SE EXPIDE EN SANTA ANA DE CORO, A LOS ______ DÍAS DEL MES DE:______ DEL AÑO_____<p>


 
</div>

  
</header>


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
$dompdf->stream("Constancia_inscripcion.pdf", array("Attachment" => false));
?>
