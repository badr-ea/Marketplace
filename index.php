<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil</title>
  <link rel="stylesheet" href="output.css" />
</head>

<body class="bg-gray-100">
  <?php include 'includes/navbar.php' ?>

  <div class="grid grid-cols-4 gap-4 m-10">

    <?php include "includes/getProducts.php" ?>

  </div>

 <?php include "includes/footer.html" ?>



</body>

</html>