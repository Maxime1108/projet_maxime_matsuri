<?php

namespace Controller;

use Model\Entity\Produit;
use Model\Repository\ProduitsRepository;
use Services\Protect;

class ProduitsController extends BaseController
{
    private ProduitsRepository $produitsRepository;
    private Produit $produit;
    public function __construct()
    {
        $this->produitsRepository = new ProduitsRepository();
        $this->produit = new Produit();
    }

    // Méthode pour l'affichage des produits selon la catégorie
    public function index()
    {
        // On récupère la catégorie de $_GET si elle y est, sinon la catégorie par défaut sera 'all'
        $categorie = $_GET['categorie'] ?? 'all';

        // Si la catégorie est différente de all c'est qu'elle existe, donc on va la chercher avec le répository, sinon on récupère tous les produits par défaut
        $produits = ($categorie !== 'all') ? $this->produitsRepository->findProduitsByCategories($categorie) : $this->produitsRepository->findAll($this->produit);

        // On échappe (protège) les produits pour éviter les attaques grâce à notre méthode statique protectHTMLSpecialChars de notre service Protect
        if ($produits) {
            $produits = Protect::protectHtMLSpecialChars($produits);
        }

        return $this->render('produits/index.html.php', [
            'produits' => $produits,
            'categorie' => $categorie
        ]);
    }

    // Méthode pour le details des produits (int $id est l'id qu'on récupère de la fonction addLink('produits','details','id')) 
    public function details(int $id)
    {
        // On récupère LE produit recherché grâce à son id dans la base de données
        $produit = $this->produitsRepository->findById($this->produit, $id);
        // d_die($produit);
        // On passe le produit à la vue
        $this->render('produits/details_produit.html.php', ['produit' => $produit]);
    }
}


