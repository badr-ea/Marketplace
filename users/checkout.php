<?php
session_start();
require_once '../config/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Initialize variables
    $totalPrice = 0;
    $nbrItems = 0;

    // Calculate total price and total number of items
    foreach($_SESSION['cart'] as $product_id => $item) {
        $totalPrice += $item['prix'] * $item['quantity'];
        $nbrItems += $item['quantity'];
    }

    
    $conn->beginTransaction();

    try {
        
        $query = "INSERT INTO commandes (id_client, prix_total, nombre_articles) VALUES (:id_client, :prix_total, :nombre_articles)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_client', $_SESSION['user_id']);
        $stmt->bindParam(':prix_total', $totalPrice);
        $stmt->bindParam(':nombre_articles', $nbrItems);
        $stmt->execute();

        
        $id_commande = $conn->lastInsertId();

        
        foreach($_SESSION['cart'] as $product_id => $item) {
            $quantite = $item['quantity'];
            $sql_update_stock = "UPDATE produits SET stock = stock - :quantite WHERE id = :product_id";
            $stmt_update_stock = $conn->prepare($sql_update_stock);
            $stmt_update_stock->bindParam(':quantite', $quantite);
            $stmt_update_stock->bindParam(':product_id', $product_id);
            $stmt_update_stock->execute();

            
            $sql_insert_order_details = "INSERT INTO commande_lignes (id_commande, id_produit, quantite) VALUES (:id_commande, :id_produit, :quantite)";
            $stmt_insert_order_details = $conn->prepare($sql_insert_order_details);
            $stmt_insert_order_details->bindParam(':id_commande', $id_commande);
            $stmt_insert_order_details->bindParam(':id_produit', $product_id);
            $stmt_insert_order_details->bindParam(':quantite', $quantite);
            $stmt_insert_order_details->execute();
        }

        
        $conn->commit();

        
        unset($_SESSION['cart']);
        $_SESSION['transaction_completed'] = true;

        
        header("Location: ../thank_you.php");
        exit();
    } catch(PDOException $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
