<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Configuración - EagleOneSRL</title>

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
max-width:700px;
margin:auto;
}

h1{
color:#3b82f6;
margin-bottom:20px;
}

p{
margin:10px 0;
font-size:18px;
}

a{
display:inline-block;
margin-top:20px;
background:#003cff;
padding:10px 20px;
color:white;
text-decoration:none;
border-radius:10px;
}
</style>

</head>
<body>

<div class="card">
<h1>⚙️ Configuración del Sistema</h1>

<p><b>Sistema:</b> EagleOneSRL</p>
<p><b>Versión:</b> 1.0</p>
<p><b>Autenticación:</b> Login + 2FA por correo</p>
<p><b>Usuario:</b> <?php echo $_SESSION['usuario']; ?></p>
<p><b>Rol:</b> <?php echo $_SESSION['rol']; ?></p>
<p><b>Estado:</b> Activo</p>

<a href="admin.php">Volver al Dashboard</a>
</div>

</body>
</html>