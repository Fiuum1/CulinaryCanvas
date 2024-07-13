<?php                                      
session_start();

if (!isset($_SESSION['username'])) {
    // Se l'utente non è loggato, reindirizzalo alla pagina di login
    header("Location: auth/login.php");
    exit;
}

require 'includes/conn_db.php';

// Recupera i dati dal modulo
$numero_piano = $_POST['numero_piano'];
$data_inizio = $_POST['data_inizio'];
$data_fine = $_POST['data_fine'];
$username = $_SESSION['username'];

// Query di selezione per verificare l'esistenza di un piano con lo stesso numeroPiano
$select_query = "SELECT * FROM Piani_alimentari WHERE NumeroPiano = $numero_piano AND Utente = '$username'";
$result_select = mysqli_query($conn, $select_query);

if (mysqli_num_rows($result_select) > 0) {
    // Se esiste già un piano con lo stesso numeroPiano per questo utente
    $_SESSION['error_message'] = "Esiste già un piano alimentare con il numero $numero_piano per l'utente $username.";
    header("Location: add_piano.php");
    exit;
} else {
    // Query di inserimento
    $insert_query = "INSERT INTO Piani_alimentari (NumeroPiano, Utente, Data_inizio, Data_fine) VALUES ($numero_piano, '$username', '$data_inizio', '$data_fine')";
    $result_insert = mysqli_query($conn, $insert_query);

    if ($result_insert) {
        // Reindirizza alla pagina dei piani alimentari dopo il successo
        header("Location: piani_alimentari.php");
        exit;
    } else {
        echo "Errore durante l'inserimento del piano alimentare: " . mysqli_error($conn);
    }
}

$conn->close();
?>
