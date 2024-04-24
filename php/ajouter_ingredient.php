<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["newIngredient"])) {

        $newIngredient = $_POST["newIngredient"];
        
        include 'config.php';

        $sql = "INSERT INTO ingredients (Nom) VALUES (?)";

        $stmt = $connexion->prepare($sql);

        $stmt->bind_param("s", $newIngredient);

        $stmt->execute();
    }
}

?>