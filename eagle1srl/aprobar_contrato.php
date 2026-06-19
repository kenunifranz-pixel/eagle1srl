<?php

include 'conexion_be.php';

$id = $_GET['id'];

mysqli_query($conexion,"
UPDATE contrataciones
SET estado='Aprobado'
WHERE id='$id'
");

header("Location: contrataciones.php");