<?php
session_start();
include 'conexion_be.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

$login = $_POST['correo'] ?? $_POST['usuario'] ?? $_POST['email'] ?? '';
$password = $_POST['password'] ?? $_POST['contrasena'] ?? $_POST['contraseña'] ?? '';

$query = "SELECT * FROM usuarios
          WHERE (usuario='$login' OR correo='$login')
          AND password='$password'
          LIMIT 1";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {

    $datos = mysqli_fetch_assoc($resultado);
    $codigo = rand(100000, 999999);

    $_SESSION['usuario_pendiente'] = $datos['usuario'];
    $_SESSION['rol_pendiente'] = $datos['rol'];
    $_SESSION['nombre_pendiente'] = $datos['nombre_completo'];
    $_SESSION['correo_pendiente'] = $datos['correo'];
    $_SESSION['codigo_2fa'] = $codigo;

    if ($datos['rol'] == "admin") {
        $_SESSION['destino_2fa'] = "admin.php";
    } elseif ($datos['rol'] == "personal") {
        $_SESSION['destino_2fa'] = "mis_asignaciones.php";
    } else {
        $_SESSION['destino_2fa'] = "cliente.php";
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kenunifranz@gmail.com';
        $mail->Password = 'bbyigrkxrnspgnky';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kenunifranz@gmail.com', 'Eagle1 SRL');
        $mail->addAddress($datos['correo'], $datos['nombre_completo']);

        $mail->isHTML(true);
        $mail->Subject = 'Codigo de verificacion Eagle1 SRL';
        $mail->Body = "
            <h2>Eagle1 SRL - Verificacion en dos pasos</h2>
            <p>Hola <b>".$datos['nombre_completo']."</b>,</p>
            <p>Tu codigo de verificacion es:</p>
            <h1 style='color:#0b2c4d;'>$codigo</h1>
            <p>Ingrese este codigo para acceder al sistema.</p>
        ";

        $mail->send();

        header("Location: verificar_2fa.php");
        exit();

    } catch (Exception $e) {
        echo "Error al enviar codigo 2FA: " . $mail->ErrorInfo;
        exit();
    }

} else {
    echo '
        <script>
            alert("Correo/usuario o contraseña incorrectos");
            window.location = "../index.php";
        </script>
    ';
    exit();
}
?>