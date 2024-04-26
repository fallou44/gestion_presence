<?php
session_start();
require_once '../models/Authmodel.php';

// Vérification des données de formulaire
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Récupération des utilisateurs depuis le fichier CSV
    $users = getUsers();

    // Vérification des informations de connexion
    $authenticatedUser = authenticateUser($users, $email, $password);
    if($authenticatedUser) {
        if(isAdmin($authenticatedUser)) {
            $_SESSION['user'] = $authenticatedUser;
            header('Location: ../view/index.html.php');
            exit();
        } else {
            // Vérification du rôle
            $roleError = validateRole($authenticatedUser);
            if(empty($roleError)) {
                $_SESSION['user'] = $authenticatedUser;
                header('Location: ../view/index.html.php');
                exit();
            } else {
                // Affichage de l'erreur de rôle
                $errorMessage = $roleError;
            }
        }
    } else {
        // Vérification des erreurs
        $errorMessage = "Email ou mot de passe incorrect";
        $emailError = validateEmail($email, $users);
        $passwordError = validatePassword($password, $users);
        require '../view/login.html.php';
    }
} else {
    // Formulaire non soumis, affichage de la page de connexion
    require '../view/login.html.php';
}
?>
