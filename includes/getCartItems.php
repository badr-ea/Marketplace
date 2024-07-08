<?php
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Parcours chaque élément dans le panier
    foreach($_SESSION['cart'] as $product_id => $item) {
        // Inclut le modèle d'élément du panier
        include "cart_item.php";
    }
} else {
    echo "<p>Votre panier est vide.</p>";
}
?>