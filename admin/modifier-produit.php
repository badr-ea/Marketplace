<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-gray-100">
    <?php include "../includes/admin-nav.php" ?>
    <div class="container mx-auto my-8 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Modifier un Produit</h1>
            <form action="modification-produit.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="id" class="block text-gray-700 font-bold mb-2">ID du Produit</label>
                    <input type="text" id="id" name="id" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-bold mb-2">Nom du Produit</label>
                    <input type="text" id="nom" name="nom" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea id="description" name="description" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" rows="4" ></textarea>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-gray-700 font-bold mb-2">Prix (MAD)</label>
                    <input type="number" id="prix" name="prix" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" step="0.01" min="0" >
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-bold mb-2">Stock</label>
                    <input type="number" id="stock" name="stock" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" min="0" >
                </div>
                <div class="mb-4">
                    <label for="categorie" class="block text-gray-700 font-bold mb-2">Catégorie</label>
                    <select id="categorie" name="categorie" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" >
                        <option value="" disabled selected>Sélectionner une catégorie</option>
                        <!-- Add options dynamically from database -->
                        <?php require_once "../config/db.php";
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
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="border rounded-lg w-full focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier Produit</button>
            </form>
        </div>
    </div>

</body>
</html>
