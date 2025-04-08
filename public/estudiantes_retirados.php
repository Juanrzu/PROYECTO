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
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
  <title>Estudiantes</title>
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

    <main class=" mb-4 xl:px-56 mt-8">
    <div class="overflow-x-auto shadow-md sm:rounded-lg -z-10 m-10 xl:m-4">

<table class=" text-xs text-left rtl:text-right text-black dark:text-gray-400">
  <thead class="text-xs text-black uppercase dark:text-gray-400">
          <tr>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Nombre</th>
            <th scope="col" class="px-3 py-2 ">Apellido</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">C.E.N</th>
            <th scope="col" class="px-3 py-2">Nacimiento</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Sexo</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Representante</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Representante Apellido</th>
            <th scope="col" class="px-3 py-2 ">C.I Representante</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Telefono</th>
            <th scope="col" class="px-3 py-2">correo</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Grado</th>
            <th scope="col" class="px-3 py-2 ">Seccion</th>
            <th scope="col" class="px-3 py-2 bg-gray-200 dark:bg-gray-800">Fecha</th>
            <th scope="col" class="px-3 py-2">Motivo</th>
            <th scope="col" class="px-3 py-2 bg-blue-400 dark:bg-blue-800">Editar</th>
            <th scope="col" class="px-3 py-2 bg-red-500 dark:bg-red-800">Restaurar</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $secc = strtoupper(trim($seccion));
          $sql = "SELECT * FROM retiro_estudiantes";
          $stmt = $connect->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();
          

          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $cen = $row['cen'];
                $nacimiento = $row['nacimiento'];
                $sexo = $row['sexo'];
                $representante = $row['representante'];
                $representanteApellido = $row['representante_apellido'];
                $cedularepre = $row['cedula_repre'];
                $telefono = $row['telefono'];
                $correo = $row['correo'];
                $grado = $row['grado'];
                $seccion = $row['seccion'];
                $motivo = $row['motivo'];
                $fechaHora = $row['fecha_hora'];
                


              echo '<tr class="border-b border-gray-900 dark:border-gray-700">
                             <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $nombre . '</td>
                              <td class="px-3 py-2 ">' . $apellido . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $cen . '</td>
                              <td class="px-3 py-2">' . $nacimiento . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $sexo . '</td>
                              <td class="px-3 py-2 ">' . $representante . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $representanteApellido. '</td>
                              <td class="px-3 py-2 ">' . $cedularepre . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' .$telefono . '</td>
                              <td class="px-3 py-2 ">' .  $correo . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' . $grado . '</td>
                              <td class="px-3 py-2 ">' . $seccion . '</td>
                              <td class="px-3 py-2 bg-gray-200 dark:bg-gray-800">' .$fechaHora . '</td>
                              <td class="px-3 py-2 ">' .$motivo . '</td>
                              <td class="px-3 py-2 bg-blue-400 dark:bg-blue-800 hover:bg-blue-500">
                                <button class=" w-full">
                                  <a href="editar.php? editarid=' . $id . ' " class="px-3 py-2">
                                  <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 24 24" id="edit-alt" data-name="Flat Line" class="icon flat-line"><path id="secondary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: rgb(44, 169, 188); stroke-width: 2;"/><path id="primary" d="M20.41,7.83,7.24,21H3V16.76L16.17,3.59a1,1,0,0,1,1.42,0l2.82,2.82A1,1,0,0,1,20.41,7.83Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                                  </a>
                                </button>
                              </td>

                                
                  
                              <button class="w-full">
                                                <td class="bg-red-500 dark:bg-red-800 hover:bg-red-400"> 
                                    <form method="POST" action="restaurar_estudiantes_retirados.php?eliminarid=' . $id . '">
                                        <button type="button" class="w-full" data-modal-target="modal-retirar-' . $id . '" data-modal-toggle="modal-retirar-' . $id . '">
                                            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 21 21">
                                                <!-- SVG contenido -->
                                            </svg>
                                        </button>
                            
                                        <div id="modal-retirar-' . $id . '" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                                            <div class="relative p-4 max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                                                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sistema</h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-retirar-' . $id . '">
                                                            <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <div class="p-4 md:p-5 space-y-4">
                                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">¿Esta seguro?</p>
                                                    </div>
                                                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button type="submit" name="registrar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Si</button>
                                                        <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="modal-retirar-' . $id . '">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>';
            }
          }




          ?>
        </tbody>
      </table>
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