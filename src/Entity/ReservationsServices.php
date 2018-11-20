<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationsServicesRepository")
 */
class ReservationsServices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $reservation_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $users_services_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationId(): ?int
    {
        return $this->reservation_id;
    }

    public function setReservationId(int $reservation_id): self
    {
        $this->reservation_id = $reservation_id;

        return $this;
    }

    public function getUsersServicesId(): ?int
    {
        return $this->users_services_id;
    }

    public function setUsersServicesId(int $users_services_id): self
    {
        $this->users_services_id = $users_services_id;

        return $this;
    }
}
