<?php
session_start();

// Verifica se l'utente è loggato, altrimenti redirect a login.php
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

require "includes/conn_db.php";

// Verifica se l'ingrediente è stato specificato e che sia una richiesta POST
if (isset($_POST['ingrediente'])) {
    $ingrediente = $_POST['ingrediente'];
    
    // Prepara la query per rimuovere l'ingrediente dalla lista della spesa dell'utente loggato
    $username = $_SESSION['username'];
    $sql = "DELETE FROM Inclusioni WHERE Utente = '$username' AND Ingrediente = '$ingrediente'";

    if ($conn->query($sql) === TRUE) {
        header("Location: lista_spesa.php");
        exit();
    } else {
        echo "Errore durante la rimozione dell'ingrediente: " . $conn->error;
    }
} else {
    echo "Nessun ingrediente specificato per la rimozione.";
}

$conn->close();
?>
