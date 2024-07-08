<?php
// Inclure la connexion à la base de données
require_once "../config/db.php";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID du produit à supprimer
    $id = $_POST["id"];

    try {
       
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Si le produit est supprimé avec succès de la base de données, supprimer son image associée
        if ($stmt->rowCount() > 0) {
            
                header("Location: ../success.php?success=true&msg=Catégorie supprimée avec succès !");
                exit();
            
        } else {
            // Aucun produit trouvé avec l'ID fourni
            echo "Aucune catégorie trouvé avec l'ID fourni.";
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        echo "Erreur: " . $e->getMessage();
    }
}
?>
