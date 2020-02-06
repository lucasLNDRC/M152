<?php
// Projet: Association XYZ
// Script: Contrôleur Principal index.php
// Description: Gère les actions à réaliser et dispatche dans les contrôleurs secondaires 
// Auteur: Novice Entreprise 
// Version 1.0.0 PC 02.10.2017 / Codage initial

require_once 'model/session.php';
require_once 'model/db.php';
$db = new Db;
$db->Db();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_URL);
if (empty($action)) {
    $action = 'home';
}

$role = getRole();
var_dump($action, $role, $_POST);

// routage explicite entre les actions et les contrôleurs
// le routage implicite est à éviter, car il sera tôt ou tard à l'origine 
// d'un oubli et d'une faille
$routes = array(
    'anonymous' => array(
        'home' => 'home',
        'post' => 'post',
        'default'=>'home'
    ),
    'banned' => array(
        'home' => 'home',
        'default'=>'home'
    ),
    'member' => array(
        'home' => 'home',
        'post' => 'post',
        'default'=>'home'
    ),
    'admin' => array(
        'home' => 'home',
        'post' => 'post',
        'default'=>'home'
    )
    
);
var_dump($routes[$role][$action]);
try {
    // si la route existe pour le role choisi, on l'utilise
    if (isset($routes[$role][$action])){
        $route = $routes[$role][$action];
        
    } else {
        // sinon on prend la route par défaut
        $route = $routes[$role]['default'];
    }
    require_once "controllers/$route.php";
} catch (Exception $e) {
   die("Impossible de se connecter à la base ". $e->getMessage());
   require_once 'views/500.php';
}