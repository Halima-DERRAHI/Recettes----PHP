<?php
include 'config.php';

// Afficher les données reçues via POST pour le débogage

print_r($_POST);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $createur = $_POST['createur'];

    // Préparer et exécuter la requête SQL pour insérer une nouvelle recette
    $sql = "INSERT INTO recettes (Titre, Description, Createur_ID) VALUES ('$titre', '$description', '$createur')";

    if ($connexion->query($sql) === TRUE) {
        echo "Nouvelle recette ajoutée avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $connexion->error;
    }
}
?>