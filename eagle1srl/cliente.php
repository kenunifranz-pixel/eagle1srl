<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

include 'php/conexion_be.php';

$mensaje = "";

if(isset($_POST['contratar'])){
    $cliente = $_SESSION['nombre_completo'];
    $empresa = $_POST['servicio'];
    $direccion = $_POST['direccion'];
    $cantidad_guardias = $_POST['cantidad_guardias'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $horario = $_POST['horario'];
    $observaciones = $_POST['observaciones'];

    $query = "INSERT INTO contrataciones
    (cliente, empresa, direccion, cantidad_guardias, fecha_inicio, fecha_fin, horario, observaciones, estado)
    VALUES
    ('$cliente','$empresa','$direccion','$cantidad_guardias','$fecha_inicio','$fecha_fin','$horario','$observaciones','Pendiente')";

    if(mysqli_query($conexion, $query)){
        $mensaje = "Solicitud enviada correctamente. El administrador revisará tu contratación.";
    }else{
        $mensaje = "Error al enviar la solicitud.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Servicios - EagleOneSRL</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    color:white;
    background:
    linear-gradient(rgba(0,0,0,.75),rgba(0,20,80,.80)),
    url('assets/images/img8.jpg');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
}

header{
    padding:25px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(0,0,0,.75);
    box-shadow:0 0 25px rgba(0,60,255,.5);
}

.logo{
    display:flex;
    align-items:center;
    gap:15px;
}

.logo img{
    width:80px;
}

.logo h2{
    color:white;
    font-size:28px;
}

nav a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-weight:bold;
}

nav a:hover{
    color:#00aaff;
}

.hero{
    text-align:center;
    padding:70px 20px 40px;
}

.hero h1{
    font-size:48px;
    color:#00aaff;
    text-shadow:0 0 15px #003cff;
}

.hero p{
    margin-top:15px;
    font-size:18px;
    color:#ddd;
}

.mensaje{
    width:80%;
    margin:20px auto;
    padding:15px;
    background:#003cff;
    border-radius:12px;
    text-align:center;
    font-weight:bold;
}

.servicios{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
    padding:40px 70px;
}

.card{
    background:rgba(0,0,0,.85);
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 0 25px rgba(0,60,255,.45);
    transition:.3s;
    border:1px solid rgba(0,60,255,.5);
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 0 35px rgba(0,140,255,.9);
}

.card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.card-body{
    padding:25px;
}

.card-body h3{
    color:#00aaff;
    font-size:24px;
    margin-bottom:12px;
}

.card-body p{
    color:#d1d5db;
    margin-bottom:20px;
}

.card-body button{
    width:100%;
    padding:13px;
    background:#003cff;
    color:white;
    border:none;
    border-radius:12px;
    font-weight:bold;
    cursor:pointer;
}

.card-body button:hover{
    background:#005eff;
}

.modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.85);
    justify-content:center;
    align-items:center;
    z-index:10;
}

.modal-content{
    background:#0b0b0b;
    width:430px;
    padding:30px;
    border-radius:22px;
    box-shadow:0 0 30px rgba(0,60,255,.8);
}

.modal-content h2{
    color:#00aaff;
    margin-bottom:20px;
}

.modal-content input,
.modal-content textarea{
    width:100%;
    padding:12px;
    margin:8px 0;
    border:none;
    border-radius:10px;
    outline:none;
}

.modal-content button{
    width:100%;
    padding:13px;
    margin-top:10px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

.btn-guardar{
    background:#003cff;
    color:white;
}

.btn-cerrar{
    background:#333;
    color:white;
}

@media(max-width:700px){
    header{
        padding:20px;
        flex-direction:column;
        gap:15px;
    }

    .hero h1{
        font-size:34px;
    }

    .servicios{
        padding:25px;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">
        <img src="assets/images/img7.jpg">
        <h2>EagleOneSRL</h2>
    </div>

    <nav>
        <a href="cliente.php">Servicios</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </nav>
</header>

<section class="hero">
    <h1>Servicios de Seguridad</h1>
    <p>Seleccione un servicio y solicite una contratación para que el administrador la revise.</p>
</section>

<?php if($mensaje != ""){ ?>
<div class="mensaje">
    <?php echo $mensaje; ?>
</div>
<?php } ?>

<section class="servicios">

    <div class="card">
        <img src="assets/images/img1.jpg">
        <div class="card-body">
            <h3>Personal de Seguridad para Empresas</h3>
            <p>Guardias capacitados para proteger oficinas, empresas, edificios y zonas privadas.</p>
            <button onclick="abrirModal('Personal de Seguridad para Empresas')">Contratar Servicio</button>
        </div>
    </div>

    <div class="card">
        <img src="assets/images/img2.jpg">
        <div class="card-body">
            <h3>Monitoreo de Cámaras</h3>
            <p>Supervisión mediante cámaras de seguridad para control preventivo y vigilancia constante.</p>
            <button onclick="abrirModal('Monitoreo de Cámaras')">Contratar Servicio</button>
        </div>
    </div>

    <div class="card">
        <img src="assets/images/img3.jpg">
        <div class="card-body">
            <h3>Seguridad para Eventos Temporales</h3>
            <p>Personal especializado para eventos sociales, privados, empresariales o temporales.</p>
            <button onclick="abrirModal('Seguridad para Eventos Temporales')">Contratar Servicio</button>
        </div>
    </div>

</section>

<div class="modal" id="modal">
    <div class="modal-content">
        <h2>Solicitar Contratación</h2>

        <form method="POST">
            <input type="text" name="servicio" id="servicio" readonly>

            <input type="text" name="direccion" placeholder="Dirección donde se realizará el servicio" required>

            <input type="number" name="cantidad_guardias" placeholder="Cantidad de guardias" required>

            <input type="date" name="fecha_inicio" required>

            <input type="date" name="fecha_fin" required>

            <input type="text" name="horario" placeholder="Horario ejemplo: 08:00 - 18:00" required>

            <textarea name="observaciones" placeholder="Observaciones adicionales"></textarea>

            <button type="submit" name="contratar" class="btn-guardar">
                Enviar solicitud
            </button>

            <button type="button" onclick="cerrarModal()" class="btn-cerrar">
                Cancelar
            </button>
        </form>
    </div>
</div>

<script>
function abrirModal(servicio){
    document.getElementById("servicio").value = servicio;
    document.getElementById("modal").style.display = "flex";
}

function cerrarModal(){
    document.getElementById("modal").style.display = "none";
}
</script>

</body>
</html>