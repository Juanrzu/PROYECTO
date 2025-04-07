<?php
    include 'connect.php';
    
    if (isset($_POST['submit'])){
        $grado= $_POST['grado'];
        $seccion= $_POST['seccion'];
        $seccion= strtoupper($seccion);
        $consulta = "SELECT * FROM grados WHERE grado = ? and seccion = ?";
        $stmt = $connect->prepare($consulta);
        $stmt->bind_param("ss", $grado, $seccion);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            echo "El grado ya está registrado.";
        } else {
        $sql= "insert into grados (grado, seccion) values('$grado', '$seccion')";
        $result= mysqli_query($connect, $sql);
        if($result){
           header('location:display.php');
        }else{
            die (mysqli_error($connect));
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Grado</label>
                <input type="text" class="form-control" placeholder="Agregue el grado" name="grado" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Sección</label>
                <input type="text" class="form-control" placeholder="Agregue la sección" name="seccion" autocomplete="off">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Finalizar</button>
            </div>
        </form>

    </div>
</body>

</html>