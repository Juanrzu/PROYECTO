<?php
session_start();

$usuario = $_SESSION['nombre_usuario'];

if (!isset($usuario)) {
    header("location: login.php");
} else {
    include('connect.php');
    include 'contador_sesion.php';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
    <title>estudiantes</title>
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

            <?php if (!empty($error)): ?>
                <p class="text-danger"><?php echo $error[0]; ?></p>
            <?php endif; ?>
            <form method="post" class="w-80 rounded-xl p-4 py-8 shadow-lg bg-gray-100" id="formulario" novalidate>
                <div class="mb-3">
                    <label>Nombres</label>
                    <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Nombres del Alumno" name="nombre" id="nombre"
                        autocomplete="off" maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label>Apellidos</label>
                    <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Apellidos del Alumno" name="apellido"
                        id="apellido" autocomplete="off" maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label>C.E.N</label>
                    <input type="number" class="form-control form-control w-full mt-2 rounded-lg" placeholder="C.E.N" name="cen" autocomplete="off" id="cen"
                        maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label>Nacimiento</label>
                    <input type="date" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Fecha de Nacimiento" name="nacimiento"
                        id="nacimiento" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>Sexo</label>
                    <select class="form-control form-control w-full mt-2 rounded-lg" name="sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Representante</label>
                    <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Nombre del Representante" name="representante"
                        id="representante-nombre" maxlength="25" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>Apellido del representante</label>
                    <input type="text" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Apellido del Representante"
                        name="representante_apellido" id="representante-apellido" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>C.I Representante</label>
                    <input type="number" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Cédula del Representante" name="cedularepre"
                        id="cedula" maxlength="12" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>Telefono</label>
                    <div class="input-group has-validation">
                        <select class="input-group-text" name="codigo" id="codigo" required>
                            <option value=0268>0268</option>
                            <option value=0414>0414</option>
                            <option value=0424>0424</option>
                            <option value=0416>0416</option>
                            <option value=0426>0426</option>
                            <option value=0412>0412</option>
                        </select>
                        <input type="text" class="form-control w-[67%] mt-2 rounded-lg" placeholder="Telefono" name="telefono"
                            autocomplete="off" maxlength="7" id="telefono" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Correo Electornico</label>
                    <input type="email" class="form-control form-control w-full mt-2 rounded-lg" placeholder="Correo" name="correo" id="email"
                        autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>Grado</label>
                    <select class="form-control form-control w-full mt-2 rounded-lg" name="grado">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Seccion</label>
                    <select class="form-control form-control w-full mt-2 rounded-lg" name="seccion">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="mb-2">
                    <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">FINALIZAR</button>

                </div>
                <div class="mb-2">
                    <button type="button" onclick="regresarPaginaAnterior()"
                        class="flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 ghost bg-blue-500 shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Regresar
                        a la página anterior</button>
                </div>

                <div id="default-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="relative p-4 max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-28">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Sistema
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="default-modal">
                                    <svg class="w-4 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="default-modal" type="submit" name="submit"
                                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SI</button>
                                <button data-modal-hide="default-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">no</button>
                            </div>
                        </div>
                    </div>


            </form>

            </section>

        </main>


        <div class="w-full text-white">p</div>
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

if (isset($_POST['submit'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cen = $_POST['cen'];
    $nacimiento = $_POST['nacimiento'];
    $sexo = $_POST['sexo'];
    $representante = $_POST['representante'];
    $representante_apellido = $_POST['representante_apellido'];
    $cedularepre = $_POST['cedularepre'];
    $telefono = strval($_POST['telefono']);
    $codigo = strval($_POST['codigo']);
    $codigo = ($codigo . $telefono);

    $correo = $_POST['correo'];
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];
    $volver = $grado;
    $volver2 = $seccion;
    $sexo = strtoupper($sexo);
    $error = [];

    if (empty($nombre) || empty($apellido) || empty($cen) || empty($nacimiento) || empty($sexo) || empty($representante) || empty($representante_apellido) || empty($cedularepre) || empty($codigo) || empty($correo) || empty($grado) || empty($seccion)) {

        echo "<div >
            <div class='container_title btn btn-danger'>
                <h5>Los datos no pueden estar vacios</h5>
            </div>
    
        </div>";
        exit;

    }

    $sql_verificar_estudiante = "SELECT * FROM estudiantes WHERE cen = '$cen'";
    $resultado_estudiante = mysqli_query($connect, $sql_verificar_estudiante);
    if (mysqli_num_rows($resultado_estudiante) > 0) {
        echo "<div >
                        <div class='container_title btn btn-danger'>
                            <h5>*Ya se encuentra registrado un estudiante con esta cedula</h5>
                        </div>
                
                    </div>";
        exit;
    }



    // aqui empieza          
    // Verificar si el representante ya existe
    $queryCheckRepre = "SELECT id FROM representante WHERE cedula = '$cedularepre'";
    $resultCheckRepre = mysqli_query($connect, $queryCheckRepre);

    if (!$resultCheckRepre) {
        die("Error al verificar el representante: " . mysqli_error($connect));
    }

    if (mysqli_num_rows($resultCheckRepre) > 0) {
        // El representante ya existe, obtener su ID
        $rowRepre = mysqli_fetch_assoc($resultCheckRepre);
        $idRepre = $rowRepre['id'];
    } else {
        if ($cen == $cedularepre) {
            $errores[] = "La cedula del estudiante y la del representante son las mismas";
        }
        $sql_verificar_cedula = "SELECT * FROM estudiantes WHERE cen = '$cedularepre' ";
        $resultado_cedula = mysqli_query($connect, $sql_verificar_cedula);
        if (mysqli_num_rows($resultado_cedula) > 0) {
            $errores[] = "La cedula del representante ingresada se encuenta registrada con un estudiante";


        }
        $sql_verificar_cedula = "SELECT * FROM profesor WHERE cedula = '$cen' ";
        $resultado_cedula = mysqli_query($connect, $sql_verificar_cedula);
        if (mysqli_num_rows($resultado_cedula) > 0) {
            $errores[] = "La cedula del estudiante ingresada se encuenta registrada con un profesor";
        }

        $sql_verificar_cedula2 = "SELECT * FROM profesor WHERE cedula = '$cedularepre' AND (nombre != '$representante' OR apellido != '$representante_apellido')";
        $resultado_cedula2 = mysqli_query($connect, $sql_verificar_cedula2);
        if (mysqli_num_rows($resultado_cedula2) > 0) {
            $errores[] = "La cedula del representante coincide con un profesor pero el nombre o apellido es diferentes";

        }
        $sql_verificar_cedula3 = "SELECT * FROM usuario WHERE cedula = '$cedularepre' AND (nombre != '$representante' OR apellido != '$representante_apellido')";
        $resultado_cedula3 = mysqli_query($connect, $sql_verificar_cedula3);
        if (mysqli_num_rows($resultado_cedula3) > 0) {
            $errores[] = "La cedula del representante coincide con un usuario del sistema pero el nombre o apellido es diferentes";


        }
        $sql_verificar_cedula4 = "SELECT * FROM representante WHERE cedula = '$cen' ";
        $resultado_cedula4 = mysqli_query($connect, $sql_verificar_cedula4);
        if (mysqli_num_rows($resultado_cedula4) > 0) {
            $errores[] = "La cedula escolar ingresada para el estudiante  se encuenta registrada con un representante";


        }
        $sql_verificar_telefono = "SELECT * FROM representante WHERE telefono = '$codigo'";
        $resultado_telefono = mysqli_query($connect, $sql_verificar_telefono);
        if (mysqli_num_rows($resultado_telefono) > 0) {
            $errores[] = "Este telefono ya se encuentra registrado con otro representante";


        }
        $sql_verificar_correo = "SELECT * FROM representante WHERE correo = '$correo'";
        $resultado_correo = mysqli_query($connect, $sql_verificar_correo);
        if (mysqli_num_rows($resultado_correo) > 0) {
            $errores[] = "Este correo ya se encuentra registrado con otro representante";


        }

        if (!empty($errores)) {
            echo "<div >
                        <div class='container_title btn btn-danger'>
                        
                            <h5>Se encontraron los siguientes errores:</h5>";

            foreach ($errores as $error) {
                echo "<h5>*$error</h5>";
            }

            echo "</div>
                    </div>";
            exit;
        }

        // El representante no existe, insertarlo y obtener su nuevo ID
        $queryInsertRepre = "INSERT INTO representante (nombre, apellido,cedula, telefono, correo) 
                                        VALUES ('$representante','$representante_apellido', '$cedularepre', '$codigo', '$correo')";

        $resultInsertRepre = mysqli_query($connect, $queryInsertRepre);

        if (!$resultInsertRepre) {
            die("Error al insertar el nuevo representante: " . mysqli_error($connect));
        }

        $idRepre = mysqli_insert_id($connect);
    }
    if (!is_numeric($telefono)) {
        $errores[] = "El teléfono debe ser ingresado con numeros";

    } elseif (strlen($telefono) > 12) {
        $errores[] = "El número de teléfono es muy largo";
    } elseif (strlen($telefono) < 11) {
        $errores[] = "El número de teléfono es muy corta";
    }

    if (!is_numeric($cedularepre)) {
        $errores[] = "La cédula del representante debe ser ingresado con numeros";

    } elseif (strlen($telefono) > 12) {
        $errores[] = "El número de teléfono es muy largo";
    } elseif (strlen($telefono) < 11) {
        $errores[] = "El número de teléfono es muy corta";
    }


    // Obtener el ID del grado
    $queryGrado = "SELECT id FROM grados WHERE nombre = '$grado'";
    $resultGrado = mysqli_query($connect, $queryGrado);

    if (!$resultGrado) {
        die("Error al obtener el ID del grado: " . mysqli_error($connect));
    }

    $rowGrado = mysqli_fetch_assoc($resultGrado);
    $idgrado = $rowGrado['id'];

    // Obtener el ID de la sección
    $querySeccion = "SELECT id FROM seccion WHERE nombre = '$seccion'";
    $resultSeccion = mysqli_query($connect, $querySeccion);

    if (!$resultSeccion) {
        die("Error al obtener el ID de la sección: " . mysqli_error($connect));
    }

    $rowSeccion = mysqli_fetch_assoc($resultSeccion);
    $idseccion = $rowSeccion['id'];

    // Inserción en la tabla de estudiantes
    $sql = "INSERT INTO estudiantes (nombre, apellido, cen, nacimiento, sexo, idgrado,idseccion ,idrepresentante ) 
                        VALUES ('$nombre', '$apellido', '$cen', '$nacimiento', '$sexo', $idgrado , $idseccion, $idRepre)";

    $resultInsert = mysqli_query(mysql: $connect, query: $sql);
     
    //ingresar insert en bitacora
    $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES ('Se Insertó un nuevo estudiante.', 
    'Informacion: nombre = $nombre, apellido = $apellido , cen = $cen , nacimiento = $nacimiento, sexo = $sexo , grado = $grado, seccion = $seccion, 
    representante = $representante , Apellido del representante = $representante_apellido , cedula representante = $cedularepre, telefono = $codigo , correo = $correo', 
    '$usuario')";
    $resultInsert2 = mysqli_query(mysql: $connect, query: $sql2);
    //aqui termina


    if ($resultInsert) {
        echo "<script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2 '</script>";
    } else {
        die(mysqli_error($connect));
    }
}


?>