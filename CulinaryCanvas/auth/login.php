<?php
session_start();

// Variabili per i messaggi di errore
$error_message = '';

// Verifica se l'utente è già loggato, in tal caso reindirizza
if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Verifica se è stato inviato il form di login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/conn_db.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $hashedPassword = crypt($password, '$2a$07$usesomesillystringforsalt$');	

    // Query per verificare le credenziali dell'utente
    $query = "SELECT * FROM Utenti WHERE e_mail = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verifica della password hashata 
        if ($hashedPassword == $user['hashedPassword']) {
            // Credenziali corrette, inizia la sessione
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['ImmagineProfilo'] = $user['ImmagineProfilo'];

            // Reindirizzamento dopo il login
            header("Location: ../index.php");
            exit();
        } else {
            $error_message = "Password errata.";
        }
    } else {
        $error_message = "Email non registrata.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CulinaryCanvas</title>
    <link rel="stylesheet" href="../css/login.css">
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
        <section class="login-section">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <?php
                // Mostra il messaggio di errore se esiste
                if (!empty($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
                
                <button type="submit">Accedi</button>
            </form>
            <address>
                <p>Email di supporto: <a href="mailto:support@culinarycanvas.com">support@culinarycanvas.com</a></p>
            </address>
        </section>
    </main>
</body>
</html>
