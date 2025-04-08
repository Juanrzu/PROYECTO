<?php
    include 'connect.php';
    $id=$_GET['editarid'];
   $id = $_GET['editarid'];

    $sql = "SELECT estudiantes.*, seccion.nombre as seccion_nombre, grados.nombre as grado_nombre, 
            representante.nombre as representante_nombre,
            representante.cedula as representante_cedula, representante.telefono as representante_telefono,
            representante.correo as representante_correo 
            FROM estudiantes 
            JOIN seccion ON estudiantes.idseccion = seccion.id 
            JOIN grados ON estudiantes.idgrado = grados.id
            JOIN representante ON estudiantes.idrepresentante = representante.id
            WHERE estudiantes.id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Conservando todas tus asignaciones originales:
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $cen = $row['cen'];
    $nacimiento = $row['nacimiento'];
    $sexo = $row['sexo'];
    $repre = $row['representante_nombre'];
    $cedula = $row['representante_cedula'];
    $tele = $row['representante_telefono'];
    $corre = $row['representante_correo'];
    $grado = $row['grado_nombre'];
    $seccion = $row['seccion_nombre'];
    $volver = $grado;
    $volver2 = $seccion;

         
    if (isset($_POST['submit'])){
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $cen= $_POST['cen'];
        $nacimiento= $_POST['nacimiento'];
        $sexo= $_POST['sexo'];
        $representante= $_POST['representante'];
        $e= $_POST['e'];
        $telefono= $_POST['telefono'];
        $correo= $_POST['correo'];
        $grado=$_POST['grado'];
        $seccion=$_POST['seccion'];
        $seccion= strtoupper($seccion);
        $sexo=strtoupper($sexo);
        $error=[];

        if (empty($error)) {
        if ($seccion === 'A' || $seccion === 'B') {
                
            $sql_grado_exist = "SELECT id FROM grados WHERE nombre = ?";
            $stmt_grado = $connect->prepare($sql_grado_exist);
            $stmt_grado->bind_param("s", $grado);
            $stmt_grado->execute();
            $result_grado_exist = $stmt_grado->get_result();
            $row_grado = $result_grado_exist->fetch_assoc();
            $grado_id = $row_grado['id'];
            
    
            $sql_seccion_exist = "SELECT id FROM seccion WHERE nombre = ?";
            $stmt_seccion = $connect->prepare($sql_seccion_exist);
            $stmt_seccion->bind_param("s", $seccion);
            $stmt_seccion->execute();
            $result_seccion_exist = $stmt_seccion->get_result();
            $row_seccion = $result_seccion_exist->fetch_assoc();
            $seccion_id = $row_seccion['id'];
            


                    // Consulta 1: Actualización de grado y sección
            $sql1 = "UPDATE estudiantes SET idgrado = ?, idseccion = ? WHERE id = ?";
            $stmt1 = $connect->prepare($sql1);
            $stmt1->bind_param("iii", $grado_id, $seccion_id, $id);

            // Consulta 2: Actualización de datos personales
            $sql2 = "UPDATE estudiantes SET nombre = ?, apellido = ?, cen = ?, nacimiento = ?, sexo = ? WHERE id = ?";
            $stmt2 = $connect->prepare($sql2);
            $stmt2->bind_param("ssissi", $nombre, $apellido, $cen, $nacimiento, $sexo, $id);

            // Consulta 3: Actualización de representante
            $sql3 = "UPDATE representante SET nombre = ?, cedula = ?, telefono = ?, correo = ? WHERE cedula = ?";
            $stmt3 = $connect->prepare($sql3);
            $stmt3->bind_param("sssss", $representante, $cedularepre, $telefono, $correo, $cedula);

            // Ejecución en transacción (más seguro que multi_query)
            $connect->autocommit(FALSE);
            $success = $stmt1->execute() && $stmt2->execute() && $stmt3->execute();

            if ($success) {
                //echo "Se ha editado al alumno";
                header('location:ver_grado.php?gradonombre=' . $volver . '&seccion=' . $volver2);
            } else {
                die(mysqli_error($connect));
            }
        } else {
            array_push ($error, "Error, La sección no existe. Ingrese al alumno en la sección 'A' o 'B'.");
        }
    }
    }
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
        <main>
            <section class="container-form">
                     <!-- Mostrar el mensaje de error aquí con echo -->
                    <?php if (!empty($error)) : ?>
                        <p class="text-danger"><?php echo $error[0]; ?></p>
                    <?php endif; ?>
                
                <form method="post">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombres del Alumno" name="nombre" autocomplete="off" value=<?php echo "$nombre"; ?> >
                    </div>
                    <div class="mb-3">
                        <label>Apellido</label>
                        <input type="text" class="form-control" placeholder="Apellidos del Alumno" name="apellido" autocomplete="off" value=<?php echo "$apellido"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>C.E.N</label>
                        <input type="number" class="form-control" placeholder="C.E.N" name="cen" autocomplete="off" value=<?php echo "$cen"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>Nacimiento</label>
                        <input type="date" class="form-control" placeholder="Fecha de Nacimiento" name="nacimiento" autocomplete="off" value=<?php echo "$nacimiento"; ?>>
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
                        <label>Representante</label>
                        <input type="text" class="form-control" placeholder="Nombre del Representante" name="representante" autocomplete="off" value=<?php echo "$repre"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>C.I Representante</label>
                        <input type="number" class="form-control" placeholder="Cédula del Representante" name="e" autocomplete="off" value=<?php echo "$cedula"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>Telefono</label>
                        <input type="text" class="form-control" placeholder="Telefono" name="telefono" autocomplete="off" value=<?php echo "$tele"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>Correo Electornico</label>
                        <input type="email" class="form-control" placeholder="Correo" name="correo" autocomplete="off" value=<?php echo "$corre"; ?>>
                    </div>
                    <div class="mb-3">
                        <label>Grado</label>
                        <input type="text" class="form-control" placeholder="Grado (solo agregar el numero del grado)" name="grado" autocomplete="off" value=<?php echo "$grado"; ?>>
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
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
            </section>

        </main>

    </div>    
        <script>
              function regresarPaginaAnterior() {
              window.history.back();
                  }
              </script>
 <script src="http://localhost/dashboard/Proyecto/assets/bootstrap/js/bootstrap.min.js"></script>  
</body>

</html>
