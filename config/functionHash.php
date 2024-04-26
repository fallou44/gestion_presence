<?php
// Générer un mot de passe aléatoire
$password = "votre_mot_de_passe";

// Crypter le mot de passe avec bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

echo $hashedPassword;



// Cela garantira que vos mots de passe sont sécurisés et cryptés dans l'application.

// Supposons que $hashedPassword soit le mot de passe crypté stocké dans votre fichier utilisateur
$userInputPassword = "mot_de_passe_utilisateur";

// Vérifier si le mot de passe entré correspond au mot de passe crypté
if (password_verify($userInputPassword, $hashedPassword)) {
    echo "Mot de passe correct !";
} else {
    echo "Mot de passe incorrect !";
}

?>