<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class User
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Serializer\Expose
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=12)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^\+33\(0\)[0-9]*$", message="number_only")
     * @Serializer\Expose
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Serializer\Expose
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Serializer\Expose
     */
    private $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Serializer\Expose
     */
    private $createdAt;

    /**
     * @var Collection|Address[]
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="user")
     * @Serializer\Expose
     */
    private $addresses;

    /**
     * @var Collection|Reservation[]
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="customer")
     * @Serializer\Expose
     */
    private $reservations;

    /**
     * @var Collection|UsersServices[]
     * @ORM\OneToMany(targetEntity="App\Entity\UsersServices", mappedBy="user")
     * @Serializer\Expose
     */
    private $usersServices;

    public function __construct()
    {
        $this->createdAt = new \DateTime();

        $this->addresses = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->usersServices = new ArrayCollection();
    }

    public function user(ValidatorInterface $validator): Response
    {
        $user = new User();

        // ... do something to the $user object

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string)$errors;

            return new Response($errorsString);
        }

        return new Response('The user is valid');
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
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Address[]|Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    public function setAddresses($addresses): self
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @return Reservation[]|Collection
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
