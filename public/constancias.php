<?php

session_start();
error_reporting(error_level: 0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
	header(header: 'location: login/login.php');
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
    <title>Inicio</title>

  </head>
  <body class="bg-ghost flex flex-col min-h-full ml-64">
    <!-- Loading Overlay mejorado -->
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

    <!-- Header Dinámico -->
    <?php
    $headerFile = strtolower($usuario) === "admin" ? 'header_admin.php' : 'header.php';
    include_once $headerFile;
    ?>

    <!-- Contenido Principal -->
    <main class="container min-h-screen p-8 ">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Generacion de constancias</h2>
    </div>


        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Constancia de estudio -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-blue-50">
                        <!-- SVG icon for estudio -->
                        <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 48 48">
                            <rect x="8" y="12" width="32" height="24" rx="3" fill="#e0e7ff" stroke="#2563eb"/>
                            <path d="M16 20h16M16 26h16M16 32h8" stroke="#2563eb" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Constancia de estudio</h3>
                        </div>
                        <a href="/dashboard/Proyecto/public/constancias/estudio/estudio.php"
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Generar constancia
                        </a>
                        <p class="text-sm text-gray-500 mt-2">Genera constancias para estudiantes activos.</p>
                    </div>
                </div>
                <!-- Constancia de trabajo -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-green-50">
                        <!-- SVG icon for trabajo -->
                        <svg class="w-24 h-24 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 48 48">
                            <rect x="10" y="14" width="28" height="20" rx="3" fill="#dcfce7" stroke="#22c55e"/>
                            <path d="M24 14v-4M18 10h12" stroke="#22c55e" stroke-linecap="round"/>
                            <circle cx="24" cy="24" r="4" fill="#22c55e"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Constancia de trabajo</h3>
                        </div>
                        <a href="/dashboard/Proyecto/public/constancias/trabajadores/crear.php"
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Generar constancia
                        </a>
                        <p class="text-sm text-gray-500 mt-2">Emite constancias para trabajadores y personal.</p>
                    </div>
                </div>
                <!-- Constancia de inscripción -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-yellow-50">
                        <!-- SVG icon for inscripción -->
                        <svg class="w-24 h-24 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 48 48">
                            <rect x="8" y="12" width="32" height="24" rx="3" fill="#fef9c3" stroke="#eab308"/>
                            <path d="M16 20h16M16 26h10" stroke="#eab308" stroke-linecap="round"/>
                            <circle cx="34" cy="30" r="3" fill="#eab308"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Constancia de inscripción</h3>
                        </div>
                        <a href="/dashboard/Proyecto/public/constancias/inscripcion/ver_alumnos.php"
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-md transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Ver alumnos
                        </a>
                        <p class="text-sm text-gray-500 mt-2">Descarga constancias de inscripción de alumnos.</p>
                    </div>
                </div>
                <!-- Constancia de aceptación -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-200">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-purple-50">
                        <!-- SVG icon for aceptación -->
                        <svg class="w-24 h-24 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 48 48">
                            <rect x="8" y="12" width="32" height="24" rx="3" fill="#f3e8ff" stroke="#a21caf"/>
                            <path d="M18 26l6 6 10-10" stroke="#a21caf" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Constancia de aceptación</h3>
                        </div>
                        <a href="/dashboard/Proyecto/public/constancias/aceptacion/ver_alumnos.php"
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Ver alumnos
                        </a>
                        <p class="text-sm text-gray-500 mt-2">Obtén constancias de aceptación para alumnos.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm mb-4 md:mb-0">Todos los derechos reservados &copy; <?= date('Y') ?></p>
                <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="inline-flex items-center gap-2 bg-gray-50 hover:bg-gray-100 rounded-full px-4 py-2 transition-colors duration-200 text-sm" aria-label="Licencia Creative Commons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
                    </svg>
                    <span>Licencia Creative Commons</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->

    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
    <script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>


