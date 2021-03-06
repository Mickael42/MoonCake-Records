<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $artiste;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $catNum;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     * @Assert\Country
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur doit être un nombre."
     * )
     * @Assert\Range(
     *      min = "0",
     *      max = "2020",
     *      minMessage="L'année ne peut être inférieur à {{ limit }}.",
     *      maxMessage="L'année ne peut  être supérieur à {{ limit }}."
     * )
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $mediaCondition;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $sleeveCondition;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *  value = 0,
     *  message = "La quantité doit être supérieur ou égal à O."
     * )
     */
    private $quantityStock;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *  value = 1,
     *  message = "Le prix du vinyle ne peut être inférieur à 1€."
     * )
     */
    private $regularPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThanOrEqual(
     *  value = 0,
     *  message = "Le prix du vinyle ne peut être inférieur à 0€."
     * )
     * @Assert\Expression(
     *     "this.getReducePrice() < this.getRegularPrice()",
     *     message="Le prix réduit doit être inférieur au prix standard."
     *  )
     */
    private $reducePrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="vinyl", orphanRemoval=true)
     */
    private $tracks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderProduct", mappedBy="vinyl")
     */
    private $orderProducts;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->orderProducts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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
        return $this->regularPrice;
    }

    public function setRegularPrice(int $regularPrice): self
    {
        $this->regularPrice = $regularPrice;

        return $this;
    }

    public function getReducePrice(): ?int
    {
        return $this->reducePrice;
    }

    public function setReducePrice(?int $reducePrice): self
    {
        $this->reducePrice = $reducePrice;

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
     * @return Collection|Track[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setVinyl($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getVinyl() === $this) {
                $track->setVinyl(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderProduct[]
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setVinyl($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->removeElement($orderProduct);
            // set the owning side to null (unless already changed)
            if ($orderProduct->getVinyl() === $this) {
                $orderProduct->setVinyl(null);
            }
        }

        return $this;
    }
}
