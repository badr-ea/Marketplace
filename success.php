<?php 
$success = isset($_GET['success']) && $_GET['success'] === 'true';
if (!$success) {
    header("Location: error.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succès</title>
    <link rel="stylesheet" href="output.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Succès</h1>
        <?php
        // Retrieve success message from URL parameter
        $successMsg = isset($_GET['msg']) ? $_GET['msg'] : "Opération réussie !";
        ?>
        <p class="text-green-600"><?php echo $successMsg; ?></p>
    </div>
</body>
</html>