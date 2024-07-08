<?php
require "config/db.php";

// Initialize variables to store filtering parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sort_price = isset($_GET['sort_price']) ? $_GET['sort_price'] : '';

// Construct the base query
$query = "SELECT * FROM produits WHERE 1";

// Add search keyword condition
if (!empty($search)) {
    $query .= " AND description LIKE '%$search%'";
}

// Add minimum price condition
if (!empty($min_price)) {
    $query .= " AND prix >= $min_price";
}

// Add maximum price condition
if (!empty($max_price)) {
    $query .= " AND prix <= $max_price";
}

// Add category condition
if (!empty($category)) {
    $query .= " AND categorie_id = $category";
}

// Add sorting condition
if ($sort_price === 'asc') {
    $query .= " ORDER BY prix ASC";
} elseif ($sort_price === 'desc') {
    $query .= " ORDER BY prix DESC";
}

$result = $conn->query($query);

if($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        include "produit.php";
    }
}
?>
