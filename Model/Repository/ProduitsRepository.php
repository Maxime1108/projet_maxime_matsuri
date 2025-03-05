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
        // d_die($produit);
        $sql = "INSERT INTO produit (title,description,prix,image,category,topVente) VALUES (:title,:description,:prix,:image,:category,:topVente)";
        // Insert dans la table produit (les champs de la table) VALUES (Les valeurs à envoyer (qui sont dans l'objet $produit qu'on a rempli dans produitadmin))

        $request = $this->connexion->prepare($sql);
        $request->bindValue(':title', $produit->getTitle());
        $request->bindValue(':description', $produit->getDescription()); // Là on fait getDescription parce que les propriétés sont privées, donc vu qu'elles sont privées on peut pas les utiliser directement, par contre les méthodes Getter elles sont là pour retourner la valeur de la propriété ! 
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
