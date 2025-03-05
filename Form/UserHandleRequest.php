<?php

namespace Form;

use Model\Entity\User;

class UserHandleRequest extends BaseHandleRequest
{
    public function register(User $user)
    {
        // Si la méthode est bien POST et que la clé register existe dans la superglobale $_POST, alors il rentrera dans le IF
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            extract($_POST);
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                throw new \Exception('Tous les champs doivent être remplis !');
            }

            if (!preg_match(pattern: '/^[A-Za-z][A-Za-z0-9_-]{2,19}$/', subject: $username)) {
                throw new \Exception('Le nom d\'utilisateur est invalide');
            } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', subject: $email)) {
                throw new \Exception('L\'Email est invalide');
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', subject: $password) || !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', subject: $confirm_password)) {
                throw new \Exception('Le mot de passe est invalide');
            }

            if ($password !== $confirm_password) {
                throw new \Exception('Les mots de passes ne correspondent pas');
            }

            $user->setUsername($username)->setEmail($email)->setMdp($password);

            return $this;
        }
    }

    public function login(User $user)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            extract($_POST);

            if (empty($username)) {
                throw new \Exception('Le nom d\'utilisateur doit être rempli');
            }

            if (empty($password)) {
                throw new \Exception('Le mot de passe doit être renseigné');
            }

            $user->setUsername($username)->setMdp($password);

            return $this;
        }
    }
}
