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

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="createur">Créateur:</label>
        <select name="createur" id="createur">
            <?php
            include 'config.php';

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $createur = $_POST['createur'];

            $sql = "INSERT INTO recettes (Titre, Description, Createur_ID) VALUES ('$titre', '$description', '$createur')";

            if ($connexion->query($sql) === TRUE) {
                echo "<p class='success-message'>Nouvelle recette ajoutée avec succès.</p>";
            } else {
                echo "Erreur: " . $sql . "<br>" . $connexion->error;
            }
        }
        ?>

        <a href="../index.php" class="btn-retour">Retour</a>
    </form>
</body>
</html>