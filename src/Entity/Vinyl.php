<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VinylRepository")
 */
class Vinyl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="vinyl", orphanRemoval=true)
     */
    private $track;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artiste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catNum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mediaCondition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sleeveCondition;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantityStock;

    /**
     * @ORM\Column(type="integer")
     */
    private $RegularPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ReducePrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductOrder", mappedBy="vinyl")
     */
    private $productOrders;

    public function __construct()
    {
        $this->track = new ArrayCollection();
        $this->productOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTrack(): Collection
    {
        return $this->track;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->track->contains($track)) {
            $this->track[] = $track;
            $track->setVinyl($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->track->contains($track)) {
            $this->track->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getVinyl() === $this) {
                $track->setVinyl(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCatNum(): ?string
    {
        return $this->catNum;
    }

    public function setCatNum(string $catNum): self
    {
        $this->catNum = $catNum;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMediaCondition(): ?string
    {
        return $this->mediaCondition;
    }

    public function setMediaCondition(string $mediaCondition): self
    {
        $this->mediaCondition = $mediaCondition;

        return $this;
    }

    public function getSleeveCondition(): ?string
    {
        return $this->sleeveCondition;
    }

    public function setSleeveCondition(string $sleeveCondition): self
    {
        $this->sleeveCondition = $sleeveCondition;

        return $this;
    }

    public function getQuantityStock(): ?int
    {
        return $this->quantityStock;
    }

    public function setQuantityStock(int $quantityStock): self
    {
        $this->quantityStock = $quantityStock;

        return $this;
    }

    public function getRegularPrice(): ?int
    {
        return $this->RegularPrice;
    }

    public function setRegularPrice(int $RegularPrice): self
    {
        $this->RegularPrice = $RegularPrice;

        return $this;
    }

    public function getReducePrice(): ?int
    {
        return $this->ReducePrice;
    }

    public function setReducePrice(?int $ReducePrice): self
    {
        $this->ReducePrice = $ReducePrice;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|ProductOrder[]
     */
    public function getProductOrders(): Collection
    {
        return $this->productOrders;
    }

    public function addProductOrder(ProductOrder $productOrder): self
    {
        if (!$this->productOrders->contains($productOrder)) {
            $this->productOrders[] = $productOrder;
            $productOrder->setVinyl($this);
        }

        return $this;
    }

    public function removeProductOrder(ProductOrder $productOrder): self
    {
        if ($this->productOrders->contains($productOrder)) {
            $this->productOrders->removeElement($productOrder);
            // set the owning side to null (unless already changed)
            if ($productOrder->getVinyl() === $this) {
                $productOrder->setVinyl(null);
            }
        }

        return $this;
    }
}
