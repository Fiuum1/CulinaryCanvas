<?php
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "CulinaryCanvas";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connessione al DB fallita: " . mysqli_connect_error());
    }
    // echo "Connessione riuscita <br>";
?>
