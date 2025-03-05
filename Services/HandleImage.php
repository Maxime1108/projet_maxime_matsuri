<?php

namespace Services;

use Exception;
use Model\Entity\Produit;

class HandleImage
{
    public static function handleImage(object $entity)
    {
        $fileType = ["jpg", "jpeg", "png", "gif", "svg", "webp", "avif"];
        // Emplacement où vous souhaitez enregistrer le fichier
        $chemin = ROOT . 'public/assets/img/';
        $target_dir = $chemin;
        // Construire un nom de fichier unique en ajoutant un horodatage au nom d'origine
        $originalFileName = basename($_FILES["image"]["name"]);
        $timestamp = time(); // Utilisation de l'horodatage actuel
        $uniqueFileName = $timestamp . "_" . $originalFileName;
        $target_file = $_SERVER['DOCUMENT_ROOT'] . $target_dir . $uniqueFileName;
        // Obtenir le type de l'image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Vérifier si le fichier est une image JPEG
        if (!in_array($imageFileType, $fileType)) {
           throw new Exception('Le format d image n est pas bon');
        } else {
            // Vérifier la taille de l'image (par exemple, 1 Mo)
            if ($_FILES["image"]["size"] > 1000000) {
              throw new Exception('la taille du fichier est trop volumineuse');
            } else {
                // Déplacer le fichier téléversé vers le répertoire cible
                // d_die($target_file);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                if ($entity instanceof Produit) {
                    $entity->setImage($uniqueFileName);
                }
            }
        }
    }
}
