<?php

use Dotenv\Dotenv;

require 'inc/init.inc.php';
require_once __DIR__ . '/vendor/autoload.php';
// Index.php est la porte d'entrée de notre application 
// Elle va récupérer nos URL's et les traiter pour les envoyer au bon contrôleur et à la bonne méthode

// On récupère les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// 1 . Vérification des paramètres de l'url
$admin = $_GET['doc'] ?? null; // Si l'URL a capturé /admin/ et l'a renvoyé, alors $_GET aura la clé doc, sinon la valeur sera null

$controller = $_GET['controller'] ?? 'home'; // Si le contrôleur a été entré, $controller prendra sa valeur, sinon par défaut il prendra la valeur home

$method = $_GET['method'] ?? 'index'; // Pareil que le contrôleur mais avec 'list'

$id = $_GET['id'] ?? null; // Les id sont optionnels dans l'URL, si aucun id n'a été renseigné, alors elle reste null

if (!empty($admin)) {
    // On construit le nom de la classe contrôleur avec une majuscule initiale
    $classController = "Controller\\admin\\" . ucfirst($controller) . "Controller";
} else {
    $classController = "Controller\\" . ucfirst($controller) . "Controller";
}

$controller = new $classController; // on envoie 'Controller\\NomDuControllerController' 

try {
    $controller->$method($id);
} catch (PDOException $e) {
    echo $e->getMessage();
}
