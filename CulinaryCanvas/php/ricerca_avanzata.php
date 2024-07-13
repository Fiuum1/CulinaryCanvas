<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Avanzata - Ricette</title>
    <link rel="stylesheet" href="css/ricerca_avanzata.css">
    <script src="js/ricerca_avanzata.js"></script>
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
        <section id="search-section" class="section">
            <h2 align=center>Ricerca Avanzata</h2>
            <form id="advanced-search-form" action="ricerca_avanzata.php" method="GET">
                <div id="ingredient-container">
                    <div class="ingredient-select">
                        <label for="ingredient-1">Ingrediente:</label>
                        <select name="ingredients[]" id="ingredient-1" class="ingredient-dropdown">
                            <?php
                            // Connessione al database
                            require 'includes/conn_db.php';

                            // Query per ottenere gli ingredienti
                            $query = "SELECT Nome FROM Ingredienti";
                            $result = mysqli_query($conn, $query);

                            // Generazione delle opzioni per il dropdown degli ingredienti
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row["Nome"] . "'>" . $row["Nome"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nessun ingrediente disponibile</option>";
                            }

                            // Chiusura della connessione
                            mysqli_close($conn);
                            ?>
                        </select>
                        <button type="button" onclick="addIngredient()">Aggiungi Ingrediente</button>
                    </div>
                </div>
                <button type="submit">Ricerca</button>
            </form>
        </section>

        <section id="results-section" class="section">
            <h2 align=center>Risultati della Ricerca</h2>
            <?php
            // Controllo se ci sono ingredienti nella query GET
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ingredients'])) {
                // Connessione al database
                require 'includes/conn_db.php';

                // Preparazione degli ingredienti per la query SQL
                $ingredients = $_GET['ingredients'];
                $ingredientPlaceholders = "'" . implode("','", $ingredients) . "'";

                // Query per ottenere le ricette corrispondenti agli ingredienti
                $sql = "SELECT DISTINCT r.ID_Ricetta, r.Titolo, r.Utente, r.Immagine, r.ValutazioneMedia, r.TempoPreparazione, r.TempoCottura, r.Difficoltà, r.Porzioni
                        FROM Ricette r
                        JOIN Composizioni c ON r.ID_Ricetta = c.Ricetta
                        WHERE c.Ingrediente IN ($ingredientPlaceholders)";

                // Esecuzione della query
                $result = mysqli_query($conn, $sql);

                // Visualizzazione dei risultati
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='ricetta'>";
                        echo "<a href='ricetta.php?id=" . $row["ID_Ricetta"] . "'><img src='" . $row["Immagine"] . "' alt='" . $row["Titolo"] . "' class='foto-ricetta'></a>";
                        echo "<h2>" . $row["Titolo"] . "</h2>";
                        echo "<p>Autore: " . $row["Utente"] . "</p>";
                        if($row["ValutazioneMedia"] !== NULL) {
                            echo "<p>Valutazione Media: " . $row["ValutazioneMedia"] . "</p>";
                        }
                        echo "<p>Tempo di Preparazione: " . $row["TempoPreparazione"] . " minuti</p>";
                        echo "<p>Tempo di Cottura: " . $row["TempoCottura"] . " minuti</p>";
                        switch($row["Difficoltà"]){
                            case 1:
                                echo "<p>Difficoltà: Media</p>";
                                break;
                            case 2:
                                echo "<p>Difficoltà: Difficile</p>";
                                break;
                            default:
                                echo "<p>Difficoltà: Facile</p>";
                                break;
                        }
                    
                        echo "<p>Porzioni: " . $row["Porzioni"] . "</p>";
                    
                        // Mostra solo gli ingredienti selezionati per la ricerca avanzata
                        echo "<p>Ingredienti: ";
                        $query_ingredienti = "SELECT Ingrediente FROM Composizioni WHERE Ricetta = " . $row["ID_Ricetta"];
                        $result_ingredienti = mysqli_query($conn, $query_ingredienti);
                        $ingredienti_selezionati = $_GET['ingredients']; // Recupera gli ingredienti dalla query GET
                    
                        while ($row_ingrediente = mysqli_fetch_assoc($result_ingredienti)) {
                            $ingrediente = $row_ingrediente["Ingrediente"];
                            if (in_array($ingrediente, $ingredienti_selezionati)) {
                                echo "<span class='matching-ingredient'>" . $ingrediente . "</span>, ";
                            }
                        }
                        echo "</p>";
                    
                        echo "</div>";
                    }
                    
                } else {
                    echo "<p>Nessuna ricetta trovata con gli ingredienti selezionati.</p>";
                }

                // Chiusura della connessione
                mysqli_close($conn);
            } else {
                echo "<p>Seleziona almeno un ingrediente e premi 'Ricerca' per visualizzare le ricette corrispondenti.</p>";
            }
            ?>
        </section>
    </main>
</body>
</html>
