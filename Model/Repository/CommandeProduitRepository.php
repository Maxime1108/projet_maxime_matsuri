<?php

// Pareil pour la table de jointure

namespace Model\Repository;

use Exception;
use Model\Entity\CommandeProduit;

class CommandeProduitRepository extends BaseRepository
{
    public function insertCommandeProduit(CommandeProduit $commandeProduit)
    {
        try {
            // requête SQL 
            $sql = "INSERT INTO commande_produit (commande_id,produit_id,quantite) VALUES (:commande,:produit,:quantite)";

            // $this->database->dbConnect() vient de BaseRepository, on prépare la requête SQL avec
            $request = $this->database->dbConnect()->prepare($sql);

            // on rempli les paramètres (:parametres)
            $request->bindValue(':commande', $commandeProduit->getCommandeId());
            $request->bindValue(':produit', $commandeProduit->getProduitId());
            $request->bindValue(':quantite', $commandeProduit->getQuantite());

            // on retourne le résultat de l'execution de la requête, si c'est true ou si c'est false
            return $request->execute();
        } catch (\PDOException $e) {
            // s'il y'a un problème, il va renvoyer un message d'erreur
            throw new Exception($e->getMessage());
        }
    }
}