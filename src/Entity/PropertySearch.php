<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch{
    /**
     * @var int|null
     * @Assert\Range(min=1000)
     */
    private $maxPrice ;

    /**
     * @return int|null
     */
    /***
     * @var string|null
     */
    private $ville;
    /***
     * @var string|null
     */
    private $nom;

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return PropertySearch
     */
    public function setNom(?string $nom): PropertySearch
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }

    /**
     * @param string|null $ville
     * @return PropertySearch
     */
    public function setVille(string $ville): PropertySearch
    {
        $this->ville = $ville;
        return $this;
    }


    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

}
