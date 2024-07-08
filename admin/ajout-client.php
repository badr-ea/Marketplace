<?php
// Inclure la connexion à la base de données
require_once "../config/db.php";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $role = $_POST["role"];

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        // Vérifier si l'e-mail existe déjà
        $sql_check_email = "SELECT id FROM utilisateurs WHERE email = :email";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bindParam(':email', $email);
        $stmt_check_email->execute();

        if ($stmt_check_email->rowCount() > 0) {
            // L'e-mail existe déjà, afficher un message d'erreur
            echo "Erreur : Cet e-mail est déjà utilisé.";
        } else {
            // L'e-mail n'existe pas, procéder à l'insertion dans la base de données
            $sql_insert_user = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe, role)
                                VALUES (:nom_utilisateur, :email, :mot_de_passe, :role)";

            // Préparer l'instruction SQL
            $stmt_insert_user = $conn->prepare($sql_insert_user);

            // Liée les paramètres
            $stmt_insert_user->bindParam(':nom_utilisateur', $nom_utilisateur);
            $stmt_insert_user->bindParam(':email', $email);
            $stmt_insert_user->bindParam(':mot_de_passe', $mot_de_passe_hash);
            $stmt_insert_user->bindParam(':role', $role);

            // Exécuter l'instruction préparée
            $stmt_insert_user->execute();

            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../success.php?success=true&msg=Utilisateur ajouté avec succès !");
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        echo "Erreur : " . $e->getMessage();
    }
}
?>
