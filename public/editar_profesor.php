<?php
    session_start();
    error_reporting(0);
    $usuario = $_SESSION['nombre_usuario'];
    if ($usuario == null || $usuario == ''){
          header('location:login/login.php');
          die();
    }
    include 'connect.php';
    
    
    
    $id=$_GET['editarid'];
    $sql = "SELECT profesor.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre 
    FROM profesor 
    JOIN seccion ON profesor.idseccion = seccion.id 
    JOIN grados ON profesor.idgrado = grados.id 
    WHERE profesor.id = $id";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($result);
        $nombre=$row['nombre'];
         $apellido=$row['apellido'];
         $cedula=$row['cedula'];
         $grado = $row['grado_nombre'];  
         $seccion = $row['seccion_nombre'];
         $volver=$grado;
         $volver2=$seccion;
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
        
        //Verificar Sección
        if (empty($error)) {
        if ($seccion === 'A' || $seccion === 'B') {
     $sql_grado_exist = "SELECT id FROM grados WHERE nombre = '$grado'";
    $result_grado_exist = mysqli_query($connect, $sql_grado_exist);
  
    $sql_seccion_exist = "SELECT id FROM seccion WHERE nombre = '$seccion'";
    $result_seccion_exist = mysqli_query($connect, $sql_seccion_exist);

    $sqlprofe = "SELECT * FROM profesor WHERE cedula = '$cedula' ";
    $resultadoprofesor = mysqli_query($connect, $sqlprofe);

    $row_profe = mysqli_fetch_assoc($resultadoprofesor);
    $profesor = $row_profe['id'];


    if (mysqli_num_rows($result_grado_exist) > 0 && mysqli_num_rows($result_seccion_exist) > 0) {
      
        $row_grado = mysqli_fetch_assoc($result_grado_exist);
        $grado_id = $row_grado['id'];

        $row_seccion = mysqli_fetch_assoc($result_seccion_exist);
        $seccion_id = $row_seccion['id'];

        $sql_verificar_estudiante = "SELECT * FROM profesor WHERE cedula = '$cedula' AND id != $id";
        $resultado_estudiante = mysqli_query($connect, $sql_verificar_estudiante);
        if(mysqli_num_rows($resultado_estudiante) > 0){
            echo "<footer class='error'>
                    <div class='container_title btn btn-danger'>
                        <h5>La nueva cedula ingresada coincide con otro profesor</h5>
                    </div>
            
                </footer>";
                        exit;
            }     
        $sql= "
        update profesor set id='$id',nombre='$nombre', apellido='$apellido', cedula='$cedula_nueva', idgrado = $grado_id, idseccion = $seccion_id where id=$id
        ";

        $result= mysqli_query($connect, $sql);
    
        if($result){
            //echo "Se ha editado el profesor";
            echo" <script> window.location='ver_grado.php? gradonombre= $volver && seccion= $volver2 '</script>";
        }else{
            die (mysqli_error($connect));
        } include 'connect.php';
    } else {
        array_push ($error, "Error, La sección no existe. Ingrese al alumno en la sección 'A' o 'B'.");
        }
    }
}
}
?>