<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - La mejor farmacia a tu mano</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="./JS/api.js"></script> <!-- Script de JavaScript -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
    <?php require "./funciones/conexion_bbdd.php" ?>
    <?php require "./funciones/funciones.php" ?>
</head>

<body>
    <?php 
    session_start();
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
        $rol = $_SESSION["rol"];
    } else {
        header("Location: /login.php");
    }
    if($rol != "admin"){
        header("Location: /index.php");
    }
    ?>
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
                    if(isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px;"> '.$_SESSION['usuario'].'</a>';
                        if($_SESSION['rol'] == "admin"){
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px; margin-right: 5px;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px; margin-right: 5px">Cerrar sesión</a>';
                        echo '<a href="carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
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
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $temp_nombre = depurar($_POST["nombre"]);
        $temp_precio = depurar($_POST["precio"]);
        $temp_descripcion = depurar($_POST["descripcion"]);
        $temp_cantidad = depurar($_POST["cantidad"]);


        $nombre_imagen = $_FILES["imagen"]["name"];
        $tipo_imagen = $_FILES["imagen"]["type"];
        $tamano_imagen = $_FILES["imagen"]["size"];
        $ruta_temporal = $_FILES["imagen"]["tmp_name"];

        #   Validación de nombre del medicamento
        if (strlen($temp_nombre) == 0) {
            $err_nombre = "Campo obligatorio";
        } else {
            $nombre = $temp_nombre;
        }

        #   Validación de descripcion
        if (strlen($temp_descripcion) == 0) {
            $err_descripcion = "Campo obligatorio";
        } else {
            $descripcion = $temp_descripcion;
        }

        #   Validación de precio
        if (strlen($temp_precio) == 0) {
            $err_precio = "El precio es obligatorio";
        } elseif (!is_numeric($temp_precio)) {
            $err_precio = "El precio debe ser un número";
        } elseif ($temp_precio < 0) {
            $err_precio = "El precio no puede ser negativo";
        } elseif ($temp_precio > 99999.99) {
            $err_precio = "El precio no puede ser mayor de 99999.99";
        } else {
            $precio = $temp_precio;
        }

        #   Validación de cantidad
        if (strlen($temp_cantidad) == 0) {
            $err_cantidad = "La cantidad es obligatoria";
        } elseif (filter_var($temp_cantidad, FILTER_VALIDATE_INT) === false) {
            $err_cantidad = "La cantidad debe ser un número entero";
        } elseif ($temp_cantidad < 0) {
            $err_cantidad = "La cantidad no puede ser negativa";
        } elseif ($temp_cantidad > 99999) {
            $err_cantidad = "La cantidad no puede ser mayor de 99999";
        } else {
            $cantidad = $temp_cantidad;
        }

        #   Validación de imagen
        if (strlen($nombre_imagen) > 1) {
            if ($_FILES["imagen"]["error"] != 0) {
                $err_imagen = "Error al subir la imagen";
            } else {
                $permitidos = ["image/jpeg", "image/png", "image/gif", "image/webp"];
                if (!in_array($_FILES["imagen"]["type"], $permitidos)) {
                    $err_imagen = "Error al subir la imagen";
                } else {
                    $ruta_final = "./img/" . $nombre_imagen;
                }
            }
        } else {
            $err_imagen = "La imagen es obligatoria";
        }
    }
    ?>
    <!-- Formulario para insertar medicamentos -->
    <div class="container">
        <h1>Insertar medicamento</h1>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nombre medicamento: </label>
                    <input class="form-control" type="text" name="nombre">
                    <?php if (isset($err_nombre)) echo '<label class=text-danger>' . $err_nombre . '</label>' ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio: </label>
                    <input class="form-control" type="text" name="precio">
                    <?php if (isset($err_precio)) echo '<label class=text-danger>' . $err_precio . '</label>' ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción: </label>
                    <input class="form-control" type="text" name="descripcion">
                    <?php if (isset($err_descripcion)) echo '<label class=text-danger>' . $err_descripcion . '</label>' ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad: </label>
                    <input class="form-control" type="text" name="cantidad">
                    <?php if (isset($err_cantidad)) echo '<label class=text-danger>' . $err_cantidad . '</label>' ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen: </label>
                    <input class="form-control" type="file" name="imagen">
                </div>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
            <?php
            //Si todas las validaciones son correctas, se inserta el medicamento 
            if (isset($nombre) && isset($descripcion) && isset($precio) && isset($cantidad) && isset($ruta_final)) {
                $sql = "INSERT INTO medicamentos (nombre, descripcion, precio, cantidad, imagen)
                    VALUES ('$nombre',
                    '$descripcion',
                    '$precio',
                    '$cantidad',
                    '$ruta_final')";
                //Mueve la imagen a la carpeta de destino
                move_uploaded_file($ruta_temporal, $ruta_final);
                $conn->query($sql);
                echo "<div class='container alert alert-success'><h3>Medicamento insertado con éxito<h3><div>";
            }
            ?>
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
                        & Victor Moreno Benítez</p>
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