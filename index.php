<?php
// Projet: Association XYZ
// Script: Contrôleur Principal index.php
// Description: Gère les actions à réaliser et dispatche dans les contrôleurs secondaires 
// Auteur: Novice Entreprise 
// Version 1.0.0 PC 02.10.2017 / Codage initial

/*
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_URL);
if (empty($action)) {
    $action = 'home';
}

$role = getRole();


// routage explicite entre les actions et les contrôleurs
// le routage implicite est à éviter, car il sera tôt ou tard à l'origine 
// d'un oubli et d'une faille
$routes = array(
    'anonymous' => array(
        'home' => 'home',
        'edituser' => 'edituser',
        'saveuser' => 'saveuser',
        'login' => 'login',
        'guestbook' => 'guestbook',
        'registration' => 'edituser',
        'default' => 'home'
    ),
    'banned' => array(
        'home' => 'home',
        'logout' => 'logout',
        'guestbook' => 'guestbook',
        'default' => 'home'
    ),
    'member' => array(
        'home' => 'home',
        'edituser' => 'edituser',
        'saveuser' => 'saveuser',
        'guestbook' => 'guestbook',
        'savemessage' => 'savemessage',
        'logout' => 'logout',
        'default' => 'home'
    ),
    'admin' => array(
        'home' => 'home',
        'listusers' => 'listusers',
        'edituser' => 'edituser',
        'saveuser' => 'saveuser',
        'deleteuser' => 'deleteuser',
        'guestbook' => 'guestbook',
        'savemessage' => 'savemessage',
        'logout' => 'logout',
        'default' => 'home'
    )
    
);

try {
    // si la route existe pour le role choisi, on l'utilise
    if (isset($routes[$role][$action])){
        $route = $routes[$role][$action];
    } else {
        // sinon on prend la route par défaut
        $route = $routes[$role]['default'];
        SetMessageFlash("Action non définie ($action)");
    }
    require_once "controllers/$route.php";
} catch (Exception $e) {
    require_once 'views/500.php';
}
*/
require_once '/controllers/home.php';