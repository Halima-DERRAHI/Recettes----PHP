<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une recette</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>
<body>
    <h1>Ajouter une recette</h1>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="recetteForm">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" required><br>

        <div id="ingredientsContainer">

            <div class="ingredient">
                <label for="ingredient">Ingrédient 1:</label>
                <select name="ingredient[]" class="ingredient" required>
                <option>Choisissez un ingrédient</option>
                    <?php
                    include 'config.php';

                    $sqlIngredients = "SELECT * FROM ingredients";
                    $resultIngredients = $connexion->query($sqlIngredients);

                    if ($resultIngredients->num_rows > 0) {
                        while($rowIngredient = $resultIngredients->fetch_assoc()) {
                            $ingredientID = $rowIngredient['ID'];
                            $ingredientNom = $rowIngredient['Nom'];
                            echo '<option value="' . $ingredientID . '">' . $ingredientNom . '</option>';
                        }
                    }
                    ?>
                </select><br>

                <label for="quantite">Quantité:</label>
                <input type="text" name="quantite[]" class="quantite" required><br>

                <label for="unite">Unité de mesure:</label>
                <select name="unite[]" class="unite" required>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="ml">ml</option>
                    <option value="cl">cl</option>
                    <option value="l">l</option>
                    <option value="cuillère à café">cuillère à café</option>
                    <option value="cuillère à soupe">cuillère à soupe</option>
                    <option value="pièce">pièce</option>
                </select><br>
            </div>
        </div>

        <button type="button" class="ajouterIngredient" id="ajouterIngredient">Plus d'ingrédients</button><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="createur">Créateur:</label>
        <select name="createur" id="createur">
        <option>Choisissez ...</option>
            <?php
            $sqlCreateurs = "SELECT * FROM users";
            $resultCreateurs = $connexion->query($sqlCreateurs);

            if ($resultCreateurs->num_rows > 0) {
                while($rowCreateur = $resultCreateurs->fetch_assoc()) {
                    $createurID = $rowCreateur['ID'];
                    $createurNom = $rowCreateur['Nom'];
                    echo '<option value="' . $createurID . '">' . $createurNom . '</option>';
                }
            }
            ?>
        </select><br>

        <input type="submit" value="Ajouter">

        <?php
        include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $createur = $_POST['createur'];
            $ingredients = $_POST['ingredient'];
            $quantites = $_POST['quantite'];
            $unites = $_POST['unite'];

            $sqlRecette = "INSERT INTO recettes (Titre, Description, Createur_ID) VALUES ('$titre', '$description', '$createur')";
            if ($connexion->query($sqlRecette) === TRUE) {
                $recetteID = $connexion->insert_id;

                for ($i = 0; $i < count($ingredients); $i++) {
                    $ingredientID = $ingredients[$i];
                    $quantite = $quantites[$i];
                    $unite = $unites[$i];

                    $sqlRecetteIngredient = "INSERT INTO recette_ingredients (Recette_ID, Ingredient_ID, Quantite, Unite_mesure) VALUES ('$recetteID', '$ingredientID', '$quantite', '$unite')";
                    if ($connexion->query($sqlRecetteIngredient) !== TRUE) {
                        echo "Erreur lors de l'insertion de l'ingrédient: " . $connexion->error;
                    }
                }
                echo "<p class='success-message'>Nouvelle recette ajoutée avec succès.</p>";
            } else {
                echo "Erreur lors de l'insertion de la recette: " . $connexion->error;
            }
        }
        ?>

    </form>

    <a href="../index.php" class="btn-retour">Retour</a>

    <script>
        var ingredientCounter = 1;

        document.getElementById('ajouterIngredient').addEventListener('click', function() {
            var container = document.getElementById('ingredientsContainer');
            var newIngredient = document.createElement('div');
            newIngredient.classList.add('ingredient');
            ingredientCounter++;

            newIngredient.innerHTML = `
                <label for="ingredient">Ingrédient ${ingredientCounter}:</label>
                <select name="ingredient[]" class="ingredient" required>
                <option>Choisissez un ingrédient</option>
                    <?php
                    $resultIngredients = $connexion->query($sqlIngredients);

                    if ($resultIngredients->num_rows > 0) {
                        while($rowIngredient = $resultIngredients->fetch_assoc()) {
                            $ingredientID = $rowIngredient['ID'];
                            $ingredientNom = $rowIngredient['Nom'];
                            echo '<option value="' . $ingredientID . '">' . $ingredientNom . '</option>';
                        }
                    }
                    ?>
                </select><br>

                <label for="quantite">Quantité:</label>
                <input type="text" name="quantite[]" class="quantite" required><br>

                <label for="unite">Unité de mesure:</label>
                <select name="unite[]" class="unite" required>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="ml">ml</option>
                    <option value="cl">cl</option>
                    <option value="l">l</option>
                    <option value="cuillère à café">cuillère à café</option>
                    <option value="cuillère à soupe">cuillère à soupe</option>
                    <option value="pièce">pièce</option>
                </select><br>
            `;
            container.appendChild(newIngredient);
        });
    </script>
</body>
</html>
