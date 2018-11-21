<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersServicesRepository")
 */
class UsersServices
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="usersServices")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="usersServices")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $furtherInformation;

    /**
     * @var Collection|Reservation[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservation", mappedBy="usersServices")
     */
    private $reservations;

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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getFurtherInformation(): string
    {
        return $this->furtherInformation;
    }

    public function setFurtherInformation(string $furtherInformation): self
    {
        $this->furtherInformation = $furtherInformation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    public function setReservations($reservations): self
    {
        $this->reservations = $reservations;
        return $this;
    }

}
