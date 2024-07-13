<?php
session_start();
require 'includes/conn_db.php'; 

// Verifica che l'utente sia loggato
if (!isset($_SESSION['username'])) {
    header("Location: ricette.php");
    exit();
}

// Recupero dei dati dal form
$titolo = $_POST['titolo'];
$descrizione = $_POST['testo'];
$difficolta = $_POST['difficolta'];
$tempo_preparazione = $_POST['tempo-preparazione'];
$porzioni = $_POST['porzioni'];
$tempo_cottura = $_POST['tempo-cottura'];
$ingredienti = $_POST['ingredienti'];
$quantita = $_POST['quantita'];
$unita = $_POST['unita'];
$categorie = $_POST['categorie'];
$immagine = $_FILES['immagine']; 

// Gestione dell'immagine
$upload_directory = 'imgs/imgs_ricette/';
$image = $_FILES['immagine'];

// Verifica se l'immagine è stata caricata correttamente
if ($image['error'] === UPLOAD_ERR_OK) {
    $image_name = basename($image['name']);
    $image_tmp_name = $image['tmp_name'];

    // Ottiene l'estensione dell'immagine
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    
    // Verifica se l'estensione è tra quelle consentite
    $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($image_ext, $allowed_exts)) {
        // Sposta l'immagine nella directory di destinazione
        $image_dest = $upload_directory . $image['name'];
        if (move_uploaded_file($image_tmp_name, $image_dest)) {
            // Preparazione della query per inserire la nuova ricetta con l'URL dell'immagine
            $insert_ricetta_query = "INSERT INTO Ricette (Titolo, Testo, Immagine, Difficoltà, Porzioni, TempoCottura, TempoPreparazione, DataPubblicazione, Utente) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
            $stmt_ricetta = $conn->prepare($insert_ricetta_query);

            // Verifica se la preparazione della query è riuscita
            if ($stmt_ricetta === false) {
                echo "Errore nella preparazione della query: " . $conn->error;
                exit();
            }

            // Mappa il valore di difficoltà a un intero
            switch ($difficolta) {
                case 'Media':
                    $difficolta_int = 1;
                    break;
                case 'Difficile':
                    $difficolta_int = 2;
                    break;
                default:
                    $difficolta_int = 0; // Default = 'Facile'
                    break;
            }

            // Lega i parametri alla query per la tabella Ricette
            $stmt_ricetta->bind_param("sssiisss", $titolo, $descrizione, $image_dest, $difficolta_int, $porzioni, $tempo_cottura, $tempo_preparazione, $_SESSION['username']);

            // Esecuzione della query per inserire la nuova ricetta
            if ($stmt_ricetta->execute()) {
                $id_ricetta = $conn->insert_id; // Ottieni l'ID della nuova ricetta inserita

                // Inserimento degli ingredienti nella tabella Composizioni
                $insert_composizione_query = "INSERT INTO Composizioni (Ricetta, Ingrediente, QuantitàIngrediente, UnitàMisura) VALUES (?, ?, ?, ?)";
                $stmt_composizione = $conn->prepare($insert_composizione_query);

                // Verifica se la preparazione della query è riuscita
                if ($stmt_composizione === false) {
                    echo "Errore nella preparazione della query: " . $conn->error;
                    exit();
                }

                // Ciclo per inserire ogni ingrediente
                for ($i = 0; $i < count($ingredienti); $i++) {
                    $ingrediente = $ingredienti[$i];
                    $quantita_ingrediente = $quantita[$i];
                    $unita_misura = $unita[$i];
                    $categoria = $categorie[$i];
                    
                    // Verifica se l'ingrediente è già presente nel database
                    $check_ingrediente_query = "SELECT Nome FROM Ingredienti WHERE Nome = ?";
                    $stmt_check = $conn->prepare($check_ingrediente_query);
                    $stmt_check->bind_param("s", $ingrediente);
                    $stmt_check->execute();
                    $stmt_check->store_result();

                    // Se l'ingrediente non è presente, inseriscilo nella tabella Ingredienti
                    if ($stmt_check->num_rows === 0) {
                        $insert_ingrediente_query = "INSERT INTO Ingredienti (Nome, Categoria) VALUES (?, ?)";
                        $stmt_insert_ingrediente = $conn->prepare($insert_ingrediente_query);
                        $stmt_insert_ingrediente->bind_param("ss", $ingrediente, $categoria);
                        $stmt_insert_ingrediente->execute();
                        $stmt_insert_ingrediente->close();
                    }

                    // Esegui l'inserimento nella tabella Composizioni
                    $stmt_composizione->bind_param("isds", $id_ricetta, $ingrediente, $quantita_ingrediente, $unita_misura);
                    $stmt_composizione->execute();

                    // Chiudi il controllo dell'ingrediente
                    $stmt_check->close();
                }

                // Chiudi la query preparata per Composizioni
                $stmt_composizione->close();

                // Chiudi la connessione al database
                $stmt_ricetta->close();
                $conn->close();

                // Redirect alla pagina di elenco ricette dopo l'inserimento
                header("Location: ricette.php");
                exit();
            } else {
                // In caso di errore nella query, gestisci l'errore o reindirizza alla pagina di errore
                echo "Errore nell'aggiunta della ricetta: " . $stmt_ricetta->error;
                exit();
            }
        } else {
            echo "Errore nel caricamento dell'immagine.";
            exit();
        }
    } else {
        echo "Tipo di file non supportato.";
        exit();
    }
} else {
    echo "Errore nel caricamento dell'immagine.";
    exit();
}
?>
