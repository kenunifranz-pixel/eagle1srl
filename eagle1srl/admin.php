<?php
session_start();
include 'php/conexion_be.php';

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION['nombre_completo'] ?? $_SESSION['usuario'];

$total_personal = 0;
$total_solicitudes = 0;
$total_pendientes = 0;
$total_aprobados = 0;

$q1 = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM usuarios WHERE rol='personal' OR rol='guardia'");
if($q1){ $total_personal = mysqli_fetch_assoc($q1)['total']; }

$q2 = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM contrataciones");
if($q2){ $total_solicitudes = mysqli_fetch_assoc($q2)['total']; }

$q3 = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM contrataciones WHERE estado='Pendiente'");
if($q3){ $total_pendientes = mysqli_fetch_assoc($q3)['total']; }

$q4 = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM contrataciones WHERE estado='Aprobado'");
if($q4){ $total_aprobados = mysqli_fetch_assoc($q4)['total']; }
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Administrador - EagleOneSRL</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif;}
body{display:flex;background:linear-gradient(180deg,#000,#001b80,#003cff);min-height:100vh;}
.sidebar{width:280px;height:100vh;background:#000;color:white;padding:20px;position:fixed;overflow:auto;}
.logo{text-align:center;margin-bottom:28px;}
.logo img{width:190px;display:block;margin:auto;}
.sidebar ul{list-style:none;}
.sidebar ul li{padding:16px;margin:12px 0;border-radius:15px;background:linear-gradient(90deg,#001b80,#003cff);font-weight:bold;}
.sidebar ul li:hover{background:white;color:#003cff;}
.sidebar ul li a{color:inherit;text-decoration:none;display:block;}
.main{margin-left:280px;width:100%;padding:30px;min-height:100vh;}
.header{background:#000;color:white;border-radius:20px;padding:25px;border:1px solid #003cff;}
.header h1{font-size:38px;}
.header p{color:#ccc;margin-top:5px;}
.logout{display:inline-block;margin-top:20px;background:#003cff;color:white;padding:12px 22px;border-radius:10px;text-decoration:none;font-weight:bold;}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:20px;margin-top:25px;}
.card{background:#000;color:white;padding:25px;border-radius:18px;border-left:6px solid #003cff;box-shadow:0 5px 20px rgba(0,60,255,.4);}
.card h3{color:#3b82f6;margin-bottom:10px;}
.card h1{font-size:42px;margin-bottom:8px;}
.card p{color:#d1d5db;}
</style>
</head>

<body>

<div class="sidebar">
    <div class="logo">
        <img src="assets/images/img7.jpg">
    </div>

    <ul>
        <li><a href="admin.php">📊 Dashboard</a></li>
        <li><a href="personal.php">👨‍💼 Personal</a></li>
        <li><a href="contrataciones.php">📩 Solicitudes de Clientes</a></li>
        <li><a href="asignaciones.php">🛡️ Asignaciones</a></li>
        <li><a href="reportes.php">📈 Reportes</a></li>
        <li><a href="configuracion.php">⚙️ Configuración</a></li>
    </ul>
</div>

<div class="main">
    <div class="header">
        <h1>Bienvenido, <?php echo $nombre; ?></h1>
        <p>Administrador del sistema EagleOneSRL</p>
        <a class="logout" href="cerrar_sesion.php">Cerrar Sesión</a>
    </div>

    <div class="cards">
        <div class="card">
            <h3>📩 Solicitudes</h3>
            <h1><?php echo $total_solicitudes; ?></h1>
            <p>Solicitudes recibidas de clientes.</p>
        </div>

        <div class="card">
            <h3>⏳ Pendientes</h3>
            <h1><?php echo $total_pendientes; ?></h1>
            <p>Solicitudes pendientes de revisión.</p>
        </div>

        <div class="card">
            <h3>✅ Aprobados</h3>
            <h1><?php echo $total_aprobados; ?></h1>
            <p>Contratos aprobados.</p>
        </div>

        <div class="card">
            <h3>👨‍💼 Personal</h3>
            <h1><?php echo $total_personal; ?></h1>
            <p>Guardias y personal activo.</p>
        </div>
    </div>
</div>

</body>
</html>