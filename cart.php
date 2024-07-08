<?php
  session_start();
  if(!isset($_SESSION['role'])) {
    header("Location: login.html");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panier d'Achat</title>
  <link href="output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 relative">
  <?php include "includes/navbar.php"?>
  <div class="container mx-4 py-10">
    <h1 class="text-2xl font-semibold mb-6">Panier d'achat</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Articles du panier -->
      <div class="col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Votre panier</h2>
        <!-- Articles individuels du panier -->
        <?php include "includes/getCartItems.php"?>
        <!-- Répétez ce bloc pour chaque article dans le panier -->
      </div>
    </div>
  </div>

  <?php
    $nbrItems = 0;
    $totalPrice = 0;
    if(isset($_SESSION['cart'])) {
      foreach($_SESSION['cart'] as $item) {
        $nbrItems += $item['quantity'];
        $totalPrice += $item['quantity'] * $item['prix'];
      }
    }
  ?>

  <!-- Résumé du panier -->
  <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <div class="absolute top-44 right-0 bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4">Résumé du panier</h2>
        <form method="post" action="users/checkout.php">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg">Nombre total d'articles :</span>
                <span class="text-lg font-semibold"><?php echo $nbrItems?></span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg">Prix total :</span>
                <span class="text-lg font-semibold"><?php echo number_format($totalPrice, 2, '.', '') ?> MAD</span>
            </div>
            <button type="submit" class="w-full bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Payer</button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
