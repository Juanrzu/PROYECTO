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
  <title>Prueba</title>
  <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>

<body>
  <div class="container-lg w-full h-full">

    <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700">
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
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

    <main class="h-full md:px-52  xl:px-96 mt-4">

   <?php echo '
                <div class="container-buttons flex justify-center items-stretch">
                  <button class="mr-2 rounded-md ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 drop-shadow-lg"><a href="http://localhost/dashboard/Proyecto/public/profesor.php" class="inline-block px-2 py-3"><p class="mx-auto">Agregar Profesor</p></a></button>
                  <button class="rounded-md ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 drop-shadow-lg"><a href="http://localhost/dashboard/Proyecto/public/estudiante.php" class="inline-block px-2 py-3"><p class="mx-auto">Agregar Estudiante</p></a></button>
                </div>
                ';
                ?>


      <section class="container-grados flex justify-center items-center flex-wrap gap-x-8 gap-y-8 z-50 mt-8">
          
        <?php

        $sql = "Select * from grados ";
        $sql2 = "Select * from seccion ";
        $result = mysqli_query($connect, $sql);
        $result2 = mysqli_query($connect, $sql2);
        if ($result and $result2) {
          echo '<div class="item-grados rounded-md shadow-2xl w-60 border border-gray-200 bg-ghost outline outline-black p-2 py-4">
                      <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
                          <img src="http://localhost/dashboard/Proyecto/src/1er_grado.jpg" alt="1er grado">
                      </div>
                      <div class="txt-grados text-shadow mb-2 font-semibold">
                          <span>1er Grado</span>
                          <span>/</span>
                          <span>Seccion A</span>
                      </div>              
                      <div class="btn-grados">
                        <a class="block ghost font-semibold w-full rounded-md  py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 1 && seccion= A ">Ver</a>
                      </div>
                    </div>
              
              <div class="item-grados  rounded-md shadow-2xl w-60 border border-gray-200 bg-ghost bg-opacity-40 outline outline-black p-2 py-4">
                <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
                  <img src="http://localhost/dashboard/Proyecto/src/1er_grado.jpg" alt="1er grado">
                </div>
                <div class="txt-grados text-shadow mb-2 font-semibold">
                  <span>1er Grado</span>
                  <span>/</span>
                  <span>Seccion B</span>
                </div>              
                <div class="btn-grados">
                  <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 1 && seccion= B ">Ver</a>
                </div>
              </div>
              
              <div class="item-grados s rounded-md shadow-2xl w-60 outline outline-black p-2">
                <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
                <img src="http://localhost/dashboard/Proyecto/src/2do_grado.jpg" alt="2do grado">
                </div>
                <div class="txt-grados text-shadow mb-2 font-semibold">
                <span>2do Grado</span>
                <span>/</span>
                <span>Seccion A</span>
                </div>              
                <div class="btn-grados">
                  <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 2 && seccion= A ">Ver</a>
                </div>
              </div>
              
              <div class="item-grados s rounded-md shadow-2xl w-60 outline outline-black p-2">
                <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
                  <img src="http://localhost/dashboard/Proyecto/src/2do_grado.jpg" alt="2do grado">
                </div>
                <div class="txt-grados text-shadow mb-2 font-semibold">
                  <span>2do Grado</span>
                  <span>/</span>
                  <span>Seccion B</span>
                </div>              
                <div class="btn-grados">
                  <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 2 && seccion= B ">Ver</a>
                </div>
              </div>
              
              <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
              <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
              <img src="http://localhost/dashboard/Proyecto/src/r3-225x300.jpg" alt="3er grado">
              </div>
                <div class="txt-grados text-shadow mb-2 font-semibold">
                <span>3er Grado</span>
                <span>/</span>
                <span>Seccion A</span>
                </div>              
                <div class="btn-grados">
                  <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 3 && seccion= A ">Ver</a>
                </div>
              </div>
              
              <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
              <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
              <img src="http://localhost/dashboard/Proyecto/src/r3-225x300.jpg" alt="3er grado">
              </div>
                <div class="txt-grados text-shadow mb-2 font-semibold">
                <span>3er Grado</span>
                <span>/</span>
                <span>Seccion B</span>
                </div>              
                <div class="btn-grados">
                <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 3 && seccion= B ">Ver</a>
                </div>
              </div>
              
              <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
              <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
              <img src="http://localhost/dashboard/Proyecto/src/r4-225x300.jpg" alt="4to grado">
              </div>
              <div class="txt-grados text-shadow mb-2 font-semibold">
              <span>4to Grado</span>
              <span>/</span>
              <span>Seccion A</span>
              </div>              
              <div class="btn-grados">
              <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 4 && seccion= A ">Ver</a>
              </div>
            </div>
            
            <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
            <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
            <img src="http://localhost/dashboard/Proyecto/src/r4-225x300.jpg" alt="4to grado">
            </div>
              <div class="txt-grados text-shadow mb-2 font-semibold">
              <span>4to Grado</span>
              <span>/</span>
              <span>Seccion B</h3>
              </div>              
              <div class="btn-grados">
              <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 4 && seccion= B ">Ver</a>
              </div>
            </div>
            
            <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
            <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
            <img src="http://localhost/dashboard/Proyecto/src/r5-225x300.jpg" alt="5to grado">
            </div>
            <div class="txt-grados text-shadow mb-2 font-semibold">
            <span>5to Grado</span>
            <span>/</span>
            <span>Seccion A</span>
            </div>              
            <div class="btn-grados">
            <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 5 && seccion= A ">Ver</a>
            </div>
          </div>
          
          <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
          <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
          <img src="http://localhost/dashboard/Proyecto/src/r5-225x300.jpg" alt="5to grado">
          </div>
            <div class="txt-grados text-shadow mb-2 font-semibold">
            <span>5to Grado</span>
            <span>/</span>
            <span>Seccion B</span>
            </div>              
            <div class="btn-grados">
            <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 5 && seccion= B ">Ver</a>
            </div>
          </div>
          
          <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
          <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
          <img src="http://localhost/dashboard/Proyecto/src/r6-225x300.jpg" alt="6to grado">
          </div>
          <div class="txt-grados text-shadow mb-2 font-semibold">
          <span>6to Grado</span>
          <span>/</span>
          <span>Seccion A</span>
          </div>              
          <div class="btn-grados">
          <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 6 && seccion= A ">Ver</a>
          </div>
        </div>
        
        <div class="item-grados rounded-md shadow-2xl w-60 outline outline-black p-2">
        <div class="img-grados max-w-sm h-40 object-bottom overflow-hidden mb-2 rounded-md">
        <img src="http://localhost/dashboard/Proyecto/src/r6-225x300.jpg" alt="6to grado">
        </div>
          <div class="txt-grados text-shadow mb-2 font-semibold">
          <span>6to Grado</span>
          <span>/</span>
          <span>Seccion B</span>
          </div>              
          <div class="btn-grados">
          <a class="block ghost font-semibold w-full rounded-md py-2 leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 text-center" href="ver_grado.php? gradonombre= 6 && seccion= B ">Ver</a>
          </div>
        </div>';
        }

        ?>
      </section>
    </main>
    <button data-tooltip-target="tooltip" type="button" class=" bg-ghost fixed right-2 bottom-16 ghost rounded-full font-medium text-s px-4 py-2.5 text-center outline outline-1 outline-black">
      <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
        <path d="M12 20H12.01" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M7 9C7 7.87439 7.37194 6.83566 7.99963 6C8.91184 4.78555 10.3642 4 12 4C14.7614 4 17 6.23858 17 9C17 11.4212 15.279 13.4405 12.9936 13.9013C12.4522 14.0104 12 14.4477 12 15V15V16" stroke="#323232" stroke-width="2" stroke-linecap="round" />
      </svg>
    </button>

    <div id="tooltip" role="tooltip" class=" absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium ghost transition-opacity duration-300 bg-gray-800 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
      <p class="flex items-center">Haz click en VER para entrar los grados</p>
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <footer class="flex justify-between items-center w-full px-8 py-4 mt-2">
      <p class="demin text-shadow">Todos Los derechos reservados 2024</p>
      <a class="btn text-shadow bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512">
          <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z" />
          Licencia Creative Commons
        </svg>
      </a>
    </footer>
  </div>
  <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
  <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>

</body>

</html>