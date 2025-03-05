<?php

namespace Model\Entity;

class Produit extends BaseEntity
{
    private string $title;
    private string $description; // Et j'ajoute le getter et le setter pour pouvoir dire : Cette propriété je veux lui donner telle valeur ou récupérer sa valeur de la base de données
    private float $prix;
    private string $image;
    private string $category;
    private string $topVente;


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $nom): self
    {
        $this->title = $nom;

        return $this;
    }

    // Getter 
    public function getDescription(): string
    {
        return $this->description; 
    }

    // Setter 
    public function setDescription(string $description): self 
    {
        $this->description = $description; 
        return $this; 
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): string
    {
        return $this->category;
    }

    public function setCategorie(string $categorie): self
    {
        $this->category = $categorie;

        return $this;
    }


    /**
     * Get the value of topVente
     */
    public function getTopVente()
    {
        return $this->topVente;
    }

    /**
     * Set the value of topVente
     *
     * @return  self
     */
    public function setTopVente($topVente = 'non')
    {
        $this->topVente = $topVente;

        return $this;
    }
}
