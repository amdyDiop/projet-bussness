<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 *
 * @Vich\Uploadable
 */

class Produit
{
    /**
* @ORM\Id()
* @ORM\GeneratedValue()
* @ORM\Column(type="integer")
*/
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */


    /**
     * @Vich\UploadableField(mapping="properties_image", fileNameProperty="fileName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     *@var string|null
     * @ORM\Column(type="string", length=255)
     *
     */
    private $fileName;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $labelle;

    /**
     * @return string
     */
    public  function getSlug(): string
    {
        return (new Slugify())->slugify($this->labelle);
    }

    /**
     * @ORM\Column(type="float")
     */
    private $prix;
    function getFormatPrice()
    {
        return number_format($this->prix, 0, '',' ' );
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $stockinit;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visible;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $liked;


    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Boutique", mappedBy="produits")
     */
    private $boutiques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="produit")
     */
    private $commandes;

    public function __construct()
    {
        $this->boutiques = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLabelle(): ?string
    {
        return $this->labelle;
    }

    public function setLabelle(string $labelle): self
    {
        $this->labelle = $labelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStockinit(): ?int
    {
        return $this->stockinit;
    }

    public function setStockinit(int $stockinit): self
    {
        $this->stockinit = $stockinit;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(?bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLiked(): ?int
    {
        return $this->liked;
    }

    public function setLiked(?int $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Produit
     */
    public function setImageFile(?File $imageFile): Produit
    {
        $this->imageFile = $imageFile;
        if ( $this -> imageFile instanceof UploadedFile )
        { $this-> updatedAt = new \ DateTime ( ' now ' );         }
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     * @return Produit
     */
    public function setFileName(?string $fileName): Produit
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Boutique[]
     */
    public function getBoutiques(): Collection
    {
        return $this->boutiques;
    }

    public function addBoutique(Boutique $boutique): self
    {
        if (!$this->boutiques->contains($boutique)) {
            $this->boutiques[] = $boutique;
            $boutique->addProduit($this);
        }

        return $this;
    }

    public function removeBoutique(Boutique $boutique): self
    {
        if ($this->boutiques->contains($boutique)) {
            $this->boutiques->removeElement($boutique);
            $boutique->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeProduit($this);
        }

        return $this;
    }
}
