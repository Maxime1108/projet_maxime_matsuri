<?php

// Ici on va représenter la table commande de la base de données

namespace Model\Entity;

use DateTime;

class Commande extends BaseEntity
{

    // On met les propriétés 
    private string $numero_commande;
    private DateTime $date_commande;
    private float $prix_total;
    private string $adresse;
    private string $ville;
    private string $pays;
    private int $code_postal;
    private int $user_id;

 

    public function getNumeroCommande()
    {
        // on retourne la propriété $numero_commande
        return $this->numero_commande;
    }

    public function setNumeroCommande(string $numero)
    {
        $this->numero_commande = $numero;
        // on retourne la classe directement (donc tout ce qui se trouve dans class Commande)
        return $this;
    }


    /**
     * Get the value of date_commande
     */
    public function getDateCommande()
    {
        return $this->date_commande;
    }

    /**
     * Set the value of date_commande
     *
     * @return  self
     */

    public function setDateCommande(DateTime $date_commande = new DateTime('now'))
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    /**
     * Get the value of prix_total
     */
    public function getPrixTotal()
    {
        return $this->prix_total;
    }

    /**
     * Set the value of prix_total
     *
     * @return  self
     */
    public function setPrixTotal($prix_total)
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set the value of pays
     *
     * @return  self
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get the value of code_postal
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * Set the value of code_postal
     *
     * @return  self
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;

        return $this;
    }
}
