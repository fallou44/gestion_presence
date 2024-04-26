<?php
session_start();

if (isset($_GET['promo'])) {
    $_SESSION['SESSION'] = $_GET['promo'] ?: 'P6';
}

require_once 'config/helpers.php';
require_once 'config/bootstrap.php';
require_once 'config/csv_fonction.php';

$route = [
    '/'           => "login",
    '/apprenant' => 'apprenant',
    '/presence'  => 'presence',
    '/promotion' => 'promotion',
    '/referentiel' => 'referentiel',
    '/promo_ajout' => 'promo_ajout',
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Vérifiez si l'URI demandée est la racine, si oui, redirigez vers la page de connexion
if ($uri === '/') {
    // Redirection vers la page de connexion
    header("Location: view/login.html.php");
    exit(); // Assurez-vous de sortir du script après la redirection
}

require_once "models/" . $uri . ".model.php";
require_once 'view/partial/header.html.php';

if (array_key_exists($uri, $route)) {
    require_once "view/" . $route[$uri] . ".html.php";
}

require_once 'view/partial/footer.html.php';
?>
