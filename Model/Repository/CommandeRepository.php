<?php

namespace Model\Repository;

use Exception;
use Model\Entity\Commande;

class CommandeRepository extends BaseRepository
{

    // ici on va avoir nos méthodes qui vont servir à gérer le CRUD (Create-Read-Update-Delete / Ajouter - Lire - Mettre à jour - Supprimer)

    // la méthode pour ajouter une commande dans la base de données, elle prend en paramètre l'objet (la classe commande remplie) commande
    public function insertCommande(Commande $commande)
    {

        try {
            // requête SQL 
            $sql = "INSERT INTO commande (numero_commande, date_commande, prix_total,adresse,ville,pays,code_postal,user_id) VALUES (:numeroCommande,:dateCommande, :prixTotal, :adresse,:ville,:pays,:code_postal, :user)";

            // $this->database->dbConnect() vient de BaseRepository, on prépare la requête SQL avec
            $request = $this->connexion->prepare($sql);

            // on rempli les paramètres (:parametres)
            $request->bindValue(':numeroCommande', $commande->getNumeroCommande());
            $request->bindValue(':dateCommande', $commande->getDateCommande()->format('Y-m-d'));
            $request->bindValue(':prixTotal', $commande->getPrixTotal());
            $request->bindValue(':adresse', $commande->getAdresse());
            $request->bindValue(':ville', $commande->getVille());
            $request->bindValue(':pays', $commande->getPays());
            $request->bindValue(':code_postal', $commande->getCodePostal());
            $request->bindValue(':user', $commande->getUserId());

            // on retourne le résultat de l'execution de la requête, si c'est true ou si c'est false
            $result = $request->execute();
            // On récupère le dernier id inséré
            $commandeId = $this->connexion->lastInsertId();

            return $commandeId;
        } catch (\PDOException $e) {

            throw new Exception($e->getMessage());
        }
    }
}
