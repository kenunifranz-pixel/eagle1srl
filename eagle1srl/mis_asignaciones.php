<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: index.php");
    exit();
}

include 'php/conexion_be.php';

$id_personal = $_SESSION['id'];

$asignaciones = mysqli_query($conexion, "
SELECT * FROM asignaciones 
WHERE id_personal = '$id_personal'
ORDER BY fecha DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Asignaciones - EagleOneSRL</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}

body{
    background:linear-gradient(180deg,#000000 0%,#001b80 45%,#003cff 100%);
    color:white;
    min-height:100vh;
    padding:35px;
}

.header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    background:#000;
    border:1px solid rgba(0,60,255,.6);
    box-shadow:0 0 25px rgba(0,60,255,.5);
    border-radius:22px;
    padding:25px;
    margin-bottom:30px;
}

.header-info h1{
    color:#3b82f6;
    font-size:38px;
}

.header-info p{
    color:#d1d5db;
    margin-top:8px;
}

.logo img{
    width:170px;
    height:auto;
}

.volver{
    display:inline-block;
    margin-bottom:25px;
    padding:12px 20px;
    background:#003cff;
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}

.contenedor{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

.card{
    background:#0b0b0b;
    padding:25px;
    border-radius:20px;
    border-left:7px solid #003cff;
    box-shadow:0 0 25px rgba(0,60,255,.45);
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h2{
    color:#3b82f6;
    margin-bottom:15px;
    font-size:28px;
}

.card p{
    margin:10px 0;
    color:#e5e7eb;
    font-size:16px;
}

.estado{
    display:inline-block;
    padding:8px 14px;
    background:#003cff;
    border-radius:20px;
    font-weight:bold;
    margin-top:10px;
}

.sin-asignaciones{
    background:#0b0b0b;
    padding:30px;
    border-radius:20px;
    box-shadow:0 0 20px rgba(0,60,255,.4);
}
</style>
</head>

<body>

<div class="header">
    <div class="header-info">
        <h1>🛡️ Mis Asignaciones</h1>
        <p>Bienvenido, <?php echo $_SESSION['nombre_completo']; ?>. Aquí puedes ver tus destinos asignados.</p>
    </div>

    <div class="logo">
        <img src="assets/images/img7.jpg" alt="Logo EagleOneSRL">
    </div>
</div>

<a class="volver" href="cerrar_sesion.php">Cerrar sesión</a>

<div class="contenedor">

<?php if(mysqli_num_rows($asignaciones) > 0){ ?>

    <?php while($fila = mysqli_fetch_assoc($asignaciones)){ ?>

        <div class="card">
            <h2><?php echo $fila['destino']; ?></h2>
            <p><b>📍 Dirección:</b> <?php echo $fila['direccion']; ?></p>
            <p><b>📅 Fecha:</b> <?php echo $fila['fecha']; ?></p>
            <p><b>🕒 Horario:</b> <?php echo $fila['hora_inicio']; ?> - <?php echo $fila['hora_fin']; ?></p>
            <p><b>📝 Observaciones:</b> <?php echo $fila['observaciones']; ?></p>
            <span class="estado"><?php echo $fila['estado']; ?></span>
        </div>

    <?php } ?>

<?php }else{ ?>

    <div class="sin-asignaciones">
        <h2>No tienes asignaciones todavía.</h2>
        <p>Cuando el administrador te asigne un destino, aparecerá aquí.</p>
    </div>

<?php } ?>

</div>

</body>
</html>