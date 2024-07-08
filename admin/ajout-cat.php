<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nom = $_POST["nom"];


        try {
            $sql = "INSERT INTO categories (nom)
                    VALUES (:nom)";

            $stmt = $conn->prepare($sql);

    
            $stmt->bindParam(':nom', $nom);

            
            $stmt->execute();

            header("Location: ../success.php?success=true&msg=Catégorie ajoutée avec succès !");
            exit();
        } catch (PDOException $e) {
            
            echo "Erreur : " . $e->getMessage();
        }
    
}
?>
