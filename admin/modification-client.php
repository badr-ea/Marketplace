<?php

require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];

    $columns = array();
    $values = array();

   
    if (!empty($_POST["nom_utilisateur"])) {
        $columns[] = "nom_utilisateur";
        $values[] = $_POST["nom_utilisateur"];
    }

    if (!empty($_POST["role"])) {
        $columns[] = "role";
        $values[] = $_POST["role"];
    }

      

    $sql = "UPDATE utilisateurs SET ";
    $updates = array();
    foreach ($columns as $index => $column) {
        $updates[] = "$column = :value$index";
    }
    $sql .= implode(", ", $updates);
    $sql .= " WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        foreach ($values as $index => $value) {
            $stmt->bindValue(":value$index", $value);
        }
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        header("Location: ../success.php?success=true&msg=Utilisateur mis à jour avec succès !");
        exit();
    } catch (PDOException $e) {
    
        echo "Error: " . $e->getMessage();
    }
}
?>
