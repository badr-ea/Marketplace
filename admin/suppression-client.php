<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $id = $_POST["id"];

    try {
       
        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            
                header("Location: ../success.php?success=true&msg=Utilisateur supprimé avec succès !");
                exit();
            
        } else {
            echo "Aucune utilisateur trouvé avec l'ID fourni.";
            exit();
        }
    } catch (PDOException $e) {
        
        echo "Erreur: " . $e->getMessage();
    }
}
?>
