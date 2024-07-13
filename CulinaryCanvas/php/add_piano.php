<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Piano Alimentare - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/add_piano.css">
    <script src="js/add_piano.js"></script>
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

    <main class="add-plan-container">
        <form class="add-plan-form" id="addPlanForm" action="process_add_piano.php" method="POST" onsubmit="return validateForm()">
            <h2>Aggiungi un nuovo piano alimentare</h2>

            <?php
            // Mostra il messaggio di errore se presente
            $error_message = $_SESSION['error_message'];
            if (!empty($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>

            <label for="numero_piano">Numero Piano:</label>
            <input type="number" id="numero_piano" name="numero_piano" min="1" required>

            <label for="data_inizio">Data Inizio:</label>
            <input type="date" id="data_inizio" name="data_inizio" required>

            <label for="data_fine">Data Fine:</label>
            <input type="date" id="data_fine" name="data_fine" required>

            <button type="submit" class="submit-button">Aggiungi Piano</button>
        </form>
    </main>
</body>
</html>
