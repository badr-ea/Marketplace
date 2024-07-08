<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Catégorie</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-gray-100">
    <?php include "../includes/admin-nav.php" ?>
    <div class="container mx-auto my-8 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Ajouter une Catégorie</h1>
            <form action="ajout-cat.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-bold mb-2">Nom de Catégorie</label>
                    <input type="text" id="nom" name="nom" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter Catégorie</button>
            </form>
        </div>
    </div>

</body>
</html>