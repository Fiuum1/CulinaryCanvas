<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulinaryCanvas</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
</head>
<body>
    <header class="header">
        <h1 onclick="window.location = './';">CulinaryCanvas</h1>
        <!-- Per far sì che al click del titolo venga reindirizzato alla pagina index-->
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
                // Utente loggato
                echo "<div class='user-info'>";
                echo "<a href='profile.php'><img src='{$_SESSION['ImmagineProfilo']}' class='user-avatar' alt='Immagine Profilo'></a>";
                echo "<span class='username'>{$_SESSION['username']}</span>";
                echo "<a href='auth/logout.php' class='logout-btn'>Logout</a>";
                echo "</div>";
            } else {
                // Utente non loggato
                echo "<button class='login-btn' onclick=\"window.location.href = 'auth/login.php';\">Login</button>";
                echo "<button class='register-btn' onclick=\"window.location.href = 'auth/register.php';\">Register</button>";
            }
            ?>
        </div>
    </header>

    <main>
        <section id="section1" class="section hidden">
            <h2 align=center>Ricette</h2>
            <img src="imgs/imgs_index/ricette.jpeg" alt="Immagine Home">
            <a href="ricette.php" class="advanced-search-link">Vai alle Ricette</a>
        </section>

        <section id="section2" class="section hidden">
            <h2 align=center>Piani alimentari</h2>
            <img src="imgs/imgs_index/piani_alimentari.png" alt="Immagine Servizi">
            <a href="piani_alimentari.php" class="advanced-search-link">Vai ai Piani alimentari</a>
        </section>

        <section id="section3" class="section hidden">
            <h2 align=center>Lista della spesa</h2>
            <img src="imgs/imgs_index/lista_della_spesa.png" alt="Immagine Contatti">
            <a href="lista_spesa.php" class="advanced-search-link">Vai alla Lista della spesa</a>
        </section>

        <section id="section4" class="section hidden">
            <h2 align=center>Ricerca Avanzata</h2>
            <img src="imgs/imgs_index/ricerca_avanzata.jpg" alt="Immagine Contatti">
            <a href="ricerca_avanzata.php" class="advanced-search-link">Vai alla Ricerca Avanzata</a>
        </section>
    </main>

</body>
</html>
