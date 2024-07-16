<?php
namespace App\Entity;

use AllowDynamicProperties;
use App\Repository\PlayRepository;
use App\Repository\PlayRolesRepository;
use App\Service\AbstractEntity;

#[AllowDynamicProperties] class Actor extends AbstractEntity
{
    private ?int $id = null;
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $email = null;
    private ?string $phone = null;
    private int $countRoles = 0;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
        $this->playRolesRepo = new PlayRolesRepository();
        $this->playRepo = new PlayRepository();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
    public function getPhoneLink(): ?string
    {
        return str_replace(' ', '', $this->phone);
    }

    /**
     * ActorRepository : allActors_countPlayRoles()
     */
    public function getCountRoles(): int
    {
        return $this->countRoles;
    }
    public function setCountRoles($countRoles)
    {
        $this->countRoles = $countRoles;
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function getFullName(): string
    {
        return $this->firstname ." ". $this->lastname;
    }

}