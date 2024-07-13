// Funzione per aggiungere un nuovo campo di selezione degli ingredienti
function addIngredient() {
    // Clona il primo elemento .ingredient-select
    var original = document.querySelector('.ingredient-select');
    var clone = original.cloneNode(true);

    // Aggiunge un pulsante per rimuovere l'ingrediente
    var removeButton = document.createElement('button');
    removeButton.textContent = 'Rimuovi';
    removeButton.type = 'rmv-button';
    removeButton.classList.add('remove-ingredient-btn'); // Aggiungo manualmente la classe remove-ingredient-btn
    removeButton.onclick = function() {
        clone.remove(); // Rimuove l'elemento clonato quando il pulsante Rimuovi viene cliccato
    };
    clone.appendChild(removeButton); //Per aggiungere il pulsante di Remove all'ingrediento (lo aggiungo come figlio del clone)

    // Aggiunge il clone al container
    document.getElementById('ingredient-container').appendChild(clone);
}



//Funzione per il redirect a ricetta.php?id=id_ricetta
document.addEventListener('DOMContentLoaded', function() {
    // Seleziona tutti gli elementi con classe 'ricetta' all'interno della sezione dei risultati
    var ricette = document.querySelectorAll('#results-section .ricetta');

    // Aggiungi un event listener per il click su ogni elemento 'ricetta'
    ricette.forEach(function(ricetta) {
        ricetta.addEventListener('click', function() {
            // Trova l'elemento 'a' con href contenente 'ricetta.php?id=' e ottieni il valore dell'id della ricetta
            var idRicetta = this.querySelector('a[href*="ricetta.php?id="]').getAttribute('href').split('=')[1];
            
            // Reindirizza alla pagina della ricetta
            window.location.href = 'ricetta.php?id=' + idRicetta;
        });
    });
});

