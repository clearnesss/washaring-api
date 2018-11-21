<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     */
    private $customer;

    /**
     * @var string
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var Collection|UsersServices[]
     * @ORM\ManyToMany(targetEntity="App\Entity\UsersServices", inversedBy="reservations")
     * @ORM\JoinTable(name="reservations_users_services")
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
     * @return User
     */
    public function getCustomer(): User
    {
        return $this->customer;
    }

    public function setCustomer(User $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
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
