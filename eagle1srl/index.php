<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro - Eagle1SRL</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<main>

    <div class="contenedor__todo">

        <!-- Caja trasera -->

        <div class="caja__trasera">

            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en Eagle1SRL</p>
                <button id="btn__iniciar-sesion">Iniciar sesión</button>
            </div>

            <div class="caja__trasera-register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para acceder al sistema</p>
                <button id="btn__registrarse">Registrarse</button>
            </div>

        </div>


        <!-- Formularios -->

        <div class="contenedor__login-register">

            <!-- LOGIN -->

            <form action="php/login_usuario_be.php"
                  method="POST"
                  class="formulario__login">

                <h2>Iniciar Sesión</h2>

                <input type="email"
                placeholder="Correo electrónico"
                name="correo"
                required>

                <input type="password"
                placeholder="Contraseña"
                name="password"
                required>

                <button type="submit">
                    Entrar
                </button>

            </form>



            <!-- REGISTRO -->

            <form action="php/registro_usuario_be.php"
                  method="POST"
                  class="formulario__register">

                <h2>Registrarse</h2>

                <input type="text"
                placeholder="Nombre completo"
                name="nombre_completo"
                required>

                <input type="email"
                placeholder="Correo electrónico"
                name="correo"
                required>

                <input type="text"
                placeholder="Usuario"
                name="usuario"
                required>

                <input type="password"
                placeholder="Contraseña"
                name="password"
                required>

                <button type="submit">
                    Registrarse
                </button>

            </form>

        </div>

    </div>

</main>

<script src="assets/js/script.js"></script>

</body>
</html>