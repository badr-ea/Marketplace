<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Utilisateur</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-gray-100">
    <?php include "../includes/admin-nav.php" ?>
    <div class="container mx-auto my-8 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Ajouter un Utilisateur</h1>
            <form action="ajout-client.php" method="POST">
                <div class="mb-4">
                    <label for="nom_utilisateur" class="block text-gray-700 font-bold mb-2">Nom d'utilisateur</label>
                    <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Adresse Email</label>
                    <input type="email" id="email" name="email" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="mot_de_passe" class="block text-gray-700 font-bold mb-2">Mot de Passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-bold mb-2">Rôle</label>
                    <select id="role" name="role" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:border-blue-500">
                        <option value="client">Client</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter Utilisateur</button>
            </form>
        </div>
    </div>
</body>
</html>
