document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('editPaymentButton').addEventListener('click', function() {
        document.getElementById('paymentPopup').style.display = 'block';
    });
    
    document.getElementById('closePayment').addEventListener('click', function() {
        document.getElementById('paymentPopup').style.display = 'none';
    });
    
    document.querySelector('form button[type="submit"]').addEventListener('click', function(e) {
        // Prevenir el comportamiento predeterminado del botón
        e.preventDefault();
    });
    
    document.getElementById('NumeroTarjeta').addEventListener('input', function (e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;
        
        // Limitar la entrada a solo 16 dígitos
        if (target.value.replace(/[^\d]/g, '').length > 16) {
            target.value = target.value.slice(0, -1);
            return;
        }
        
        target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1-').trim();
        
        if(position !== length && (position+1) % 5 === 0)
            position++;
    
        // Si la longitud del valor es 19 o el valor termina con un guión y la longitud de los dígitos es 16, se elimina el último guión
        if(target.value.length === 19 || (target.value.endsWith('-') && target.value.replace(/[^\d]/g, '').length === 16)) {
            target.value = target.value.slice(0, -1);
        }
    
        target.setSelectionRange(position, position);
    });
    
    document.getElementById('FechaCaducidad').addEventListener('input', function (e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;
        
        // Limitar la entrada a solo 4 dígitos
        if (target.value.replace(/[^\d]/g, '').length > 6) {
            target.value = target.value.slice(0, -1);
            return;
        }
        
        target.value = target.value.replace(/[^\d]/g, '').replace(/(.{2})/, '$1/').trim();
        
        if(position !== length && (position+1) % 3 === 0)
            position++;
    
        // Si la longitud del valor es 6 o el valor termina con una barra y la longitud de los dígitos es 5, se elimina la última barra
        if(target.value.length === 6 || (target.value.endsWith('/') && target.value.replace(/[^\d]/g, '').length === 4)) {
            target.value = target.value.slice(0, -1);
        }
    
        target.setSelectionRange(position, position);
    });
    
});