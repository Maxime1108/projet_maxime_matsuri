<?php

namespace Controller\Admin;

use Controller\BaseController;
use Form\Admin\ProduitAdminHandleRequest;
use Model\Entity\Produit;
use Model\Repository\ProduitsRepository;

class ProduitAdminController extends BaseController
{
    private Produit $produit;
    private ProduitsRepository $produitsRepository;
    private ProduitAdminHandleRequest $form;

    public function __construct()
    {
        $this->produit = new Produit;
        $this->produitsRepository = new ProduitsRepository;
        $this->form = new ProduitAdminHandleRequest;
    }

    public function addProduct()
    {
        try {
            $this->form->addAdminProduct($this->produit); // On appelle la méthode addAdminProduct (pour le formulaire)
            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $addProd = $this->produitsRepository->addProduct($this->produit);

                if ($addProd) {
                    $this->render('admin/produit/add_product.html.php', [
                        'success' => 'Votre produit a bien été ajouté'
                    ]);
                }
            }
        } catch (\Exception $e) {
            $_ENV['ERROR_MESSAGE'] = $e->getMessage();
        }

        $this->render('admin/produit/add_product.html.php');
    }

    public function list()
    {
        $produits = $this->produitsRepository->findAll($this->produit);
        return $this->render('admin/produit/liste.html.php', [
            'produits' => $produits
        ]);
    }

    public function edit()
    {
        return $this->render('admin/produit/edit.html.php');
    }

    public function delete()
    {
        return $this->render('admin/produit/delete.html.php');
    }
}
