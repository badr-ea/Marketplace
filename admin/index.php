<?php 
session_start();


if ($_SESSION['role'] !== "admin") {
  header("Location: login.html");
  exit();
}


require_once "../config/db.php";


$sql_clients = "SELECT COUNT(*) AS total_clients FROM utilisateurs WHERE role = 'client'";
$stmt_clients = $conn->prepare($sql_clients);
$stmt_clients->execute();
$total_clients = $stmt_clients->fetch(PDO::FETCH_ASSOC)['total_clients'];

// Query to get the total number of products
$sql_products = "SELECT COUNT(*) AS total_products FROM produits";
$stmt_products = $conn->prepare($sql_products);
$stmt_products->execute();
$total_products = $stmt_products->fetch(PDO::FETCH_ASSOC)['total_products'];


$sql_orders = "SELECT COUNT(*) AS total_orders FROM commandes";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->execute();
$total_orders = $stmt_orders->fetch(PDO::FETCH_ASSOC)['total_orders'];
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../output.css" />
  </head>
  
  <body class="bg-gray-100">
    <!-- Navigation -->
    <?php include "../includes/admin-nav.php"?>
    <!-- Contenu Principal -->
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4 mx-8">
            Bienvenue sur le Tableau de Bord Administrateur
        </h1>
        <div class="grid grid-cols-3 mx-8 gap-8">
            <div class="bg-white p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                <h2 class="text-lg font-semibold mb-2">Total Clients</h2>
                <p class="text-gray-600 text-xl"><?php echo $total_clients; ?></p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                <h2 class="text-lg font-semibold mb-2">Total Produits</h2>
                <p class="text-gray-600 text-xl"><?php echo $total_products; ?></p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                <h2 class="text-lg font-semibold mb-2">Total Commandes</h2>
                <p class="text-gray-600 text-xl"><?php echo $total_orders; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
