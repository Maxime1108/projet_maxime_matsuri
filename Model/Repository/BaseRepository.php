<?php

namespace Model\Repository;

use Model\Database;
use Model\Entity\BaseEntity;

class BaseRepository
{
    protected $connexion;
    protected $database;

    public function __construct()
    {
        $this->database = new Database;
        $this->connexion = $this->database->dbConnect();
    }
    public function findAll(BaseEntity $tableName): ?array
    {
        $sql = "SELECT * FROM $tableName";

        $request = $this->connexion->query($sql);

        $class = "Model\Entity\\" . ucfirst($tableName);  // ucfirst : majuscule au début de la chaine de caractères
        return $request->fetchAll(\PDO::FETCH_CLASS, $class) ?? null;
    }

    public function findById(BaseEntity $tableName, int $id)
    {
        $sql = "SELECT * FROM $tableName WHERE id = :id";

        $request = $this->connexion->prepare($sql);
        $request->execute(['id' => $id]);
        
        return $request->fetchObject(get_class($tableName));
    }

    public function edit(BaseEntity $tableName, array $params, string $condition)
    {
        try {
            // Construire la requête SQL avec des placeholders
            $sql = "UPDATE $tableName SET ";
            $updates = [];
            foreach ($params as $key => $value) {
                $updates[] = "$key = :$key";
            }
            $sql .= implode(", ", $updates);
            $sql .= " WHERE $condition";

            // Préparer la requête
            $request = $this->connexion->prepare($sql);

            // Lier les valeurs
            foreach ($params as $key => $value) {
                $request->bindValue(":$key", $value);
            }

            // Exécuter la requête
            return $request->execute();
        } catch (\PDOException $e) {
            // Enregistrer l'erreur dans les logs
            error_log($e->getMessage());
            return false; // Retourner false en cas d'échec
        }
    }
}
