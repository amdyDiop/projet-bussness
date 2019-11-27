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
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="commande")
     */
    private $clients;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="commandes")
     */
    private $produit;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->produit = new ArrayCollection();
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
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCommande($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getCommande() === $this) {
                $client->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
        }

        return $this;
    }

}
