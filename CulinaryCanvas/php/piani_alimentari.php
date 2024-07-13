<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piani Alimentari - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/piani_alimentari.css">
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
                header("Location: auth/login.php");
                exit();
            }
            ?>
        </div>
    </header>

    <main>
        <section id="meal-plans" class="section">
            <h2>I tuoi Piani Alimentari</h2>
            <?php
            require 'includes/conn_db.php'; 
            $username = $_SESSION['username'];
            $query = "SELECT NumeroPiano, DATE_FORMAT(Data_inizio, '%d/%m/%Y') AS Data_inizio, DATE_FORMAT(Data_fine, '%d/%m/%Y') AS Data_fine FROM Piani_alimentari WHERE Utente = '$username'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Errore nella query: " . mysqli_error($conn);
                exit();
            }

            if (mysqli_num_rows($result) > 0) {
                echo "<ul class='meal-plans-list'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $numeroPiano = $row['NumeroPiano'];
                    $dataInizio = $row['Data_inizio'];
                    $dataFine = $row['Data_fine'];

                    echo "<li class='meal-plan'>";
                    echo "<h3>Piano #$numeroPiano</h3>";
                    echo "<p>Data inizio: $dataInizio</p>";
                    echo "<p>Data fine: $dataFine</p>";
                    echo "<a href='view_piano.php?numeroPiano=$numeroPiano' class='view-plan-btn'>Vedi Piano</a>";
                    echo " <a href='delete_piano.php?numeroPiano=$numeroPiano' class='delete-plan-btn'>Elimina Piano</a>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Non hai ancora creato nessun piano alimentare.</p>";
            }

            mysqli_close($conn);
            ?>
            <button onclick="window.location='add_piano.php';" class="create-plan-btn">Crea Nuovo Piano Alimentare</button>
        </section>
    </main>
</body>
</html>
