// API URL
const apiURL = '/JS/PharmacyAppAPI.json';

// Function to shuffle an array
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Event to run when the document is loaded
document.addEventListener('DOMContentLoaded', (event) => {
    const productosContainer = document.getElementById('productos');
    // Fetch the API
    fetch(apiURL)
        .then(response => response.json())
        .then(data => {
            // Shuffle the list of medicines
            const shuffledMedicamentos = shuffle(data.medicamentos);
            // Get the first 5 medicines
            const selectedMedicamentos = shuffledMedicamentos.slice(0, 5);
            // Run the list of selected medicines
            selectedMedicamentos.forEach(medicamento => {
                // Format the price to euros
                let precioEnEuros = medicamento.precio.toLocaleString('es-ES', { style: 'currency', currency: 'EUR' })
                // Create each card for the medicine
                const card = `
    <div class="card">
        <img src="${medicamento.imagen}" alt="${medicamento.nombre}">
        <h2>${medicamento.nombre}</h2>
        <p>${medicamento.descripcion}</p>
        <p>Precio: ${precioEnEuros}</p>
        <button class="add-to-cart">
            <img src="/img/anadir-al-carrito.png" alt="Añadir al carrito" style="width: 20px; height: 20px; margin-right: 5px">
            Añadir
        </button>
    </div>
`;
                // Add the card to the container
                productosContainer.innerHTML += card;
            });
        })
        .catch(error => console.error('Error:', error));
});