<?php
// Projet: Association XYZ
// Script: session.php
// Description: Librairie de fonction en lien avec la gestion des roles à l'aide de la session
// Auteur: Novice Entreprise
// Version 1.0.0 PC 02.10.2017 / Codage initial


// Si la session n'est pas encore démarrée, elle est démarrée ici.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Indique si l'utilisateur courant est administrateur ou non
 * @return boolean vrai si l'utilisateur est un administrateur, sinon faux
 */
function isAdmin() {
    return ((isset($_SESSION['user'])) && ($_SESSION['user']['status'] == 'admin'));
}

/**
 * Indique si l'utilisateur courant est identifié ou non
 * Un utilisateur identifié est soit un membre, soit un admininstrateur
 * @return boolean vrai si l'utilisateur est identifié, sinon faux
 */
function isMember() {
    return ((isset($_SESSION['user'])) && (in_array($_SESSION['user']['status'], array('member', 'admin'))));
}

/**
 * Indique si l'utilisateur courant est banni ou non
 * @return boolean vrai si l'utilisateur est banni, sinon faux
 */
function isBanned() {
    return ((isset($_SESSION['user'])) && ($_SESSION['user']['status'] == 'banned'));
}

/**
 * Indique si l'utilisateur courant correspond à l'id passé en paramètes
 * @return boolean vrai si l'utilisateur est correspond, sino faux
 */
function isOwner($idUser) {
    return ((isset($_SESSION['user'])) && ($_SESSION['user']['idUser'] == $idUser));
}

/**
 * Indique si l'utilisateur courant est anonyme ou non
 * @return boolean vrai si l'utilisateur n'est pas identifié, sinon faux
 */
function isAnonymous() {
    return ((empty($_SESSION['user'])));
}

/**
 * Retourne le role actuel de l'utilisateur courant
 * @return string le role de l'utilisateur
 */
function getRole() {
    if (empty($_SESSION['user'])) {
        $role = 'anonymous';
    } else {
        $role = $_SESSION['user']['status'];
    }
    return $role;
}

/**
 * Retourne l'id de l'utilisateur courrant
 * @return int/null l'id de l'utilisateur ou null s'il n'est pas identifié
 */
function getSessionUserId() {
    if (isset($_SESSION['user']['idUser'])) {
        return $_SESSION['user']['idUser'];
    } else {
        return null;
    }
}
