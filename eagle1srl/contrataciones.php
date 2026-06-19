<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

include 'php/conexion_be.php';

if(isset($_POST['registrar'])){
    $cliente = $_POST['cliente'];
    $empresa = $_POST['empresa'];
    $direccion = $_POST['direccion'];
    $cantidad_guardias = $_POST['cantidad_guardias'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $horario = $_POST['horario'];
    $observaciones = $_POST['observaciones'];

    $query = "INSERT INTO contrataciones
    (cliente, empresa, direccion, cantidad_guardias, fecha_inicio, fecha_fin, horario, observaciones)
    VALUES
    ('$cliente','$empresa','$direccion','$cantidad_guardias','$fecha_inicio','$fecha_fin','$horario','$observaciones')";

    mysqli_query($conexion, $query);
}

$contrataciones = mysqli_query($conexion, "SELECT * FROM contrataciones ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Contrataciones - EagleOneSRL</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(180deg,#000,#001b80,#003cff);
    color:white;
    min-height:100vh;
    padding:30px;
}

h1{
    color:#3b82f6;
    margin-bottom:20px;
}

a{
    color:#3b82f6;
    text-decoration:none;
    font-weight:bold;
}

.contenedor{
    display:grid;
    grid-template-columns:350px 1fr;
    gap:25px;
    margin-top:25px;
}

.formulario, .tabla{
    background:#0b0b0b;
    padding:25px;
    border-radius:18px;
    box-shadow:0 0 20px rgba(0,60,255,.4);
}

input, textarea{
    width:100%;
    padding:12px;
    margin:8px 0;
    border:none;
    border-radius:10px;
    outline:none;
}

button{
    width:100%;
    padding:13px;
    background:#003cff;
    color:white;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    margin-top:10px;
}

button:hover{
    background:#005eff;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th{
    background:#003cff;
    padding:12px;
}

td{
    background:#111;
    padding:10px;
    text-align:center;
    border-bottom:1px solid #222;
}
</style>
</head>

<body>

<h1>📋 Contrataciones de Clientes</h1>
<a href="admin.php">← Volver al Dashboard</a>

<div class="contenedor">

    <div class="formulario">
        <h2>Registrar contratación</h2>

        <form method="POST">

            <input type="text" name="cliente" placeholder="Nombre del cliente" required>

            <input type="text" name="empresa" placeholder="Empresa / lugar del servicio" required>

            <input type="text" name="direccion" placeholder="Dirección del servicio" required>

            <input type="number" name="cantidad_guardias" placeholder="Cantidad de guardias" required>

            <input type="date" name="fecha_inicio" required>

            <input type="date" name="fecha_fin" required>

            <input type="text" name="horario" placeholder="Horario: 08:00 - 18:00" required>

            <textarea name="observaciones" placeholder="Observaciones"></textarea>

            <button type="submit" name="registrar">Guardar contratación</button>

        </form>
    </div>

    <div class="tabla">
        <h2>Contrataciones registradas</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Empresa</th>
                <th>Dirección</th>
                <th>Guardias</th>
                <th>Fechas</th>
                <th>Horario</th>
                <th>Estado</th>
            </tr>

            <?php while($fila = mysqli_fetch_assoc($contrataciones)){ ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['cliente']; ?></td>
                <td><?php echo $fila['empresa']; ?></td>
                <td><?php echo $fila['direccion']; ?></td>
                <td><?php echo $fila['cantidad_guardias']; ?></td>
                <td><?php echo $fila['fecha_inicio']." / ".$fila['fecha_fin']; ?></td>
                <td><?php echo $fila['horario']; ?></td>
                <td><?php echo $fila['estado']; ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>