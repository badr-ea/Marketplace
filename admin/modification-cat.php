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
   

    // Construct the update query dynamically
    $sql = "UPDATE categories SET ";
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
        header("Location: ../success.php?success=true&msg=Catégorie mise à jour avec succès !");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
