<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @Assert\NotBlank(
     *     message = "The email should not be blank.",
     * )
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=12)
     * @Assert\NotBlank(
     *     message = "The phone should not be blank.",
     * )
     * @Assert\Regex(pattern="/^\+33\(0\)[0-9]*$/", message="number_only")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "The password should not be blank.",
     * )
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "The first name should not be blank.",
     * )
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "The last name should not be blank.",
     * )
     */
    private $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *     message = "The creation date should not be blank.",
     * )
     */
    private $createdAt;

    /**
     * @var ArrayCollection|Address[]
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="user")
     */
    private $addresses;

    /**
     * @var ArrayCollection|Reservation[]
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="customer")
     */
    private $reservations;

    /**
     * @var ArrayCollection|UsersServices[]
     * @ORM\OneToMany(targetEntity="App\Entity\UsersServices", mappedBy="user")
     */
    private $usersServices;

    /**
     * @var array
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

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


    public function getUsername(): string
    {
        return $this->email;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        $this->password = null;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * @param array
     * @return User
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @var string
     * @return User
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @var string
     * @return User
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @var string
     * @return User
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @var string
     * @return User
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return User
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @var \DateTime
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Address[]|ArrayCollection|null
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @var ArrayCollection
     * @return User
     */
    public function setAddresses($addresses): self
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @return Reservation[]|ArrayCollection|null
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @var ArrayCollection
     * @return User
     */
    public function setReservations($reservations): self
    {
        $this->reservations = $reservations;
        return $this;
    }

    /**
     * @return UsersServices[]|ArrayCollection|null
     */
    public function getUsersServices()
    {
        return $this->usersServices;
    }

    /**
     * @var ArrayCollection
     * @return User
     */
    public function setUsersServices($usersServices): self
    {
        $this->usersServices = $usersServices;
        return $this;
    }
}
