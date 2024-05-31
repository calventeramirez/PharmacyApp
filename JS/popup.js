
window.onload = function() {

// Obtiene el popup
var popup = document.getElementById("popup");

// Obtiene el botón que abre el popup
var btn = document.getElementById("editButton");

// Obtiene el elemento <span> que cierra el popup
var span = document.getElementById("close");

// Cuando el usuario hace clic en el botón, abre el popup 
btn.onclick = function(event) {
    event.stopPropagation();
    popup.style.display = "block";
  }

// Cuando el usuario hace clic en <span> (x), cierra el popup
span.onclick = function() {
  popup.style.display = "none";
}

// Cuando el usuario hace clic en cualquier lugar fuera del contenido del popup, lo cierra
window.onclick = function(event) {
    if (event.target == popup) {
      if(event.target != document.getElementsByClassName('popup-content')[0] && !document.getElementsByClassName('popup-content')[0].contains(event.target)) {
        popup.style.display = "none";
      }
    }
  }
} 