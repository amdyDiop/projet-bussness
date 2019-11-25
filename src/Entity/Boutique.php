<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoutiqueRepository")
 */
class Boutique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomBoutique;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nomVendeur;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $prenomVendeur;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $mailVendeur;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBoutique(): ?string
    {
        return $this->nomBoutique;
    }

    public function setNomBoutique(string $nomBoutique): self
    {
        $this->nomBoutique = $nomBoutique;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNomVendeur(): ?string
    {
        return $this->nomVendeur;
    }

    public function setNomVendeur(string $nomVendeur): self
    {
        $this->nomVendeur = $nomVendeur;

        return $this;
    }

    public function getPrenomVendeur(): ?string
    {
        return $this->prenomVendeur;
    }

    public function setPrenomVendeur(string $prenomVendeur): self
    {
        $this->prenomVendeur = $prenomVendeur;

        return $this;
    }

    public function getMailVendeur(): ?string
    {
        return $this->mailVendeur;
    }

    public function setMailVendeur(string $mailVendeur): self
    {
        $this->mailVendeur = $mailVendeur;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
