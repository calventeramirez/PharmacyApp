<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - Registro</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="/CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <?php require "./funciones/conexion_bbdd.php" ?>
</head>

<body>
    <header>
        <?php session_start(); ?>
        <div class="header-top">
            <a href="./index.html" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
                <div class="buscador">
                    <input type="text" placeholder="Buscar productos...">
                </div>
                <div class="cuenta-carrito">
                <?php
                    // Si el usuario está logueado
                    if(isset($_SESSION['usuario'])) {
                        header("Location: index.php");
                    } else { // Si no está logueado
                        echo '<a href="./login.php" class="cuenta"><i class="fas fa-user"></i> Iniciar sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav>
            <ul class="menu-verde">
                <li><a href="./index.php">Inicio</a></li>
                <li><a href="">Medicamentos</a></li>
                <li><a href="./contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['tarjeta'])){
                    $temp_tarjeta = $_POST['tarjeta'];
                } else {
                    $temp_tarjeta = "";
                } 
                if(isset($_POST['usuario'])){
                    $temp_usuario = $_POST['usuario'];
                } else {
                   $temp_usuario = "";
                }
                if(isset($_POST['nombre'])){
                    $temp_nombre = $_POST['nombre'];
                } else {
                    $temp_nombre = "";
                }
                if(isset($_POST['apellido'])){
                    $temp_apellido = $_POST['apellido'];
                } else {
                    $temp_apellido = "";
                }
                if(isset($_POST['email'])){
                    $temp_email = $_POST['email'];
                } else {
                    $temp_email = "";
                }
                if(isset($_POST['contrasena'])){
                    $temp_contrasena = $_POST['contrasena'];
                } else {
                    $temp_contrasena = "";
                }
                if(isset($_POST['contrasenaRep'])){
                    $temp_contrasenaRep = $_POST['contrasenaRep'];
                } else {
                    $temp_contrasenaRep = "";
                }

                //Validamos la tarjeta sanitaria
                if (!strlen($temp_tarjeta) > 0) {
                    $err_tarjeta = "La tarjeta sanitaria es obligatoria";
                } else {
                    $tarjeta = $temp_tarjeta;
                }
                //Validamos el usuario
                if (!strlen($temp_usuario) > 0) {
                    $err_usario = "El nombre de usuario es obligatorio";
                } else {
                    $patron = "/^[a-zA-Z0-9]{4,8}$/";
                    if (!preg_match($patron, $temp_usuario)) {
                        $err_usario = "El usuario debe tener entre 4 y 8 caracteres y contener solamente letras o numeros";
                    } else {
                        $usuario = $temp_usuario;
                    }
                }
                 //Validacion y patron de nombre
                if (!strlen($temp_nombre) > 0) {
                    $err_nombre = "El nombre es obligatorio";
                } else {
                    $nombre = ucwords(strtolower($temp_nombre));
                }

                //Validacion y patron de apellido
                if (!strlen($temp_apellido) > 0) {
                    $err_apellido = "El apellido es obligatorio";
                } else {
                    $apellido = ucwords(strtolower($temp_apellido));
                }

                //Validamos el email
                if (!strlen($temp_email) > 0) {
                    $err_email = "El email es obligatorio";
                } else {
                    $patron = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";
                    if (!preg_match($patron, $temp_email)) {
                        $err_email = "El email no es válido";
                    } else {
                        $email = $temp_email;
                    }
                }

                //Validamos la contraseña
                if (!strlen($temp_contrasena) > 0) {
                    $err_contrasena = "La contraseña es obligatoria";
                } else {
                    $contrasena = $temp_contrasena;
                }

                //Validamos la contraseña repetida
                if (!strlen($temp_contrasenaRep) > 0) {
                    $err_contrasenaRep = "Repetir la contraseña es obligatoria";
                } else {
                    $contrasenaRep = $temp_contrasenaRep;
                }

                //Comprobamos que las contraseñas coinciden
                if ($contrasena != $contrasenaRep) {
                    $err_contrasenaRep = "Las contraseñas no coinciden";
                }

                //Si no hay errores
                if (!isset($err_tarjeta) && !isset($err_usuario) && !isset($err_nombre) && !isset($err_apellido) && !isset($err_email) && !isset($err_contrasena) && !isset($err_contrasenaRep)) {
                    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO usuarios (tarjetaSanitaria, nick, nombre, apellidos, email, contrasena) VALUES ('$tarjeta', '$usuario', '$nombre', '$apellido', '$email', '$contrasena_cifrada')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Usuario registrado correctamente";
                        header("Location: index.php");
                    } 
                }else{
                    echo $err_nombre;
                    echo "<div class='alert alert-danger' role='alert'>Error al registrar el usuario</div>";
                }
            }
        ?>
        <!-- Sección de inicio -->
        <section>
            <div id = "contenedor-login">
                <div id = "login">
                    <form class="form" method ="post">
                        <div class="flex-column">
                            <label>Tarjeta Sanitaria</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
                              <input type="text" name = "tarjeta" class="input" placeholder="Tarjeta Sanitaria">
                        </div>
                        <div class="flex-column">
                            <label>Usuario</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
                              <input type="text" name = "usuario" class="input" placeholder="Usuario">
                        </div>
                        <div class="flex-column">
                            <label>Nombre</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
                              <input type="text" name = "nombre" class="input" placeholder="Nombre">
                        </div>
                        <div class="flex-column">
                            <label>Apellido</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
                              <input type="text" name = "apellido" class="input" placeholder="Apellidos">
                        </div>
                        <div class="flex-column">
                            <label>Email</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
                              <input type="email" name = "email" class="input" placeholder="Email">
                        </div>
                        <div class="flex-column">
                            <label>Contraseña</label></div>
                            <div class="inputForm">
                              <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
                              <input type="password" name = "contrasena" class="input" placeholder="Contraseña">
                              <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                        </div>
                        <div class="flex-column">
                            <label>Repita la contraseña</label></div>
                            <div class="inputForm">
                                <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
                                <input type="password" name = "contrasenaRep" class="input" placeholder="Repita la contraseña">
                                <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                        </div>
                        <button class="button-submit" id="boton">Registrar</button>
                        <p class="p">¿Tienes cuenta? <a href="./login.php"><span class="span">Inicia Sesión</span></a>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="row">
                <div class="col-lg-2">
                    <img src="img/logo_sin_fondo.png" alt="Logo" id="imagen-footer">
                </div>
                <div class="col-lg-7">
                    <p> &copy; Desarrollado por: Pablo Jesús Calvente Ramírez, Fernando Dominguez Lago, Pablo Pérez Iza
                        & Victor
                        Moreno Benítez</p>
                </div>
                <div class="col-lg-3">
                    <p>Enlaces de interés</p>
                    <ul>
                        <li class="footer-li"><a href="./politicaPrivacidad.php">Política de privacidad</a></li>
                        <li class="footer-li"><a href="./terminosCondiciones.php">Términos y condiciones</a></li>
                        <li class="footer-li"><a href="#">Política de cookies</a></li>
                    </ul>
                </div>
            </div>
    </footer>
    <script src="JS/bootstrap.bundle.min.js"></script> <!-- Bootstrap -->
</body>

</html>