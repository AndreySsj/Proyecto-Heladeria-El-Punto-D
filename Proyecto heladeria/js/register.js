const formRegister = document.querySelector(".form-register");
const inputUser = document.querySelector(".form-register input[type='text']");
const inputEmail = document.querySelector(".form-register input[type='email']");
const inputPass = document.querySelector(".form-register input[type='password']");

const userNameRegex = /^[a-zA-Z0-9\_\-]{4,16}$/;
const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
const passwordRegex = /^.{4,12}$/;

const estadoValidacionCampos = {
    userName: false,
    userEmail: false,
    userPassword: false,
};


document.addEventListener("DOMContentLoaded", () =>{
    formRegister.addEventListener("submit", e =>{
        //e.preventDefault();
        enviarFormulario(e)
    });

    inputUser.addEventListener("input", () =>{
        validarCampo(userNameRegex, inputUser, "El nombre de usuario debe ser de 4 a 16 caracteres y solo puede contener letras y guión bajo.")
    })

    inputEmail.addEventListener("input", () =>{
        validarCampo(emailRegex, inputEmail, "El correo solo puede contener letras, números, puntos, guiones y guíon bajo")
    })

    inputPass.addEventListener("input", () =>{
        validarCampo(passwordRegex,inputPass, "La contraseña debe contener de 4 a 12 caracteres")
    })

})

function validarCampo(regularExpresion, campo, mensaje){
    const validarCampo = regularExpresion.test(campo.value)
    if(validarCampo){
        eliminarAlerta(campo.parentElement.parentElement)
        estadoValidacionCampos[campo.name] = true;
        campo.parentElement.classList.remove("error");
    }else{
        estadoValidacionCampos[campo.name] = false;
        mostrarAlerta(campo.parentElement.parentElement, mensaje)
        campo.parentElement.classList.add("error");
    }
    
}

function mostrarAlerta(referencia, mensaje){
    eliminarAlerta(referencia);
    const alertaExistente = referencia.querySelector(".alerta");

    if (!alertaExistente) {
        const alertaDiv = document.createElement("div");
        alertaDiv.classList.add("alerta");
        alertaDiv.textContent = mensaje;
        referencia.appendChild(alertaDiv);
    }
}

function eliminarAlerta(referencia){
    const alertas = referencia.querySelectorAll(".alerta");
    alertas.forEach(alerta => alerta.remove()); // Asegúrate de eliminar cada alerta.
}



function enviarFormulario(e) {
    const alertaExito = document.getElementById("alertaExito");
    const alertaError = document.getElementById("alertaError");

    if (estadoValidacionCampos.userName && estadoValidacionCampos.userEmail && estadoValidacionCampos.userPassword) {
        estadoValidacionCampos.userName = false;
        estadoValidacionCampos.userEmail = false;
        estadoValidacionCampos.userPassword = false;
        
        //formRegister.reset();

        alertaExito.style.display = "block";
        alertaError.style.display = "none";
        setTimeout(() => {
            alertaExito.style.display = "none";
        }, 3000);
    } else {

        e.preventDefault();
        alertaExito.style.display = "none";
        alertaError.style.display = "block";
        setTimeout(() => {
            alertaError.style.display = "none";
        }, 3000);
    }
}

