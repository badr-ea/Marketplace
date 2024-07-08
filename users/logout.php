<?php
// Start session
session_start();
echo "Chargement...";
sleep(2);
// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the index page
header("Location: ../index.php");
exit();
?>
