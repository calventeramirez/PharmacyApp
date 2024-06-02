<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - PharmacyApp</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
    <?php require "./funciones/conexion_bbdd.php" ?>
    <?php require "./funciones/medicamento.php" ?>

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
    if ($rol != "admin" && $rol != "cliente") {
        header("Location: /index.php");
    }
    ?>

    <header>
        <div class="header-top">
            <a href="/index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
            <div class="buscador">
                <form action="buscar.php" method="get">
                    <input type="text" name="termino" placeholder="Buscar productos...">
                    <button type="submit"><img src="/img/busqueda.png" alt="Buscar"></button>
                </form>
            </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if (isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px; "> ' . $_SESSION['usuario'] . '</a>';
                        if ($_SESSION['rol'] == "admin") {
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px ;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px;">Cerrar sesión</a>';
                        echo '<a href="./carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 5px;">Iniciar Sesión</a>';
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
    <div class="container">
        <h2 class="text-center mb-3">Tu carrito de compra</h2>
        <div>
            <table class=" container table table-striped table-hover">
                <thead class="table table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener medicamentos en la carrito
                    $sql = "SELECT pc.idMedicamento, p.nombre, p.descripcion, p.precio, pc.cantidad, p.imagen, pc.idReceta 
                            FROM medicamentosrecetas pc 
                            JOIN medicamentos p ON pc.idMedicamento = p.idMedicamento 
                            JOIN recetas r ON pc.idReceta = r.idReceta 
                            JOIN usuarios u ON r.nick = u.nick 
                            WHERE u.nick = '$usuario'";

                    $resultado = $conn->query($sql);
                    $medicamentos = [];

                    // Creación de objetos medicamentos a partir de los resultados
                    $numeroMedicamentos = 0;
                    while ($fila = $resultado->fetch_assoc()) {
                        $nuevo_medicamento = new Medicamento(
                            $fila["idMedicamento"],
                            $fila["nombre"],
                            $fila["descripcion"],
                            $fila["precio"],
                            $fila["cantidad"],
                            $fila["imagen"]
                        );
                        $idReceta = $fila["idReceta"];
                        array_push($medicamentos, $nuevo_medicamento);
                        $numeroMedicamentos++;
                    }

                    // Mostrar medicamentos en la tabla
                    foreach ($medicamentos as $medicamento) {
                        echo "<tr>";
                        echo "<td>" . $medicamento->nombre . "</td>";
                        echo "<td>" . $medicamento->precio . "</td>";
                        echo "<td>" . $medicamento->descripcion . "</td>";
                        echo "<td>" . $medicamento->cantidad . "</td>";
                        ?>
                    <td>
                        <img witdh="50" height="100" src="<?php echo $medicamento->imagen ?>">
                    </td>
                    <td>
                        <form method="POST" action="./funciones/eliminarProducto.php">
                        <input type="hidden" name="idMedicamento" value="<?php echo $medicamento->idMedicamento ?>">
                        <input type="hidden" name="precio" value="<?php echo $medicamento->precio ?>">
                        <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Mostrar precio total del carrito -->
            <?php
            $sql = "SELECT precioTotal FROM recetas WHERE nick = '$usuario'";
            $resultado = $conn->query($sql);
            $fila = $resultado->fetch_assoc();
            if ($fila !== null && isset($fila['precioTotal'])) {
                $precioTotal = $fila['precioTotal'];
            } else {
                $precioTotal = 0;
            }

            ?>
         <h4>Total: <?php echo $precioTotal ?>€</h4>

         
         <!-- Tarjeta para mostrar la dirección de envío -->
         <div id="addressCard" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-width: 300px; box-shadow: 0 2px 5px rgba(0,0,0,0.3); <?php echo $precioTotal > 0 ? '' : 'display: none;'; ?>">
            <h3>Dirección de envío</h3>
            <p id="addressText">Por favor, introduce tu dirección de envío.</p>
        </div>
         <?php
         if ($precioTotal > 0) {
             ?>
                <form id ="paymentForm2" method="post" action="/funciones/realizarPedido.php">
                    <input type="hidden" name="precioTotal" value="<?php echo $precioTotal ?>">
                    <input type="hidden" name="idReceta" value="<?php echo $idReceta ?>">
                    <input type="hidden" name="numeroMedicamentos" value="<?php echo $numeroMedicamentos ?>">
                    <button type="submit" class="btn btn-primary btn-small" id="orderButton" style="width: 150px;">Realizar pedido</button>
                    <!-- Agregar botones para editar la dirección de envío y el método de pago -->
                    <button type="button" class="btn btn-primary btn-small" id="editAddressButton" style="width: 200px;">Editar dirección de envío</button>
                    <button type="button" class="btn btn-primary btn-small" id="editPaymentButton" style="width: 150px;">Método de pago</button>
                </form>
                <?php
         } else {
             echo "<p>No puedes realizar un pedido con el carrito vacío.</p>";
         }
         ?>


<!-- Popup para editar la información de pago -->
<div id="paymentPopup" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;"">
    <div style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%;">
        <form id="paymentForm">
            <button type="button" id="closePaymentPopupButton" style="float: right; background: none; border: none; font-size: 20px;">&times;</button>
            <h3>Editar información de pago</h3>
            <label for ="CardName">Nombre en la tarjeta</label>
            <input type="text" id="CardName" name="CardName" required>
            <label for ="CardNumber">Número de tarjeta</label>
            <input type="text" id="CardNumber" name="CardNumber" required>
            <label for ="ExpiryDate">Fecha de caducidad</label>
            <input type="text" id="ExpiryDate" name="ExpiryDate" required>
            <label for ="CVV">CVV</label>
            <input type="text" id="CVV" name="CVV" required>
            <button type="submit" class="btn btn-primary">Guardar información de pago</button>
        </form>
    </div>
</div>

<div id="payPopup" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); align-items: center; justify-content: center;">
    <div style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; text-align: center;">
        <img src="img/compra.png" alt="Descripción de la imagen" style="width: 50px; height: 50px;">
        <h3>Compra realizada con éxito</h3>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('orderButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('payPopup').style.display = 'flex'; // Muestra el popup
        setTimeout(function() {
            document.getElementById('payPopup').style.display = 'none'; // Oculta el popup después de 2 segundos
            document.getElementById('paymentForm2').submit(); // Envía el formulario
        }, 2000);
    });
});
</script>
        
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
                <div class="col-lg-2">
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


     
<!-- Popup para editar la dirección de envío -->
<div id="addressPopup" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;">
    <div style="background-color: #fefefe; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; overflow-y: auto; max-height: 90vh;">
        <form id="addressForm">
            <button type="button" id="closePopupButton" style="float: right; background: none; border: none; font-size: 20px;">&times;</button>
            <h3>Editar dirección de envío</h3>
            <label for ="Nombre">Nombre</label>
            <input type="text" id="Nombre" name="Nombre" required>
            <label for ="Apellidos">Apellidos</label>
            <input type="text" id="Apellidos" name="Apellidos" required>
            <label for = "Direccion">Dirección</label>
            <input type="text" id="Direccion" name="Direccion" required>
            <label for = "Ciudad">Ciudad</label>
            <input type="text" id="Ciudad" name="Ciudad" required>
            <label for = "CodigoPostal">Código Postal</label>
            <input type="text" id="CodigoPostal" name="CodigoPostal" required>
            <button type="submit" class="btn btn-primary">Guardar Dirección</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
      // Obtenemos el popup y el botón
    var popup = document.getElementById('addressPopup');
    var button = document.getElementById('editAddressButton');

    // Nos aseguramos de que el popup esté oculto al cargar la página
    popup.style.display = 'none';

    // Mostramo el popup cuando se hace clic en el botón "Editar dirección de envío"
    button.addEventListener('click', function() {
        popup.style.display = 'flex';
    });

    // Ocultar el popup cuando se hace clic en el botón de cierre
    document.getElementById('closePopupButton').addEventListener('click', function() {
        popup.style.display = 'none';
    });

    // Guardar los datos de la dirección en el almacenamiento local y actualizar la tarjeta de dirección cuando se envía el formulario
    document.getElementById('addressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var nombre = document.getElementById('Nombre').value;
    var apellidos = document.getElementById('Apellidos').value;
    var direccion = document.getElementById('Direccion').value;
    var ciudad = document.getElementById('Ciudad').value;
    var codigo = document.getElementById('CodigoPostal').value;
    var addressText = 'Nombre: ' + nombre + '<br>Apellidos: ' + apellidos + '<br>Dirección: ' + direccion + '<br>Ciudad: ' + ciudad + '<br>Código Postal: ' + codigo;
    document.getElementById('addressText').innerHTML = addressText;
    document.getElementById('addressPopup').style.display = 'none';
});
});
</script>
    
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtén los popups y los botones
    var paymentPopup = document.getElementById('paymentPopup');
    var editPaymentButton = document.getElementById('editPaymentButton');

    // Nos aseguramos de que los popups estén ocultos al cargar la página
  
    paymentPopup.style.display = 'none';

    // Mostrar el popup de método de pago cuando se hace clic en el botón "Método de pago"
    editPaymentButton.addEventListener('click', function() {
        paymentPopup.style.display = 'flex';
    });

    // Ocultar los popups cuando se hace clic en los botones de cierre
 
    document.getElementById('closePaymentPopupButton').addEventListener('click', function() {
        paymentPopup.style.display = 'none';
    });


       // Agregar un guión después de cada bloque de 4 dígitos en el número de la tarjeta
    document.getElementById('CardNumber').addEventListener('input', function(e) {
        // Limitar la longitud de la entrada a 19 caracteres (16 dígitos y 3 guiones)
        if (e.target.value.length > 19) {
            e.target.value = e.target.value.slice(0, 19);
        } else {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1-').trim();
            // Eliminar el último guión si la longitud de la entrada es 19
            if (e.target.value.length === 19) {
                e.target.value = e.target.value.slice(0, -1);
            }
        }
    });
        // Limitar la longitud de la entrada a 5 caracteres (2 dígitos, 1 '/', y 2 dígitos)
    document.getElementById('ExpiryDate').addEventListener('input', function(e) {
        if (e.target.value.length > 5) {
            e.target.value = e.target.value.slice(0, 5);
        } else {
            e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{2})/, '$1/').trim();
        }
    });
        // Limitar la longitud de la entrada de CVV a 3 caracteres
    document.getElementById('CVV').addEventListener('input', function(e) {
        if (e.target.value.length > 3) {
            e.target.value = e.target.value.slice(0, 3);
        }
    });

     // Guardar los datos de pago en el almacenamiento local y actualizar la tarjeta de pago cuando se envía el formulario
     document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var cardName = document.getElementById('CardName').value;
        var cardNumber = document.getElementById('CardNumber').value;
        var expiryDate = document.getElementById('ExpiryDate').value;
        var cvv = document.getElementById('CVV').value;
        document.getElementById('paymentPopup').style.display = 'none';

        // Guardar los datos de pago en el almacenamiento local
        localStorage.setItem('cardName', cardName);
        localStorage.setItem('cardNumber', cardNumber);
        localStorage.setItem('expiryDate', expiryDate);
        localStorage.setItem('cvv', cvv);
    });
});


</script>
</body>
</html>