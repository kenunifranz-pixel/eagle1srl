<?php
session_start();
include 'php/conexion_be.php';

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

$totalUsuarios = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM usuarios"));
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reportes - EagleOneSRL</title>

<style>
body{
font-family:Arial;
background:#0b1f33;
color:white;
padding:30px;
}

.card{
background:#000;
padding:25px;
border-radius:15px;
margin-bottom:20px;
}

table{
width:100%;
background:white;
color:black;
border-collapse:collapse;
}

th,td{
padding:10px;
border:1px solid #ddd;
}

h1{
color:#3b82f6;
}
</style>

</head>
<body>

<h1>📈 Reportes del Sistema</h1>

<div class="card">
<h2>Total de Usuarios</h2>
<h1><?php echo $totalUsuarios; ?></h1>
</div>

<table>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Correo</th>
<th>Usuario</th>
<th>Rol</th>
</tr>

<?php

$consulta = mysqli_query($conexion,"SELECT * FROM usuarios");

while($row = mysqli_fetch_assoc($consulta)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['nombre_completo']; ?></td>
<td><?php echo $row['correo']; ?></td>
<td><?php echo $row['usuario']; ?></td>
<td><?php echo $row['rol']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>