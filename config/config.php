<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "Recettes";

// Connexion à la base de données
$connexion = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connexion échouée: " . $connexion->connect_error);
}

?>