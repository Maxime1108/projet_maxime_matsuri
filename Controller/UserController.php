<?php

namespace Controller;

use Form\UserHandleRequest;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserController extends BaseController
{
    private User $user;
    private UserHandleRequest $form;
    private UserRepository $userRepository;

    // Le constructeur instanciera directement les classes demandées à chaque appel d'une méthode
    public function __construct()
    {
        $this->user = new User;
        $this->form = new UserHandleRequest;
        $this->userRepository = new UserRepository();
    }
    public function register()
    {
        try {
            // On vérifie si l'utilisateur est connecté
            if (isset($_SESSION['user'])) {
                // S'il est déjà connecté il n'a rien à faire dans la page d'inscription
                return redirection(addLink('home', 'index'));
            }

            $this->form->register($this->user);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->userRepository->insertUser($this->user);

                redirection(addLink('user', 'login'));
            }
        } catch (\Exception $e) {
            // On rempli la variable d'environnement qui récupère l'erreur
            $_ENV['ERROR_MESSAGE'] = $e->getMessage();
        }

        return $this->render('inscription/inscription.html.php', []);
    }

    public function login()
    {
        try {
            // On vérifie si l'utilisateur est connecté
            if (isset($_SESSION['user'])) {
                return redirection(addLink('home', 'index'));
            }

            // on lance la méthode login qui se charge de gérer le formulaire en lui passant un objet user
            $this->form->login($this->user);

            // Si le formulaire est soumis ET valide
            if ($this->form->isSubmitted() && $this->form->isValid()) {

                // On appelle la méthode loginUser du repository en lui passant l'objet user préalablement rempli dans le formulaire
                $this->userRepository->loginUser($this->user);
                $_SESSION['user'] = ['id' => $this->user->getId(), 'username' => $this->user->getUsername(), 'role' => $this->user->getRole()];
                redirection(addLink('home', 'index'));
            }
        } catch (\Exception $e) {
            // On rempli la variable d'environnement qui récupère l'erreur
            $_ENV['ERROR_MESSAGE'] = $e->getMessage();
        }

        return $this->render('login/login.html.php');
    }

    public function logout()
    {
        session_destroy();
        redirection(addLink('home', 'index'));
    }
}
