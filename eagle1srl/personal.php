<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

include 'php/conexion_be.php';

$consulta = mysqli_query($conexion, "SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Personal - EagleOneSRL</title>

<style>
body{
    font-family:Arial;
    background:#0d1117;
    color:white;
    padding:30px;
}

h1{
    color:#3b82f6;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th{
    background:#2563eb;
    padding:12px;
}

td{
    background:#161b22;
    padding:10px;
    text-align:center;
    border-bottom:1px solid #30363d;
}

a{
    color:#3b82f6;
    text-decoration:none;
}
</style>

</head>
<body>

<h1>👨‍💼 Personal Registrado</h1>

<a href="mis_asignaciones.php"
style="
display:inline-block;
padding:12px 20px;
background:#003cff;
color:white;
text-decoration:none;
border-radius:10px;
margin-bottom:20px;
margin-right:15px;
font-weight:bold;">
🛡️ Ver mis asignaciones
</a>


<a href="admin.php">⬅ Volver al Dashboard</a>

<table>

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Correo</th>
<th>Usuario</th>
<th>Rol</th>
<th>Estado</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($consulta)){ ?>

<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre_completo']; ?></td>
<td><?php echo $fila['correo']; ?></td>
<td><?php echo $fila['usuario']; ?></td>
<td><?php echo $fila['rol']; ?></td>
<td><?php echo $fila['estado']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>