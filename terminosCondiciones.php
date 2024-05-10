<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - Terminos y Condiciones</title>
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
                    <input type="text" placeholder="Buscar productos...">
                </div>
                <div class="cuenta-carrito">
                <?php
                    // Si el usuario está logueado
                    if(isset($_SESSION['usuario'])) {
                        echo '<a href="#"><i class="fas fa-user"></i> '.$_SESSION['usuario'].'</a>';
                        if($_SESSION['rol'] == "admin"){
                            echo '<a href="./anadir_medicamentos.php">Añadir Medicamento</a>';
                        }
                        echo '<a href="./funciones/cerraSesion.php">Cerra sesión</a>';
                        echo '<a href="./carrito.php" ><i class="fas fa-shopping-cart"></i> Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="./login.php" class="cuenta"><i class="fas fa-user"></i> Iniciar sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav>
            <ul class="menu-verde">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="">Medicamentos</a></li>
                <li><a href="/contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Sección de inicio -->
        <div>
            <div>
                <article>
                    <h2>1. Introducción</h2>
                    <p>PharmacyApp (en adelante, la "App") es una aplicación móvil que permite a los usuarios acceder a una variedad de servicios relacionados con la salud y la farmacia. Estos Términos y Condiciones de Uso (en adelante, los "Términos") regulan el uso de la App por parte de los usuarios.</p>

                    <h2>2. Aceptación de los Términos</h2>
                    <p>Al descargar, instalar o utilizar la App, el usuario acepta y se compromete a cumplir con estos Términos. Si el usuario no está de acuerdo con estos Términos, no debe descargar, instalar o utilizar la App.</p>

                    <h2>3. Registro y Cuenta</h2>
                    <p>Para utilizar algunos de los servicios de la App, el usuario deberá crear una cuenta. El usuario es responsable de la información que proporciona al crear su cuenta y de mantener la información de su cuenta actualizada. El usuario no podrá usar el nombre de usuario o la contraseña de otra persona sin su autorización.</p>

                    <h2>4. Uso de la App</h2>
                    <p>El usuario se compromete a utilizar la App de manera responsable y de acuerdo con la ley. El usuario no podrá utilizar la App para ningún propósito ilegal o que pueda dañar a otros.</p>

                    <h2>5. Propiedad Intelectual</h2>
                    <p>La App y todo su contenido, incluyendo, sin limitación, texto, imágenes, audio y video, están protegidos por derechos de autor, marcas comerciales y otros derechos de propiedad intelectual. El usuario no podrá copiar, distribuir, modificar, crear obras derivadas o de cualquier otra manera utilizar el contenido de la App sin el consentimiento previo por escrito del propietario de los derechos de propiedad intelectual.</p>

                    <h2>6. Privacidad</h2>
                    <p>PharmacyApp se compromete a proteger la privacidad de los usuarios. La App recopila cierta información sobre los usuarios, como su nombre, dirección de correo electrónico y número de teléfono. Esta información se utiliza para proporcionar los servicios de la App y para mejorar la experiencia del usuario. PharmacyApp no compartirá la información de los usuarios con terceros sin el consentimiento previo del usuario.</p>

                    <h2>7. Limitación de Responsabilidad</h2>
                    <p>PharmacyApp no se hace responsable de ningún daño directo, indirecto, incidental, especial o consecuente que surja del uso o la imposibilidad de usar la App.</p>

                    <h2>8. Indemnización</h2>
                    <p>El usuario indemnizará y mantendrá libre de daños a PharmacyApp, sus directivos, empleados, agentes y representantes de cualquier reclamación, pérdida, responsabilidad, daño, costo o gasto (incluidos los honorarios de abogados) que surja de o esté relacionado con el uso de la App por parte del usuario o el incumplimiento de estos Términos por parte del usuario.</p>

                    <h2>9. Modificación de los Términos</h2>
                    <p>PharmacyApp puede modificar estos Términos en cualquier momento. Las modificaciones entrarán en vigor al ser publicadas en la App. Si el usuario no está de acuerdo con las modificaciones, puede dejar de usar la App.</p>

                    <h2>10. Terminación</h2>
                    <p>PharmacyApp puede rescindir el acceso del usuario a la App en cualquier momento sin previo aviso.</p>

                    <h2>11. Ley Aplicable y Jurisdicción</h2>
                    <p>Estos Términos se regirán e interpretarán de conformidad con las leyes de España. Cualquier disputa que surja de estos Términos se someterá a la jurisdicción exclusiva de los tribunales de España.</p>

                    <h2>12. Disposiciones Generales</h2>
                    <p>Estos Términos constituyen el acuerdo completo entre el usuario y PharmacyApp en relación con el uso de la App. Si alguna disposición de estos Términos se considera inválida o inaplicable, dicha disposición se eliminará de estos Términos y las disposiciones restantes seguirán en pleno vigor y efecto.</p>

                    <h2>13. Contacto</h2>
                    <p>Si tiene alguna pregunta sobre estos Términos, puede contactarnos a [correo electrónico protegido]</p>
                </article>
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
                <div class="col-lg-3">
                    <p>Enlaces de interés</p>
                    <ul>
                        <li class="footer-li"><a href="/politicaPrivacidad.php">Política de privacidad</a></li>
                        <li class="footer-li"><a href="/terminosCondiciones.php">Términos y condiciones</a></li>
                        <li class="footer-li"><a href="/cookies.php">Política de cookies</a></li>
                    </ul>
                </div>
            </div>
    </footer>
    <script src="JS/bootstrap.bundle.min.js"></script> <!-- Bootstrap -->
</body>

</html>