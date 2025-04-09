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

    //sentencia preparada
   
     
        $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
                FROM profesor 
                JOIN seccion ON profesor.idseccion = seccion.id 
                JOIN grados ON profesor.idgrado = grados.id 
                WHERE profesor.id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $cedula = $row['cedula'];
            $grado = $row['grado_nombre'];
            $seccion = $row['seccion_nombre'];
            $volver = $grado;
            $volver2 = $seccion;
        } $stmt->close();
        
    
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
</head>

<body>
    <div class="container-all">
    <main class="contaianer-sm">
            <!-- Mostrar el mensaje de error aquí con echo -->
            
            <?php if (!empty($error)) : ?>
            <p class="text-danger"><?php echo $error[0]; ?></p>
        <?php endif; ?>
            <form method="post"class="col mx-auto needs-validation p-5" id="formulario" novalidate >
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre del Profesor" name="nombre" maxlength="25" id="nombre" autocomplete="off" value=<?php echo "$nombre"; ?> >
                </div>
                <div class="mb-3">
                    <label>Apellido</label>
                    <input type="text" class="form-control" placeholder="Apellido del Profesor" name="apellido" maxlength="25" id="apellido" autocomplete="off" value=<?php echo "$apellido"; ?> >
                </div>
                <div class="mb-3">
                    <label>Cedula</label>
                    <input type="number" class="form-control" placeholder="Cedula" name="cedula" id="cedula" autocomplete="off" maxlength="25" value=<?php echo "$cedula"; ?> >
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
                <div class="container-error text-danger mb-3"></div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Finalizar</button>
                </div>
                <div class="mb-3">
                    <button type="button" onclick="regresarPaginaAnterior()" class="btn btn-primary">Regresar a la página anterior</button>
                </div>




                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title fs-5" id="exampleModalLabel"></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <span>esta seguro que quiere editar a este profesor?</span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              <button type="submit" class="btn btn-primary" name="submit" data-bs-dismiss="modal">Si</button>
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
        <script src="http://localhost/dashboard/Proyecto/assets/modal.js"></script>
        <script src="http://localhost/dashboard/Proyecto/assets/validacion-profesor.js"></script> 
</body>

</html>

<?php

if (isset($_POST['submit'])){
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $cedula_nueva= $_POST['cedula'];
        $grado=$_POST['grado'];
        $seccion=$_POST['seccion'];
        $seccion= strtoupper($seccion);
        $error=[];

        if (empty($nombre) || empty($apellido) || empty($cedula) || empty($grado) || empty($seccion)) {
            echo "<footer class='error'>
            <div class='container_title btn btn-danger'>
                <h5>Los datos no pueden estar vacios</h5>
            </div>
        
            </footer>";
              
            exit();
        }
        //preparar sentencia
        //Verificar Sección
        if (empty($error)) {
            if ($seccion === 'A' || $seccion === 'B') {

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
            
                $sqlprofe = "SELECT * FROM profesor WHERE cedula = ?";
                $stmt_profe = $connect->prepare($sqlprofe);
                $stmt_profe->bind_param("s", $cedula);
                $stmt_profe->execute();
                $resultadoprofesor = $stmt_profe->get_result();
            
                if ($row_profe = $resultadoprofesor->fetch_assoc()) {
                    $profesor = $row_profe['id'];
                }
            
                $stmt_grado->close();
                $stmt_seccion->close();
                $stmt_profe->close();
                //fin
            }}

          
            if ($result_grado_exist->num_rows > 0 && $result_seccion_exist->num_rows > 0) {
             //preparar sentencia
                // Obtener IDs de grado y sección
                $row_grado = $result_grado_exist->fetch_assoc();
                $grado_id = $row_grado['id'];
            
                $row_seccion = $result_seccion_exist->fetch_assoc();
                $seccion_id = $row_seccion['id'];
            
                // Verificar si la nueva cédula ya existe en otro profesor
                $sql_verificar_estudiante = "SELECT * FROM profesor WHERE cedula = ? AND id != ?";
                $stmt_verificar = $connect->prepare($sql_verificar_estudiante);
                $stmt_verificar->bind_param("si", $cedula_nueva, $id);
                $stmt_verificar->execute();
                $resultado_estudiante = $stmt_verificar->get_result();
            
                if ($resultado_estudiante->num_rows > 0) {
                    echo "<footer class='error'>
                            <div class='container_title btn btn-danger'>
                                <h5>La nueva cédula ingresada coincide con otro profesor</h5>
                            </div>
                          </footer>";
                    $stmt_verificar->close();
                    exit;
                }
                $stmt_verificar->close();
                // Consulta para contar cuántos profesores hay asignados a un grado y sección específicos
                    $sql_count = "SELECT COUNT(*) AS total FROM profesor WHERE idgrado = ? AND idseccion = ?";
                    $stmt = $connect->prepare($sql_count);
                    $stmt->bind_param("ii", $grado_id, $seccion_id);
                    $stmt->execute();
                    $result_count = $stmt->get_result();
                    $row_count = $result_count->fetch_assoc();
                    $total_profesores = $row_count['total'];


                    // Verificar si ya hay 2 profesores asignados a este grado y sección
                    if ($total_profesores >= 2) {
                        echo "<footer class='error'>
                                <div class='container_title btn btn-danger'>
                                    <h5>Ya hay 2 profesores asignados a este grado y sección</h5>
                                </div>
                            </footer>";
                        exit();
                    }
            
                // Actualizar profesor
                $sql = "UPDATE profesor SET nombre = ?, apellido = ?, cedula = ?, idgrado = ?, idseccion = ? WHERE id = ?";
                $stmt = $connect->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("sssiii", $nombre, $apellido, $cedula_nueva, $grado_id, $seccion_id, $id);
                    }
                
                //ingresar insert en bitacora
                $sql2 = "INSERT INTO bitacora (accion, datos_accion, usuario) VALUES (?, ?, ?)";
                $stmt2 = $connect->prepare($sql2);
                $accion = "Se actualizaron los datos de un profesor.";
                $datos_accion = "nombre = $nombre, apellido = $apellido, cedula = $cedula, grado = $grado, seccion = $seccion";
                $stmt2->bind_param("sss", $accion, $datos_accion, $usuario);
                $resultInsert2 = $stmt2->execute();
                
                //aqui termina
    
        if($stmt->execute()){
            //echo "Se ha editado el profesor";
            echo" <script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2 '</script>";
            $stmt->close();
            //finn
        }else{
            die (mysqli_error($connect));
        } include 'connect.php';
    } else {
        array_push ($error, "Error, La sección no existe. Ingrese al alumno en la sección 'A' o 'B'.");
        }}
?>