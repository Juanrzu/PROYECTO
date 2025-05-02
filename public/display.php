<?php

session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}
include 'connect.php';
include 'contador_sesion.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de estudiantes</title>
  <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body class="ml-64">


  <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 z-50"
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



    <?php
    if ($usuario == "admin" || $usuario == "Admin" ) {
      include('header_admin.php');
    } else {
      include('header.php');
    }
    ?>

<main class="container min-h-screen p-8 ">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <h2 class="text-3xl font-bold text-gray-800">Panel Integral de Gestión Estudiantil</h2>
  </div>

  <div class="flex flex-wrap gap-4 mb-8">
    <a href="../public/profesor.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">                
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Agregar Profesor
    </a>
    
    <a href="../public/estudiante.php" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Agregar estudiante
    </a>
  </div>

  <?php
  $sql = "Select * from grados ";
  $sql2 = "Select * from seccion ";
  $result = mysqli_query($connect, $sql);
  $result2 = mysqli_query($connect, $sql2);
  
  if ($result and $result2) {
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">'; 
    
    // Array con los datos de los grados para simplificar el código
    $grados = [
      ['1er Grado', '1er_grado.jpg'],
      ['2do Grado', '2do_grado.jpg'],
      ['3er Grado', 'r3-225x300.jpg'],
      ['4to Grado', 'r4-225x300.jpg'],
      ['5to Grado', 'r5-225x300.jpg'],
      ['6to Grado', 'r6-225x300.jpg']
    ];
    
    $secciones = ['A', 'B'];
    
    foreach ($grados as $grado) {
      foreach ($secciones as $seccion) {
        // Cambia el color según la sección
        $seccionColor = ($seccion === 'B') ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800';
        echo '
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200">
          <div class="h-48 overflow-hidden">
            <img class="w-full h-full object-cover object-right-top" src="http://localhost/dashboard/Proyecto/src/'.$grado[1].'" alt="'.$grado[0].'">
          </div>
          <div class="p-4">
            <div class="flex justify-between items-center mb-3">
              <h3 class="text-lg font-semibold text-gray-800">'.$grado[0].'</h3>
              <span class="'.$seccionColor.' text-xs font-medium px-2.5 py-0.5 rounded">Sección '.$seccion.'</span>
            </div>
            <a href="ver_grado.php?gradonombre='.explode(' ', $grado[0])[0].'&&seccion='.$seccion.'" 
               class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-300">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              Ver estudiantes
            </a>
          </div>
        </div>';
      }
    }
    
    echo '</div>'; 
  }
  ?>
</main>


    <!-- Botón de Ayuda -->
    <button data-tooltip-target="tooltip" type="button" class="fixed right-6 bottom-14 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-colors duration-200 outline-none focus:ring-4 focus:ring-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
            <path d="M12 20H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <div id="tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-lg opacity-0 tooltip dark:bg-gray-700">
            <div class="flex items-center mb-2">
            <span>Haz clic aquí en <span class="inline-flex items-center p-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">Ver estudiantes</span> la información de un usuario.</span>
            </div>
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <footer class="flex flex-col md:flex-row justify-between items-center w-full px-8 py-4 mt-8 border-t border-gray-200">
      <p class="demin text-shadow text-gray-600 mb-4 md:mb-0">Todos Los derechos reservados © 2024</p>
      <a class="btn text-shadow bg-slate-50 rounded-full hover:bg-gray-100 transition duration-200 flex items-center gap-2 px-4 py-2" href="https://creativecommons.org/licenses/by-sa/4.0/">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="24px" height="24px" viewBox="0 0 512 512">
          <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
        </svg>
        <span>Licencia Creative Commons</span>
      </a>
    </footer>
  <script src="../node_modules\flowbite\dist\flowbite.min.js"></script>
  <script src="../src/js/script.js"></script>

</body>

</html>