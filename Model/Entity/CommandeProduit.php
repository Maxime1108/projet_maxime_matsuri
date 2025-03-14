<?php 


namespace Model\Entity;

class CommandeProduit extends BaseEntity{
    private int $commande_id;
    private int $produit_id;
    private int $quantite;

    /**
     * Get the value of commande_id
     */ 
    public function getCommandeId()
    {
        return $this->commande_id;
    }

    /**
     * Set the value of commande_id
     *
     * @return  self
     */ 
    public function setCommandeId($commande_id)
    {
        $this->commande_id = $commande_id;

        return $this;
    }

    /**
     * Get the value of produit_id
     */ 
    public function getProduitId()
    {
        return $this->produit_id;
    }

    /**
     * Set the value of produit_id
     *
     * @return  self
     */ 
    public function setProduitId($produit_id)
    {
        $this->produit_id = $produit_id;

        return $this;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }
}