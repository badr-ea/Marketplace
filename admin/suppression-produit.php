<?php
// Inclure la connexion à la base de données
require_once "../config/db.php";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID du produit à supprimer
    $id = $_POST["id"];

    try {
        // Tout d'abord, récupérer le chemin de l'image de la base de données en fonction de l'ID du produit
        $stmt = $conn->prepare("SELECT chemin_image FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cheminImage = $row['chemin_image'];

        // Supprimer le produit de la base de données
        $stmt = $conn->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Si le produit est supprimé avec succès de la base de données, supprimer son image associée
        if ($stmt->rowCount() > 0) {
            // Supprimer l'image du dossier "uploads" dans le répertoire racine
            if (unlink(".." . $cheminImage)) {
                // Image supprimée avec succès
                // Rediriger vers une page de succès ou afficher un message de succès
                header("Location: ../success.php?success=true&msg=Produit supprimé avec succès !");
                exit();
            } else {
                // Erreur lors de la suppression de l'image
                echo "Erreur lors de la suppression de l'image.";
                exit();
            }
        } else {
            // Aucun produit trouvé avec l'ID fourni
            echo "Aucun produit trouvé avec l'ID fourni.";
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        echo "Erreur: " . $e->getMessage();
    }
}
?>
