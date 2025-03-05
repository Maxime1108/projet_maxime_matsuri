<?php

namespace Model\Entity;

class User extends BaseEntity
{
    private string $username;
    private string $email;
    private string $mdp;
    private string $role;


    /**
     * Get the value of nom
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setUsername($nom)
    {
        $this->username = $nom;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
