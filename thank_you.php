<?php
session_start();
if (!isset($_SESSION['transaction_completed']) || $_SESSION['transaction_completed'] !== true) {
    header("Location: index.php");
    exit();
}

unset($_SESSION['transaction_completed']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <link href="output.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .success-bg {
            background-color: #F0FFF4; /* Light green */
        }
        .success-text {
            color: #00796B; /* Dark green */
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full success-bg">
        <h2 class="text-3xl font-semibold mb-4 success-text">Merci pour votre commande!</h2>
        <p class="text-lg mb-4 success-text">Votre commande a été confirmée avec succès.</p>
        <p class="text-lg mb-4 success-text">Vous allez être redirigé vers la page d'accueil dans quelques instants.</p>
    </div>

    <?php
    header("refresh:5;url=index.php");
    ?>
</body>
</html>
