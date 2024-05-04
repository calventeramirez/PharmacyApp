//VALIDACIÓN LOGIN
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
    
    //Validación contraseña
    let contrasena = document.getElementsByName("contrasena")[0].value;
    if (contrasena.length < 8 && formularioCorrecto || contrasena.length > 12 && formularioCorrecto) {
        alert("La contraseña debe tener entre 8 y 12 caracteres");
        formularioCorrecto = false;
    }
    
    if(formularioCorrecto) location.href="../funciones/login.php";
});