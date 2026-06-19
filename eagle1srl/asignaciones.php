<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

include 'php/conexion_be.php';

if(isset($_POST['asignar'])){
    $id_personal = $_POST['id_personal'];
    $id_contratacion = $_POST['id_contratacion'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $observaciones = $_POST['observaciones'];

    $contrato = mysqli_query($conexion, "SELECT * FROM contrataciones WHERE id='$id_contratacion'");
    $datos = mysqli_fetch_assoc($contrato);

    $destino = $datos['empresa'];
    $direccion = $datos['direccion'];
    $fecha = $datos['fecha_inicio'];

    $insertar = "INSERT INTO asignaciones
    (id_personal, destino, direccion, fecha, hora_inicio, hora_fin, observaciones, estado)
    VALUES
    ('$id_personal','$destino','$direccion','$fecha','$hora_inicio','$hora_fin','$observaciones','Pendiente')";

    mysqli_query($conexion, $insertar);
}

$personal = mysqli_query($conexion, "SELECT * FROM usuarios WHERE rol='personal'");
$contrataciones = mysqli_query($conexion, "SELECT * FROM contrataciones ORDER BY id DESC");

$asignaciones = mysqli_query($conexion, "
SELECT asignaciones.*, usuarios.nombre_completo 
FROM asignaciones
INNER JOIN usuarios ON asignaciones.id_personal = usuarios.id
ORDER BY asignaciones.id DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Asignaciones - EagleOneSRL</title>

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

select, input, textarea{
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

<h1>🛡️ Asignaciones de Guardias</h1>
<a href="admin.php">← Volver al Dashboard</a>

<div class="contenedor">

    <div class="formulario">
        <h2>Asignar guardia</h2>

        <form method="POST">

            <select name="id_personal" required>
                <option value="">Seleccione un guardia</option>
                <?php while($p = mysqli_fetch_assoc($personal)){ ?>
                    <option value="<?php echo $p['id']; ?>">
                        <?php echo $p['nombre_completo']; ?> - <?php echo $p['correo']; ?>
                    </option>
                <?php } ?>
            </select>

            <select name="id_contratacion" required>
                <option value="">Seleccione una contratación</option>
                <?php while($c = mysqli_fetch_assoc($contrataciones)){ ?>
                    <option value="<?php echo $c['id']; ?>">
                        <?php echo $c['empresa']; ?> - <?php echo $c['direccion']; ?>
                    </option>
                <?php } ?>
            </select>

            <input type="time" name="hora_inicio" required>

            <input type="time" name="hora_fin" required>

            <textarea name="observaciones" placeholder="Observaciones para el guardia"></textarea>

            <button type="submit" name="asignar">Asignar guardia</button>

        </form>
    </div>

    <div class="tabla">
        <h2>Guardias asignados</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Guardia</th>
                <th>Destino</th>
                <th>Dirección</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Estado</th>
            </tr>

            <?php while($a = mysqli_fetch_assoc($asignaciones)){ ?>
            <tr>
                <td><?php echo $a['id']; ?></td>
                <td><?php echo $a['nombre_completo']; ?></td>
                <td><?php echo $a['destino']; ?></td>
                <td><?php echo $a['direccion']; ?></td>
                <td><?php echo $a['fecha']; ?></td>
                <td><?php echo $a['hora_inicio']." - ".$a['hora_fin']; ?></td>
                <td><?php echo $a['estado']; ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>