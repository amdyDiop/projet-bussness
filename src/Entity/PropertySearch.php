<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch{
    /**
     * @var int|null
     * @Assert\Range(min=100000)
     */
    private $maxPrice ;

    /**
     * @var int|null
     * @Assert\Range(min=10 , max=450)
     */
    private  $surface;

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

    /**
     * @return int|null
     */
    /***
     * @var string|null
     */
    private $ville;

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

    /**
     * @return int|null
     */
    public function getSurface(): ?int
    {
        return $this->surface;
    }

    /**
     * @param int|null $surface
     * @return PropertySearch
     */
    public function setSurface(int $surface): PropertySearch
    {
        $this->surface = $surface;
        return $this;
    }







}
