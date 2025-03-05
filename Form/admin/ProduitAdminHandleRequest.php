<?php

namespace Form\Admin;

use Form\BaseHandleRequest;
use Model\Entity\Produit;
use Services\HandleImage;

class ProduitAdminHandleRequest extends BaseHandleRequest
{
    public function addAdminProduct(Produit $produit)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_admin_product'])) { // Si la méthode de requête est POST et que la clé 'add_admin_product' existe dans ce $_POST alors c'est bon !
            extract($_POST);
            if ($_FILES['image']['size'] <= 0) {
                throw new \Exception('Le produit a besoin d\'une image');
            }
            if (empty($title) || empty($prix) ||  empty($categorie || empty($description))) {
                throw new \Exception('Tous les champs doivent être remplis !');
            }

            // d_die($produit); // Ici produit est vide 

            $produit->setTitle($title)->setDescription($description)->setCategorie($categorie)->setPrix($prix)->setTopVente();

            // d_die($produit); // Ici il est rempli grâce aux setters (setTitle, setDescription etc), les valeurs sont ce qu'on récupère dans $_POST (donc dans le formulaire)

            // C'est pas fini, on doit changer le REPOSITORY maintenant pour lui qu'il doit aussi envoyer la description dans la base de données 

            // au dessus on dit : On a un objet produit , avant d'arriver là il est null parce qu'il vient d'être instancié 
            HandleImage::handleImage($produit);
            return $this;
        }
    }
}
