function addIngredientField() {
    var container = document.getElementById('ingredientContainer');
    var newField = document.createElement('div');
    newField.classList.add('ingredient-fields');
    newField.innerHTML = '<input type="text" name="ingredienti[]" placeholder="Nome ingrediente" required> ' +
                        '<input type="number" step="0.01" name="quantita[]" placeholder="Quantità" required> ' +
                        '<input type="text" name="unita[]" placeholder="Unità di misura" required> ' +
                        '<input type="text" name="categorie[]" placeholder="Categoria" required> ' +
                        '<button type="button" class="remove-button" onclick="removeIngredientField(this)">Rimuovi</button>';
    container.appendChild(newField);
}

function removeIngredientField(element) {
    if (document.getElementsByClassName('ingredient-fields').length > 1) {
        element.parentNode.remove();
    }
}

function updateCharacterCount() {
    var textarea = document.getElementById('testo');
    var charCount = document.getElementById('charCount');
    var currentLength = textarea.value.length;
    charCount.textContent = currentLength + '/2000 caratteri';
}