<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des recettes</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<body>
    <div class="container">
        <h1>Liste des recettes</h1>
        <ul>
            <?php
            include 'php/config.php';

            $sql = "SELECT r.ID, r.Titre, r.Description, u.Nom AS CreateurNom FROM recettes r
                    INNER JOIN users u ON r.Createur_ID = u.ID";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<h3>Titre:</h3> " . $row["Titre"];

                    // Récupérer les ingrédients associés à la recette
                    $recetteID = $row["ID"];
                    $sqlIngredients = "SELECT i.Nom, ri.Quantite, ri.Unite_mesure FROM ingredients i
                        INNER JOIN recette_ingredients ri ON i.ID = ri.Ingredient_ID
                        WHERE ri.Recette_ID = $recetteID";
                    $resultIngredients = $connexion->query($sqlIngredients);

                    if ($resultIngredients->num_rows > 0) {
                        echo "<h4>Ingrédients:</h4>";
                        echo "<ul>";
                        while ($ingredientRow = $resultIngredients->fetch_assoc()) {
                            echo "<li>" . $ingredientRow["Nom"] . " - " . $ingredientRow["Quantite"] . " " . $ingredientRow["Unite_mesure"] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>Aucun ingrédient trouvé pour cette recette.</p>";
                    }

                    echo "<h4>Description:</h4>";
                    echo "<div class='description'>";
                    echo "<span>" . $row["Description"] . "</span>";
                    echo "</div>";

                    echo "<h4>Créateur:</h4>";
                    echo "<p>" . $row["CreateurNom"] . "</p>";

                    echo "</li>";
                }
            } else {
                echo "<li>Aucune recette trouvée.</li>";
            }

            $connexion->close();
            ?>
        </ul>
        <div class="button-containter">
            <a href="php/ajouter_utilisateur.php" class="button">Ajouter un utilisateur</a>
            <a href="php/ajouter_recette.php" class="button">Ajouter une recette</a>
        </div>
    </div>
</body>
</html>
