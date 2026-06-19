<?php
session_start();

if (!isset($_SESSION['codigo_2fa'])) {
    header("Location: ../index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_ingresado = $_POST['codigo'];

    if ($codigo_ingresado == $_SESSION['codigo_2fa']) {

        $_SESSION['id'] = $_SESSION['id_pendiente'] ?? '';
        $_SESSION['id_usuario'] = $_SESSION['id_pendiente'] ?? '';
        $_SESSION['usuario'] = $_SESSION['usuario_pendiente'] ?? '';
        $_SESSION['rol'] = $_SESSION['rol_pendiente'] ?? '';
        $_SESSION['nombre_completo'] = $_SESSION['nombre_pendiente'] ?? '';
        $_SESSION['correo'] = $_SESSION['correo_pendiente'] ?? '';

        $rol = $_SESSION['rol'];

        unset($_SESSION['id_pendiente']);
        unset($_SESSION['usuario_pendiente']);
        unset($_SESSION['rol_pendiente']);
        unset($_SESSION['nombre_pendiente']);
        unset($_SESSION['correo_pendiente']);
        unset($_SESSION['codigo_2fa']);

        if ($rol == "admin") {
            header("Location: ../admin.php");
        } elseif ($rol == "personal" || $rol == "guardia") {
            header("Location: ../mis_asignaciones.php");
        } else {
            header("Location: ../cliente.php");
        }
        exit();

    } else {
        $error = "Código incorrecto. Intente nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación 2FA - Eagle1 SRL</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0b1f33;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        .contenedor {
            background: #fff;
            color: #222;
            width: 380px;
            padding: 35px;
            border-radius: 15px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 12px;
            font-size: 18px;
            text-align: center;
            margin-top: 15px;
        }
        button {
            width: 96%;
            padding: 12px;
            margin-top: 20px;
            background: #0b2c4d;
            color: white;
            border: none;
            border-radius: 8px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Verificación 2FA</h2>
    <p>Ingrese el código enviado a su correo electrónico.</p>

    <form method="POST">
        <input type="text" name="codigo" maxlength="6" placeholder="Código 2FA" required>
        <button type="submit">Verificar</button>
    </form>

    <p class="error"><?php echo $error; ?></p>
</div>

</body>
</html>