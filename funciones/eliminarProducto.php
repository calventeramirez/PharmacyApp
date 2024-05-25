<?php
    require 'conexion_bbdd.php';
    session_start();
    $usuario = $_SESSION['usuario'];
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
        $id_Medicamento = $_POST['idMedicamento'];
        $precio_Medicamento = $_POST['precio'];

        $sql_aux = "SELECT precioTotal FROM recetas WHERE nick = '$usuario'";
        $precioTotal = $conn->query($sql_aux)->fetch_assoc()["precioTotal"];

        echo $precio_Medicamento;

        echo $precioTotal;
        $sqlP = "UPDATE recetas SET precioTotal = (precioTotal - '$precio_Medicamento' * 1) WHERE nick = '$usuario'";
        $conn->query($sqlP);


        $sql = "DELETE FROM medicamentosrecetas WHERE idMedicamento = '$id_Medicamento'";
        $conn->query($sql);
        header("Location: ../carrito.php");
    }
?>