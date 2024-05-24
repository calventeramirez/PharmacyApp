<?php
    require 'conexion_bbdd.php';
    session_start();
    $usuario = $_SESSION['usuario'];
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
        $id_Medicamento = $_POST['idMedicamento'];
        //Obtengo el id de la receta del usuario
        $sql = "SELECT idReceta FROM recetas WHERE nick = '$usuario'";
        $idReceta = $conn->query($sql)->fetch_assoc()["idReceta"];
        //Inserto el medicamento en la tabla medicamentosrecetas
        $sql2 = "INSERT INTO medicamentosrecetas VALUES ('$id_Medicamento', '$idReceta', '1')";
        $conn->query($sql2);

        //Actualizo el precio total
        $sql = "SELECT precio FROM medicamentos WHERE idMedicamento = '$id_Medicamento'";
        $precio = $conn->query($sql)->fetch_assoc()["precio"];
        $sql = "UPDATE recetas SET precioTotal = (precioTotal + '$precio' * '1') WHERE idReceta = '$idReceta'";
        $conn->query($sql);
        header("Location: ../carrito.php");
    }
?>