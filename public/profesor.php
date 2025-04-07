<?php
  session_start();

  $usuario = $_SESSION['nombre_usuario'];

  if (!isset($usuario)) {
    header("location: login.php");
  } else{
    include('connect.php');
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Profesor</title>

</head>

<body class="bg-ghost">
  <div class="container-lg w-full flex flex-col">

    <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700">
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

    <?php
    if ($usuario == "admin" || $usuario == "Admin") {
      include('./header_admin.php');
    } else {
      include('./header.php');
    }

    ?>

  
    <main class=" flex justify-center items-center xl:px-56 mt-8">
              <form method="post" id="formulario" class="w-80 rounded-xl p-4 py-8 shadow-lg bg-gray-100" novalidate>
                  <div class="mb-2">
                      <label>Nombre</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg"  placeholder="Nombre del Profesor" maxlength="25" name="nombre" id="nombre" autocomplete="off" required>
                  </div>
                  <div class="mb-2">
                      <label>Apellido</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg"  placeholder="Apellido del Profesor" maxlength="25" name="apellido" id="apellido" autocomplete="off"  required>
                  </div>
                  <div class="mb-2">
                      <label>Cedula</label>
                      <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Cedula" name="cedula" autocomplete="off" id="cedula" required>
                  </div>
                  <div class="mb-2">
                      <label>Grado</label>
                  <select class="form-control form-control w-full mt-2 rounded-lg" name="grado"  required>
                      <option value=1>1</option>
                      <option value=2>2</option>
                      <option value=3>3</option>
                      <option value=4>4</option>
                      <option value=5>5</option>
                      <option value=6>6</option>
                  </select>
                </div>
                <div class="mb-2">
                      <label>Seccion</label>
                  <select class="form-control form-control w-full mt-2 rounded-lg" name="seccion"  required>
                      <option value="A">A</option>
                      <option value="B">B</option>
                  </select>
                </div>
                  <div class="mb-2">
                  <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">FINALIZAR</button>
                  </div>
                  <div class="mb-2">
                        <button type="button" onclick="regresarPaginaAnterior()" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" id="btn-modal">Regresar a la página anterior</button>
                    </div>

                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Sistema
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    ¿Esta Seguro Que Quiere Registrar Un Profesor?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="default-modal" type="submit" name="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SI</button>
                                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">no</button>
                            </div>
                        </div>
                    </div>
              </form>
     </main> 

     <script>
                  function regresarPaginaAnterior() {
                    window.history.back();
                      }
        </script>
    <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>


</body>
</html>

<?php

if (isset($_POST['submit'])){
  $nombre= $_POST['nombre'];
  $apellido= $_POST['apellido'];
  $cedula= $_POST['cedula'];
  $grado=$_POST['grado'];
  $seccion=$_POST['seccion'];
  $seccion= strtoupper($seccion);
  $volver=$grado;
  $volver2=$seccion;
  $error=[];

  if (empty($nombre) || empty($apellido) || empty($cedula) || empty($grado) || empty($seccion)) {
    echo "<footer class='error'>
    <div class='container_title btn btn-danger'>
        <h5 class='title-h1'>Los datos no pueden estar vacios</h5>
    </div>

</footer>";
      
    exit();
  }
  //Verificar Sección
  if (empty($error)) {
    if ($seccion === 'A' || $seccion === 'B' ) {
      
      $sqlgrado = "SELECT id FROM grados WHERE nombre = '$grado'";
      $resultgrado = mysqli_query($connect, $sqlgrado);
      $rowgrado = mysqli_fetch_assoc($resultgrado);
      $idgrado = $rowgrado['id'];
  
      $sqlseccion = "SELECT id FROM seccion WHERE nombre = '$seccion'";
      $resultseccion = mysqli_query($connect, $sqlseccion);
      $rowseccion = mysqli_fetch_assoc($resultseccion);
      $idseccion = $rowseccion['id'];
      }
    }
  $sqlprofe = "SELECT * FROM profesor WHERE cedula = '$cedula' ";
  $resultadoprofesor = mysqli_query($connect, $sqlprofe);

    // Verificar si la consulta devuelve resultados
  if (mysqli_num_rows($resultadoprofesor) > 0) {
    echo "<footer class='error'>
    <div class='container_title btn btn-danger'>
        <h5>La cedula ya se encuentra registrada a otro profesor</h5>
    </div>

</footer>";
exit;
  } 
 // Consulta para contar cuántos profesores hay asignados a un grado y sección específicos
 $sql_count = "SELECT COUNT(*) AS total FROM profesor WHERE idgrado = $idgrado AND idseccion = $idseccion";
 $result_count = mysqli_query($connect, $sql_count);
 $row_count = mysqli_fetch_assoc($result_count);
 $total_profesores = $row_count['total'];

 // Verificar si ya hay 2 profesores asignados a este grado y sección
 if ($total_profesores >= 2) {
     echo "<footer class='error'>
             <div class='container_title btn btn-danger'>
                 <h5>Ya hay 2 profesores asignados a este grado y sección</h5>
             </div>
         </footer>";
     exit();
 }
 
      $sql= "INSERT INTO profesor (nombre, apellido, cedula, idgrado, idseccion) VALUES ('$nombre', '$apellido', '$cedula', $idgrado, $idseccion) ";
      $result= mysqli_query($connect, $sql);
      if($result){
 
         echo"<script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2'</script>";
      }else{
          die (mysqli_error($connect));
      } 
  }


?>