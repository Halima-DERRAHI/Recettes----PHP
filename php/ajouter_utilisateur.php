<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom"><br>
        <input type="submit" value="Ajouter">
    </form>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Inclure le fichier de configuration
        include 'config.php';

        // Récupérer le nom de l'utilisateur du formulaire
        $nom = $_POST['nom'];

        // Préparer et exécuter la requête SQL pour ajouter un nouvel utilisateur
        $stmt = $connexion->prepare("INSERT INTO users (Nom) VALUES (?)");
        $stmt->bind_param("s", $nom);
        $stmt->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt->affected_rows > 0) {
            echo "Utilisateur ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
        }

        // Fermer la requête
        $stmt->close();
    }
    ?>
</body>
</html>