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

                $sql = "SELECT * FROM recettes";
                $result = $connexion->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<h3>Titre:</h3> " . $row["Titre"];
                        echo "<h4>Description:</h4>";
                        echo "<div class='description'>";
                        echo "<span>" . $row["Description"] . "</span>";
                        echo "</div>";
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