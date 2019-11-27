<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteRepository")
 */
class Vente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="ventes")
     */
    private $id_produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Boutique", inversedBy="ventes")
     */
    private $id_boutique;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(Produit $idProduit): self
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit[] = $idProduit;
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->id_produit->contains($idProduit)) {
            $this->id_produit->removeElement($idProduit);
        }

        return $this;
    }

    public function getIdBoutique(): ?Boutique
    {
        return $this->id_boutique;
    }

    public function setIdBoutique(?Boutique $id_boutique): self
    {
        $this->id_boutique = $id_boutique;

        return $this;
    }
}
