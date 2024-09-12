const btnSignIn = document.getElementById("sign-in"),
        btnSignUp = document.getElementById("sign-up"),
        containerFormRegister = document.querySelector(".register"),
        containerFormLogin = document.querySelector(".login");

btnSignIn.addEventListener("click", e =>{
    containerFormRegister.classList.add("hide");
    containerFormLogin.classList.remove("hide");
})

btnSignUp.addEventListener("click", e=>{
    containerFormLogin.classList.add("hide");
    containerFormRegister.classList.remove("hide");
})

document.addEventListener('DOMContentLoaded', function () {
    if (document.body.classList.contains('logged-in')) {
        // Deshabilitar clics en el icono de usuario
        document.querySelector('.fa-user').style.pointerEvents = 'none';
        document.querySelectorAll('#login-form input[type="button"], #login-form input[type="submit"]').forEach(button => {
            button.disabled = true;
        });

        // Opcional: Ocultar el icono de usuario
        document.querySelector('.fa-user').style.opacity = '0.5'; // O cualquier otro estilo para indicar deshabilitado
    }
});


