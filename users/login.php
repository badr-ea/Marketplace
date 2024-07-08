<?php
require_once '../config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (!empty($email) && !empty($password)) {
            try {
                // Retrieve user record based on email
                $sql_get_user = "SELECT * FROM utilisateurs WHERE email = ?";
                $stmt_get_user = $conn->prepare($sql_get_user);
                $stmt_get_user->execute([$email]);
                $user = $stmt_get_user->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    // Verify password
                    if (password_verify($password, $user['mot_de_passe'])) {
                        // Password is correct, set session variables
                        $_SESSION['username'] = $user['nom_utilisateur'];
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role'] = $user['role'];
                        
                        // Check if the user has the role "admin"
                        if ($user['role'] === 'admin') {
                            header("Location: ../admin/");
                            exit();
                        } else {
                            header("Location: ../index.php");
                            exit();
                        }
                    } else {
                        echo "Mot de passe incorrect.";
                    }
                } else {
                    echo "Aucun utilisateur trouvé avec cet email.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion : " . $e->getMessage();
            }
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    } else {
        echo "Certains champs sont manquants.";
    }
}
?>
