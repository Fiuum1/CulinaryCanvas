<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Piano - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/view_piano.css">
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
        <section id="view-meal-plan" class="section">
            <?php
            require 'includes/conn_db.php';

            if (isset($_GET['numeroPiano'])) {
                $numeroPiano = $_GET['numeroPiano'];
                $username = $_SESSION['username'];

                // Query per ottenere le informazioni del piano alimentare
                $queryPiano = "SELECT NumeroPiano, Data_inizio, Data_fine
                               FROM Piani_alimentari 
                               WHERE NumeroPiano = '$numeroPiano' AND Utente = '$username'";
                $resultPiano = mysqli_query($conn, $queryPiano);

                if ($resultPiano && mysqli_num_rows($resultPiano) > 0) {
                    $piano = mysqli_fetch_assoc($resultPiano);
                    $dataInizio = new DateTime($piano['Data_inizio']);
                    $dataFine = new DateTime($piano['Data_fine']);
                    
                    // Calcolare il numero di giorni tra le date di inizio e fine
                    $interval = $dataInizio->diff($dataFine);
                    $numeroGiorni = $interval->days + 1; // includi anche l'ultimo giorno

                    echo "<h2>Piano Alimentare #{$piano['NumeroPiano']}</h2>";
                    echo "<p>Data inizio: {$dataInizio->format('d/m/Y')}</p>";
                    echo "<p>Data fine: {$dataFine->format('d/m/Y')}</p>";

                    // Query per ottenere le ricette associate al piano alimentare
                    $queryRicette = "SELECT R.ID_Ricetta, R.Titolo, R.Immagine, P.TipoPasto, P.Giorno 
                                     FROM Partecipazioni P
                                     JOIN Ricette R ON P.Ricetta = R.ID_Ricetta
                                     WHERE P.PianoAlimentare = '$numeroPiano' AND P.Utente = '$username'
                                     ORDER BY P.Giorno, FIELD(P.TipoPasto, 'Colazione', 'Pranzo', 'Snack', 'Cena', 'Dessert')";
                    $resultRicette = mysqli_query($conn, $queryRicette);

                    if ($resultRicette && mysqli_num_rows($resultRicette) > 0) {
                        $piani = [];
                        while ($row = mysqli_fetch_assoc($resultRicette)) {
                            $piani[$row['Giorno']][] = $row;
                        }

                        echo "<ul class='day-list'>";
                        foreach ($piani as $giorno => $ricette) {
                            echo "<li class='day-item'>";
                            echo "<h3>Giorno $giorno</h3>";
                            echo "<ul class='meal-list'>";
                            foreach ($ricette as $ricetta) {
                                echo "<li class='meal-item'>";
                                echo "<h4>{$ricetta['TipoPasto']}: <a href='ricetta.php?id={$ricetta['ID_Ricetta']}'>{$ricetta['Titolo']}</a></h4>";
                                echo "<div class='recipe-image-container'>";
                                echo "<a href='ricetta.php?id={$ricetta['ID_Ricetta']}'><img src='{$ricetta['Immagine']}' class='recipe-image' alt='Immagine Ricetta'></a>";
                                echo "</div>";
                                
                                // Form per rimuovere la ricetta dal piano alimentare
                                echo "<form method='POST' action='remove_recipe_from_piano.php'>";
                                echo "<input type='hidden' name='piano_id' value='$numeroPiano'>";
                                echo "<input type='hidden' name='giorno' value=$giorno>";
                                echo "<input type='hidden' name='ricetta_id' value='{$ricetta['ID_Ricetta']}'>";
                                echo "<button type='submit' class='remove-recipe-btn'>Rimuovi</button>";
                                echo "</form>";

                                echo "</li>";
                            }
                            echo "</ul>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>Non ci sono ricette per questo piano alimentare.</p>";
                    }

                    // Form per aggiungere una nuova ricetta al piano alimentare
                    echo "<form class='add-recipe-form' method='POST' action='add_recipe_to_piano.php'>";
                    echo "<h3>Aggiungi Ricetta</h3>";
                    echo "<label for='ricetta'>Seleziona Ricetta:</label>";
                    echo "<select name='ricetta' id='ricetta' required>";
                    $queryAllRicette = "SELECT ID_Ricetta, Titolo FROM Ricette";
                    $resultAllRicette = mysqli_query($conn, $queryAllRicette);
                    while ($ricetta = mysqli_fetch_assoc($resultAllRicette)) {
                        echo "<option value='{$ricetta['ID_Ricetta']}'>{$ricetta['Titolo']}</option>";
                    }
                    echo "</select>";

                    echo "<label for='tipoPasto'>Tipo di pasto:</label>";
                    echo "<select name='tipoPasto' id='tipoPasto' required>";
                    echo "<option value='Colazione'>Colazione</option>";
                    echo "<option value='Pranzo'>Pranzo</option>";
                    echo "<option value='Snack'>Snack</option>";
                    echo "<option value='Cena'>Cena</option>";
                    echo "<option value='Dessert'>Dessert</option>";
                    echo "</select>";

                    // Input per il giorno, limitato ai giorni effettivi del piano
                    echo "<label for='giorno'>Giorno:</label>";
                    echo "<select name='giorno' id='giorno' required>";
                    for ($i = 1; $i <= $numeroGiorni; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select>";

                    // Campo nascosto per il numero del piano alimentare (necessario per inviarlo a add_..._piano.php)
                    echo "<input type='hidden' name='numeroPiano' value='$numeroPiano'>";
                    echo "<button type='submit' class='add-recipe-btn'>Aggiungi Ricetta</button>";
                    echo "</form>";

                } else {
                    echo "<p>Piano alimentare non trovato.</p>";
                }
            } else {
                echo "<p>ID del piano alimentare non specificato.</p>";
            }

            mysqli_close($conn);
            ?>
        </section>
    </main>
</body>
</html>
