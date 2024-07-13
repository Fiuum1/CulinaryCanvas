<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

// Connessione al database
require 'includes/conn_db.php'; 

// Ottiene la nuova email dall'input del form
$new_email = $_POST['new_email'];
$username = $_SESSION['username'];

// Aggiorna l'email nel database
$query_update_email = "UPDATE Utenti SET e_mail = '$new_email' WHERE username = '$username'";
if (mysqli_query($conn, $query_update_email)) {
    $_SESSION['success_message'] = "Email aggiornata con successo!";
} else {
    $_SESSION['error_message'] = "Errore durante l'aggiornamento dell'email: " . mysqli_error($conn);
}

mysqli_close($conn);

// Reindirizza alla pagina del profilo
header("Location: profile.php");
exit();
?>
