<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>
        <input type="submit" value="Ajouter">
    </form>

    <?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nom = $_POST['nom'];

        $stmt = $connexion->prepare("INSERT INTO users (Nom) VALUES (?)");
        $stmt->bind_param("s", $nom);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<p class='success-message'>Utilisateur ajouté avec succès.</p>";
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <a href="../index.php" class="btn-retour">Retour</a>

</body>
</html>