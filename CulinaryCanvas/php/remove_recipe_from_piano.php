<?php
session_start();
require 'includes/conn_db.php';

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit;
}

$username = $_SESSION['username'];

// Se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $piano_id = $_POST['piano_id'];
    $ricetta_id = $_POST['ricetta_id'];
    $giorno = $_POST['giorno'];

    // Query per eliminare l'entrata dalla tabella Partecipazioni
    $query = "DELETE FROM Partecipazioni 
              WHERE Ricetta = $ricetta_id 
              AND PianoAlimentare = $piano_id 
              AND Utente = '$username' 
              AND Giorno = $giorno";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect a view_piano.php con il piano_id
        header("Location: view_piano.php?numeroPiano=" . $piano_id);
        exit;
    } else {
        echo "Errore nella rimozione della ricetta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
