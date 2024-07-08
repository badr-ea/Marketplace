<?php
    require "config/db.php";
    $query = "SELECT * FROM produits ORDER BY RAND() LIMIT 8";
    $result = $conn->query($query);

    if($result->rowCount() > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row['stock'] === 0) continue;
            include "produit.php";
        }
    }

?>