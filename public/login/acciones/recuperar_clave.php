<?php
include './../../connect.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/output.css">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>Recuperar Contraseña</title>
</head>

<body class="bg-login">

    <div class="container-lg w-full h-full">
        <header class="header-login w-full flex items-center justify-between px-2 py-4 ">
            
            <div class="container_title text-xl lg:text-3xl">
                <h1 class="title-h1 ghost">E.B "Cesar Arteaga Castro"</h1>
            </div>

            <div class="container-escudo bg-slate-300 rounded-full">
                <img class=" object-cover w-16 h-16" src="http://localhost/dashboard/Proyecto/src/escudo.png" alt="">
            </div>
        </header>
        <main class="h-screen w-full flex justify-center items-center flex-col">

            <form id="formulario" class="space-y-6 rounded-xl p-4 py-8 mx-20 drop-shadow-lg bg-gray-500 bg-opacity-80" method="POST">
                <div class="item-form">
                    <label for="usuario" class="block text-sm font-medium leading-6 dim">Usuario</label>
                    
                    <div class="mt-2">
                        <input name="usuario" type="text" id="usuario" placeholder="Ingrese el usuario" class="block w-full rounded-md border-0 px-2 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="item-form">
                    <label class="block text-sm font-medium leading-6 dim">¿Cual es el nombre de su madre o padre?</label>

                    <div class="mt-2 ">
                        <input type="password" id="p1" class="block w-full rounded-md border-0 px-2 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6" name="pregunta1" placeholder="Ingrese su respuesta" required class="block w-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="item-form">
                    <label class="block text-sm font-medium leading-6 dim">¿Cual es su animal favorito?</label>
                    <div class="mt-2 ">
                        <input type="password" id="p2" class="block w-full rounded-md border-0 px-2 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6" name="pregunta2" placeholder="Ingrese su respuesta" class="block w-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                

                <div class="item-form">
                    <label class="block text-sm font-medium leading-6 dim">Ingrese la nueva Contraseña</label>
                    <div class="mt-2 ">
                        <input type="password" id="contraseña" class="block w-full rounded-md border-0 px-2 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6" name="contraseña" placeholder="Ingrese su respuesta" class="block w-full rounded-md border-0 px-2 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:dim focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

            <div class="text-sm">
                    <a href='http://localhost\dashboard\Proyecto\public\login\login.php' class="font-semibold text-xs text-indigo-500 hover:text-blue-800">Ya tiene una cuenta?</a>
                </div>
            <div>
                <button type="submit" id="btn" name="registrar" class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-indigo-500 shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Iniciar sesion</button>
            </div>
            
            </form>
            </main>


            <footer class="flex justify-between items-center mx-4 py-2">
                    <p class="ghost">Todos Los derechos reservados 2024</p>
                    <a  class="btn bg-slate-50 rounded-full" href="https://creativecommons.org/licenses/by-sa/4.0/">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="32px" height="32px" viewBox="0 0 512 512"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/>
                        Licencia Creative Commons
                    </svg>
                    </a>
            </footer>


            <script>
						const form = document.getElementById('formulario');
						const btn = document.getElementById('btn')
						const usuario = document.getElementById('usuario');
                        const p1 = document.getElementById('p1');
                        const p2 = document.getElementById('p2');
						const contraseña = document.getElementById('contraseña');
                        
                        


						btn.addEventListener("click", (e)=>{
							const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
							var error = "";
                            var msg = document.createElement("div");

                            
									if(usuario.value == "" || contraseña.value == "" || p1.value == "" || p2.value == ""){
										error += `<div class="w-full flex justify-start items-center border-b-2 border-gray-300 pb-1">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost">Los campos no pueden estar vacios</p> 
                                            </div>`;
										usuario.classList.add('invalid');
										contraseña.classList.add('invalid');
                                        p1.classList.add('invalid');
										p2.classList.add('invalid');

                                        }else{
                                            if(!regex.test(usuario.value)){
                                            error += `<div class="flex justify-center items-center border-b-2 border-gray-300 pb-1">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost">ingrese un usuario con caracteres valido</p> 
                                            </div>`;
                                            usuario.classList.add('invalid')
                                            }else{
                                            usuario.classList.remove('invalid');
                                            contraseña.classList.remove('invalid');
                                        }
                                    }

                                            if(!regex.test(p1.value) || !regex.test(p2.value)){
                                            error += `<div class="flex justify-center items-center border-b-2 border-gray-300 pb-1">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs ghost">Ingrese una respuesta con caracteres validos</p> 
                                            </div>`;
                                            p1.classList.add('invalid');
                                            p2.classList.add('invalid');
                                            }else{
                                            p1.classList.remove('invalid');
                                            p2.classList.remove('invalid');
                                            }
                                        
                                 

                                   
									if(usuario.classList.contains("invalid") || contraseña.classList.contains("invalid") || p1.classList.contains("invalid") || p2.classList.contains("invalid")){
                                        msg.innerHTML = `<div class="fixed bottom-12 right-2 fixed bottom-12 right-2 mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">${error}</div>`;
					document.body.appendChild(msg);

					// Selecciona el elemento div que deseas eliminar
					var elemento = msg;

					// Configura el timeout para eliminar el div después de 5 segundos (5000 milisegundos)
					setTimeout(function() {
						msg = ""
						elemento.remove();
					}, 4000);



					e.preventDefault();
					e.stopPropagation();
									}
						})

		</script>






        <?php
            // Verifica si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Conexión a la base de datos (ajusta los detalles según tu configuración)
                include '../../connect.php';

                // Recibir datos del formulario
                $usuario = $_POST['usuario'];
                $pregunta1 = strtolower($_POST['pregunta1']);
                $pregunta2 = strtolower($_POST['pregunta2']);
                $nueva_contraseña = $_POST['contraseña'];


            if(isset($_POST['registrar'])){


                if (empty($usuario) || empty($pregunta1) || empty($pregunta2) || empty($nueva_contraseña)) {
                    echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Los campos no puede estar vacios</p>
						</div>';
                        exit;
                }
            }
                //preparar sentencia 1
                // Consulta para verificar las respuestas de seguridad
                $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                
                //fin
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $pregunta1_bd = $row['respuesta_seguridad1'];
                    $pregunta2_bd = $row['respuesta_seguridad2'];
                    

                // Verificar las respuestas de seguridad y actualizar la contraseña
                if (password_verify($pregunta1, $pregunta1_bd) && password_verify($pregunta2, $pregunta2_bd)) {

                    //preparar sentencia 2
                    // Las respuestas coinciden, actualiza la contraseña
            
                    $contraseña_cifrada = password_hash($nueva_contraseña, PASSWORD_ARGON2ID);
                    $update_sql = "UPDATE usuario SET contraseña = ? WHERE nombre_usuario = ?";
                    $stmt = $connect->prepare($update_sql);
                    $stmt->bind_param("ss", $contraseña_cifrada, $usuario);
                    if ($stmt->execute() === TRUE) {
                    
                    echo"<script> window.location='http://localhost/dashboard/Proyecto/public/login/login.php'</script>";
                    
                    }
                    else {

                        echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">La contraseña es incorrecta</p>
						</div>'. $connect->error;
                    } $stmt->close();
                     //fin
                } else {
                    echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Una de las respuesta es incorrecta</p>
						</div>';
                }
                    } else {
                echo '<div class="error mt-2 px-2 py-4 text-center bg-indigo-500 rounded-xl">
							<svg fill="#f00505" width="40px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path> </g></svg>
						    <p class="mx-auto text-xs">Usuario no encontrado</p>
						</div>';
                }
            }

    ?>
</body>
</html>
