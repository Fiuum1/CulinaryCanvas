<?php
session_start();
require 'includes/conn_db.php';

$id_ricetta = $_POST['id_ricetta'];
// Verifica se l'utente è loggato, altrimenti redirect a login.php
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

$utente = $_SESSION['username'];

// Ottieni gli ingredienti della ricetta con relative quantità e unità di misura dalla tabella Composizioni
$query_ingredienti = "SELECT Ingrediente, QuantitàIngrediente, UnitàMisura FROM Composizioni WHERE Ricetta = $id_ricetta";
$result_ingredienti = mysqli_query($conn, $query_ingredienti);

// Inserisci gli ingredienti nella lista della spesa dell'utente
while ($row = mysqli_fetch_assoc($result_ingredienti)) {
    $nome_ingrediente = $row['Ingrediente'];
    $quantità_ingrediente = $row['QuantitàIngrediente'];
    $unità_misura = $row['UnitàMisura'];

    // Verifica se l'ingrediente è già presente nella lista della spesa dell'utente
    $query_check = "SELECT COUNT(*) AS num FROM Inclusioni WHERE Utente = '$utente' AND Ingrediente = '$nome_ingrediente'";
    $result_check = mysqli_query($conn, $query_check);
    $row_check = mysqli_fetch_assoc($result_check);
    $num_ingrediente = $row_check['num'];

    if ($num_ingrediente > 0) {
        // Se l'ingrediente è già presente, aggiorna la quantità nella lista della spesa
        $query_update = "UPDATE Liste_della_spesa SET QuantitàIngrediente = QuantitàIngrediente + $quantità_ingrediente WHERE Utente = '$utente' AND Ingrediente = '$nome_ingrediente'";
        mysqli_query($conn, $query_update);
    } else {
        // Altrimenti, inserisci l'ingrediente nella lista della spesa
        $query_insert_lista = "INSERT INTO Inclusioni (Utente, Ingrediente, QuantitàIngrediente, UnitàMisura) VALUES ('$utente', '$nome_ingrediente', $quantità_ingrediente, '$unità_misura')";
        mysqli_query($conn, $query_insert_lista);
    }
}

// Redirect alla pagina della ricetta
header("Location: lista_spesa.php");
exit();
?>
