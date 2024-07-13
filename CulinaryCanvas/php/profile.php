<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

// Connessione al database
require 'includes/conn_db.php'; 

// Ottieni informazioni sull'utente
$username = $_SESSION['username'];
$query_user_info = "SELECT Nome, Cognome, ImmagineProfilo, e_mail FROM Utenti WHERE username = '$username'";
$result_user_info = mysqli_query($conn, $query_user_info);
$user_info = $result_user_info->fetch_assoc();

// Ottieni ricette pubblicate dall'utente
$query_ricette = "SELECT ID_Ricetta, Titolo FROM Ricette WHERE Utente = '$username'";
$result_ricette = mysqli_query($conn, $query_ricette);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente</title>
    <link rel="stylesheet" href="css/profile.css"> <!-- Assicurati di collegare il tuo foglio di stile per il profilo -->
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
            <div class="user-info">
                <a href="#"><img src="<?php echo $user_info['ImmagineProfilo']; ?>" class="user-avatar" alt="Immagine Profilo"></a>
                <span class="username"><?php echo $_SESSION['username']; ?></span>
                <a href="auth/logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <main>
        <section class="user-profile">
            <h2>Profilo Utente</h2>
            <div class="profile-info">
                <div class="profile-picture">
                    <img src="<?php echo $user_info['ImmagineProfilo']; ?>" alt="Immagine Profilo">
                </div>
                <div class="profile-details">
                    <h3><?php echo $user_info['Nome'] . ' ' . $user_info['Cognome']; ?></h3>
                    <p>Username: <?php echo $_SESSION['username']; ?></p>
                    <p>Email: <?php echo $user_info['e_mail']; ?></p>
                </div>
                <!-- Form per aggiornare l'email -->
                <form action="update_email.php" method="post">
                    <label for="new_email">Nuova Email:</label>
                    <input type="email" id="new_email" name="new_email" required>
                    <button type="submit">Aggiorna Email</button>
                </form>
            </div>
        </section>

        <section class="user-recipes">
            <h2>Ricette Pubblicate</h2>
            <div class="recipes-list">
                <?php
                // Mostra tutte le ricette pubblicate dall'utente
                while ($row = $result_ricette->fetch_assoc()) {
                    echo "<div class='recipe'>";
                    echo "<h3><a href='ricetta.php?id=" . $row['ID_Ricetta'] . "'>" . $row['Titolo'] . "</a></h3>";
                    echo "<form action='delete_ricetta.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='id_ricetta' value='" . $row['ID_Ricetta'] . "'>";
                    echo "<button type='submit' class='delete-btn'>Rimuovi</button>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
