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
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="commandes")
     */
    private $produit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="commandes")
     */
    private $users;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valider;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $livrer;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCommandes($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCommandes() === $this) {
                $user->setCommandes(null);
            }
        }

        return $this;
    }

    public function getValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(?bool $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

    public function getLivrer(): ?string
    {
        return $this->livrer;
    }

    public function setLivrer(?string $livrer): self
    {
        $this->livrer = $livrer;

        return $this;
    }

}
