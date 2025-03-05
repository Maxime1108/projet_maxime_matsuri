<?php

namespace Controller\Admin;

use Controller\BaseController;
use Form\Admin\UserAdminHandleRequest;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserAdminController extends BaseController
{

    private UserRepository $userRepository;
    private User $user;
    private UserAdminHandleRequest $userAdminHandleRequest;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userAdminHandleRequest = new UserAdminHandleRequest;
        $this->user = new User;
    }

    public function userList()
    {
        $users = $this->userRepository->findAll($this->user);
        return $this->render(
            'admin/user/list.html.php',
            ['users' => $users]
        );
    }

    public function editUser(int $id)
    {
        $edit = $this->userRepository->edit($this->user, ['role'], $id);
        if ($edit) {
            $_SESSION['edit'] = true;
        }
        return $this->userList();
    }
}
