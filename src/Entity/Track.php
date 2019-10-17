<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 */
class Track
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vinyl", inversedBy="tracks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vinyl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(
     *     type="float",
     *     message="La valeur doit être un nombre à virgule."
     * )
     * @Assert\GreaterThanOrEqual(
     *  value = 1,
     *  message = "La durée doit être supérieure ou égale à 1 seconde."
     * )
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string",
     *     message="La valeur doit être une chaîne de caractères."
     * )
     */
    private $position;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVinyl(): ?Vinyl
    {
        return $this->vinyl;
    }

    public function setVinyl(?Vinyl $vinyl): self
    {
        $this->vinyl = $vinyl;

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

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }
}
