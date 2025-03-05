<?php

// Init.inc.php est notre fichier de configuration, il permet : 

/*
    Configurer nos constantes globales
    Démarrer la session pour éviter d'avoir à le faire à chaque page
    Configurer l'autoloading pour charger automatiquement les classes necessaires
    Inclure les fonctions pour les rendre accessibles globalement
*/

// Pour rappel : chaque requête effectuée est dirigée vers Index.php, qui lui même inclut init.inc.php, Cela fait que toutes les configurations ici présentes seront appliquées.

// require avant la session pour éviter les erreurs
require 'autoload.php';
session_start();
include __DIR__ . "/functions.inc.php";

const ROOT = '/projet_maxime/';
$exception_erreur = '';