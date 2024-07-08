<div class="flex items-center border-b border-gray-200 pb-4 mb-4">
    <img src="<?php echo $item['chemin_image']; ?>" alt="Image du produit" class="w-20 h-20 mr-4">
    <div>
        <h3 class="text-lg font-semibold"><?php echo $item['nom']; ?></h3>
        <p class="text-gray-600">Prix : <?php echo $item['prix']; ?> MAD</p>
        <div class="flex items-center mt-2">
            <!-- Input field for quantity -->
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="number" name="quantity" min="1" max="<?php echo $item['stock'] ?>" class="w-16 h-10 border border-gray-300 rounded-md text-center" value="<?php echo $item['quantity']?>">
                <button type="submit" name="update_quantity" class="ml-2 bg-blue-500 text-white px-4 py-1 rounded-md">Modifier</button>
            </form>
            <!-- Form for removing from cart -->
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="remove_from_cart" class="ml-2 bg-red-500 text-white px-4 py-1 rounded-md">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['remove_from_cart'], $_POST['product_id'])) {
        // Vérifie si product_id n'est pas vide et est un entier valide
        if(!empty($_POST['product_id']) && filter_var($_POST['product_id'], FILTER_VALIDATE_INT)) {
            session_start();
            $id = $_POST['product_id'];
            // Vérifie si le produit existe dans le panier
            if(isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
                // Facultatif : vous pouvez rediriger l'utilisateur vers la page du panier ou afficher un message de succès
                header("Location: cart.php");
                exit(); // Arrête l'exécution ultérieure
            } else {
                $error = "Produit introuvable dans le panier.";
            }
        } else {
            $error = "ID de produit invalide.";
        }
    } elseif (isset($_POST['update_quantity'], $_POST['product_id'], $_POST['quantity'])) {
        // Handle quantity update
        // Vérifie si product_id n'est pas vide et est un entier valide
        if(!empty($_POST['product_id']) && filter_var($_POST['product_id'], FILTER_VALIDATE_INT)) {
            session_start();
            $id = $_POST['product_id'];
            // Vérifie si le produit existe dans le panier
            if(isset($_SESSION['cart'][$id])) {
                // Met à jour la quantité du produit dans le panier
                $_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];
                // Facultatif : vous pouvez rediriger l'utilisateur vers la page du panier ou afficher un message de succès
                header("Location: cart.php");
                exit(); // Arrête l'exécution ultérieure
            } else {
                $error = "Produit introuvable dans le panier.";
            }
        } else {
            $error = "ID de produit invalide.";
        }
    } else {
        $error = "Requête invalide.";
    }
}

// Affiche le message d'erreur s'il existe
if(isset($error)) {
    header("Location: error.php");
}
?>
