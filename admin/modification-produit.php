<?php
// Include the database connection
require_once "../config/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];

    // Initialize arrays to store column names and values for the update query
    $columns = array();
    $values = array();

    // Check and add each field to the update query if it has a value
    if (!empty($_POST["nom"])) {
        $columns[] = "nom";
        $values[] = $_POST["nom"];
    }
    if (!empty($_POST["description"])) {
        $columns[] = "description";
        $values[] = $_POST["description"];
    }
    if (!empty($_POST["prix"])) {
        $columns[] = "prix";
        $values[] = $_POST["prix"];
    }
    if (!empty($_POST["stock"])) {
        $columns[] = "stock";
        $values[] = $_POST["stock"];
    }
    if (!empty($_POST["categorie"])) {
        $columns[] = "categorie_id";
        $values[] = $_POST["categorie"];
    }

    // Handle image upload if a new image is provided
    if (!empty($_FILES["image"]["name"])) {
        $uploadDir = "../uploads/"; // Directory to upload images
        $imagePath = $uploadDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $columns[] = "chemin_image";
            $values[] = "/uploads/" . basename($_FILES["image"]["name"]);
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Construct the update query dynamically
    $sql = "UPDATE produits SET ";
    $updates = array();
    foreach ($columns as $index => $column) {
        $updates[] = "$column = :value$index";
    }
    $sql .= implode(", ", $updates);
    $sql .= " WHERE id = :id";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        foreach ($values as $index => $value) {
            $stmt->bindValue(":value$index", $value);
        }
        $stmt->bindParam(":id", $id);

        // Execute the prepared statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: ../success.php?success=true&msg=Produit mis à jour avec succès !");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
