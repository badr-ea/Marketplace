<?php
// Check if the product has been added to the cart
if(isset($_POST['add_to_cart'])) {
    // Initialize the cart session variable if it doesn't exist
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Query to fetch product details from the database
    $query = "SELECT * FROM produits WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $cartRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($cartRow) {
    
        $cartRow['quantity'] = $quantity;
        $_SESSION['cart'][$product_id] = $cartRow;
        
    } else {
        echo "<p>Produit non trouvé.</p>";
    }
}
?>

<div class="max-w-xs bg-white shadow-md rounded-lg overflow-hidden">
    <img class="w-full h-64 object-cover" src="<?php echo $row['chemin_image'] ?>" alt="Image du produit">
    <div class="p-4">
        <h2 class="text-gray-800 font-bold text-xl mb-2"><?php echo $row['nom'] ?></h2>
        <p class="text-gray-600 text-sm"><?php echo $row['description'] ?></p>
        <p class="text-gray-600 text-sm">Prix : <?php echo $row['prix'] ?> MAD</p>
        <div class="flex items-center justify-between mt-4">
            <form method="post">
                <!-- Add product_id as a hidden input -->
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <!-- Input field for quantity -->
                <input type="number" name="quantity" min="1" max="<?php echo $row['stock'] ?>" class="w-16 px-3 py-1 border rounded-lg text-gray-700 focus:outline-none flex-grow" value="1" min="1">
                <!-- Add to cart button -->
                <button type="submit" name="add_to_cart" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>
