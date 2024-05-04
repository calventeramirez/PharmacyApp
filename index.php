<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - La mejor farmacia a tu mano</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="#"></script> <!-- Script de JavaScript -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
</head>

<body>
    <?php session_start(); ?>
    <header>
        <div class="header-top">
            <a href="./index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
                <div class="buscador">
                    <input type="text" placeholder="Buscar productos...">
                </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if(isset($_SESSION['usuario'])) {
                        echo '<a href="#"><i class="fas fa-user"></i> '.$_SESSION['usuario'].'</a>';
                        if($_SESSION['rol'] == "admin"){
                            echo '<a href="./anadirMedicamento.php">Añadir Medicamento</a>';
                        }
                        echo '<a href="./funciones/cerraSesion.php">Cerra sesión</a>';
                        echo '<a href="#" ><i class="fas fa-shopping-cart"></i> Carrito</a>';
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
        <!-- Sección de inicio -->
        <!-- <section id = "imagen-logo">
            <img src="img/logo.jpg" alt="Logo de PharmacyApp">
        </section> -->
        <section id="letras-index">
            <h2>PharmacyApp</h2>
            <p>PharmacyApp es una innovadora plataforma digital diseñada para revolucionar la forma den que las personas acceden a medicamentos y gestionan sus tratamientos. Esta aplicación móvil y web se ha desarrollado con el propósito de brindar comodidad y asistencia a personas mayores, dependientes y pacientes con enfermedades crónicas, en particular, aquellos que enfrentan la lucha contra el cáncer.</p>
        </section>
        <section>
            <div>
                <h2>Tu salud, nuestra prioridad</h2>
                <p>Accede a tus medicamentos de forma fácil y cómoda desde tu hogar.</p>
                <a href="login.php" class="btn btn-success">Comienza ahora</a>
            </div>
        </section>
        <section class="servicios">
            <h2>Servicios destacados</h2>
            <ul class="servicios-list">
                <li>
                    <i class="fas fa-user-md"></i>
                    <h3>Consultas médicas online</h3>
                    <p>Consulta con nuestros médicos especialistas desde la comodidad de tu hogar.</p>
                </li>
                <li>
                    <i class="fas fa-pills"></i>
                    <h3>Farmacia online</h3>
                    <p>Solicita tus medicamentos y recíbelos en casa sin moverte.</p>
                </li>
                <li>
                    <i class="fas fa-chart-line"></i>
                    <h3>Seguimiento de salud</h3>
                    <p>Monitoriza tu salud y recibe consejos personalizados.</p>
                </li>
            </ul>
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
                        <li class="footer-li"><a href="./politicaPrivacidad.html">Política de privacidad</a></li>
                        <li class="footer-li"><a href="./terminosCondiciones.html">Términos y condiciones</a></li>
                        <li class="footer-li"><a href="#">Política de cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="JS/bootstrap.bundle.min.js"></script> <!-- Bootstrap -->
</body>

</html>