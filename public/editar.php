<?php

session_start();
error_reporting(0);
$usuario = $_SESSION['nombre_usuario'];
if ($usuario == null || $usuario == '') {
  header('location:./login/login.php');
  die();
}
include 'connect.php';


    $id=$_GET['editarid'];
    $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
    representante.nombre as representante_nombre, representante.apellido as representante_apellido,
    representante.cedula as representante_cedula, representante.telefono as representante_telefono,
    representante.correo as representante_correo 
    FROM estudiantes 
    JOIN seccion ON estudiantes.idseccion = seccion.id 
    JOIN grados ON estudiantes.idgrado = grados.id
    JOIN representante On estudiantes.idrepresentante = representante.id
    WHERE estudiantes.id=$id ";

    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $cen=$row['cen'];
         $nacimiento=$row['nacimiento'];
         $sexo=$row['sexo'];
         $representante=$row['representante_nombre'];
         $representante_apellido=$row['representante_apellido'];
         $cedula=$row['representante_cedula'];
         $telefono=$row['representante_telefono'];
         $correo=$row['representante_correo'];
         $grado=$row['grado_nombre'];
         $seccion=$row['seccion_nombre'];
         $idrepresentante = $row ['representante.id'];
         $volver=$grado;
         $volver2=$seccion;
         
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/src/css/styles.css">
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
        if ($nombre == "admin" || $nombre == "Admin") {
            include('./header_admin.php');
        } else {
            include('./header.php');
        }

        ?>



   
        <main class="container-sm">
           
                     <!-- Mostrar el mensaje de error aquí con echo -->
                    <?php if (!empty($error)) : ?>
                        <p class="text-danger"><?php echo $error[0]; ?></p>
                    <?php endif; ?>
                
                <form method="post" class="w-80 rounded-xl p-4 py-8 shadow-lg bg-gray-100" id="formulario" novalidate>
                    <div class="mb-3">
                        <label>Nombres</label>
                        <input type="text" class="form-control" placeholder="Nombres del Alumno" name="nombre" autocomplete="off" value=<?php echo "$nombre"; ?> id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellidos del Alumno" name="apellido" autocomplete="off" value=<?php echo "$apellido"; ?> id="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label>C.E.N</label>
                        <input type="number" class="form-control" placeholder="C.E.N" name="cen" autocomplete="off" value=<?php echo "$cen"; ?> id="cen" required>
                    </div>
                    <div class="mb-3">
                        <label>Nacimiento</label>
                        <input type="date" class="form-control" placeholder="Fecha de Nacimiento" name="nacimiento" autocomplete="off" value=<?php echo "$nacimiento"; ?> id="nacimiento" required>
                    </div>
                    <div class="mb-3">
                    <label>Sexo (<b>presione abajo para desplegar las opciones</b>)</label>
                        <select class="form-control" name="sexo">
                            <?php if ($sexo == "Masculino"){?>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <?php     
                                }else{
                                ?>
                                <option value="Femenino">Femenino</option> 
                                <option value="Masculino">Masculino</option>
                                <?php
                                }?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nombre del representante</label>
                        <input type="text" class="form-control" placeholder="Nombre del Representante" name="representante" autocomplete="off" value=<?php echo "$representante"; ?> id="representante-nombre" required>
                    </div>
                    <div class="mb-3">
                        <label>Apellido del representante</label>
                        <input type="text" class="form-control" placeholder="Apellido del Representante" name="representante_apellido" autocomplete="off" value=<?php echo "$representante_apellido"; ?> id="representante-apellido" required>
                    </div>
                    <div class="mb-3">
                        <label>C.I Representante</label>
                        <input type="number" class="form-control" placeholder="Cédula del Representante" name="cedularepre" id="cedula" autocomplete="off" value=<?php echo "$cedula"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>Telefono</label>

                            <input type="number" class="form-control" placeholder="Telefono" name="telefono" autocomplete="off" maxlength="7" value=<?php echo "$telefono"; ?> id="telefono" required>
                        </div>
                    <div class="mb-3">
                        <label>Correo Electornico</label>
                        <input type="email" class="form-control" placeholder="Correo" name="correo" id="email" autocomplete="off" value=<?php echo "$correo"; ?> required>
                    </div>

                                
                    <div class="mb-3">
                      <label>Grado (<b>presione abajo para desplegar las opciones</b>)</label>
                  <select class="form-control" name="grado"  required>
                      <option value=1>1</option>
                      <option value=2>2</option>
                      <option value=3>3</option>
                      <option value=4>4</option>
                      <option value=5>5</option>
                      <option value=6>6</option>
                  </select>
                </div>
                    <div class="mb-3">
                    <label>Seccion (<b>presione abajo para desplegar las opciones</b>)</label>
                        <select class="form-control" name="seccion">
                            <?php if ($seccion == "A"){?>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <?php     
                                }else{
                                ?>
                                <option value="B">B</option>
                                <option value="A">A</option>
                                <?php
                                }?>
                        </select>
                    </div>
                    <div class="container-error text-danger mb-3">

                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btn-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Finalizar</button>
                    </div>

                    <div class="mb-3">
                        <button type="button" onclick="regresarPaginaAnterior()" class="btn btn-primary">Regresar a la página anterior</button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                            
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <span>esta seguro que quiere editar?</span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary" name="submit" id="btn">Si</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                </form>

            </main>  

    </div>

        <script>
			const form = document.getElementById('formulario');
			const btn = document.getElementById('btn');
			const nombre = document.getElementById('nombre');
			const apellido = document.getElementById('apellido');




			form.addEventListener("submit", (e) => {
				const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
				var error = "";
				var msg = document.createElement("div");


				if (nombre.value == "" || apellido.value == "") {
					error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs text-principal pb-1">Los campos no pueden estar vacios</p> 
                                            </div>`;
					nombre.classList.add('invalid');
					apellido.classList.add('invalid');

				} else {
					if (!regex.test(nombre.value)) {
						error += `<div class=" flex justify-start items-center border-b-2 border-gray-300 pb-2">
                                            <svg fill="#f00505" width="40px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#f00505" transform="matrix(1, 0, 0, 1, 0, 0)" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cross-round</title> <path d="M0 16q0 3.264 1.28 6.208t3.392 5.12 5.12 3.424 6.208 1.248 6.208-1.248 5.12-3.424 3.392-5.12 1.28-6.208-1.28-6.208-3.392-5.12-5.088-3.392-6.24-1.28q-3.264 0-6.208 1.28t-5.12 3.392-3.392 5.12-1.28 6.208zM4 16q0-3.264 1.6-6.016t4.384-4.352 6.016-1.632 6.016 1.632 4.384 4.352 1.6 6.016-1.6 6.048-4.384 4.352-6.016 1.6-6.016-1.6-4.384-4.352-1.6-6.048zM9.76 20.256q0 0.832 0.576 1.408t1.44 0.608 1.408-0.608l2.816-2.816 2.816 2.816q0.576 0.608 1.408 0.608t1.44-0.608 0.576-1.408-0.576-1.408l-2.848-2.848 2.848-2.816q0.576-0.576 0.576-1.408t-0.576-1.408-1.44-0.608-1.408 0.608l-2.816 2.816-2.816-2.816q-0.576-0.608-1.408-0.608t-1.44 0.608-0.576 1.408 0.576 1.408l2.848 2.816-2.848 2.848q-0.576 0.576-0.576 1.408z"></path></g></svg>
                                            <p class=" text-xs text-principal pb-1">ingrese un nombre con caracteres validos</p> 
                                            </div>`;
						nombre.classList.add('invalid')
					} else {
						nombre.classList.remove('invalid');
						nombre.classList.add('valid');

					}
				}



				if (nombre.classList.contains("invalid") || apellido.classList.contains("invalid")) {
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


 <script src="http://localhost\dashboard\Proyecto\node_modules\flowbite\dist\flowbite.min.js"></script>
 <script src="http://localhost/dashboard/Proyecto/src/js/script.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])){
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $cen= $_POST['cen'];
        $nacimiento= $_POST['nacimiento'];
        $sexo= $_POST['sexo'];
        $representante= $_POST['representante'];
        $representante_apellido= $_POST['representante_apellido'];
        $cedularepre= $_POST['cedularepre'];
        $telefono= strval($_POST['telefono']);
        $codigo= strval($_POST['codigo']);
        $codigo = ($codigo . $telefono);
        
       
        $correo= $_POST['correo'];
        $grado=$_POST['grado'];
        $seccion=$_POST['seccion'];
    
        $seccion= strtoupper($seccion);
        $sexo=strtoupper($sexo);
        $error=[];


        //  Validar que ningún campo esté vacío
    if (empty($nombre) || empty($apellido) || empty($cen) || empty($nacimiento) || empty($sexo) || empty($representante) || empty($representante_apellido)||empty($cedula) || empty($telefono) || empty($correo) || empty($grado) || empty($seccion)) {
        echo "<div >
        <div class='container_title btn btn-danger'>
            <h5>Los datos no pueden estar vacios</h5>
        </div>

    </div>";

    
        exit();
    }


        if ($sexo === "M" || $sexo === "MASCULINO") {
            $sexo = "Masculino";
        } elseif ($sexo === "F" || $sexo === "FEMENINO") {
            $sexo = "Femenino";
        } else {
            array_push($error, "Error al registrar el género, por favor compruebe el dato.") ;
        }
        if (empty($error)) {
        if ($seccion === 'A' || $seccion === 'B') {
    
    
    $sql_grado_exist = "SELECT id FROM grados WHERE nombre = '$grado'";
    $result_grado_exist = mysqli_query($connect, $sql_grado_exist);
  
    $sql_seccion_exist = "SELECT id FROM seccion WHERE nombre = '$seccion'";
    $result_seccion_exist = mysqli_query($connect, $sql_seccion_exist);

    $sql_idrepre_exist = "SELECT * FROM representante WHERE cedula = '$cedula'";
    $result_idrepre_exist = mysqli_query($connect, $sql_idrepre_exist);

    $row_idrepre_exist = mysqli_fetch_assoc($result_idrepre_exist);
    $idrepresentante = $row_idrepre_exist['id'];

    if (mysqli_num_rows($result_grado_exist) > 0 && mysqli_num_rows($result_seccion_exist) > 0) {
      
        $sql_verificar_estudiante = "SELECT * FROM estudiantes WHERE cen = '$cen' AND id != $id";
        $resultado_estudiante = mysqli_query($connect, $sql_verificar_estudiante);
        if(mysqli_num_rows($resultado_estudiante) > 0){
            echo "<div >
                    <div class='container_title btn btn-danger'>
                        <h5>*La nueva cedula escolar ingresada coincide con la de otro estudiante</h5>
                    </div>
            
                </div>";
                        exit;
            }
        if ($cen==$cedularepre   ){
                $errores[] = "La cedula del estudiante y la del representante son las mismas";
            }
            $sql_verificar_cedula = "SELECT * FROM representante WHERE cedula = '$cen' ";
            $resultado_cedula = mysqli_query($connect, $sql_verificar_cedula);
            if(mysqli_num_rows($resultado_cedula) > 0){
                $errores[] = "La cedula escolar ingresada para el estudiante  se encuenta registrada con un representante";
            }
            
            $sql_verificar_cedula = "SELECT * FROM profesor WHERE cedula = '$cen' ";
            $resultado_cedula = mysqli_query($connect, $sql_verificar_cedula);
            if(mysqli_num_rows($resultado_cedula) > 0){
                $errores[] = "La cedula escolar ingresada se encuenta registrada con un profesor";

            }
            $sql_verificar_cedula = "SELECT * FROM estudiantes WHERE cen = '$cedularepre' ";
            $resultado_cedula = mysqli_query($connect, $sql_verificar_cedula);
            if(mysqli_num_rows($resultado_cedula) > 0){
                $errores[] = "La cedula del representante ingresada se encuenta registrada con un estudiante";

            }
           
            $sql_verificar_telefono = "SELECT * FROM representante WHERE telefono = '$codigo' AND id != $idrepresentante";
            $resultado_telefono = mysqli_query($connect, $sql_verificar_telefono);

            if(mysqli_num_rows($resultado_telefono) > 0){
                $errores[] = "Este telefono ya se encuentra registrado con otro representante";


            }  
            $sql_verificar_correo = "SELECT * FROM representante WHERE correo = '$correo' AND id != $idrepresentante ";
            $resultado_correo = mysqli_query($connect, $sql_verificar_correo);
            if(mysqli_num_rows($resultado_correo) > 0){
                $errores[] = "Este correo ya se encuentra registrado con otro representante";

            }
          
            if(!empty($errores)){
                echo "<div >
                        <div class='container_title btn btn-danger'>
                        
                            <h5>Se encontraron los siguientes errores:</h5>";
              
                foreach($errores as $error){
                    echo "<h5>*$error</h5>";
                }
               
                echo "</div>
                    </div>";
                exit;
            }



        $row_grado = mysqli_fetch_assoc($result_grado_exist);
        $grado_id = $row_grado['id'];

        $row_seccion = mysqli_fetch_assoc($result_seccion_exist);
        $seccion_id = $row_seccion['id'];
            
            $sql1 = "UPDATE estudiantes SET idgrado = $grado_id, idseccion = $seccion_id WHERE id = $id";
            
            $sql2 = "UPDATE estudiantes SET nombre = '$nombre', apellido = '$apellido', cen = $cen, nacimiento = '$nacimiento', sexo = '$sexo' WHERE id = $id";
            $sql3 = "UPDATE representante SET nombre = '$representante',  apellido='$representante_apellido',cedula ='$cedularepre', telefono = '$codigo', correo = '$correo' WHERE cedula = $cedula";
            
            // Ejecutar todas las consultas
            $result = mysqli_multi_query($connect, $sql3 . ";" . $sql1. ";" . $sql2);
         
    
            if ($result) {
            
                echo" <script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2 '</script>";
            } else {
                die(mysqli_error($connect));
            }
        } else {
            array_push ($error, "Error, La sección no existe. Ingrese al alumno en la sección 'A' o 'B'.");
        }
    }
    }
}

    ?>