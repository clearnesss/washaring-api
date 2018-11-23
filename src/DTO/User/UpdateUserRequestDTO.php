<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequestDTO
{
    /**
     * @var int
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     * @Assert\Regex(pattern="/^\+33\(0\)[0-9]*$/", message="number_only")
     */
    private $phone;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function hydrate(User $user): User
    {
        if (null !== $this->id) {
            $user->setId($this->id);
        }
        if (null !== $this->phone) {
            $user->setPhone($this->phone);
        }
        if (null !== $this->email) {
            $user->setEmail($this->email);
        }
        if (null !== $this->firstName) {
            $user->setFirstName($this->firstName);
        }
        if (null !== $this->lastName) {
            $user->setLastName($this->lastName);
        }
        if (null !== $this->password) {
            $user->setPassword($this->password);
        }

        return $user;
    }
}