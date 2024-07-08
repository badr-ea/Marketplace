<?php
// Inclure la connexion à la base de données
require_once "../config/db.php";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $stock = $_POST["stock"];
    $categorie = $_POST["categorie"];

    // Gérer le téléchargement de l'image
    $uploadDir = "../uploads/"; // Répertoire pour télécharger les images
    $imagePath = $uploadDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // Image téléchargée avec succès, procéder à l'insertion dans la base de données
        try {
            // Préparer l'instruction SQL pour insérer les données du produit dans la base de données
            $sql = "INSERT INTO produits (nom, description, prix, stock, categorie_id, chemin_image)
                    VALUES (:nom, :description, :prix, :stock, :categorie, :chemin_image)";

            // Préparer l'instruction SQL
            $stmt = $conn->prepare($sql);

            // Liée les paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':chemin_image', $imagePath);

            $imagePath = "/uploads/" . basename($_FILES["image"]["name"]);

            // Exécuter l'instruction préparée
            $stmt->execute();

            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../success.php?success=true&msg=Produit ajouté avec succès !");
            exit();
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>
