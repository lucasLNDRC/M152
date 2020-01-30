<?php
// Projet: Association XYZ
// Script: Vue 500.php
// Description: Page d'erreur du serveur, très volubile en développement, 
// et beaucoup moins en recettage ou en production 
// Auteur: Novice Entreprise
// Version 1.0.0 PC 02.10.2017 / Codage initial

require_once 'model/config.php';

$pageTitle = "Erreur 500";

include "header.php";
?>

<div class="row">
    <div class="col-sm-12">
        <h4 class='alert alert-danger'>Une erreur interne s'est produite</h4>
    </div>

</div>
<?php if (APP_STATUS == "dev"): ?>
    <div class="row">
        <div class="col-sm-12">
            <p>Message d'erreur :</p>
            <pre><?= $e->getMessage(); ?></pre>
            <pre><?= $e->getTraceAsString(); ?></pre>
            <p>Liste des paramètres reçus en GET :</p>
            <pre><?= var_dump($_GET) ?></pre>
            <p>Liste des paramètres reçus en POST :</p>
            <pre><?= var_dump($_POST) ?></pre>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-sm-12">
            <p>Veuillez prendre contact avec le responsable de l'application</p>
        </div>
    </div>
<?php endif; ?>

<?php
include "footer.php";
