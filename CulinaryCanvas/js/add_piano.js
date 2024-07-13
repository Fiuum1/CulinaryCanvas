function validateForm() {
    var today = new Date();
    var dataInizio = new Date(document.getElementById("data_inizio").value);
    var dataFine = new Date(document.getElementById("data_fine").value);

    // Controllo se la data di inizio è successiva a quella odierna
    if (dataInizio <= today) {
        alert("La data di inizio deve essere successiva alla data odierna.");
        return false; // Impedisce l'invio del modulo se la validazione fallisce
    }

    // Controllo se la data di fine è successiva alla data di inizio
    if (dataFine <= dataInizio) {
        alert("La data di fine deve essere successiva alla data di inizio.");
        return false; // Impedisce l'invio del modulo se la validazione fallisce
    }

    return true; // Consente l'invio del modulo se la validazione è superata
}

function showErrorMessage(message) {
    alert(message);
}