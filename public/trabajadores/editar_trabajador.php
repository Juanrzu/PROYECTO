<?php

session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
    header('location: ./../login/login.php');
    die();
}
include './../connect.php';
include '../contador_sesion.php';
    
    $id=$_GET['editarid'];
    $sql = "SELECT * FROM trabajadores WHERE id = $id";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $telefono= $row['telefono'];
         $cedula=$row['cedula'];
         $rol= $row['rol']; 


           //guardar datos viejos
         $nombre_anterior = $nombre;
         $apellido_anterior = $apellido;
         $cedula_anterior = $cedula;
         $telefono_anterior = $telefono;
         $rol_anterior = $rol;
         //fin 
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajadores</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>
</head>

<body class="bg-ghost">

    <div class="container-lg w-full flex flex-col">


       
        <div class="container-loading fixed flex items-center justify-center w-screen h-screen bg-gray-700 bg-opacity-75">
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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


     <main class="flex justify-center items-center xl:px-56 mt-8">
            <!-- Mostrar el mensaje de error aquí con echo -->
            
            <?php if (!empty($error)) : ?>
                <p class="text-red-500 mb-4"><?php echo $error[0]; ?></p>
            <?php endif; ?>
            
            <form method="post" class="w-full max-w-screen-sm rounded-md border border-gray-300 p-6 shadow-sm bg-white" id="formulario" novalidate>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        
        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Nombre del trabajador" name="nombre" maxlength="25" id="nombre" autocomplete="off" value="<?php echo $nombre; ?>">
        </div>
        
        <!-- Apellido -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Apellido del trabajador" name="apellido" maxlength="25" id="apellido" autocomplete="off" value="<?php echo $apellido; ?>">
        </div>
        
        <!-- Cédula -->
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cedula</label>
            <input type="number" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Cedula" name="cedula" id="cedula" autocomplete="off" maxlength="25" value="<?php echo $cedula; ?>">
        </div>
        
        <!-- Teléfono -->
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Telefono</label>
            <div class="flex">
                <select class="px-4 py-3 rounded-l-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="codigo" id="codigo" required>
                    <option value="0268">0268</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                    <option value="0412">0412</option>
                </select>
                <input type="text" class="block w-full px-4 py-3 rounded-r-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Telefono" name="telefono" autocomplete="off" maxlength="7" id="telefono" required value="<?php echo $telefono; ?>">
            </div>
        </div>
        
        <!-- Rol -->
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Rol" name="rol" id="rol" autocomplete="off" maxlength="25" value="<?php echo $rol; ?>">
        </div>
        
        <!-- Botones -->
        <div class="col-span-2 mt-6 flex flex-col sm:flex-row gap-3 ">
                    <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        Finalizar
                    </button>
                    <button type="button" onclick="regresarPaginaAnterior()" class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
                        Regresar
                    </button>
                </div>
    </div>

                <!-- Modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <div class="relative bg-white rounded-md shadow-md border border-gray-300">
                            <div class="flex items-center justify-between p-4 border-b border-gray-300">
                                <h3 class="text-lg font-semibold text-gray-700">Confirmación</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 space-y-4">
                                <p class="text-sm text-gray-600">¿Está seguro que quiere editar este alumno?</p>
                            </div>
                            <div class="flex items-center p-4 border-t border-gray-300">
                                <button data-modal-hide="default-modal" type="submit" name="submit" id="btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                    Confirmar
                                </button>
                                <button data-modal-hide="default-modal" type="button" class="px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
</form>
       
    </main>

    </div>
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

if (isset($_POST['registrar'])){
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $cedula_nueva= $_POST['cedula'];
        $telefono=$_POST['telefono'];
        $codigo=$_POST['codigo'];
        $codigo = ($codigo . $telefono);
        $rol=$_POST['rol'];
        $error=[];

        if (empty($nombre) || empty($apellido) || empty($cedula) || empty($telefono) || empty($rol)) {
            echo "<footer class='error'>
            <div class='container_title btn btn-danger'>
                <h5>Los datos no pueden estar vacios</h5>
            </div>
        
            </footer>";
              
            exit();
        }
        
        //Verificar Sección
        $cambios = [];
            
        if ($apellido_anterior != $apellido) {
            $cambios[] = "Apellido anterior = $apellido_anterior, Apellido actualizado = $apellido";
        }
        if ($nombre_anterior != $nombre) {
            $cambios[] = "Nombre anterior = $nombre_anterior, Nombre actualizado = $nombre";
        }
        if ($cedula_anterior != $cedula) {
            $cambios[] = "Cedula anterior = $cen_anterior, Cedula actualizado = $cedula";
        }           
        if ($telefono_anterior != $telefono) {
            $cambios[] = "Telefono anterior = $telefono_anterior, Telefono actualizado = $codigo";
        }
        if ($rol_anterior != $rol) {
            $cambios[] = "Rol anterior = $rol_anterior, Rol actualizada = $rol";
        }

            // Unir todos los cambios en un string
            $datos_accion = implode(", ", $cambios);
            $datos_accion = "Cambios: " . $datos_accion;

         //ingresar insert en bitacora 
       $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
       $stmt2 = $connect->prepare($sql2);
       $accion= "Se actualizo un trabajador.";
       $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
       $resultInsert2 = $stmt2->execute();
         //aqui termina

        $sql= "
        update trabajadores set nombre='$nombre', apellido='$apellido', cedula='$cedula_nueva', telefono = '$codigo', rol = '$rol' where id=$id
        ";

        $result= mysqli_query($connect, $sql);
    
        if($result){
            //echo "Se ha editado el profesor";
            echo" <script> window.location='trabajadores.php'</script>";
        }else{
            die (mysqli_error($connect));
        } include 'connect.php';
    }
?>