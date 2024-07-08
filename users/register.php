<?php
require_once '../config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (!empty($username) && !empty($email) && !empty($password)) {
            try {
                // Check if email already exists
                $sql_check_email = "SELECT COUNT(*) FROM utilisateurs WHERE email = ?";
                $stmt_check_email = $conn->prepare($sql_check_email);
                $stmt_check_email->execute([$email]);
                $email_count = $stmt_check_email->fetchColumn();
                
                if ($email_count > 0) {
                    echo "L'adresse e-mail existe déjà.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    $sql = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$username, $email, $hashed_password]);

                    $user_id = $conn->lastInsertId();
                    
                    // Store user information in session
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user_id;
                    
                    header("Location: index.php");
                    exit();
                }
            } catch (PDOException $e) {
                echo "Erreur lors de l'inscription : " . $e->getMessage();
            }
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    } else {
        echo "Certains champs sont manquants.";
    }
}
?>
