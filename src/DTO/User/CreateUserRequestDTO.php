<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^\+33\(0\)[0-9]*$/", message="number_only")
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     */
    private $lastName;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function transform(): User
    {
        $user = new User();
        $user->setEmail($this->email)
             ->setPhone($this->phone)
             ->setFirstName($this->firstName)
             ->setLastName($this->lastName)
             ->setPassword($this->password);

        return $user;
    }

}