<?php
require 'conexion_bbdd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_SESSION["usuario"];
    $precioTotal = $_POST["precioTotal"];
    $idReceta = $_POST["idReceta"];
    $fechaActual = date('Y/m/d');
    $numeroMedicamentos = $_POST["numeroMedicamentos"];

    $sql = "INSERT INTO pedidos (nick, precioTotal, fechaPedido)
    VALUES ('$usuario', '$precioTotal', '$fechaActual')";
    $conn->query($sql);

    $sql1 = "SELECT idPedido FROM pedidos WHERE nick = '$usuario'
    AND precioTotal = '$precioTotal' AND fechaPedido = '$fechaActual'";
    $idPedido = $conn->query($sql1)->fetch_assoc()["idPedido"];

    echo $idReceta;
    $sql2 = "SELECT idMedicamento, cantidad FROM medicamentosrecetas WHERE idReceta = '$idReceta'";
    $res = $conn->query($sql2);

    $idMedicamentos = [];
    $cantidades = [];

    while ($fila = $res->fetch_assoc()) {
        echo $fila["idMedicamento"];
        echo $fila["cantidad"];
        array_push($idMedicamentos, $fila["idMedicamento"]);
        array_push($cantidades, $fila["cantidad"]);
    }
    echo $idMedicamentos[0];
    for ($i = 0; $i < $numeroMedicamentos; $i++) {
        $linea = $i + 1;
        $sqlAux = "SELECT precio FROM medicamentos WHERE idMedicamento = '$idMedicamentos[$i]'";
        $precio = $conn->query($sqlAux)->fetch_assoc()["precio"];
        $sql3 = "INSERT INTO lineaspedidos VALUES ('$linea', '$idMedicamentos[$i]', '$idPedido', '$precio', '$cantidades[$i]')";
        $conn->query($sql3);
    }

    $cont = 0;
    while ($cont < $numeroMedicamentos) {
        $sql4 = "DELETE FROM medicamentosrecetas WHERE idMedicamento = $idMedicamentos[$cont]";
        $conn->query($sql4);
        $cont++;
    }

    $sql5 = "UPDATE recetas SET precioTotal = '0.0' WHERE idReceta = '$idReceta'";
    $conn->query($sql5);
}
header("Location: /index.php");
?>