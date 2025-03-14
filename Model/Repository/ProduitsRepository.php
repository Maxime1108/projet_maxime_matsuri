<?php

namespace Model\Repository;

use Model\Entity\Produit;

class ProduitsRepository extends BaseRepository
{
    public function findProduitsByCategories(string $categorie): array
    {
        $pdo = $this->connexion;

        $sql = "SELECT * FROM produit WHERE category = :categorie";

        $request = $pdo->prepare($sql);
        $request->bindParam(':categorie', $categorie, \PDO::PARAM_STR);

        if ($request->execute()) {
            return $request->fetchAll(\PDO::FETCH_CLASS, 'Model\Entity\Produit');
        } else {
            return [];
        }
    }
    public function addProduct(Produit $produit)
    {

        $sql = "INSERT INTO produit (title,description,prix,image,category,topVente) VALUES (:title,:description,:prix,:image,:category,:topVente)";

        $request = $this->connexion->prepare($sql);
        $request->bindValue(':title', $produit->getTitle());
        $request->bindValue(':description', $produit->getDescription()); 
        $request->bindValue(':prix', $produit->getPrix());
        $request->bindValue(':image', $produit->getImage());
        $request->bindValue(':category', $produit->getCategorie());
        $request->bindValue(':topVente', $produit->getTopVente());

        if ($request->execute()) {
            return true;
        }

        throw new \Exception('Un probleme est survenu lors de l\'enregistrement du produit');
    }
}


