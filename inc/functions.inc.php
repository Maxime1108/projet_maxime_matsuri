<?php

// Ici on va retrouver toutes les fonctions globales utilisées à divers endroits de l'application, comme : 

// Fonction de redirection 

function addLink($controller, $method = 'list', $id = null)
{
    return ROOT . "$controller/$method" . ($id ? "/$id" : "");
    // Exemple : addLink('home','list');
}

function redirection($url)
{
    header("Location: $url");
    exit;
    // Exemple redirection('/errors/403.php');
    // Autre Exemple redirection(addLink('user','login'))
}

function debug($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function d_die($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die;
}

function error($num = 404){
    redirection("errors/$num.php");
    exit;
}
