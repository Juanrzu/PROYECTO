<?php
session_start();
error_reporting(0);
$usuarioSeccion = $_SESSION['nombre_usuario'];
if ($usuarioSeccion == null || $usuarioSeccion == '' || ($usuarioSeccion != 'admin' && $usuarioSeccion != 'Admin')) {
    header('location: ../login/login.php');
    die();
}
include '../connect.php';
include '../contador_sesion.php';

$id = $_GET['editarid'];
$sql = "SELECT * FROM usuario WHERE id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$usuario = $row['nombre_usuario'];
$contraseña = $row['contraseña'];
$estado = $row['estado'];
$nombre = $row['nombre'];
$apellido = $row['apellido'];
$cedula = $row['cedula'];
$telefono = $row['telefono'];
$gmail = $row['correo'];
$intentos_fallidos = $row['intentos_fallidos'];


 //guardar datos viejos
 $nombre_anterior = $nombre;
 $usuario_anterior = $usuario;
 $apellido_anterior = $apellido;
 $cedula_anterior = $cedula;
 $telefono_anterior = $telefono;
 $estado_anterior = $estado;
 $gmail_anterior = $gmail;
 //fin 
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
</head>

<body class="bg-gray-50">
    <!-- Loading Screen -->
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
    if ($usuarioSeccion == "admin" || $usuarioSeccion == "Admin") {
        include('../header_admin.php');
    } else {
        header('location: ../display.php');
        include('../header.php');
    }
    ?>

    <main class="container mx-auto px-4 py-8">
        <form method="post" class="w-full max-w-screen-sm mx-auto rounded-md border border-gray-300 p-6 shadow-sm bg-white" id="formulario" novalidate>
            <div class="mb-6 border-b border-gray-200 pb-4">
                <h3 class="text-xl font-semibold text-gray-800">Editar Usuario</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!-- Usuario -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                    <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                         placeholder="Nombre de usuario" name="usuario" id="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
                </div>

                <!-- Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                         placeholder="Nombre del usuario" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>

                <!-- Apellido -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                    <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                         placeholder="Apellido del usuario" name="apellido" id="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>
                </div>

                <!-- Cédula -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
                    <input type="text" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                         placeholder="Cédula del usuario" name="cedula" id="cedula" value="<?php echo htmlspecialchars($cedula); ?>" required>
                </div>

                <!-- Teléfono -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                    <div class="flex items-center gap-3">
                        <select class="px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="codigo" id="codigo">
                            <option value="0268">0268</option>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                            <option value="0412">0412</option>
                        </select>
                        <input type="text" class="flex-1 px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                             placeholder="Teléfono" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
                    </div>
                </div>

                <!-- Correo Electrónico -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <input type="email" class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" 
                         placeholder="Correo del usuario" name="gmail" id="gmail" value="<?php echo htmlspecialchars($gmail); ?>" required>
                </div>

                <!-- Estado -->
                <div>
                    <label class="text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select class=" w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="estado" id="estado">
                        <option value="Activo" <?php echo $estado == "Activo" ? "selected" : ""; ?>>Activo</option>
                        <option value="Inactivo" <?php echo $estado == "Inactivo" ? "selected" : ""; ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <button type="submit" name="submit" 
                    class="w-full px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                    Guardar Cambios
                </button>    
            <button type="button" onclick="window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'" 
                    class="w-full px-4 py-3 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm border border-gray-300">
                    Cancelar
                </button>
            </div>
        </form>
    </main>

    <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById('formulario');
        const inputs = {
            usuario: document.getElementById('usuario'),
            nombre: document.getElementById('nombre'),
            apellido: document.getElementById('apellido'),
            cedula: document.getElementById('cedula'),
            telefono: document.getElementById('telefono'),
            gmail: document.getElementById('gmail'),
            estado: document.getElementById('estado')
        };

        const regex = {
            soloLetras: /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/,
            correo: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        };

        const LIMITES = {
            usuario: 20,
            nombre: 50,
            apellido: 50,
            cedula: 15,
            telefono: 15,
            gmail: 100,
            estado: 50
        };

        const mostrarNotificacion = (mensaje, tipo = 'error') => {
            const icono = tipo === 'error' 
                ? '<span style="color: red;">&#x26A0;</span>' 
                : '<span style="color: green;">&#x2714;</span>';
            
            // Eliminar notificaciones previas
            document.querySelectorAll('.notificacion').forEach(el => el.remove());

            const notificacion = document.createElement('div');
            notificacion.className = `notificacion fixed bottom-4 right-4 px-4 py-3 rounded shadow-lg ${
                tipo === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700'
            }`;
            notificacion.innerHTML = `${icono} ${mensaje}`;
            document.body.appendChild(notificacion);

            setTimeout(() => notificacion.remove(), 4000);
        };

        const validarCampo = (input, regex = null, maxLength = Infinity, mensajeVacio = null, mensajeInvalido = null) => {
            const valor = input.value.trim();
            input.classList.remove('border-red-500');

            if (!valor) {
                input.classList.add('border-red-500');
                return { valido: false, mensaje: mensajeVacio || `El campo ${input.id} no puede estar vacío` };
            }

            if (regex && !regex.test(valor)) {
                input.classList.add('border-red-500');
                return { valido: false, mensaje: mensajeInvalido || `Formato inválido para ${input.id}` };
            }

            if (valor.length > maxLength) {
                input.classList.add('border-red-500');
                return { valido: false, mensaje: `El campo ${input.id} no puede tener más de ${maxLength} caracteres` };
            }

            return { valido: true };
        };

        form.addEventListener("submit", (e) => {
            let errores = [];

            const validaciones = [
                { input: inputs.usuario, resultado: validarCampo(inputs.usuario, null, LIMITES.usuario, 'El usuario es obligatorio') },
                { input: inputs.nombre, resultado: validarCampo(inputs.nombre, regex.soloLetras, LIMITES.nombre, 'El nombre es obligatorio', 'Solo se permiten letras') },
                { input: inputs.apellido, resultado: validarCampo(inputs.apellido, regex.soloLetras, LIMITES.apellido, 'El apellido es obligatorio', 'Solo se permiten letras') },
                { input: inputs.cedula, resultado: validarCampo(inputs.cedula, null, LIMITES.cedula, 'La cédula es obligatoria') },
                { input: inputs.telefono, resultado: validarCampo(inputs.telefono, null, LIMITES.telefono, 'El teléfono es obligatorio') },
                { input: inputs.gmail, resultado: validarCampo(inputs.gmail, regex.correo, LIMITES.gmail, 'El correo es obligatorio', 'Formato de correo inválido') },
                { input: inputs.estado, resultado: validarCampo(inputs.estado, null, LIMITES.estado, 'El estado es obligatorio') }
            ];

            validaciones.forEach(({ input, resultado }) => {
                if (!resultado.valido) {
                    errores.push(resultado.mensaje);
                }
            });

            if (errores.length > 0) {
                mostrarNotificacion(errores.join('<br>'));
                return;
            }

            mostrarNotificacion('Formulario enviado correctamente', 'success');
            form.submit();
        });
    });
</script>




<?php
        
        if (isset($_POST['submit'])){
            $usuario = $_POST['usuario']; 
            $estado = $_POST['estado'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];  
            $cedula = $_POST['cedula'];
            $telefono = $_POST['telefono'];
            $codigo= strval($_POST['codigo']);
            $codigo = ($codigo . $telefono);
            $correo = $_POST['gmail'];
     
            if (empty($usuario) || empty($estado) || empty($nombre) || empty($apellido) || empty($cedula) || empty($codigo) || empty($correo)) {
                
                echo "<div >
                    <div class='container_title btn btn-danger'>
                        <h5 class='title-h1'>Los datos no pueden estar vacios</h5>
                    </div>
            
                </div>";
                exit;
            
            }

           // Verificar usuario existente 
                $sql_verificar_usuario = "SELECT * FROM usuario WHERE nombre_usuario = ? AND id != ?";
                $stmt_usuario = $connect->prepare($sql_verificar_usuario);
                $stmt_usuario->bind_param("si", $usuario, $id);
                $stmt_usuario->execute();
                if ($stmt_usuario->get_result()->num_rows > 0) {
                    $errores[] = "Este usuario ya se encuentra registrado";
                }
                $stmt_usuario->close();

                // Verificar cédula existente 
                $sql_verificar_cedula = "SELECT * FROM usuario WHERE cedula = ? AND id != ?";
                $stmt_cedula = $connect->prepare($sql_verificar_cedula);
                $stmt_cedula->bind_param("si", $cedula, $id);
                $stmt_cedula->execute();
                if ($stmt_cedula->get_result()->num_rows > 0) {
                    $errores[] = "La cédula ya se encuentra registrada";
                }
                $stmt_cedula->close();

                // Verificar teléfono existente 
                $sql_verificar_telefono = "SELECT * FROM usuario WHERE telefono = ? AND id != ?";
                $stmt_telefono = $connect->prepare($sql_verificar_telefono);
                $stmt_telefono->bind_param("si", $codigo, $id);
                $stmt_telefono->execute();
                if ($stmt_telefono->get_result()->num_rows > 0) {
                    $errores[] = "El teléfono ya se encuentra registrado";
                }
                $stmt_telefono->close();

                // Verificar correo existente 
                $sql_verificar_correo = "SELECT * FROM usuario WHERE correo = ? AND id != ?";
                $stmt_correo = $connect->prepare($sql_verificar_correo);
                $stmt_correo->bind_param("si", $correo, $id);
                $stmt_correo->execute();
                if ($stmt_correo->get_result()->num_rows > 0) {
                    $errores[] = "Este correo ya se encuentra registrado";
                }
                $stmt_correo->close();

            
                if(!empty($errores)){
                    echo "<div >
                            <div class='container_title btn btn-danger'>
                            
                                <h5>Se encontraron los siguientes errores:</h5>";
                    echo "<ul>";
                    foreach($errores as $error){
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>
                        </div>";
                    exit;
                }
                //preparar bitacora
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
                if ($gmail_anterior != $gmail) {
                    $cambios[] = "Gmail anterior = $gmail_anterior, Gmail actualizada = $gmail";
                }
                if ($estado_anterior != $estado) {
                    $cambios[] = "Estado anterior = $estado_anterior, Estado actualizada = $estado";
                }
                if ($usuario_anterior != $usuario) {
                    $cambios[] = "Usuario anterior = $usuario_anterior, Usuario actualizada = $usuario";
                }
      
                    // Unir todos los cambios en un string
                    $datos_accion = implode(", ", $cambios);
                    $datos_accion = "Cambios: " . $datos_accion;
        
                 //ingresar insert en bitacora 
               $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
               $stmt2 = $connect->prepare($sql2);
               $accion= "Se actualizo un usuario.";
               $stmt2->bind_param("sss", $accion, $datos_accion, $usuarioSeccion);
               $resultInsert2 = $stmt2->execute();
                 //aqui termina



                //sentencia 2
                if ($estado == "Activo"){
                    $sql1 = "UPDATE usuario SET 
                                nombre = ?, 
                                apellido = ?, 
                                cedula = ?, 
                                telefono = ?, 
                                correo = ?, 
                                nombre_usuario = ?, 
                                contraseña = ?,
                                intentos_fallidos = 0, 
                                estado = ? 
                            WHERE id = ?";

                    $stmt = $connect->prepare($sql1);
                    if ($stmt) {
                        $stmt->bind_param("ssssssssi", 
                            $nombre, 
                            $apellido, 
                            $cedula, 
                            $codigo, 
                            $gmail, 
                            $usuario, 
                            $contraseña,
                            $estado, 
                            $id
                        );}
    
            
                    if ($stmt->execute()) {
                        echo"<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
                        $stmt->close();
                    } else {
                        die(mysqli_error($connect));
                    }
                }
                //sentencia 3
                if  ($estado == "Inactivo"){

                        $sql1 = "UPDATE usuario SET 
                            nombre = ?, 
                            apellido = ?, 
                            cedula = ?, 
                            telefono = ?, 
                            correo = ?, 
                            nombre_usuario = ?, 
                            contraseña = ?,
                            intentos_fallidos = ?, 
                            estado = ? 
                        WHERE id = ?";

                $stmt = $connect->prepare($sql1);
                    if ($stmt) {
                        $stmt->bind_param("ssssssssi", 
                            $nombre, 
                            $apellido, 
                            $cedula, 
                            $codigo, 
                            $gmail, 
                            $usuario, 
                            $contraseña,
                            $intentos_fallidos,
                            $estado,
                            $id
                        );}
                

        
                if ($stmt->execute()) {
                    echo"<script> window.location='http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php'</script>";
                    $stmt->close();
                } else {
                    die(mysqli_error($connect));
                }
            } 
        }


       ?>
