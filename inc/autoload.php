<?php 

function chargeClass($className){
    // Remplace les antislash par des slash pour le chemin du fichier
    $filePath = str_replace('\\','/',$className);

    // Construit le chemin complet du fichier de la classe
    $root = __DIR__ . "/../$filePath.php";

    if(file_exists($root)){
        require $root;
    } else {
        throw new Exception ("La classe $className n'a pas été trouvée");
    }

   
} 
// Enregistre la fonction chargeClass pour qu'elle soit automatiquement appelée pour charger les classes
spl_autoload_register("chargeClass");