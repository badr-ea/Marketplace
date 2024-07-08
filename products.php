<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recherche</title>
  <link rel="stylesheet" href="output.css" />
</head>

<body class="bg-gray-100 h-fit">
  <?php include 'includes/navbar.php' ?>

  <div class="container mx-auto flex py-10">
    <div class="w-1/4 mr-4 bg-white p-6 rounded-md shadow-md">
      <h2 class="text-lg font-semibold mb-4">Filtrer les produits</h2>
      <form action="" method="GET">
        <input type="text" name="search" placeholder="Rechercher des produits..." class="w-full mb-2 p-2 border border-gray-300 rounded-md">
        <input type="number" name="min_price" placeholder="Prix minimum" class="w-full mb-2 p-2 border border-gray-300 rounded-md">
        <input type="number" name="max_price" placeholder="Prix maximum" class="w-full mb-2 p-2 border border-gray-300 rounded-md">
        <select name="category" class="w-full mb-2 p-2 border border-gray-300 rounded-md">
          <option value="">Toutes les catégories</option>

          <?php require_once "config/db.php";
                        $query = "SELECT * FROM categories";
                        $result = $conn->query($query);
                        if($result->rowCount() > 0) {
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $nom = $row['nom'];
                                $id = $row['id'];
                                echo "<option value='$id'>$nom</option>";
                            }
                        }
                        ?>
        </select>
        <div class="mb-2">
          <label class="block mb-1">Trier par prix :</label>
          <select name="sort_price" class="w-full p-2 border border-gray-300 rounded-md">
            <option value="">Aucun</option>
            <option value="asc">Prix : du plus bas au plus élevé</option>
            <option value="desc">Prix : du plus élevé au plus bas</option>
          </select>
        </div>
        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Rechercher</button>
      </form>
    </div>

    <div class="w-3/4 grid grid-cols-4 gap-4">
      
      <?php include "includes/getProductsByDes.php"?>
    </div>
  </div>
  
</body>
<?php include "includes/footer.html" ?>

</html>