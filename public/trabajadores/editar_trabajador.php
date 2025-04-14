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
        <div class="col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
            <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Nombre del trabajador" name="nombre" maxlength="25" id="nombre" autocomplete="off" value="<?php echo $nombre; ?>">
        </div>
        
        <!-- Apellido -->
        <div class="col-span-1">
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
                <input type="text" class="block w-full px-4 py-3 rounded-r-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="Telefono" name="telefono" autocomplete="off" maxlength="11" id="telefono" required value="<?php echo $telefono; ?>">
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
    <script>
            function regresarPaginaAnterior() {
                window.history.back();
            }
        </script>
        <script src="http://localhost/dashboard/Proyecto/node_modules/flowbite/dist/flowbite.min.js"></script>
        <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
        <script>


    const form = document.getElementById('formulario');
    const btn = document.getElementById('btn');
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        cedula: document.getElementById('cedula'),
        telefono: document.getElementById('telefono'),
        rol: document.getElementById('rol')
    };

    const regex = {
        soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
        soloNumeros: /^\d+$/,
    };

    const LIMITES = {
        nombre: { min: 2, max: 25 },
        apellido: { min: 2, max: 25 },
        telefono: { min: 7, max: 12 },
        cedula: { min: 2, max: 25 }
    };

    const mostrarNotificacion = (mensaje, tipo = 'error') => {
        const sanitizeHTML = (str) => {
            const temp = document.createElement('div');
            temp.textContent = str;
            return temp.innerHTML;
        };

        const icono = tipo === 'error' ?
            `<svg fill="#f00505" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path>
            </svg>` :
            `<svg fill="#4BB543" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4.71,7.71-5,5a1,1,0,0,1-1.42,0l-3-3a1,1,0,0,1,1.42-1.42L11,12.59l4.29-4.3a1,1,0,0,1,1.42,1.42Z"/>
            </svg>`;

        const color = tipo === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';

        document.querySelectorAll('.notificacion').forEach(el => el.remove());

        const notificacion = document.createElement('div');
        notificacion.className = `notificacion fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${color} border flex items-center`;
        notificacion.innerHTML = `
            <div class="flex-shrink-0 mr-3">${icono}</div>
            <div class="text-sm">${sanitizeHTML(mensaje)}</div>
        `;

        document.body.appendChild(notificacion);

        setTimeout(() => {
            notificacion.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => notificacion.remove(), 500);
        }, 4000);
    };

    const validarCampo = (input, regex = null, minLength = 0, maxLength = Infinity, mensaje = null) => {
        const valor = input.value.trim();
        input.classList.remove('border-red-500');

        if (!valor) {
            return { valido: false, mensaje: mensaje || `El campo ${input.id} no puede estar vacíossssssssssss` };
        }

        if (regex && !regex.test(valor)) {
            return { valido: false, mensaje: mensaje || `Formato inválido para ${input.id}ss` };
        }

        if (valor.length < minLength) {
            return { valido: false, mensaje: mensaje || `${input.id} debe tener al menos ${minLength} caracteressssss` };
        }

        if (valor.length > maxLength) {
            return { valido: false, mensaje: mensaje || `${input.id} no puede exceder los ${maxLength} caracteresssss` };
        }

        return { valido: true };
    };

    form.addEventListener("submit", (e) => {
    // Limpiar errores previos
    Object.values(inputs).forEach(input => input.classList.remove('border-red-500'));
    
    // Validaciones
    const validaciones = [
        { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre.min, LIMITES.nombre.max, "Nombre inválido") },
        { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido.min, LIMITES.apellido.max, "Apellido inválido") },
        { input: inputs.cedula, resultado: validarCampo(inputs.cedula, regex.soloNumeros, LIMITES.cedula.min, LIMITES.cedula.max, "Cédula inválida") },
        { input: inputs.telefono, resultado: validarCampo(inputs.telefono, regex.soloNumeros, LIMITES.telefono.min, LIMITES.telefono.max, "Teléfono inválido") }
    ];

    // Verificar si hay errores
    const errores = validaciones.filter(v => !v.resultado.valido);
    
    if (errores.length > 0) {
        e.preventDefault(); // Detener el envío si hay errores
        errores[0].input.classList.add('border-red-500');
        mostrarNotificacion(errores[0].resultado.mensaje);
    }
    // Si no hay errores, el formulario se enviará automáticamente
});
</script>
</body>

</html>

<?php

if (isset($_POST['submit'])){

        // Recibir datos del formulario
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $cedula = trim($_POST['cedula']);
        $telefono = trim($_POST['telefono']);
        $rol = trim($_POST['rol']);
     
    
        // Configuración de límites y expresiones regulares
        $LIMITES = [
            'nombre' => ['min' => 2, 'max' => 25],
            'apellido' => ['min' => 2, 'max' => 25],
            'cedula' => ['min' => 6, 'max' => 12],
            'telefono' => ['min' => 7, 'max' => 11],
            'rol' => ['min' => 2, 'max' => 25]
        ];
    
        $regex = [
            'soloLetras' => '/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/',
            'soloNumeros' => '/^\d+$/',
        ];
    
        $errores = [];
    
        // Función para validar campos
        function validarCampo($valor, $regex = null, $limites, $campo) {
            if (empty($valor)) return "$campo no puede estar vacío.";
            if ($regex && !preg_match($regex, $valor)) return "Formato inválido en $campo.";
            if (strlen($valor) < $limites['min'] || strlen($valor) > $limites['max']) {
                return "$campo debe tener entre {$limites['min']} y {$limites['max']} caracteres.";
            }
            return null;
        }
    
        // Validar todos los campos
        $errores[] = validarCampo($nombre, $regex['soloLetras'], $LIMITES['nombre'], 'Nombre');
        $errores[] = validarCampo($apellido, $regex['soloLetras'], $LIMITES['apellido'], 'Apellido');
        $errores[] = validarCampo($cedula, $regex['soloNumeros'], $LIMITES['cedula'], 'Cedula');
        $errores[] = validarCampo($telefono, $regex['soloNumeros'], $LIMITES['telefono'], 'Teléfono');
        $errores[] = validarCampo($rol, $regex['soloLetras'], $LIMITES['rol'], 'rol');
    
    
        // Filtrar errores vacíos
        $errores = array_filter($errores);
    
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo "<script>
                    const notificacion = document.createElement('div');
                    notificacion.className = 'fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg bg-red-100 text-red-700 border flex items-center';
                    notificacion.innerHTML = `<span>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</span>`;
                    document.body.appendChild(notificacion);
                    setTimeout(() => notificacion.remove(), 4000);
                </script>";
            }
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
        update trabajadores set nombre='$nombre', apellido='$apellido', cedula='$cedula', telefono = '$telefono', rol = '$rol' where id=$id
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