<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricette - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/ricette.css">
</head>
<body>
    <header class="header">
        <h1 onclick="window.location = './';">CulinaryCanvas</h1>
        <div class="expanding-bar"></div>
        <nav>
            <ul>
                <li><a href="ricette.php">Ricette</a></li>
                <li><a href="piani_alimentari.php">Piani alimentari</a></li>
                <li><a href="lista_spesa.php">Lista della spesa</a></li>
                <li><a href="ricerca_avanzata.php">Ricerca avanzata</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo "<div class='user-info'>";
                echo "<a href='profile.php'><img src='{$_SESSION['ImmagineProfilo']}' class='user-avatar' alt='Immagine Profilo'></a>";
                echo "<span class='username'>{$_SESSION['username']}</span>";
                echo "<a href='auth/logout.php' class='logout-btn'>Logout</a>";
                echo "</div>";
            } else {
                echo "<button class='login-btn' onclick=\"window.location.href = 'auth/login.php';\">Login</button>";
                echo "<button class='register-btn' onclick=\"window.location.href = 'auth/register.php';\">Register</button>";
            }
            ?>
        </div>
    </header>

<main>
    <?php
    require 'includes/conn_db.php';

    // Pulsante per aggiungere una nuova ricetta (visibile solo agli utenti loggati)
    if (isset($_SESSION['username'])) {
        echo "<div class='add-recipe-button'>";
        echo "<button onclick=\"window.location='add_ricetta.php';\">Aggiungi una nuova ricetta</button>";
        echo "</div>";
    }
    // Query per ottenere le ricette
    $query = "SELECT ID_Ricetta, Titolo, Immagine, Difficoltà, TempoPreparazione, TempoCottura, Porzioni, Utente FROM Ricette ORDER BY ID_Ricetta ASC";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            echo "<div class='ricetta' onclick=\"window.location='ricetta.php?id=" . $row['ID_Ricetta'] . "'\">";
            echo '<h2 style="color:#2980b9;">"' . $row['Titolo'] . '" di ' . $row['Utente'] . '</h2>';
            echo "<img src='" . $row['Immagine'] . "' alt='Foto della ricetta' class='foto-ricetta' style='width:100%; height:auto; margin:10px 0;'/>";
            echo "<div class='details'>";
            switch($row['Difficoltà']){
                case 1:
                    $diff = 'Media';
                    break;
                case 2:
                    $diff = 'Difficile';
                    break;
                default:
                    $diff = 'Facile';
            }
            echo "<span class='difficolta'>Difficoltà: " . $diff . "</span>";
            echo "<span class='tempo-preparazione'>Preparazione: " . $row['TempoPreparazione'] . " min</span>";
            echo "<span class='tempo-cottura'>Cottura: " . $row['TempoCottura'] . " min</span>";
            echo "<span class='porzioni'>" . $row['Porzioni'] . " porzioni</span>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Nessuna ricetta trovata.";
    }
    ?>
</main>




</body>
</html>
