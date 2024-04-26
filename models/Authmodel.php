<?php
define("CSV_FILE_PATH", "/var/www/html/projet_new/data/Auth/users.csv");

function getUsers() {
    return array_map('str_getcsv', file(CSV_FILE_PATH));
}

function authenticateUser($users, $email, $password) {
    foreach($users as $user) {
        if($user[1] === $email && $user[2] === $password) {
            return $user;
        }
    }
    return false;
}

function isAdmin($user) {
    return $user[3] === 'Administrateur';
}

function validateEmail($email, $users) {
    foreach($users as $user) {
        if($user[1] === $email) {
            return ""; // Email valide
        }
    }
    return "Email incorrect";
}

function validatePassword($password, $users) {
    foreach($users as $user) {
        if($user[2] === $password) {
            return ""; // Mot de passe valide
        }
    }
    return "Mot de passe incorrect";
}

function validateRole($user) {
    if(isAdmin($user)) {
        return ""; // Rôle valide
    }
    return "Vous n'avez pas les autorisations nécessaires pour vous connecter";
}
?>
