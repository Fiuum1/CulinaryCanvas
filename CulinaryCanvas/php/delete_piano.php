<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

// Connessione al database
require 'includes/conn_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Ottieni l'ID della ricetta da eliminare
    $numeroPiano = $_GET['numeroPiano'];

    // Elimina la ricetta dal database
    $query_delete = "DELETE FROM Piani_alimentari WHERE NumeroPiano = $numeroPiano";
    mysqli_query($conn, $query_delete);
    
    header("Location:piani_alimentari.php");
}
$conn->close();
?>
