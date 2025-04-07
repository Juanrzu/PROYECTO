<?php
session_start();
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$cedula = $_SESSION['cedula'];
$telefono = $_SESSION['telefono'];
$gmail = $_SESSION['gmail'];
$contraseña = $_SESSION['contraseña']; 



if (!isset($usuario)) {
	header("location: login.php");
}else{

	if 	($usuario == "admin"){
		echo "hola admin :D";

	} else{
		echo " hola mortal ";
	}




















}



