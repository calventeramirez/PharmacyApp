<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - La mejor farmacia a tu mano</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!--JavaScript for Carousel -->
    <script src="./JS/api.js"></script> <!-- Script de JavaScript -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
</head>

<body>
    <?php session_start(); ?>
    <header>
        <div class="header-top">
            <a href="/index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
                <div class="buscador">
                    <input type="text" placeholder="Buscar productos...">
                </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if (isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px;"> ' . $_SESSION['usuario'] . '</a>';
                        if ($_SESSION['rol'] == "admin") {
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px; margin-right: 5px;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px; margin-right: 5px">Cerrar sesión</a>';
                        echo '<a href="./carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 5px">Iniciar Sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav>
            <ul class="menu-verde">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="/medicamentos.php">Medicamentos</a></li>
                <li><a href="/contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Sección de inicio -->
        <!-- <section id = "imagen-logo">
            <img src="img/logo.jpg" alt="Logo de PharmacyApp">
        </section> -->

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/img/farmacia-online.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/img/rubraca.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Atras</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>
        <section class="salud">
            <div>
                <h2>Tu salud, nuestra prioridad</h2>
                <p>Accede a tus medicamentos de forma fácil y cómoda desde tu hogar.</p>
                <a href="login.php" class="btn btn-success">Comienza ahora</a>
            </div>
            <h2>Productos destacados</h2>
            <div id="productos"></div>
        </section>
        <section class="servicios">
        
    <h2>Servicios destacados</h2>
    <div class="servicios-list">
        <div class="card">
            <img src="/img/consulta-medica.jpg" alt="Consulta médica">
            <h3>Consultas médicas online</h3>
            <p>Consulta con nuestros médicos especialistas desde la comodidad de tu hogar.</p>
        </div>
        <div class="card">
            <img src="/img/farmacia-online.jpg" alt="Farmacia Online">
            <h3>Farmacia online</h3>
            <p>Solicita tus medicamentos y recíbelos en casa sin moverte.</p>
        </div>
        <div class="card">
            <img src="/img/seguimiento-salud.jpg" alt="Seguimiento de salud">
            <h3>Seguimiento de salud</h3>
            <p>Monitoriza tu salud y recibe consejos personalizados.</p>
        </div>
    </div>
    </section>
    <section class="card-equipo">
        <div class="titulo-parrafo">
            <h2>Conozca al equipo de PharmacyApp</h2>
            <p>Nuestro pequeño equipo le brindará un servicio de calidad y un trato profesional</p>
        </div>
    <div class="equipo-list">
        <div class="miembro">
            <img src="/img/calvente.jpg" alt="Miembro 1">
            <h3>Pablo Calvente</h3>
            <p>Desarrollador y lider del proyecto</p>
        </div>
        <div class="miembro">
            <img src="/img/fernando.jpeg" alt="Miembro 2">
            <h3>Fernando Domínguez</h3>
            <p>Desarrollador</p>
        </div>
        <div class="miembro">
            <img src="/img/pablo.jpg" alt="Miembro 3">
            <h3>Pablo Pérez</h3>
            <p>Desarrollador</p>
        </div>
        <div class="miembro">
            <img src="/img/victor.jpg" alt="Miembro 4">
            <h3>Victor Moreno</h3>
            <p>Desarrollador</p>
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