<?php

include 'conexion_be.php';

$id = $_GET['id'];

mysqli_query($conexion,"
UPDATE contrataciones
SET estado='Rechazado'
WHERE id='$id'
");

header("Location: contrataciones.php");