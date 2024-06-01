document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('editPaymentButton').addEventListener('click', function () {
        document.getElementById('paymentPopup').style.display = 'block';
    });

    document.getElementById('NumeroTarjeta').addEventListener('input', function (e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;

        // Limitar la entrada a solo 16 dígitos
        if (target.value.replace(/[^\d]/g, '').length > 16) {
            target.value = target.value.slice(0, -1);
            return;
        }

        target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1-').trim();

        if (position !== length && (position + 1) % 5 === 0)
            position++;

        // Si la longitud del valor es 19 o el valor termina con un guión y la longitud de los dígitos es 16, se elimina el último guión
        if (target.value.length === 19 || (target.value.endsWith('-') && target.value.replace(/[^\d]/g, '').length === 16)) {
            target.value = target.value.slice(0, -1);
        }

        target.setSelectionRange(position, position);
    });
});

document.getElementById('FechaCaducidad').addEventListener('input', function (e) {
    var target = e.target, position = target.selectionEnd, length = target.value.length;

    // Limitar la entrada a solo 4 dígitos
    if (target.value.replace(/[^\d]/g, '').length > 6) {
        target.value = target.value.slice(0, -1);
        return;
    }

    target.value = target.value.replace(/[^\d]/g, '').replace(/(.{2})/, '$1/').trim();

    if (position !== length && (position + 1) % 3 === 0)
        position++;

    // Si la longitud del valor es 6 o el valor termina con una barra y la longitud de los dígitos es 5, se elimina la última barra
    if (target.value.length === 6 || (target.value.endsWith('/') && target.value.replace(/[^\d]/g, '').length === 4)) {
        target.value = target.value.slice(0, -1);
    }

    target.setSelectionRange(position, position);
});

document.getElementById('CVV').addEventListener('input', function (e) {
    var target = e.target;

    // Limitar la entrada a solo 3 dígitos
    if (target.value.replace(/[^\d]/g, '').length > 3) {
        target.value = target.value.slice(0, -1);
    }
});

document.querySelector('form').addEventListener('submit', function (e) {
    // Prevenir el comportamiento predeterminado del botón
    e.preventDefault();

    // Obtener los datos del formulario
    var nombreTarjeta = document.getElementById('NombreTarjeta').value;
    var numeroTarjeta = document.getElementById('NumeroTarjeta').value;
    var fechaCaducidad = document.getElementById('FechaCaducidad').value;
    var cvv = document.getElementById('CVV').value;

    // Crear un objeto con los datos de la tarjeta
    var datosTarjeta = {
        nombreTarjeta: nombreTarjeta,
        numeroTarjeta: numeroTarjeta,
        fechaCaducidad: fechaCaducidad,
        cvv: cvv
    };

    // Convertir el objeto a una cadena JSON
    var datosTarjetaJSON = JSON.stringify(datosTarjeta);

    // Guardar los datos de la tarjeta en el almacenamiento local
    localStorage.setItem('datosTarjeta', datosTarjetaJSON);

    // Limpiar solo los campos de la tarjeta
    document.getElementById('NombreTarjeta').value = '';
    document.getElementById('NumeroTarjeta').value = '';
    document.getElementById('FechaCaducidad').value = '';
    document.getElementById('CVV').value = '';

    // Cerrar el popup después de guardar los datos
    document.getElementById('paymentPopup').style.display = 'none';
});