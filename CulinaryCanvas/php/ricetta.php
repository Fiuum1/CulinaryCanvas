<?php
session_start();
require 'includes/conn_db.php';

// Funzione per ottenere il nome della difficoltà
function getDifficulty($diff) {
    switch($diff) {
        case 1:
            return 'Media';
        case 2:
            return 'Difficile';
        default:
            return 'Facile';
    }
}

// Funzione per ottenere la valutazione media
function getAverageRating($conn, $id_ricetta) {
    $query = "SELECT AVG(Valutazione) AS ValutazioneMedia FROM Recensioni WHERE Ricetta = $id_ricetta";
    $result = mysqli_query($conn, $query);
    $valutazione_media = $result->fetch_assoc()['ValutazioneMedia'];
    return $valutazione_media;
}

// Funzione per aggiornare la valutazione media nella tabella Ricette
function updateAverageRating($conn, $id_ricetta) {
    // Calcola la media delle valutazioni per la ricetta specificata
    $query_avg = "SELECT AVG(Valutazione) AS ValutazioneMedia FROM Recensioni WHERE Ricetta = $id_ricetta";
    $result_avg = mysqli_query($conn, $query_avg);
    $row = mysqli_fetch_assoc($result_avg);
    $valutazione_media = $row['ValutazioneMedia'];

    // Aggiorna ValutazioneMedia nella tabella Ricette
    $update_query = "UPDATE Ricette SET ValutazioneMedia = $valutazione_media WHERE ID_Ricetta = $id_ricetta";
    mysqli_query($conn, $update_query);
}

// Ottenere l'ID della ricetta dalla query string
$id_ricetta = $_GET['id'];

// Query per ottenere i dettagli della ricetta// Query per ottenere i dettagli della ricetta e l'utente creatore
$query = "SELECT R.Titolo, R.Immagine, R.Testo, R.Difficoltà, R.TempoPreparazione, R.TempoCottura, R.Porzioni, U.username, U.ImmagineProfilo 
          FROM Ricette R
          INNER JOIN Utenti U ON R.Utente = U.username
          WHERE R.ID_Ricetta = $id_ricetta";
$result = mysqli_query($conn, $query);

if ($result) {
    if ($result->num_rows > 0) {
        $ricetta = $result->fetch_assoc();
    } else {
        echo "Ricetta non trovata.";
        exit();
    }
} else {
    echo "Errore nella query: " . mysqli_error($conn);
    exit();
}

$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    $ricetta = $result->fetch_assoc();
} else {
    echo "Ricetta non trovata.";
    exit();
}

// Gestione dell'invio della valutazione e del commento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valutazione'])) {
    $valutazione = $_POST['valutazione'];
    $commento = $_POST['commento'];

    // Verifica se l'utente ha già valutato questa ricetta
    $utente = $_SESSION['username'];
    $query_check_voto = "SELECT COUNT(*) AS numVoti FROM Recensioni WHERE Utente = '$utente' AND Ricetta = $id_ricetta";
    $result_check_voto = mysqli_query($conn, $query_check_voto);
    $num_voti = mysqli_fetch_assoc($result_check_voto)['numVoti'];

    if ($num_voti > 0) {
        echo "<h1> Hai già valutato questa ricetta. </h1>";
        exit();
    }

    // Inserimento della valutazione e del commento nel database
    $query_insert_valutazione = "INSERT INTO Recensioni (Utente, Ricetta, Valutazione, Commento, Data) 
                                 VALUES ('$utente', $id_ricetta, $valutazione, '$commento', NOW())";
    mysqli_query($conn, $query_insert_valutazione);

    // Aggiorna la valutazione media per la ricetta
    updateAverageRating($conn, $id_ricetta);
    
    // Redirect per evitare il reinvio dei dati
    header("Location: ricetta.php?id=$id_ricetta");
    exit();
}


// Query per ottenere la valutazione media
$valutazione_media = getAverageRating($conn, $id_ricetta);

// Query per ottenere le recensioni degli utenti sulla ricetta
$query_recensioni = "SELECT Utente, Valutazione, Data, Commento FROM Recensioni WHERE Ricetta = $id_ricetta";
$result_recensioni = mysqli_query($conn, $query_recensioni);
$recensioni = [];
while ($row = mysqli_fetch_assoc($result_recensioni)) {
    $recensioni[] = $row;
}

// Query per ottenere tutti gli ingredienti della ricetta
$query_ingredienti = "SELECT Ingrediente, QuantitàIngrediente, UnitàMisura FROM Composizioni WHERE Ricetta = $id_ricetta";
$result_ingredienti = mysqli_query($conn, $query_ingredienti);
$ingredienti = [];
while ($row = mysqli_fetch_assoc($result_ingredienti)) {
    $ingredienti[] = $row;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ricetta['Titolo']; ?> - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/ricetta.css">
</head>
<body>
    <header class="header">
        <h1 onclick="window.location = './';">CulinaryCanvas</h1>
        <nav>
            <ul>
                <li><a href="ricette.php">Ricette</a></li>
                <li><a href="piani_alimentari.php">Piani alimentari</a></li>
                <li><a href="lista_spesa.php">Lista della spesa</a></li>
                <li><a href="ricerca_avanzata.php">Ricerca avanzata</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['username'])) : ?>
                <div class='user-info'>
                    <a href='profile.php'><img src='<?php echo $_SESSION['ImmagineProfilo']; ?>' class='user-avatar' alt='Immagine Profilo'></a>
                    <span class='username'><?php echo $_SESSION['username']; ?></span>
                    <a href='auth/logout.php' class='logout-btn'>Logout</a>
                </div>
            <?php else : ?>
                <button class='login-btn' onclick="window.location.href = 'auth/login.php';">Login</button>
                <button class='register-btn' onclick="window.location.href = 'auth/register.php';">Register</button>
            <?php endif; ?>
        </div>
    </header>

    <main class="recipe-container">
        <h2><?php echo $ricetta['Titolo']; ?></h2>
        <div class="creator-info">
            <span><?php echo $ricetta['username']; ?></span>
            <img src="<?php echo $ricetta['ImmagineProfilo']; ?>" class="creator-avatar" alt="Immagine Profilo Creatore">
        </div>
        <div class="recipe-content">
            <img src="<?php echo $ricetta['Immagine']; ?>" class="recipe-photo" alt="Foto della ricetta">
            <br>
            <div class="ingredients">
                <h3>Ingredienti:</h3>
                <ul>
                    <?php foreach ($ingredienti as $ingrediente) : ?>
                        <li>
                            <?php echo $ingrediente['Ingrediente']; ?> -
                            <?php echo $ingrediente['QuantitàIngrediente']; ?>
                            <?php echo $ingrediente['UnitàMisura']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                </div>
            <div class="recipe-details">
                <p><?php echo nl2br($ricetta['Testo']); ?></p>
                <div class="additional-details">
                    <span><strong>Difficoltà:</strong> <?php echo getDifficulty($ricetta['Difficoltà']); ?></span>
                    <span><strong>Preparazione:</strong> <?php echo $ricetta['TempoPreparazione']; ?> min</span>
                    <span><strong>Cottura:</strong> <?php echo $ricetta['TempoCottura']; ?> min</span>
                    <span><strong>Porzioni:</strong> <?php echo $ricetta['Porzioni']; ?></span>
                </div><br>
            </div>
        </div>
        
        <!-- Sezione per aggiungere alla lista della spesa -->
        <div class="add-to-shopping-list">
            <h3>Aggiungi ingredienti alla lista della spesa:</h3>
            <form action="add_to_shopping_list.php" method="POST">
                <input type="hidden" name="id_ricetta" value="<?php echo $id_ricetta; ?>">
                <button type="submit" class="add-to-list">Aggiungi alla lista della spesa</button>
            </form>
        </div>
    
        <!-- Sezione per le recensioni -->
        <div class="comment-section">
            <h3>Recensioni degli utenti:</h3>
            <?php if (!empty($recensioni)) : ?>
                <ul class="reviews-list">
                    <?php foreach ($recensioni as $recensione) : ?>
                        <li>
                            <strong>Utente:</strong> <?php echo $recensione['Utente']; ?><br>
                            <strong>Valutazione:</strong> <?php echo $recensione['Valutazione']; ?> stelle<br>
                            <strong>Data:</strong> <?php echo $recensione['Data']; ?><br>
                            <?php 
                            if ($recensione['Commento'] !== '') {
                                echo '<strong>Commento:</strong><br>' . nl2br($recensione['Commento']);
                            }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Non ci sono recensioni per questa ricetta.</p>
            <?php endif; ?>
        </div>
        <!-- Sezione per la valutazione media -->
        <div class="average-rating-section">
            <h3>Valutazione media:</h3>
            <p>
                <?php 
                if ($valutazione_media !== null) {
                    echo number_format($valutazione_media, 1);
                } else {
                    echo "<p> N/A";
                }
                echo " su 5.0 </p>";
                ?>
        </div>
        <!-- Sezione per valutare la ricetta -->
        <div class="rating-section">
            <h3>Valuta questa ricetta:</h3>
            <form action="<?php echo "?id=$id_ricetta"; ?>" method="POST">
                <label for="valutazione">Valutazione:</label>
                <select name="valutazione" id="valutazione" required>
                    <option value="">Seleziona una valutazione</option>
                    <option value="1">1 stella</option>
                    <option value="2">2 stelle</option>
                    <option value="3">3 stelle</option>
                    <option value="4">4 stelle</option>
                    <option value="5">5 stelle</option>
                </select><br>
                <label for="commento">Commento:</label><br>
                <textarea name="commento" id="commento" cols="30" rows="5"></textarea><br>
                <button type="submit" class="submit-rating">Invia valutazione</button>
            </form>
        </div>
    </main>

    <script>
        // Script per verificare se l'utente è loggato prima di inviare la valutazione
        document.querySelector('.submit-rating').addEventListener('click', function(event) {
            <?php if (!isset($_SESSION['username'])) { ?>
                alert("Devi aver effettuato l'accesso per aggiungere una valutazione.");
                event.preventDefault();
                window.location.href = 'auth/login.php';
            <?php } ?>
        });
    </script>
</body>
</html>