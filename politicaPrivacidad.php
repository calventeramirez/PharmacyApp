<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - Politica de privacidad</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
</head>

<body>
    <header>
    <?php session_start(); ?>
        <div class="header-top">
            <a href="./index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
            <div class="buscador">
                <form action="buscar.php" method="get">
                    <input type="text" name="termino" placeholder="Buscar productos...">
                    <button type="submit"><img src="/img/busqueda.png" alt="Buscar"></button>
                </form>
            </div>
                <div class="cuenta-carrito">
                <?php
                    // Si el usuario está logueado
                    if (isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px; "> ' . $_SESSION['usuario'] . '</a>';
                        if ($_SESSION['rol'] == "admin") {
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px ;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px;">Cerrar sesión</a>';
                        echo '<a href="./carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 5px;">Iniciar Sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav>
            <ul class="menu-verde">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="./medicamentos.php">Medicamentos</a></li>
                <li><a href="/contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Sección de inicio -->
        <div class ="politica-inicio">
            <div class="politica">
                <section>
                    <h1>Política de privacidad del sitio web</h1>
                    <h2>PharmacyApp</h2>
                </section>
                <section>
                    <h3>1. POLÍTICA DE PRIVACIDAD Y PROTECCIÓN DE DATOS</h3>
                    <p>
                        PharmacyApp, en adelante RESPONSABLE, es el Responsable del tratamiento de los datos personales del
                        Usuario y le informa que estos datos serán tratados de conformidad con lo dispuesto en las normativas
                        vigentes en protección de datos personales, el Reglamento (UE) 2016/679 de 27 de abril de 2016 (GDPR) relativo
                        a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y la Ley Orgánica
                        (ES) 15/1999 de 13 de diciembre (LOPD) relativa a la protección de datos de carácter personal, por lo que se le
                        facilita la siguiente información del tratamiento:
                    </p>
                </section>
                <section>
                    <h3>2. FINALIDAD DEL TRATAMIENTO</h3>
                    <p>
                        Mantener una relación comercial con el Usuario. Las operaciones previstas para realizar el tratamiento son:
                        Remisión de comunicaciones comerciales publicitarias por email, fax, SMS, MMS, comunidades sociales o
                        cualquier otro medio electrónico o físico, presente o futuro, que posibilite realizar comunicaciones
                        comerciales. Estas comunicaciones serán realizadas por el RESPONSABLE y estarán relacionadas con sus
                        productos y servicios, o de sus colaboradores o proveedores con los que este haya alcanzado algún acuerdo
                        de promoción. En este caso, los terceros nunca tendrán acceso a los datos personales.
                    </p>
                </section>
                <section>
                    <h3>3. LEGITIMACIÓN DEL TRATAMIENTO</h3>
                    <p>
                        La base legal para el tratamiento de los datos es el consentimiento. Para contactar con el RESPONSABLE, suscribirse
                        a un boletín o realizar comentarios en este sitio Web se requiere el consentimiento con esta política de privacidad.
                    </p>
                </section>
                <section>
                    <h3>4. DESTINATARIOS DE CESIONES O TRANSFERENCIAS</h3>
                    <p>
                        No se prevén cesiones o transferencias internacionales de datos.
                    </p>
                </section>
                <section>
                    <h3>5. DERECHOS</h3>
                    <p>
                        El Usuario tiene sobre PharmacyApp y podrá ejercer los siguientes derechos:
                    </p>
                    <ul>
                        <li>Derecho de acceso: permite al interesado conocer y obtener información sobre sus datos de carácter personal
                            sometidos a tratamiento.</li>
                        <li>Derecho de rectificación o supresión: permite corregir errores y modificar los datos que resulten ser inexactos
                            o incompletos.</li>
                        <li>Derecho de cancelación: permite que se supriman los datos que resulten ser inadecuados o excesivos.</li>
                        <li>Derecho de oposición: derecho del interesado a que no se lleve a cabo el tratamiento de sus datos de carácter
                            personal o se cese el tratamiento de los mismos.</li>
                        <li>Limitación del tratamiento: conlleva el marcado de los datos personales conservados, con la finalidad de limitar
                            su futuro tratamiento.</li>
                        <li>Portabilidad de los datos: facilitación de los datos objeto de tratamiento al interesado, para que éste pueda
                            transmitirlos a otro responsable, sin impedimentos.</li>
                    </ul>
                </section>
                <section>
                    <h3>6. PROCEDENCIA DE LOS DATOS</h3>
                    <p>
                        Los datos personales que tratamos en PharmacyApp proceden del propio interesado.
                    </p>
                </section>
                <section>
                    <h3>7. INFORMACIÓN ADICIONAL</h3>
                    <p>
                        Información adicional sobre protección de datos personales
                    </p>
                </section>
            </div>
        </div>
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
                <div class="col-lg-2">
                    <p>Enlaces de interés</p>
                    <ul>
                        <li class="footer-li"><a href="/politicaPrivacidad.php">Política de privacidad</a></li>
                        <li class="footer-li"><a href="/terminosCondiciones.php">Términos y condiciones</a></li>
                        <li class="footer-li"><a href="/cookies.php">Política de cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="JS/bootstrap.bundle.min.js"></script> <!-- Bootstrap -->
</body>

</html>