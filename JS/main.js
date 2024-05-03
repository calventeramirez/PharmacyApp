//VALIDACIÓN REGISTRO
let boton = document.getElementById("boton");

boton.addEventListener("click", function (ev) {
    ev.preventDefault();
    let formularioCorrecto = true;

    //Validación usuario
    let usuario = document.getElementsByName("usuario")[0].value.split(" ");
    if (document.getElementsByName("usuario")[0].value == "" && formularioCorrecto) {
        alert("El usuario no puede estar vacio")
        formularioCorrecto = false;
    } else {
        if ((usuario.length > 2 && formularioCorrecto)) {
            alert("El usuario debe tener una palabra");
            formularioCorrecto = false;
        }
    }
    
    // Validación nombre
    let nombre = document.getElementsByName("nombre")[0].value.split(" ");
    if (document.getElementsByName("nombre")[0].value == "" && formularioCorrecto) {
        alert("El nombre no puede estar vacio")
        formularioCorrecto = false;
    } else {
        if ((nombre.length < 1 && formularioCorrecto) || (nombre.length > 2 && formularioCorrecto)) {
            alert("El nombre debe tener una o dos palabras");
            formularioCorrecto = false;
        }
    }
    
    //Validacion apellido
    let apellidos = document.getElementsByName("apellidos")[0].value.split(" ");
    if (document.querySelectorAll("input")[2].value == "" && formularioCorrecto) {
        alert("El apellido no puede estar vacio")
        formularioCorrecto = false;
    } else {
        if ((apellidos.length < 1 && formularioCorrecto) || (apellidos.length > 2 && formularioCorrecto)) {
            alert("Los apellidos deben tener una o dos palabras");
            formularioCorrecto = false;
            
        }
    }
    
    //Validacion email
    let email = document.getElementsByName('email')[0].value;
    let validacionEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    
    if (validacionEmail.test(!email)) {
        alert("El email es incorrecto")
        formularioCorrecto = false;
    } 
    
    //Validación contraseña
    let contrasena = document.getElementsByName("contrasena")[0].value;
    if (contrasena.length < 8 && formularioCorrecto || contrasena.length > 12 && formularioCorrecto) {
        alert("La contraseña debe tener entre 8 y 12 caracteres");
        formularioCorrecto = false;
    }
    
    //Validación repita contraseña
    let contrasenaRep = document.getElementsByName("contrasenaRep")[0].value;
    if( contrasenaRep != contrasena && formularioCorrecto){
        alert("Las contraseñas deben ser la misma");
        formularioCorrecto = false
    }

    if(formularioCorrecto) location.href="index.thml";
});