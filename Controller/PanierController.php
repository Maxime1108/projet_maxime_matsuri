<?php

namespace Controller;

use Model\Entity\Produit;
use Model\Repository\ProduitsRepository;
use Services\Protect;

class PanierController extends BaseController
{
    private ProduitsRepository $produitsRepository;
    private Produit $produit;

    public function __construct()
    {
        $this->produit = new Produit;
        $this->produitsRepository = new ProduitsRepository();
    }
    public function addToCart()
    {
        $panier = $_SESSION['cart'] ?? $_SESSION['cart'] = [];
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id = $data['id'];

        $produit = $this->produitsRepository->findById($this->produit, $id);

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        } else {
            $panier = $_SESSION['cart'];
            foreach ($panier as $p) {
                if ($p['produit']->getId() == $produit->getId()) {
                    echo json_encode(['doublon' => 'Le produit a déjà été ajouté au panier']);
                    return;
                }
            }
        }

        $panier[] = [
            'produit' => $produit,
            'quantite' => 1
        ];

        $_SESSION['cart'] = $panier;
        d_die($panier);
        $nb = count($panier);

        $_SESSION['nb'] = $nb;

        echo json_encode(['message' => 'Le produit a bien été ajouté au panier', 'nb' => $nb]);
    }


    public function index()
    {
        $panier = $_SESSION['cart'] ?? [];
        $panier = Protect::protectHtmlSpecialChars($panier);
        $total = 0;
        foreach ($panier as $p) {
            $total += $p['produit']->getPrix() * $p['quantite'];
        }
        $_SESSION['total'] = $total;
        $this->render('cart/index.html.php', ['panier' => $panier, 'total' => $total]);
    }


    public function update()
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json, true);

        $id = intval($data['id']);

        $quantite = intval($data['quantite']);

        $panier = &$_SESSION['cart'] ?? [];

        $newTotal = 0;

        foreach ($panier as &$p) {
            if ($p['produit']->getId() == $id) {
                $p['quantite'] = $quantite;
                break;
            }
        }

        foreach ($panier as &$p) {
            $newTotal += $p['produit']->getPrix() * $p['quantite'];
        }

        echo json_encode(['success' => true, 'quantite' => $quantite, 'total' => $newTotal]);
    }


    public function supp()
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json, true);
        $id = intval($data['id']);
        $newTotal = 0;

        // On récupère la session (&signifie qu'on récupère la session originale et non une copie, elle sera mise à jour directement sans avoir besoin de la mettre à jour ensuite)
        $panier = &$_SESSION['cart'] ?? [];

        foreach ($panier as $key => $p) {
            if ($p['produit']->getId() == $id) {
                unset($panier[$key]);
                break;
            }
        }

        foreach ($panier as $p) {
            $newTotal += $p['produit']->getPrix() * $p['quantite'];
        }

        echo json_encode(['success' => true, 'newTotal' => $newTotal]);
    }
}
