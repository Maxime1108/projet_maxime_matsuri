<?php

// On a besoin d'un controller bien sur pour gérer les requêtes des commandes 
namespace Controller;

use Form\AdresseHandleRequest;
use Form\PaiementHandleRequest;
use Model\Entity\Commande;
use Model\Entity\CommandeProduit;
use Model\Repository\CommandeProduitRepository;
use Model\Repository\CommandeRepository;

class CommandeController extends BaseController
{
    private Commande $commande;

    private CommandeRepository $commande_repository;
    private CommandeProduitRepository $commande_produit_repository;

    // On importe le géstionnaire du formulaire
    private AdresseHandleRequest $adresseHandleRequest;
    private PaiementHandleRequest $paiementHandleRequest;


    public function __construct()
    {
        $this->commande = new Commande;
        $this->commande_repository = new CommandeRepository();
        $this->commande_produit_repository = new CommandeProduitRepository();
        $this->adresseHandleRequest = new AdresseHandleRequest;
        $this->paiementHandleRequest = new PaiementHandleRequest;
    }

    public function index()
    {
        try {
 
            $panier = $_SESSION['cart'] ?? [];
            $total = $_SESSION['total'] ?? 0;

            $this->adresseHandleRequest->addAdresse($this->commande);

            if ($this->adresseHandleRequest->isSubmitted() && $this->adresseHandleRequest->isValid()) {

                $_SESSION['adresse'] = $this->commande;

                return redirection(addLink('commande', 'paiement'));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return $this->render('commande/adresse.html.php');
    }

    // On créer une méthode pour le formulaire de paiement 
    public function paiement()
    {
        try {
            $this->paiementHandleRequest->verificationPaiement();

            if ($this->paiementHandleRequest->isSubmitted() && $this->paiementHandleRequest->isValid()) {
                // si le paiement est valide, on va maintenant tout remplir (tout doit partir dans la base de données, ensuite on redirigera vers une page de confirmation de paiement par exemple !)

                $commande = $_SESSION['adresse'];
                $panier = $_SESSION['cart'];
                $total = $_SESSION['total'];

                $commande->setNumeroCommande('N°' . rand(500, 3000000) . uniqid('_', true))->setDateCommande()->setPrixTotal($total)->setUserId($_SESSION['user']['id']);

                // il faut avant envoyer la commande dans la base de donnée parce qu'on aura besoin de son id

                $commandeId = $this->commande_repository->insertCommande($commande);


                foreach ($panier as $p) {

                    $commandeProduit = new CommandeProduit;

                    
                    $commandeProduit->setCommandeId($commandeId)->setProduitId($p['produit']->getId())->setQuantite($p['quantite']);

                    $this->commande_produit_repository->insertCommandeProduit($commandeProduit);
                }

                unset($_SESSION['cart']);
                unset($_SESSION['total']);
                unset($_SESSION['adresse']);

                return redirection(addLink('commande','finalisation'));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        return $this->render('commande/paiement.html.php');
    }

    public function finalisation(){
        
        return $this->render('commande/finalisation.html.php');
    }
}
