document.addEventListener("DOMContentLoaded", () => {

    const formulario_login = document.querySelector(".formulario__login");
    const formulario_register = document.querySelector(".formulario__register");
    const contenedor_login_register = document.querySelector(".contenedor__login-register");
    const caja_trasera_login = document.querySelector(".caja__trasera-login");
    const caja_trasera_register = document.querySelector(".caja__trasera-register");

    const btn_iniciar_sesion = document.getElementById("btn__iniciar-sesion");
    const btn_registrarse = document.getElementById("btn__registrarse");

    btn_iniciar_sesion.addEventListener("click", iniciarSesion);
    btn_registrarse.addEventListener("click", registrarse);

    function iniciarSesion(){
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";

        contenedor_login_register.style.transform = "translateX(0px)";
        contenedor_login_register.style.opacity = "0.95";

        setTimeout(() => {
            contenedor_login_register.style.opacity = "1";
        }, 300);

        caja_trasera_login.style.opacity = "0";
        caja_trasera_register.style.opacity = "1";
    }

    function registrarse(){
        formulario_register.style.display = "block";
        formulario_login.style.display = "none";

        contenedor_login_register.style.transform = "translateX(420px)";
        contenedor_login_register.style.opacity = "0.95";

        setTimeout(() => {
            contenedor_login_register.style.opacity = "1";
        }, 300);

        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    }

});