<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numcommande;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCommande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idlient;

    /**
     * @ORM\Column(type="float")
     */
    private $tht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $ttva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tttc;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lcommande", mappedBy="idCommande")
     */
    private $idProduit;

    public function __construct()
    {
        $this->idProduit = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcommande(): ?int
    {
        return $this->numcommande;
    }

    public function setNumcommande(int $numcommande): self
    {
        $this->numcommande = $numcommande;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getIdlient(): ?Client
    {
        return $this->idlient;
    }

    public function setIdlient(?Client $idlient): self
    {
        $this->idlient = $idlient;

        return $this;
    }

    public function getTht(): ?float
    {
        return $this->tht;
    }

    public function setTht(float $tht): self
    {
        $this->tht = $tht;

        return $this;
    }

    public function getTtva(): ?float
    {
        return $this->ttva;
    }

    public function setTtva(?float $ttva): self
    {
        $this->ttva = $ttva;

        return $this;
    }

    public function getTttc(): ?float
    {
        return $this->tttc;
    }

    public function setTttc(?float $tttc): self
    {
        $this->tttc = $tttc;

        return $this;
    }

    /**
     * @return Collection|Lcommande[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Lcommande $idProduit): self
    {
        if (!$this->idProduit->contains($idProduit)) {
            $this->idProduit[] = $idProduit;
            $idProduit->setIdCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(Lcommande $idProduit): self
    {
        if ($this->idProduit->contains($idProduit)) {
            $this->idProduit->removeElement($idProduit);
            // set the owning side to null (unless already changed)
            if ($idProduit->getIdCommande() === $this) {
                $idProduit->setIdCommande(null);
            }
        }

        return $this;
    }




}
