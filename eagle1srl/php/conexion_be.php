<?php
$conexion = mysqli_connect(
    "sql309.infinityfree.com",
    "if0_42218485",
    "pqhRFSYwUfbw1PN",
    "if0_42218485_login_register_db"
);

if(!$conexion){
    die("Error de conexión: " . mysqli_connect_error());
}
?>