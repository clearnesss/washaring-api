<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $suggestedPrice;

    /**
     * @var Collection|UsersServices[]
     * @ORM\OneToMany(targetEntity="App\Entity\UsersServices", mappedBy="service")
     */
    private $usersServices;

    public function __construct()
    {
        $this->usersServices = new ArrayCollection();
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getSuggestedPrice(): float
    {
        return $this->suggestedPrice;
    }

    public function setSuggestedPrice(float $suggestedPrice): self
    {
        $this->suggestedPrice = $suggestedPrice;
        return $this;
    }

    /**
     * @return UsersServices[]|Collection
     */
    public function getUsersServices()
    {
        return $this->usersServices;
    }

    public function setUsersServices($usersServices): self
    {
        $this->usersServices = $usersServices;
        return $this;
    }

}
