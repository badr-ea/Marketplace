<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Utilisateur</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-gray-100">
    <?php include "../includes/admin-nav.php" ?>
    <div class="container mx-auto my-8 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Supprimer un Utilisateur</h1>
            <form action="suppression-client.php" method="POST">
                <div class="mb-4">
                    <label for="id" class="block text-gray-700 font-bold mb-2">ID d'utilisateur</label>
                    <input type="text" id="id" name="id" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer Utilisateur</button>
            </form>
        </div>
    </div>
</body>
</html>
