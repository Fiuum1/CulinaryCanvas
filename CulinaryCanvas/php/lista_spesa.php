<?php
session_start();

// Verifica se l'utente è loggato, altrimenti redirect a login.php
if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

require "includes/conn_db.php";

// Query per ottenere gli ingredienti nella lista della spesa dell'utente loggato
$username = $_SESSION['username'];
$sql = "SELECT i.Nome AS NomeIngrediente, i.Categoria, s.QuantitàIngrediente, s.UnitàMisura
        FROM Inclusioni s
        JOIN Ingredienti i ON s.Ingrediente = i.Nome
        WHERE s.Utente = '$username'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $ingredienti = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $ingredienti = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista della spesa - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/lista_spesa.css">
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
            <div class='user-info'>
                <a href='profile.php'><img src='<?php echo $_SESSION['ImmagineProfilo']; ?>' class='user-avatar' alt='Immagine Profilo'></a>
                <span class='username'><?php echo $_SESSION['username']; ?></span>
                <a href='auth/logout.php' class='logout-btn'>Logout</a>
            </div>
        </div>
    </header>

    <main class="shopping-list-container">
        <h2>Lista della spesa</h2>

        <!-- Lista degli ingredienti -->
        <ul class="shopping-list">
            <?php foreach ($ingredienti as $ingrediente) : ?>
                <li>
                    <div class="ingredient-info">
                        <span class="ingredient-name"><?php echo $ingrediente['NomeIngrediente']; ?></span>
                        <span class="ingredient-details"><?php echo $ingrediente['QuantitàIngrediente'] . ' ' . $ingrediente['UnitàMisura']; ?></span>
                        <span class="ingredient-category"><?php echo $ingrediente['Categoria']; ?></span>
                    </div>
                    <form action="rimuovi_ingrediente.php" method="POST">
                        <input type="hidden" name="ingrediente" value="<?php echo $ingrediente['NomeIngrediente']; ?>">
                        <button type="submit" class="remove-btn">Rimuovi</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (empty($ingredienti)) : ?>
            <p>Nessun ingrediente nella lista della spesa.</p>
        <?php endif; ?>
    </main>
</body>
</html>
