<?php

namespace Model\Repository;

use Model\Entity\User;
use PDO;

class UserRepository extends BaseRepository
{
    public function insertUser(User $user)
    {
        try {
            // Vérification que l'email n'existe pas déjà
            $checkSql = "SELECT COUNT(*) FROM user WHERE email = :email";
            $checkRequest = $this->connexion->prepare($checkSql);
            $checkRequest->bindValue(':email', $user->getEmail());
            $checkRequest->execute();

            // Si le resultat comporte 1 ligne, c'est qu'un utilisateur possedant cet email a été trouvé, donc l'email est déjà utilisé
            if ($checkRequest->fetchColumn() > 0) {
                throw new \Exception('L\'email est déjà utilisé !');
            }

            // Insertion de l'utilisateur
            $sql = "INSERT INTO user (username,email, mdp) VALUES (:username, :email, :mdp)";

            $request = $this->connexion->prepare($sql);
            // BindValue plutot que BindParam car BindParam n'accepte que les variables et non le resultat d'une méthode
            $request->bindValue(':username', $user->getUsername());
            $request->bindValue(':email', $user->getEmail());
            // On hash le mdp
            $request->bindValue(':mdp', password_hash($user->getMDP(), PASSWORD_DEFAULT));

            if (!$request->execute()) {
                throw new \Exception('Erreur lors de l\'inscription. Veuillez réessayer plus tard');
            }
            return true;
        } catch (\PDOException $e) {
            // Gestion des erreurs SQL
            throw new \Exception('Une erreur s\'est produite, veuillez réessayez plus tard.');
        }
    }

    public function loginUser(User $user)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $request = $this->connexion->prepare($sql);
        $request->bindValue(':username', $user->getUsername());

        if ($request->execute()) {
            // Vérifie si l'utilisateur existe
            if ($request->rowCount() > 0) {
                $request->setFetchMode(PDO::FETCH_CLASS, '\Model\Entity\User');
                // Récupérer les données
                $userBdd = $request->fetch();
                // Vérifie le mot de passe
                if (password_verify($user->getMdp(), $userBdd->getMDP())) {
                    $user->setRole($userBdd->getRole())->setId($userBdd->getId());
                    return true; // Connexion réussie
                } else {
                    throw new \Exception('Utilisateur ou Mot de passe incorrect');
                }
            } else {
                throw new \Exception('Utilisateur ou Mot de passe incorrects');
            }
        }
    }
}
