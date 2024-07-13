<!DOCTYPE html>
<html lang="it">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CulinaryCanvas</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
</head>
<body>
    <header class="header">        
        <h1 onclick="window.location = '../';">CulinaryCanvas</h1>
        <div class="expanding-bar expanded"></div>
        <nav>
            <ul>
                <li><a href="../ricette.php">Ricette</a></li>
                <li><a href="../piani_alimentari.php">Piani alimentari</a></li>
                <li><a href="../lista_spesa.php">Lista della spesa</a></li>
                <li><a href="../ricerca_avanzata.php">Ricerca avanzata</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <button class="login-btn" onclick="window.location.href = 'login.php';">Login</button>
            <button class="register-btn" onclick="window.location.href = 'register.php';">Register</button>
        </div>
    </header>

    <main>
        <section class="register-section">
            <h2>Register</h2>
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>

                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" name="cognome" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="ImmagineProfilo">Immagine Profilo:</label>
                <div class="ImmagineProfilo-container">
                    <i class="fas fa-user-circle"></i>
                    <input type="file" id="ImmagineProfilo" name="ImmagineProfilo" accept="image/*" required>
                </div>
                
                <button type="submit" name="register">Registrati</button>
            </form>
            <?php
                session_start();
                // Verifica se l'utente è già loggato, in tal caso reindirizza
                if (isset($_SESSION['username'])) {
                    header("Location: ../index.php");
                    exit();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
                    // Includiamo il file per la connessione al database
                    require '../includes/conn_db.php';
                    
                    // Sanificazione dei dati
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = $_POST['password']; // Verrà hashata dopo

                    // Controllo se username o email esistono già
                    $check_query = "SELECT * FROM Utenti WHERE username = '$username' OR e_mail = '$email'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        echo "<p style='color: red;'>Errore: Username o Email già esistenti.</p>";
                    } else {
                        // Hash della password
                        $hashedPassword = crypt($password, '$2a$07$usesomesillystringforsalt$');	

                        // Gestione dell'upload dell'immagine di profilo
                        $profile_pic_name = null;
                        if (isset($_FILES['ImmagineProfilo']) && $_FILES['ImmagineProfilo']['error'] == UPLOAD_ERR_OK) {
                            $target_dir = "../users_uploads/";
                            $target_file = $target_dir . basename($_FILES["ImmagineProfilo"]["name"]);
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                            // Check se il file è un'immagine
                            $check = getimagesize($_FILES["ImmagineProfilo"]["tmp_name"]);
                            if ($check !== false) {
                                if (move_uploaded_file($_FILES["ImmagineProfilo"]["tmp_name"], $target_file)) {
                                    $profile_pic_name = 'users_uploads/'.$_FILES["ImmagineProfilo"]["name"];
                                } else {
                                    echo "<p style='color: red;'>Errore durante l'upload dell'immagine di profilo.</p>";
                                }
                            } else {
                                echo "<p style='color: red;'>Il file selezionato non è un'immagine.</p>";
                            }
                        }

                        // Inserimento nel database
                        $insert_query = "INSERT INTO Utenti (username, e_mail, hashedPassword, Nome, Cognome, ImmagineProfilo) VALUES ('$username', '$email', '$hashedPassword', '$name', '$cognome', '$profile_pic_name')";

                        if (mysqli_query($conn, $insert_query)) {
                            echo "<p style='color: green;'>Registrazione avvenuta con successo!</p>";
                            
                            $query = "INSERT INTO Liste_della_spesa (Utente) VALUES ('$username')";
                            mysqli_query($conn,$query);
                            
                            // Reindirizzamento alla pagina di login dopo la registrazione
                            header("Location: login.php");
                            exit();
                        } else {
                            echo "<p style='color: red;'>Errore durante la registrazione: " . mysqli_error($conn) . "</p>";
                        }
                    }

                    mysqli_close($conn);
                }
            ?>
        </section>
    </main>

</body>
</html>
