-- Utilisation de la base de données Recettes
USE Recettes;

-- Table des utilisateurs
CREATE TABLE users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50),
);

-- Table des recettes
CREATE TABLE recettes (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Titre VARCHAR(100),
    Description TEXT,
    Createur_ID INT,
    FOREIGN KEY (Createur_ID) REFERENCES users(ID)
);
-- Table des ingrédients
CREATE TABLE ingredients (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50),
    Unite_mesure VARCHAR(10)
);

-- Table de liaison entre les recettes, les ingrédients et les quantités
CREATE TABLE recette_ingredients (
    Recette_ID INT,
    Ingredient_ID INT,
    Quantite FLOAT,
    PRIMARY KEY (Recette_ID, Ingredient_ID),
    FOREIGN KEY (Recette_ID) REFERENCES recettes(ID),
    FOREIGN KEY (Ingredient_ID) REFERENCES ingredients(ID)
);

-- Table des catégories de recettes
CREATE TABLE categories (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50)
);

-- Table de liaison entre les recettes et les catégories
CREATE TABLE recette_categories (
    Recette_ID INT,
    Categorie_ID INT,
    PRIMARY KEY (Recette_ID, Categorie_ID),
    FOREIGN KEY (Recette_ID) REFERENCES recettes(ID),
    FOREIGN KEY (Categorie_ID) REFERENCES categories(ID)
);