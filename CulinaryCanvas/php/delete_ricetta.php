<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

// Connessione al database
require 'includes/conn_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ottieni l'ID della ricetta da eliminare
    $id_ricetta = $_POST['id_ricetta'];

    // Elimina la ricetta dal database
    $query_delete = "DELETE FROM Ricette WHERE ID_Ricetta = $id_ricetta";
    mysqli_query($conn, $query_delete);
    
    header("Location: profile.php");
}
$conn->close();
?>
