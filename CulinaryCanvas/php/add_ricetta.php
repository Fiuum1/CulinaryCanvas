<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Ricetta - CulinaryCanvas</title>
    <link rel="stylesheet" href="css/add_ricetta.css">
    <script src="js/add_ricetta.js"></script>
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

    <main class="add-recipe-container">
        <form class="add-recipe-form" id="addRecipeForm" action="process_add_ricetta.php" method="POST" enctype="multipart/form-data">
            <h2>Aggiungi una nuova ricetta</h2>
            <label for="titolo">Titolo:</label>
            <input type="text" id="titolo" name="titolo" required>

            <label for="testo">Descrizione (max 2000 caratteri):</label>
            <textarea id="testo" name="testo" rows="4" maxlength="2000" oninput="updateCharacterCount()" required></textarea>
            <p id="charCount">0/2000 caratteri</p>

            <label for="difficolta">Difficoltà:</label>
            <select id="difficolta" name="difficolta" required>
                <option value="3">Facile</option>
                <option value="1">Media</option>
                <option value="2">Difficile</option>
            </select>

            <label for="tempo-preparazione">Tempo di preparazione (minuti):</label>
            <input type="number" id="tempo-preparazione" name="tempo-preparazione" required>

            <label for="porzioni">Porzioni:</label>
            <input type="number" id="porzioni" name="porzioni" required>

            <label for="tempo-cottura">Tempo di cottura (minuti):</label>
            <input type="number" id="tempo-cottura" name="tempo-cottura" required>

            <div class="ingredient-section">
                <h3>Ingredienti:</h3>
                <div id="ingredientContainer">
                    <div class="ingredient-fields">
                        <input type="text" name="ingredienti[]" placeholder="Nome ingrediente" required>
                        <input type="number" step="0.01" name="quantita[]" placeholder="Quantità" required>
                        <input type="text" name="unita[]" pattern="^[a-zA-Z]+$" placeholder="Unità di misura" required>
                        <input type="text" name="categorie[]" placeholder="Categoria" required>
                        <button type="button" class="remove-button" onclick="removeIngredientField(this)">Rimuovi</button>
                    </div>
                </div>
                <button type="button" class="add-more-button" onclick="addIngredientField()">Aggiungi ingrediente</button>
            </div>
            <label for="immagine">Immagine:</label>
            <input type="file" name="immagine" accept="image/*" required>
            <br></br>
            <button type="submit" class="submit-button">Aggiungi Ricetta</button>
        </form>
    </main>
</body>
</html>
