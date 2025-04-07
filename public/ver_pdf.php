<?php

session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>Pdf</title>
</head>

<body>
<div class="d-flex flex-column flex-shrink-0" style="height: 100vh; justify-content: flex-start; align-items: stretch;">
  <header class="d-flex align-items-center bg-dark text-white px-4 py-2" style="justify-content: space-between; align-items: center;">
  <div class="container_title text-md lg:text-3xl">
     <h1> E.P.N "Cesar Arteaga Castro"</h1>
  </div>

  
</header>


<main class="container-fluid p-4" style="margin-top:5em;">
<table class="table table-borderless">
<thead>
    <tr>
      <th scope="col">Nombre del Docente</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Grado</th>
      <th scope="col">Sección</th>

    </tr>
  </thead>
  <tbody>
  <?php 

    $grado=$_GET['gradonombre'];
    $seccion=$_GET['seccion'];

    $secc = strtoupper(trim($seccion));
    
    if ($secc === "A") {
      $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
      FROM profesor 
      JOIN seccion ON profesor.idseccion = seccion.id 
      JOIN grados ON profesor.idgrado = grados.id 
      WHERE seccion.nombre = '$secc' and grados.nombre = $grado";
        
    } else {
      $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
      FROM profesor 
      JOIN seccion ON profesor.idseccion = seccion.id 
      JOIN grados ON profesor.idgrado = grados.id 
      WHERE seccion.nombre = '$secc' and grados.nombre = $grado";
    }
    $result = mysqli_query($connect, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $nombre = $row['nombre'];  
          $apellido = $row['apellido'];
          $cedula = $row['cedula'];
          $grado = $row['grado_nombre'];  
          $seccion = $row['seccion_nombre'];
    
            echo '
            <tr>
                    <td>' . $nombre . '</td>
                    <td>' . $apellido . '</td>
                    <td>' . $cedula . '</td>
                    <td>' . $grado . '</td>
                    <td>' . $secc . '</td>
                    
                </tr>';
            
            
        }
    }
    ?>
    </tbody>
</table>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">C.E.N</th>
                        <th scope="col">Nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Representante</th>
                        <th scope="col">C.I Representante</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Sección</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    
                     
                  
                    $secc = strtoupper(trim($seccion));
                    
                    if ($secc === "A") {
                      $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                      representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                      representante.telefono as telefono, representante.correo as correo
                      FROM estudiantes 
                      JOIN seccion ON estudiantes.idseccion = seccion.id 
                      JOIN grados ON estudiantes.idgrado = grados.id
                      JOIN representante On estudiantes.idrepresentante = representante.id
                      WHERE seccion.nombre = '$secc' and grados.nombre = $grado";

                    } else {
                      $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                      representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                      representante.telefono as telefono, representante.correo as correo
                      FROM estudiantes 
                      JOIN seccion ON estudiantes.idseccion = seccion.id 
                      JOIN grados ON estudiantes.idgrado = grados.id
                      JOIN representante ON estudiantes.idrepresentante = representante.id
                      WHERE seccion.nombre = '$secc' and grados.nombre = $grado";
                    }
                    $result=mysqli_query($connect,$sql);
                    if($result){
                        while( $row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $nombre=$row['nombre'];
                        $apellido=$row['apellido'];
                        $cen=$row['cen'];
                        $nacimiento=$row['nacimiento'];
                        $sexo=$row['sexo'];
                        $representante=$row['representante_nombre'];
                        $cedularepre=$row['cedularepre'];
                        $telefono=$row['telefono'];
                        $correo=$row['correo'];
                        $grado = $row['grado_nombre'];  
                        $seccion = $row['seccion_nombre'];
                        
                        echo '<tr>
                        <td>'.$nombre.'</td>
                        <td>'.$apellido.'</td>
                        <td>'.$cen.'</td>
                        <td>'.$nacimiento.'</td>
                        <td>'.$sexo.'</td>
                        <td>'.$representante.'</td>
                        <td>'.$cedularepre.'</td>
                        <td>'.$telefono.'</td>
                        <td>'.$correo.'</td>
                        <td>'.$grado.'</td>
                        <td>'.$seccion.'</td>
                      </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="http://localhost/dashboard/Proyecto/assets/script.js"></script>
</body>

<style>

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1em;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

</style>

</html>

<?php
$html = ob_get_clean();

require_once 'C:\xampp\htdocs\dashboard\Proyecto\pdf\dompdf\autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isHtml5ParserEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A3', 'landscape');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>