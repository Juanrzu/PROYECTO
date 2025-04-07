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
  <title>Estudiantes</title>
</head>

<body class="bg-ghost">
<div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
          viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
            fill="currentColor" />
          <path
            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
            fill="currentFill" />
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    </div>

  <div class="container w-full max-w-7xl h-full mx-auto">

    <?php
    if ($usuario == "admin" || $usuario == "Admin") {
      include('./header_admin.php');
    } else {
      include('./header.php');
    }

    ?>

    <main class="flex justify-between flex-col mt-4">


    <div class="container-buttons flex justify-start mx-4">
      <?php
       $grado = $_GET['gradonombre'];
       $seccion = $_GET['seccion'];

      echo '<button class=" p-4 rounded-md text-white bg-blue-700 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 drop-shadow-lg"><a target="_blank" href="ver_pdf.php?gradonombre=' . $grado . '&seccion=' . $seccion . '" class="text-light">Descargar PDF</a></button>';
      echo ' <button class=" p-4 rounded-md text-white bg-blue-700 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 drop-shadow-lg mx-3 "><a href="http://localhost/dashboard/Proyecto/public/profesor.php" class="text-light">Agregar Profesor</a></button>';
      echo ' <button class=" p-4 rounded-md text-white bg-blue-700 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 drop-shadow-lg"><a href="http://localhost/dashboard/Proyecto/public/estudiante.php" class="text-light">Agregar Estudiante</a></button>';

      ?>
    </div>

    <div class="w-full mt-4">
      <table class="w-11/12 mx-auto rounded-lg text-xs text-left rtl:text-right dark:text-gray-400 z-50">
        <thead class=" uppercase dark:text-gray-400">
          <tr>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Nombre</th>
            <th scope="col" class="px-3 py-2 ">Apellido</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Cedula</th>
            <th scope="col" class="px-3 py-2">Grado</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sección</th>
            <th scope="col" class="px-3 py-2 bg-blue-400 dark:bg-blue-800">Editar</th>
            <th scope="col" class="px-3 py-2 bg-red-500 dark:bg-red-800">Borrar</th>
          </tr>
        </thead>
        <tbody class="text-md">
          <?php

          $secc = strtoupper(trim($seccion));

          if ($secc === "A") {
            $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
              FROM profesor 
              JOIN seccion ON profesor.idseccion = seccion.id 
              JOIN grados ON profesor.idgrado = grados.id 
              WHERE seccion.nombre = '$secc' and grados.nombre = $grado
              ORDER BY profesor.nombre ASC";

          } else {
            $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
              FROM profesor 
              JOIN seccion ON profesor.idseccion = seccion.id 
              JOIN grados ON profesor.idgrado = grados.id 
              WHERE seccion.nombre = '$secc' and grados.nombre = $grado
              ORDER BY profesor.nombre ASC";
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

              echo '<tr class="border-b border-gray-900 dark:border-gray-700">
                            <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $nombre . '</td>
                            <td class="px-3 py-2">' . $apellido . '</td>
                            <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cedula . '</td>
                            <td class="px-3 py-2">' . $grado . '</td>
                            <td class="px-3 py-2  bg-gray-200 dark:bg-gray-800">' . $secc . '</td>
                            <td class="text-center bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                                <button class="w-1/2">
                                  <a href="editar_profesor.php? editarid=' . $id . ' " class="px-3 py-2">
                                  <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line" class="icon flat-line"><path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;"/><path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                                  </a>
                                </button>
                                </td>

                                <td class="text-center px-3 py-2 bg-red-500 dark:bg-red-800">
                                
                                <button class="w-1/2">
                                <a href="eliminar_profesor.php? eliminarid=' . $id . '" class="px-3 py-2">
                                  <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 -0.5 21 21" version="1.1">
  
                                  <title>delete [#1487]</title>
                                  <desc>Created with Sketch.</desc>
                                  <defs>
                              
                              </defs>
                                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                                          <g id="icons" transform="translate(56.000000, 160.000000)">
                                              <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">
                              
                              </path>
                                          </g>
                                      </g>
                                  </g>
                              </svg>
                                  </a>
                                </button>
                                </td>
                        </tr> ';
            }
          }




          ?>
        </tbody>
      </table>
    </div>

    <div class="container-buscador w-full m-8">

    
        <form  method="post" class="max-w-md ">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="buscador"  class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese Un Nombre"/>
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

      </div>

      <div class="overflow-x-auto shadow-md sm:rounded-lg mx-4">

        <table class="w-full text-xs text-left rtl:text-right text-black dark:text-gray-400 z-50">
          <thead class="text-xs text-black uppercase dark:text-gray-400">
            <tr>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Nombres</th>
              <th scope="col" class="px-3 py-2 ">Apellidos</th>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">C.E.N</th>
              <th scope="col" class="px-3 py-2 ">Nacimiento</th>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sexo</th>
              <th scope="col" class="px-3 py-2 ">Representante</th>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">C.I Representante</th>
              <th scope="col" class="px-3 py-2 ">Telefono</th>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Correo Electronico</th>
              <th scope="col" class="px-3 py-2 ">Grado</th>
              <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sección</th>
              <th scope="col" class="px-3 py-2 bg-blue-400 dark:bg-blue-800">Editar</th>
              <th scope="col" class="px-3 py-2 bg-red-500 dark:bg-red-800">Borrar</th>
            </tr>
          </thead>
          <tbody class="text-md">
            <?php

            $secc = strtoupper(trim($seccion));




            if (isset($_POST['buscador'])) {

              $nombre = $_POST['buscador'];


              $limit = "SELECT estudiantes.*, representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                      representante.telefono as telefono, representante.correo as correo
                      FROM estudiantes 
                      join seccion on estudiantes.idseccion = seccion.id
                      join grados on estudiantes.idgrado = grados.id
                      JOIN representante ON estudiantes.idrepresentante = representante.id
                      WHERE estudiantes.nombre LIKE '%$nombre%' or estudiantes.cen LIKE '%$nombre%'
                      or estudiantes.apellido LIKE '%$nombre%' or representante.nombre LIKE '%$nombre%'
                      or representante.correo LIKE '%$nombre%' or representante.cedula LIKE '%$nombre%'";
          
          $resultado = mysqli_query($connect, $limit);

              if(!empty($nombre) && $connect->real_escape_string($nombre)){
          
              if ($resultado && mysqli_num_rows($resultado) > 0) {

                    while ($row = mysqli_fetch_assoc($resultado)) {
                      $id = $row['id'];
                      $nombre = $row['nombre'];
                      $apellido = $row['apellido'];
                      $cen = $row['cen'];
                      $nacimiento = $row['nacimiento'];
                      $sexo = $row['sexo'];
                      $representante = $row['representante_nombre'];
                      $cedularepre = $row['cedularepre'];
                      $telefono = $row['telefono'];
                      $correo = $row['correo'];
          
          
                      echo '<tr class="border-b border-gray-900 dark:border-gray-700">
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $nombre . '</td>
                    <td class="px-3 py-2 ">' . $apellido . '</td>
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cen . '</td>
                    <td class="px-3 py-2">' . $nacimiento . '</td>
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $sexo . '</td>
                    <td class="px-3 py-2 ">' . $representante . '</td>
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cedularepre . '</td>
                    <td class="px-3 py-2 ">' . $telefono . '</td>
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $correo . '</td>
                    <td class="px-3 py-2 ">' . $grado . '</td>
                    <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $secc . '</td>
                    <td class="text-center bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                      <button class="w-1/2">
                        <a href="editar.php? editarid= ' . $id . '" class="px-3 py-2">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line" class="icon flat-line"><path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;"/><path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                        </a>
                      </button>
                    </td>
          
                    <td class="text-center bg-red-500 dark:bg-red-800 hover:bg-red-400"> 
                      <button class="w-1/2">
                      <a href="eliminar.php? eliminarid=' . $id . '" class="px-3 py-2">
                          <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 -0.5 21 21" version="1.1">
                
                              <title>delete [#1487]</title>
                              <desc>Created with Sketch.</desc>
                              <defs>
                          
                          </defs>
                              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                                      <g id="icons" transform="translate(56.000000, 160.000000)">
                                          <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">
                          
                          </path>
                                      </g>
                                  </g>
                              </g>
                          </svg>
                      </a>
                      </button>
                    </td>
                  </tr>';}
          
          
                } else{

                  // Notificacion diciendo que no se encontro nada
                echo "no se encontro nada";
              }


              } else {


                $contador = "SELECT COUNT(*) AS total 
                FROM estudiantes 
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id 
                JOIN representante ON estudiantes.idrepresentante = representante.id 
                WHERE seccion.nombre = '$secc' and grados.nombre = '$grado'";

              $consulta = $connect->query($contador); 
              $row = $consulta->fetch_assoc(); 
              $total_registros = $row['total'];

              $registros_por_pagina = 10;

              $total_paginas = ceil($total_registros / $registros_por_pagina);


              $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
              if ($pagina_actual < 1) {
                  $pagina_actual = 1;
              } elseif ($pagina_actual > $total_paginas) {
                  $pagina_actual = $total_paginas;
              }

              $offset = ($pagina_actual - 1) * $registros_por_pagina;

              if ($total_registros == 0) {
                $offset = 1;
            }



                if ($secc === "A") {
                  $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                representante.telefono as telefono, representante.correo as correo
                FROM estudiantes  
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id
                JOIN representante On estudiantes.idrepresentante = representante.id
                WHERE seccion.nombre = '$secc' and grados.nombre = $grado
                ORDER BY estudiantes.nombre ASC
                LIMIT $offset, $registros_por_pagina";
    
                } else {
                  $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                representante.telefono as telefono, representante.correo as correo
                FROM estudiantes 
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id
                JOIN representante ON estudiantes.idrepresentante = representante.id
                WHERE seccion.nombre = '$secc' and grados.nombre = $grado
                ORDER BY estudiantes.nombre ASC
                LIMIT $offset, $registros_por_pagina";
                }

                $result = mysqli_query($connect, $sql);
                if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $cen = $row['cen'];
                    $nacimiento = $row['nacimiento'];
                    $sexo = $row['sexo'];
                    $representante = $row['representante_nombre'];
                    $cedularepre = $row['cedularepre'];
                    $telefono = $row['telefono'];
                    $correo = $row['correo'];
                    $grado = $row['grado_nombre'];
                    $seccion = $row['seccion_nombre'];
    
    
                    echo '<tr class="border-b border-gray-900 dark:border-gray-700">
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $nombre . '</td>
                  <td class="px-3 py-2 ">' . $apellido . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cen . '</td>
                  <td class="px-3 py-2">' . $nacimiento . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $sexo . '</td>
                  <td class="px-3 py-2 ">' . $representante . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cedularepre . '</td>
                  <td class="px-3 py-2 ">' . $telefono . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $correo . '</td>
                  <td class="px-3 py-2 ">' . $grado . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $seccion . '</td>
                  <td class="text-center bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                    <button class="w-1/2">
                      <a href="editar.php? editarid= ' . $id . '" class="px-3 py-2">
                      <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line" class="icon flat-line"><path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;"/><path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                      </a>
                    </button>
                  </td>
    
                  <td class="text-center bg-red-500 dark:bg-red-800 hover:bg-red-400"> 
                    <button class="w-1/2">
                    <a href="eliminar.php? eliminarid=' . $id . '" class="px-3 py-2">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 -0.5 21 21" version="1.1">
              
                            <title>delete [#1487]</title>
                            <desc>Created with Sketch.</desc>
                            <defs>
                        
                        </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">
                        
                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                    </button>
                  </td>
                </tr>';
    
    
    
    
                  }
                }


              }


              } else {

                
                $contador = "SELECT COUNT(*) AS total 
                FROM estudiantes 
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id 
                JOIN representante ON estudiantes.idrepresentante = representante.id 
                WHERE seccion.nombre = '$secc' and grados.nombre = '$grado'"; 

              $consulta = $connect->query($contador); 
              $row = $consulta->fetch_assoc(); 
              $total_registros = $row['total'];

              $registros_por_pagina = 10;

              $total_paginas = ceil($total_registros / $registros_por_pagina);


              $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
              if ($pagina_actual < 1) {
                  $pagina_actual = 1;
              } elseif ($pagina_actual > $total_paginas) {
                  $pagina_actual = $total_paginas;
              }

              $offset = ($pagina_actual - 1) * $registros_por_pagina;

              if ($total_registros == 0) {
                $offset = 1;
            }

            

                if ($secc === "A") {
          
                  $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                representante.telefono as telefono, representante.correo as correo
                FROM estudiantes  
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id
                JOIN representante On estudiantes.idrepresentante = representante.id
                WHERE seccion.nombre = '$secc' and grados.nombre = $grado
                ORDER BY estudiantes.nombre ASC
                LIMIT $offset, $registros_por_pagina";

    
                } else {

                  
                  $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
                representante.nombre as representante_nombre, representante.cedula as cedularepre, 
                representante.telefono as telefono, representante.correo as correo
                FROM estudiantes 
                JOIN seccion ON estudiantes.idseccion = seccion.id 
                JOIN grados ON estudiantes.idgrado = grados.id
                JOIN representante ON estudiantes.idrepresentante = representante.id
                WHERE seccion.nombre = '$secc' and grados.nombre = $grado
                ORDER BY estudiantes.nombre ASC
                LIMIT $offset, $registros_por_pagina";
                  
                }

                $result = mysqli_query($connect, $sql);
                
                if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $cen = $row['cen'];
                    $nacimiento = $row['nacimiento'];
                    $sexo = $row['sexo'];
                    $representante = $row['representante_nombre'];
                    $cedularepre = $row['cedularepre'];
                    $telefono = $row['telefono'];
                    $correo = $row['correo'];
                    $grado = $row['grado_nombre'];
                    $seccion = $row['seccion_nombre'];
    
                    

                    echo '<tr class="border-b border-gray-900 dark:border-gray-700">
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $nombre . '</td>
                  <td class="px-3 py-2 ">' . $apellido . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cen . '</td>
                  <td class="px-3 py-2">' . $nacimiento . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $sexo . '</td>
                  <td class="px-3 py-2 ">' . $representante . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cedularepre . '</td>
                  <td class="px-3 py-2 ">' . $telefono . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $correo . '</td>
                  <td class="px-3 py-2 ">' . $grado . '</td>
                  <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $seccion . '</td>
                  <td class="text-center bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                    <button class="w-1/2">
                      <a href="editar.php? editarid= ' . $id . '" class="px-3 py-2">
                      <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line" class="icon flat-line"><path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;"/><path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                      </a>
                    </button>
                  </td>
    
                  <td class="text-center bg-red-500 dark:bg-red-800 hover:bg-red-400"> 
                    <button class="w-1/2">
                    <a href="eliminar.php? eliminarid=' . $id . '" class="px-3 py-2">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 -0.5 21 21" version="1.1">
              
                            <title>delete [#1487]</title>
                            <desc>Created with Sketch.</desc>
                            <defs>
                        
                        </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">
                        
                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                    </button>
                  </td>
                </tr>';
    
    
    
    
                  }
                }

              }

                ?>

              
            
          </tbody>
        </table>
      </div>


      <div aria-label="Page navigation example w-full">
        <ul class="flex items-center justify-center -space-x-px h-10 text-base py-8">

        <?php 

          for ($i = 1; $i <= $total_paginas; $i++) {
            if ($i == $pagina_actual) {
                echo "
                          <li>
                      <a href='#' class='flex items-center justify-center px-4 h-10 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'>$i</a>
                    </li>
                ";
            } else {
                echo "

                          <li>
                      <a href='ver_grado.php?gradonombre=$grado & seccion=$secc & pagina=$i' aria-current='page' class='z-10 flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700 dark:bg-gray-700 dark:text-white'>$i</a>
                      </li>
                ";
            }
          }

        ?>

        </ul>
      </div>



    </main>

    <footer class="flex justify-between items-center w-full px-8 py-4 mt-[20%]">
      <p class="demin">Todos Los derechos reservados 2024</p>
      <a class="btn bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512">
          <path
            d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
          Licencia Creative Commons
        </svg>
      </a>
    </footer>
  </div>
  <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
  <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
  









</html>