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
    $piano_id = $_POST['numeroPiano'];
    $ricetta_id = $_POST['ricetta'];
    $giorno = $_POST['giorno'];
    $tipo_pasto = $_POST['tipoPasto'];

    // Verifica se la ricetta è già presente per lo stesso giorno nello stesso piano
    $query_verifica = "SELECT COUNT(*) AS num_rows FROM Partecipazioni WHERE PianoAlimentare = $piano_id AND Ricetta = $ricetta_id AND Giorno = $giorno AND Utente = '$username'";
    $result_verifica = mysqli_query($conn, $query_verifica);

    if ($result_verifica) {
        $row_verifica = mysqli_fetch_assoc($result_verifica);
        if ($row_verifica['num_rows'] > 0) {
            // Ricetta già presente per lo stesso giorno nello stesso piano
            echo "Attenzione: Questa ricetta è già stata aggiunta per il giorno $giorno in questo piano alimentare.";
            exit;
        } else {
            // Inserimento nella tabella Partecipazioni
            $query = "INSERT INTO Partecipazioni (Ricetta, PianoAlimentare, Utente, TipoPasto, Giorno) VALUES ($ricetta_id, $piano_id, '$username', '$tipo_pasto', $giorno)";
            $result = mysqli_query($conn, $query);
            if ($result) {
                // Redirect a view_piano.php con il piano_id
                header("Location: piani_alimentari.php");
                exit;
            } else {
                echo "Errore nell'aggiunta della ricetta: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Errore nella verifica della ricetta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
