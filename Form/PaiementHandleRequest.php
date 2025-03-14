<?php

namespace   Form;

use Exception;

// T'arrives à suivre ou je vais trop vite? 

class PaiementHandleRequest extends BaseHandleRequest
{

    public function verificationPaiement()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_pay'])) {
            extract($_POST);

            if (empty($titulaire) || empty($num_carte) || empty($expire) || empty($cvv)) {
                throw new Exception('Merci de remplir tous les champs !');
            }
            // Regex pour le nom du titulaire de la carte
            // Accepte les lettres, espaces, tirets et apostrophes
            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\'\-]{3,50}$/u', $titulaire)) {
                throw new Exception('Le nom est invalide');
            }

            // Regex pour le numéro de carte (sans espaces)
            // Tous types de cartes (détection générique, longueur 13-19 chiffres)

            if (!preg_match('/^[0-9]{13,19}$/', $num_carte)) {
                throw new Exception('Le numero de carte est invalide');
            }

            // Date d'expiration (format MM/YY)
            // Accepte les dates de 01/00 à 12/99

            if (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $expire)) {
                throw new Exception('La date d\'expiration est invalide');
            }

            // Code de sécurité CVV
            // 3 chiffres (Visa, MasterCard) ou 4 chiffres (American Express)
            if (!preg_match('/^[0-9]{3,4}$/', $cvv)) {
                throw new Exception('le CVV est invalide');
            }

            // S'il a passé toutes les vérifications du dessus, c'est que tout est bon, on peut retourner true (on ne garde JAMAIS des numéros de carte bancaire)
            return true;
        }
    }
}
