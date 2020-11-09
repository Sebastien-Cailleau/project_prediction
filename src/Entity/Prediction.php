<?php

namespace App\Entity;

use App\Repository\PredictionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PredictionRepository::class)
 */
class Prediction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pole;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bestLap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $second;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $third;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fourth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fifth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sixth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $seventh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eighth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ninth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tenth;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="prediction", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPole(): ?string
    {
        return $this->pole;
    }

    public function setPole(?string $pole): self
    {
        $this->pole = $pole;

        return $this;
    }

    public function getBestLap(): ?string
    {
        return $this->bestLap;
    }

    public function setBestLap(?string $bestLap): self
    {
        $this->bestLap = $bestLap;

        return $this;
    }

    public function getFirst(): ?string
    {
        return $this->first;
    }

    public function setFirst(?string $first): self
    {
        $this->first = $first;

        return $this;
    }

    public function getSecond(): ?string
    {
        return $this->second;
    }

    public function setSecond(?string $second): self
    {
        $this->second = $second;

        return $this;
    }

    public function getThird(): ?string
    {
        return $this->third;
    }

    public function setThird(?string $third): self
    {
        $this->third = $third;

        return $this;
    }

    public function getFourth(): ?string
    {
        return $this->fourth;
    }

    public function setFourth(?string $fourth): self
    {
        $this->fourth = $fourth;

        return $this;
    }

    public function getFifth(): ?string
    {
        return $this->fifth;
    }

    public function setFifth(?string $fifth): self
    {
        $this->fifth = $fifth;
        return $this;
    }

    public function getSixth(): ?string
    {
        return $this->sixth;
    }

    public function setSixth(?string $sixth): self
    {
        $this->sixth = $sixth;

        return $this;
    }

    public function getSeventh(): ?string
    {
        return $this->seventh;
    }

    public function setSeventh(?string $seventh): self
    {
        $this->seventh = $seventh;

        return $this;
    }

    public function getEighth(): ?string
    {
        return $this->eighth;
    }

    public function setEighth(?string $eighth): self
    {
        $this->eighth = $eighth;

        return $this;
    }

    public function getNinth(): ?string
    {
        return $this->ninth;
    }

    public function setNinth(?string $ninth): self
    {
        $this->ninth = $ninth;

        return $this;
    }

    public function getTenth(): ?string
    {
        return $this->tenth;
    }

    public function setTenth(?string $tenth): self
    {
        $this->tenth = $tenth;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
