<?php
    session_start();
    error_reporting(0);
    $usuario = $_SESSION['nombre_usuario'];
    if ($usuario == null || $usuario == ''){
          header('location:login/login.php');
          die();
    }
    include 'connect.php';
    include 'contador_sesion.php';

    $id=$_GET['editarid'];
    // preparar sentencia
    // PREPARED STATEMENT FOR STUDENT DATA QUERY
            $sql = "SELECT estudiantes.*, 
            seccion.nombre AS seccion_nombre, 
            grados.nombre AS grado_nombre,
            representante.nombre AS representante_nombre, 
            representante.apellido AS representante_apellido,
            representante.cedula AS representante_cedula, 
            representante.telefono AS representante_telefono,
            representante.correo AS representante_correo,
            representante.id AS representante_id
            FROM estudiantes 
            JOIN seccion ON estudiantes.idseccion = seccion.id 
            JOIN grados ON estudiantes.idgrado = grados.id
            JOIN representante ON estudiantes.idrepresentante = representante.id
            WHERE estudiantes.id = ?";

            $stmt = $connect->prepare($sql);

            if (!$stmt) {
            die("Error en preparación: " . $connect->error);
            }

            // Bind parameters and execute
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
            // Assign variables (preserving your original structure)
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $cen = $row['cen'];
            $nacimiento = $row['nacimiento'];
            $sexo = $row['sexo'];
            $representante = $row['representante_nombre'];
            $representante_apellido = $row['representante_apellido'];
            $cedula = $row['representante_cedula'];
            $telefono = $row['representante_telefono'];
            $correo = $row['representante_correo'];
            $grado = $row['grado_nombre'];
            $seccion = $row['seccion_nombre'];
            $idrepresentante = $row['representante_id'];  // Fixed column name
            $volver=$grado;
            $volver2=$seccion;
            }

            //guardar datos viejos
            $nombre_anterior = $nombre;
            $apellido_anterior = $apellido;
            $cen_anterior = $cen;
            $nacimiento_anterior = $nacimiento;
            $sexo_anterior = $sexo;
            $grado_anterior = $grado;
            $seccion_anterior = $seccion;
            $representante_anterior = $representante;
            $representante_apellido_anterior = $representante_apellido;
            $cedularepre_anterior = $cedularepre;
            $codigo_anterior = $telefono;
            $correo_anterior = $correo;
            $stmt->close();
            //fin
         
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="http://localhost/dashboard/Proyecto/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/dashboard/Proyecto/assets/styles.css">
</head>

<body>

    <div class="container-all">
        <main class="container-sm">
           
                     <!-- Mostrar el mensaje de error aquí con echo -->
                    <?php if (!empty($error)) : ?>
                        <p class="text-danger"><?php echo $error[0]; ?></p>
                    <?php endif; ?>
                
                <form method="post" class="col mx-auto" id="formulario" novalidate>
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
                              <button type="submit" class="btn btn-primary" name="submit" >Si</button>
                            </div>
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
 <script src="http://localhost/dashboard/Proyecto/assets/bootstrap/js/bootstrap.min.js"></script>  
 <script src="http://localhost/dashboard/Proyecto/assets/validacion-estudiante.js"></script>  
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

    //preparar sentencia
        $sql_grado_exist = "SELECT id FROM grados WHERE nombre = ?";
        $stmt_grado = $connect->prepare($sql_grado_exist);
        $stmt_grado->bind_param("s", $grado);
        $stmt_grado->execute();
        $result_grado_exist = $stmt_grado->get_result();

        $sql_seccion_exist = "SELECT id FROM seccion WHERE nombre = ?";
        $stmt_seccion = $connect->prepare($sql_seccion_exist);
        $stmt_seccion->bind_param("s", $seccion);
        $stmt_seccion->execute();
        $result_seccion_exist = $stmt_seccion->get_result();

        $sql_idrepre_exist = "SELECT id FROM representante WHERE cedula = ?";
        $stmt_repre = $connect->prepare($sql_idrepre_exist);
        $stmt_repre->bind_param("s", $cedula);
        $stmt_repre->execute();
        $result_idrepre_exist = $stmt_repre->get_result();
        $idrepresentante = $row_idrepre_exist['id'];
        
        // Close statements
        $stmt_grado->close();
        $stmt_seccion->close();
        $stmt_repre->close();

    //fin
    //preparar sentencia
    if (mysqli_num_rows($result_grado_exist) > 0 && mysqli_num_rows($result_seccion_exist) > 0) {
        //verificar estudiante
        $sql_verificar_estudiante = "SELECT * FROM estudiantes WHERE cen = ? AND id != ?";
        $stmt = $connect->prepare($sql_verificar_estudiante);
        $stmt->bind_param("si", $cen, $id);
        $stmt->execute();
        $resultado_estudiante = $stmt->get_result();
        if ($resultado_estudiante->num_rows > 0) {
            echo "<div>
                    <div class='container_title btn btn-danger'>
                        <h5>*La nueva cédula escolar ingresada coincide con la de otro estudiante</h5>
                    </div>
                </div>";
            
            $stmt->close();
            exit;
        }

        $stmt->close();
        if ($cen==$cedularepre   ){
            $errores[] = "La cedula del estudiante y la del representante son las mismas";
        }
            //verificar representante
                $sql_verificar_cedula = "SELECT id FROM representante WHERE cedula = ?";
                $stmt = $connect->prepare($sql_verificar_cedula);
                $stmt->bind_param("s", $cen);
                if ($stmt->execute()) {
                    $resultado_cedula = $stmt->get_result();
                    if ($resultado_cedula->num_rows > 0) {
                        $errores[] = "La cédula escolar ingresada para el estudiante se encuentra registrada con un representante";
                    }
                
                $stmt->close();

                $sql_verificar_cedula = "SELECT * FROM representante WHERE cedula = ?";
                $stmt = $connect->prepare($sql_verificar_cedula);
                $stmt->bind_param("s", $cen);
                $stmt->execute();
                $resultado_cedula = $stmt->get_result();

            if($resultado_cedula->num_rows > 0){
                $errores[] = "La cedula escolar ingresada para el estudiante  se encuenta registrada con un representante";
            }
            
            $sql_verificar_cedula = "SELECT * FROM profesor WHERE cedula = ?";
            $stmt = $connect->prepare($sql_verificar_cedula);
            $stmt->bind_param("s", $cen);
            $stmt->execute();
            $resultado_cedula = $stmt->get_result();
            
            if($resultado_cedula->num_rows > 0) {
                $errores[] = "La cédula escolar ingresada se encuentra registrada con un profesor";
            }
            
           $sql_verificar_cedula = "SELECT * FROM estudiantes WHERE cen = ?";
            $stmt = $connect->prepare($sql_verificar_cedula);
            $stmt->bind_param("s", $cedularepre);
            $stmt->execute();
            $resultado_cedula = $stmt->get_result();

            if($resultado_cedula->num_rows > 0) {
                $errores[] = "La cédula del representante ingresada se encuentra registrada con un estudiante";
            }

           
           $sql_verificar_telefono = "SELECT * FROM representante WHERE telefono = ? AND id != ?";
            $stmt = $connect->prepare($sql_verificar_telefono);
            $stmt->bind_param("si", $codigo, $idrepresentante);
            $stmt->execute();
            $resultado_telefono = $stmt->get_result();

            if($resultado_telefono->num_rows > 0) {
                $errores[] = "Este telefono ya se encuentra registrado con otro representante";
            }

            $sql_verificar_correo = "SELECT * FROM representante WHERE correo = ? AND id != ?";
            $stmt = $connect->prepare($sql_verificar_correo);
            $stmt->bind_param("si", $correo, $idrepresentante);
            $stmt->execute();
            $resultado_correo = $stmt->get_result();

            if($resultado_correo->num_rows > 0) {
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
           
            
            //agregar datos a la bitacora
            $cambios = [];
            
                if ($apellido_anterior != $apellido_nuevo) {
                    $cambios[] = "Apellido anterior = $apellido_anterior, Apellido actualizado = $apellido_nuevo";
                }
                if ($nombre_anterior != $nombre_nuevo) {
                    $cambios[] = "Nombre anterior = $nombre_anterior, Nombre actualizado = $nombre_nuevo";
                }
                if ($cen_anterior != $cen_nuevo) {
                    $cambios[] = "CEN anterior = $cen_anterior, CEN actualizado = $cen_nuevo";
                }
                if ($nacimiento_anterior != $nacimiento_nuevo) {
                    $cambios[] = "Fecha de nacimiento anterior = $nacimiento_anterior, Fecha de nacimiento actualizado = $nacimiento_nuevo";
                }
                if ($sexo_anterior != $sexo_nuevo) {
                    $cambios[] = "Sexo anterior = $sexo_anterior, Sexo actualizado = $sexo_nuevo";
                }
                if ($grado_anterior != $grado_nuevo) {
                    $cambios[] = "Grado anterior = $grado_anterior, Grado actualizado = $grado_nuevo";
                }
                if ($seccion_anterior != $seccion_nuevo) {
                    $cambios[] = "Sección anterior = $seccion_anterior, Sección actualizada = $seccion_nuevo";
                }
                if ($representante_anterior != $representante_nuevo) {
                    $cambios[] = "Representante anterior = $representante_anterior, Representante actualizado = $representante_nuevo";
                }
                if ($representante_apellido_anterior != $representante_apellido_nuevo) {
                    $cambios[] = "Apellido del representante anterior = $representante_apellido_anterior, Apellido del representante actualizado = $representante_apellido_nuevo";
                }
                if ($cedularepre_anterior != $cedularepre_nuevo) {
                    $cambios[] = "Cédula de representante anterior = $cedularepre_anterior, Cédula representante actualizado = $cedularepre_nuevo";
                }
                if ($codigo_anterior != $codigo_nuevo) {
                    $cambios[] = "Teléfono anterior = $codigo_anterior, Teléfono actualizado = $codigo_nuevo";
                }
                if ($correo_anterior != $correo_nuevo) {
                    $cambios[] = "Correo anterior = $correo_anterior, Correo actualizado = $correo_nuevo";
                }
        
                    // Unir todos los cambios en un string
                    $datos_accion = implode(", ", $cambios);
                    $datos_accion = "Nombre: $nombre_anterior, Apellido: $apellido_anterior, CEN: $cen_anterior. Cambios: " . $datos_accion;

                    // insertar en la bitácora
                    $sql4 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES ('Se actualizaron los datos de un estudiante.', 
                    '$datos_accion', '$usuario')";
                    
                    $result = mysqli_multi_query($connect, $sql3 . ";" . $sql1. ";" . $sql2 . ";" . $sql4);
               
                    
                    //fin
    
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
}

    ?>