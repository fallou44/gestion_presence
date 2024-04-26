<?php
// session_start();

$role = isset($_SESSION['user'][3]) ? $_SESSION['user'][3] : '';
$enabled_links = array(
    '/promotion',
    '/referentiel',
    '/apprenant',
    '/presence',
    '/evénement'
);

$lien = ""; // Variable pour stocker la classe de lien

// Vérifier le rôle de l'utilisateur et déterminer les liens activés et désactivés en conséquence
if ($role === 'Administrateur') {
    $lien = "enabled-link";
} elseif ($role === 'Apprenant') {
    $lien = "disabled-link";
    // Désactiver tous les liens sauf '/presence' et '/evénement'
    $enabled_links = array('/presence', '/evénement');
} else {
    // Définir un comportement par défaut si le rôle n'est pas défini ou n'est ni Administrateur ni Apprenant
    $lien = "disabled-link";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-SONATEL ACADEMY-</title>
    <link rel="stylesheet" href="../public/css<?=$uri?>.css">
    <link rel="stylesheet" href="public/css/main.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/d2ba3c872c.js" crossorigin="anonymous"></script>
</head>
<body>
<input type="checkbox" id="menu_checkbox">
<header class="header">
    <div class="flex-left">
        <label for="menu_checkbox">
            <div><i class="fa fa-bars" aria-hidden="true"></i></div>
            <div><i class="fa-solid fa-circle-arrow-right"></i></div>
        </label>
        <div class="icons">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                </svg>
            </div>
        </div>
        <form action="#" method="post" class="search-form">
            <input type="text" name="search" required placeholder="Rechercher..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
        </form>
    </div>
    <div class="flex-right">
        <input type="date" name="" id="" value="<?= date('Y-m-d');?>">
        <div class="profil">
            <img src="https://imgs.search.brave.com/2-mL1a95ogQh8F5fREvDxO2fqfBcc_0MGdgKFosZjwU/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9wbHVz/cG5nLmNvbS9pbWct/cG5nL3VzZXItcG5n/LWljb24tdXNlci0y/LWljb24tcG5nLWZp/bGUtNTEyeDUxMi1w/aXhlbC01MTIucG5n" style="width: 35px;" class="image" alt="">
            <div class="info">
                <p><?= isset($_SESSION['user']) ? $_SESSION['user'][0] : 'Utilisateur non connecté' ?></p>
                <form action="logout.php" method="post">
                <select name="role" id="role" style="border-radius: 5px; border: 1px solid black; margin-top: 10px; background-color: white ; text-align: center; " >
    <?php if(isset($_SESSION['user'])): ?>
        <option value="admin" <?= $role === 'Administrateur' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $role === 'Apprenant' ? 'selected' : '' ?>>Apprenant</option>
        <option value="logout">Déconnexion</option>
    <?php else: ?>
        <option value="guest">Invité</option>
    <?php endif; ?>
</select>

                </form>
            </div>
        </div>
    </div>
</header>




<div class="side-bar"  >

    <div id="close-btn">
        <i class="fas fa-times"></i>
    </div>

    <div class="profile">
        <img src="public/images/sonatel.png" class="image" alt="">
        <h3 class="menu">- menu</h3>
    </div>
    <!-- <nav class="navbar"  >
        <a href="#" class="<?=$lien?>"><i class="fa fa-align-right" aria-hidden="true"></i><span>Dashboard</span></a>
        <a href="/promotion" class="<?=$lien?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>promos</span></a>
        <a href="/referentiel" class="<?=$lien?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i><span>Référentiels</span></a>
        <a href="/apprenant" class="<?=$lien?>"> <i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Utilisateurs</span></a>
        <a href="#" class="<?=$lien?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Visiteurs</span></a>
        <a href="/presence" class="<?=$lien?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Presence</span></a>
        <a href="#" class="<?=$lien?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i><span>Événements</span></a>

    </nav> -->
    <nav class="navbar">
    <a href="" class="<?= in_array('/dashboard', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-align-right" aria-hidden="true"></i><span>Dashboard</span></a>
    <a href="/promotion" class="<?= in_array('/promotion', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Promos</span></a>
    <a href="/referentiel" class="<?= in_array('/referentiel', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i><span>Référentiels</span></a>
    <a href="/apprenant" class="<?= in_array('/apprenant', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Utilisateurs</span></a>
    <a href="#" class="<?= in_array('/visiteurs', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Visiteurs</span></a>
    <a href="/presence" class="<?= in_array('/presence', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Presence</span></a>
    <a href="/evenement" class="<   ?= in_array('/evenement', $enabled_links) ? 'enabled-link' : 'disabled-link' ?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i><span>Événements</span></a>
</nav>


</div>
<style>
    .disabled-link {
        pointer-events: none; /* Empêche le clic */
        opacity: 0.5; /* Réduit l'opacité pour indiquer qu'il est désactivé */
        cursor: not-allowed; /* Change le curseur pour indiquer qu'il est désactivé */
    }

    .enabled-link {
        pointer-events: auto; /* Permet les événements du pointeur */
        opacity: 1; /* Augmente l'opacité pour indiquer qu'il est activé */
        cursor: pointer; /* Change le curseur pour indiquer qu'il est autorisé */
    }
</style>


<section class="home-section">


<script>
    document.getElementById('role').addEventListener('change', function() {
        var selectedOption = this.value;
        if (selectedOption === 'logout') {
            window.location.href = 'view/login.html.php'; // Redirige vers la page de déconnexion
        }
    });
</script>
