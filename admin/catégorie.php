<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-gray-100">
    <?php include "../includes/admin-nav.php" ?>
    <div class="flex flex-col mt-5 justify-around bg-gray-300 p-4">
        <a href="ajouter-catégorie.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter une catégorie</a>
        <a href="modifier-catégorie.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Modifier une catégorie</a>
        <a href="supprimer-catégorie.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Supprimer une catégorie</a>
    </div>
</body>
</html>