<?php

session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario']) || empty($_SESSION['nombre_usuario'])) {
    header('Location: ./../login/login.php');
    exit();
}

$usuario = $_SESSION['nombre_usuario'];

// Incluir archivos necesarios
require_once './../connect.php';
require_once '../contador_sesion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar preguntas</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">

</head>

<body class="bg-ghost">

    <div class="container-lg w-full h-full">


        <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 z-50">
            <div role="status">
                <svg class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <?php
        if ($usuario == "admin" || $usuario == "Admin") {
            include('../header_admin.php');
        } else {
            include('../header.php');
        }
        ?>

        <main class=" flex justify-center items-center xl:px-56 mt-8">


        <form method="POST" class="w-80 rounded-xl p-4 py-8 shadow-lg bg-gray-50" id="formulario">
        <div class="mb-6">
            <label for="usuario" class="block text-sm font-medium text-gray-700">Usuario</label>
            <input type="text" class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" name="usuario" id="usuario" autocomplete="off" value="<?php echo "$usuario"; ?>">
        </div>

        <div class="mb-6">
            <label for="p1" class="block text-sm font-medium text-gray-700">Pregunta de seguridad 1</label>
            <input type="text" class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" name="pregunta1" id="p1" placeholder="¿Cuál es el nombre de su madre o padre?">
        </div>

        <div class="mb-6">
            <label for="p2" class="block text-sm font-medium text-gray-700">Pregunta de seguridad 2</label>
            <input type="text" class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" name="pregunta2" id="p2" placeholder="¿Cuál es su animal favorito?">
        </div>

        <div class="mb-6">
            <label for="pregunta_nueva1" class="block text-sm font-medium text-gray-700">Nueva respuesta de seguridad 1</label>
            <input type="text" class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" name="pregunta_nueva1" id="pregunta_nueva1" placeholder="Ingrese la nueva respuesta a la pregunta de seguridad 1">
        </div>

        <div class="mb-6">
            <label for="pregunta_nueva2" class="block text-sm font-medium text-gray-700">Nueva respuesta de seguridad 2</label>
            <input type="text" class="block w-full mt-2 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" name="pregunta_nueva2" id="pregunta_nueva2" placeholder="Ingrese la nueva respuesta a la pregunta de seguridad 2">
        </div>

        <div class="mb-6 flex gap-4">
            <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex w-full justify-center px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">REGISTRAR</button>
            <button type="button" onclick="window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'" class="flex w-full justify-center px-4 py-3 text-sm font-medium text-white bg-blue-700 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">Regresar</button>
        </div>

            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 bottom-0 z-50 justify-center items-center">
                <div class="relative p-4 max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sistema</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-5">
                    <p class="text-base text-gray-500 dark:text-gray-400">¿Está seguro que quiere registrar un usuario?</p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="submit" name="registrar" class="px-5 py-2 text-sm text-white bg-blue-700 rounded-lg focus:ring-4 focus:outline-none hover:bg-blue-800 focus:ring-blue-300">SI</button>
                    <button data-modal-hide="default-modal" type="button" class="px-5 py-2 ms-3 text-sm text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">No</button>
                    </div>
                </div>
                </div>
            </div>
        </form>

        </main>
        <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
        <p class="text-gray-600 text-sm">Todos los derechos reservados © 2024</p>
        <a href="https://creativecommons.org/licenses/by-sa/4.0/" class="mt-2 md:mt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-800 transition-colors duration-200" fill="currentColor" viewBox="0 0 512 512">
            <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
            </svg>
        </a>
        </div>
    </footer>
    </div>
    <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>




    <script>
        const form = document.getElementById('formulario');
        const btn = document.getElementById('registrar');
        const usuario = document.getElementById('usuario');
        const p1 = document.getElementById('p1');
        const p2 = document.getElementById('p2');
        const new_pregunta1 = document.getElementById('pregunta_nueva1');
        const new_pregunta2 = document.getElementById('pregunta_nueva2');




        form.addEventListener("submit", (e) => {

            const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
            var error = "";
            var msg = document.createElement("div");



            if (usuario.value == "" || p1.value == "" || p2.value == "" || new_pregunta1.value == "" || new_pregunta2.value == "") {
                error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Los campos no pueden estar vacios</p> 
                                            </div>`;

                usuario.classList.add('is-invalid');
                usuario.classList.remove('is-valid');

                p1.classList.add('is-invalid');
                p1.classList.remove('is-valid');

                p2.classList.add('is-invalid');
                p2.classList.remove('is-valid');

                new_pregunta1.classList.add('is-invalid');
                new_pregunta1.classList.remove('is-valid');

                new_pregunta2.classList.add('is-invalid');
                new_pregunta2.classList.remove('is-valid');


            } else {
                usuario.classList.remove('is-invalid');
                usuario.classList.add('is-valid');

                p1.classList.remove('is-invalid');
                p1.classList.add('is-valid');

                p2.classList.remove('is-invalid');
                p2.classList.add('is-valid');

                new_pregunta1.classList.remove('is-invalid');
                new_pregunta1.classList.add('is-valid');

                new_pregunta2.classList.remove('is-invalid');
                new_pregunta2.classList.add('is-valid');


                if (!regex.test(usuario.value)) {
                    error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                            <p class=" text-[11px] ghost pb-1">ingrese un Usuario con caracteres validos</p> 
                            </div>`;
                    usuario.classList.add('is-invalid');
                    usuario.classList.remove('is-valid');
                } else {
                    usuario.classList.add('is-valid');
                    usuario.classList.remove('is-invalid');
                }


                if (!regex.test(p1.value)) {
                    error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Ingrese una respuesta con caracteres validos</p> 
                                            </div>`;
                    p1.classList.add('is-invalid');
                    p1.classList.remove('is-valid');
                } else {
                    p1.classList.add('is-valid');
                    p1.classList.remove('is-invalid');
                }

                if (!regex.test(p2.value)) {
                    error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Ingrese una pregunta con caracteres validos</p> 
                                            </div>`;
                    p2.classList.add('is-invalid');
                    p2.classList.remove('is-valid');
                } else {
                    p2.classList.add('is-valid');
                    p2.classList.remove('is-invalid');
                }



                if (!regex.test(new_pregunta1.value)) {
                    error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Ingrese una respuesta con caracteres validos</p> 
                                            </div>`;
                    new_pregunta1.classList.add('is-invalid');
                    new_pregunta1.classList.remove('is-valid');
                } else {
                    new_pregunta1.classList.add('is-valid');
                    new_pregunta1.classList.remove('is-invalid');
                }

                if (!regex.test(new_pregunta2.value)) {
                    error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2 mt-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-[11px] ghost pb-1">Ingrese una pregunta con caracteres validos</p> 
                                            </div>`;
                    new_pregunta2.classList.add('is-invalid');
                    new_pregunta2.classList.remove('is-valid');
                } else {
                    new_pregunta2.classList.add('is-valid');
                    new_pregunta2.classList.remove('is-invalid');
                }

            }





            if (usuario.classList.contains("is-invalid") || p1.classList.contains("is-invalid") || p2.classList.contains("is-invalid") || new_pregunta1.classList.contains("is-invalid") || new_pregunta2.classList.contains("is-invalid")) {
                msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-blue-500 rounded-xl font-bold w-56 md:w-80">${error}</div>`;
                document.body.appendChild(msg);

                // Selecciona el elemento div que deseas eliminar
                var elemento = msg;

                // Configura el timeout para eliminar el div después de 5 segundos (5000 milisegundos)
                setTimeout(function() {
                    msg = ""
                    elemento.remove();
                }, 4500);



                e.preventDefault();
                e.stopPropagation();
            }




        });
    </script>
</body>

</html>


<?php

// Verifica si se ha enviado el formulario

// Recibir datos del formulario
$usuario = $_POST['usuario'];
$pregunta1 = strtolower($_POST['pregunta1']);
$pregunta2 = strtolower($_POST['pregunta2']);
$pregunta_nueva1 = strtolower($_POST['pregunta_nueva1']);
$pregunta_nueva2 = strtolower($_POST['pregunta_nueva2']);


if (isset($_POST['registrar'])) {

    if (empty($usuario) || empty($pregunta1) || empty($pregunta2) || empty($pregunta_nueva1) || empty($pregunta_nueva2)) {
        echo "<footer class='error'>

            <div class='container_title btn btn-danger'>
            <h5 class='title-h1'> Los datos no pueden estar vacios</h5>
            </div>

    
            </footer>";

        exit;
    }




//prerarar sentencia 1
// Consulta para verificar las respuestas de seguridad
        $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

//fin

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pregunta1_bd = $row['respuesta_seguridad1'];
    $pregunta2_bd = $row['respuesta_seguridad2'];
    $stmt->close();

    // Verificar las respuestas de seguridad y actualizar la contraseña
    if (password_verify($pregunta1, $pregunta1_bd) && password_verify($pregunta2, $pregunta2_bd)) {
        
        //preparar sentencia 2
        // Las respuestas coinciden, actualiza la contraseña
        $pregunta1_cifrada = password_hash($pregunta_nueva1, PASSWORD_ARGON2ID);
        $pregunta2_cifrada = password_hash($pregunta_nueva2, PASSWORD_ARGON2ID);
        $update_sql = "UPDATE usuario SET respuesta_seguridad1 = ?, respuesta_seguridad2 = ? WHERE nombre_usuario = ?";
        $stmt = $connect->prepare($update_sql);
        $stmt->bind_param("sss", $pregunta1_cifrada, $pregunta2_cifrada, $usuario);
        //fin
        if ($stmt->execute()) {
            if($usuario === 'admin'){
                echo"<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuario.php'</script>";
                exit();
            }else{
                echo"<script> window.location='http://localhost/dashboard/Proyecto/public/display.php'</script>";
                exit();
            }
            
        }else {

            echo '<script>						
		var msg = document.createElement("div");

					msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
									<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
									<p class=" text-[11px] ghost pb-1">Hay un error en la contraseña</p> 
							</div>
					</div>`;

									var elemento = msg;
									setTimeout(function() {
										elemento.remove();
									}, 4000);
	document.body.appendChild(msg);

</script>' . $connect->error;
        } $stmt->close();
    } else {
        echo '<script>						
		var msg = document.createElement("div");

					msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
									<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
									<p class=" text-[11px] ghost pb-1">Las respuestas de seguridad no coinciden</p> 
							</div>
					</div>`;

									var elemento = msg;
									setTimeout(function() {
										elemento.remove();
									}, 4000);
	document.body.appendChild(msg);

</script>';
		exit;
    }
} else {

    echo '<script>						
		var msg = document.createElement("div");

					msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
									<svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
									<p class=" text-[11px] ghost pb-1">Ese Usuario no existe</p> 
							</div>
					</div>`;

									var elemento = msg;
									setTimeout(function() {
										elemento.remove();
									}, 4000);
	document.body.appendChild(msg);

</script>';
    exit;
}

}
?>