<?php
    // Procesamiento del formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $temp_usuario = $_POST["usuario"];
        $temp_nombre = $_POST["nombre"];
        $temp_apellido = $_POST["apellido"];
        $temp_email = $_POST["email"];
        $temp_contrasena = $_POST["contrasena"];
        $temp_contrasenaRep = $_POST["contrasenaRep"];

        # Validación de usuario
        if (strlen($temp_usuario) == 0) {
            $err_usuario = "Campo obligatorio";
        } else {
            $patron = "/^[a-zA-Z_]$/";
            if (!preg_match($patron, $temp_usuario)) {
                $err_usuario = "El usuario debe ser una palabra";
            } else {
                $usuario = $temp_usuario;
            }
        }

        # Validación de nombre
        if (strlen($temp_nombre) == 0) {
            $err_nombre = "Campo obligatorio";
        } else {
            $patron = "/^[a-zA-Z_]$/";
            if (!preg_match($patron, $temp_nombre)) {
                $err_nombre = "El nombre debe ser una palabra";
            } else {
                $nombre = $temp_nombre;
            }
        }

        # Validación de apellido
        if (strlen($temp_apellido) == 0) {
            $err_apellido = "Campo obligatorio";
        } else {
            $patron = "/^[a-zA-Z_]$/";
            if (!preg_match($patron, $temp_apellido)) {
                $err_apellido = "El apellido debe ser una palabra";
            } else {
                $apellido = $temp_apellido;
            }
        }

        # Validación de email
        if (strlen($temp_email) == 0) {
            $err_email = "Campo obligatorio";
        } else {
            $patron = "/^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/";
            if (!preg_match($patron, $temp_email)) {
                $err_email = "El email esta incorrecto";
            } else {
                $email = $temp_email;
            }
        }

        # Validación de contraseña
        if (strlen($temp_contrasena) == 0) {
            $err_contrasena = "Campo obligatorio";
        } else {
            $patron = "/{8,12}/";
            if (!preg_match($patron, $temp_contrasena)) {
                $err_contrasena = "El contraseña debe tener entre 8 y 12 caracteres y contener solamente letras o números";
            } else {
                $contrasena_cifrada = password_hash($temp_contrasena, PASSWORD_DEFAULT);
            }
        }

        # Validación repita contraseña
        if (strlen($temp_contrasenaRep) == 0) {
            $err_contrasenaRep = "Campo obligatorio";
        } else {
            $patron = "/{8,12}/";
            if ($err_contrasenaRep != $contrasena) {
                $err_contrasenaRep = "Las contraseñas deben ser iguales";
            }
        }
    }
?>

<?php
    // Si la validación es exitosa, se insertan los datos en la base de datos
    if (isset($usuario) && isset($nombre) && isset($apellido) && isset($email) && isset($contrasena_cifrada)) {
        $sql = "INSERT INTO usuarios (usuario, nombre, apellido, email, contrasena) VALUES ('$usuario', '$nombre', '$apellido', '$email', '$contrasena_cifrada')";
        $sql2 = "INSERT INTO pedidos (usuario, precioTotal) VALUES ('$usuario', '0')";
        $duplicado = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

        // Se verifica si el usuario ya existe
        if ($conexion->query($duplicado)->num_rows > 0) {
            $err_usuario = "El usuario ya existe";
        } else {
            // Se insertan los datos en la base de datos
            $conexion->query($sql);
            $conexion->query($sql2);
            header('location: index.html');
        }
    }
?>