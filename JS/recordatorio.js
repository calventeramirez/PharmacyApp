document.addEventListener('DOMContentLoaded', (event) => {
    let contador = 5; // 5 segundos
  
    function iniciarContador() {
      let intervalo = setInterval(function() {
        contador--;
        let horas = Math.floor(contador / 3600);
        let minutos = Math.floor((contador % 3600) / 60);
        let segundos = contador % 60;
        //document.getElementById('contador').textContent = `${horas}:${minutos}:${segundos}`;
  
        // Cuando el contador llega a cero, muestra el popup
        if (contador <= 0) {
          clearInterval(intervalo);
          document.getElementById('recordatorio').style.display = 'block';
        }
      }, 1000);
    }
  

    function manejarConfirmacion() {
        if (document.getElementById('confirmacion').checked) {
          document.getElementById('recordatorio').style.display = 'none';
          document.getElementById('popup2').style.display = 'block';
          contador = 5; // Reinicia el contador
          iniciarContador(); // Reinicia la cuenta atrás para el proximo recordatorio
        } else if (document.getElementById('negacion').checked) {
          document.getElementById('recordatorio').style.display = 'none';
          document.getElementById('popup3').style.display = 'block';
        }
      }
      
      function cerrarPopup() {
        this.parentElement.style.display = 'none';
      }
      
      let botonesCerrar = document.getElementsByClassName('cerrar-popup');
      for (let i = 0; i < botonesCerrar.length; i++) {
        botonesCerrar[i].addEventListener('click', cerrarPopup);
      }
  
  
    document.getElementById('confirmar').addEventListener('click', manejarConfirmacion);

    iniciarContador();
  });