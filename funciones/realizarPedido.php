<?php
    require 'conexion_bbdd.php';
    session_start();
    if(!isset($_SESSION["usuario"])) {
        header("Location: /login.php");
    }
    $usuario = $_SESSION["usuario"];
    $precioTotal = $_POST["precioTotal"];
    $idCesta = $_POST["idReceta"];
    $fechaActual = date('Y/m/d');
    $numeroMedicamentos = $_POST["numeroMedicamentos"];

    $sql = "INSERT INTO pedidos (usuario, precioTotal, fechaPedido)
    VALUES ('$usuario', '$precioTotal', '$fechaActual')";
    $conexion -> query($sql);

    $sql1 = "SELECT idPedido FROM pedidos WHERE usuario = '$usuario'
    AND precioTotal = '$precioTotal' AND fechaPedido = '$fechaActual'";
    $idPedido = $conexion -> query($sql1) -> fetch_assoc()["idPedido"];

    $sql2 = "SELECT idMedicamento, cantidad FROM medicamentosReceta WHERE idReceta = '$idReceta'";
    $res = $conexion -> query($sql2);

    $idMedicamentos = [];
    $cantidades = [];

    while($fila = $res -> fetch_assoc()) {
        array_push($idProductos, $fila["idMedicamento"]);
        array_push($cantidades, $fila["cantidad"]);
    }

    for($i = 0; $i < $numeroMedicamentos; $i++) {
        $linea = $i + 1;
        $sqlAux = "SELECT precio FROM Medicamentos WHERE idMedicamento = '$idMedicamentos[$i]'";
        $precio = $conexion -> query($sqlAux) -> fetch_assoc()["precio"];
        $sql3 = "INSERT INTO lineasPedidos VALUES ('$linea', '$idMedicamentos[$i]', '$idPedido', '$precio', '$cantidades[$i]')";
        $conexion -> query($sql3);
    }

    $cont = 0;
    while($cont < $numeroMedicamentos) {
        $sql4 = "DELETE FROM medicamentosCesta WHERE idMedicamento = $idMedicamentos[$cont]";
        $conexion -> query($sql4);
        $cont++;
    }

    $sql5 = "UPDATE recetas SET precioTotal = '0.0' WHERE idReceta = '$idReceta'";
    $conexion -> query($sql5);
    header("Location: /index.php");
?>