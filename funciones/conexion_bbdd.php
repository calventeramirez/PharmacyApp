<?php
    $_servidor = "localhost"; //Para almacenar la ip de la base de datos
    $_usuario = "admin";
    $_contraseña = "admin";
    $_base_de_datos = "db_pharmacyapp";

    $conn = new mysqli($_servidor, $_usuario, $_contraseña, $_base_de_datos)
        or die("Error de conexión");