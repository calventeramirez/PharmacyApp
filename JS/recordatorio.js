document.addEventListener('DOMContentLoaded', (event) => {
  document.getElementById('si').addEventListener('click', function() {
    document.getElementById('popup2').style.display = 'flex';
    document.getElementById('recordatorio').style.display = 'none'; // Oculta el popup de recordatorio
  });
  
  document.getElementById('no').addEventListener('click', function() {
    document.getElementById('popup3').style.display = 'flex';
    document.getElementById('recordatorio').style.display = 'none';
  });

  var cerrarPopups = document.getElementsByClassName('cerrar-popup');

  for (var i = 0; i < cerrarPopups.length; i++) {
    cerrarPopups[i].addEventListener('click', function() {
      this.parentElement.style.display = 'none'; // Oculta el contenido del popup
      this.parentElement.parentElement.style.display = 'none'; // Oculta todo el popup
      if (this.parentElement.parentElement.id === 'popup3') {
        mostrarRecordatorio();
      }
    });
  }

  // Función para mostrar el popup de recordatorio después de 5 segundos
  function mostrarRecordatorio() {
    setTimeout(function() {
      document.getElementById('recordatorio').style.display = 'flex';
    }, 5000);
  }

  mostrarRecordatorio();
});