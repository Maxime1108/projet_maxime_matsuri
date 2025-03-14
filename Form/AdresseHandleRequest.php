<?php

// On ajoute un formulaire pour l'adresse 

namespace Form;

use Exception;
use Model\Entity\Commande;

class AdresseHandleRequest extends BaseHandleRequest
{
    public function addAdresse(Commande $commande)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAdresse'])) {
     
            extract($_POST);
            if (empty($adresse) || empty($ville) || empty($pays) || empty($code_postal)) {
                throw new Exception('Merci de renseigner toutes les informations');
            }

            // On vérifie si le format est correct pour les adresse ville etc 

            // Accepte les lettres, chiffres, espaces et caractères spéciaux courants
            // Longueur minimum 3, maximum 100 caractères
            if (!preg_match('/^[a-zA-ZÀ-ÿ0-9\s\'\-\.,#\/]{3,100}$/u', $adresse)) {
                throw new Exception('Le format de l\'adresse est incorrect');
            }

            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\'\-]{2,50}$/u', $ville)) {
                throw new Exception('Le format de la ville est incorrect');
            }
            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\'\-]{2,50}$/u', $pays)) {
                throw new Exception('Le format du pays est incorrect');
            }

            if (!preg_match('/^[0-9]{5}$/', $code_postal)) {
                throw new Exception('le format code postal est incorrect');
            }

            // s'il n'y pas d'erreur, on rempli la commande avec les adresse
            $commande->setAdresse($adresse)->setPays($pays)->setVille($ville)->setCodePostal($code_postal);
            // on retourne ensuite l'objet commande
            return $commande;
        }
    }
}
