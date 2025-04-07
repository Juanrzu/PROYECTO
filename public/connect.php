<?php

    $connect=new mysqli('localhost','root','','proyecto');

    if (!$connect){
    die (mysqli_error($connect));
    }
?>