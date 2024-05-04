<?php
    // Procesamiento del formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        // Consulta SQL para obtener el usuario de la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $conexion->query($sql);

        // Verifica si el usuario existe
        if ($resultado->num_rows == 0) {
    ?>
        <!-- Mensaje de error si el usuario no existe -->
        <div class="alert alert-danger" role="alert">
            EL USUARIO NO EXISTE
        </div>
    <?php
        } else {
        // Recupera la contraseña cifrada y el rol del usuario
        while ($fila = $resultado->fetch_assoc()) {
            $contrasena_cifrada = $fila["contrasena"];
            $rol = $fila["rol"];
        }

        // Verifica la contraseña
        $acceso_valido = password_verify($contrasena, $contrasena_cifrada);

        if ($acceso_valido) {
            // Si la contraseña es válida, se inicia la sesión
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["rol"] = $rol;
            header('location: index.html');
        } else {
            // Mensaje de error si la contraseña es incorrecta
            echo "LA CONTRASEÑA ESTÁ MAL";
        }
        }
    }
    ?>