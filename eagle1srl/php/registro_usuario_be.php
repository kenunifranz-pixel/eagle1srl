<?php

include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$rol = "cliente";
$estado = "Activo";

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, password, rol, estado)
VALUES ('$nombre_completo','$correo','$usuario','$password','$rol','$estado')";

$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    header("Location: ../index.php");
    exit();
}else{
    echo "Error al registrar: " . mysqli_error($conexion);
}

mysqli_close($conexion);

?>