<?php
namespace App\Entity;

use App\Service\AbstractEntity;

class User extends AbstractEntity 
{
    private ?int $id = null;
    private ?string $email = null;
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $role = null;
    private ?string $phone = null;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }


    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    
    public function getRole(): ?string
    {
        return $this->role;
    }
    public function setRole(?string $role): void
    {
        $this->role = empty($role) ? 'ROLE_USER' : $role;
    }

    public function getRoleType(): ?string
    {
        if ($this->getRole() == ROLE_ADMIN) {
            return 'Administrateur';
        }
        if ($this->getRole() == ROLE_ACCOUNT) {
            return 'Trésorier';
        }

        return 'Utilisateur';
    }

    public function getRoleTypeAndIcon(): ?string
    {
        if ($this->getRole() == ROLE_ADMIN) {
            return '<i class="fa-solid fa-user-gear"></i>&ensp;Administrateur';
        }
        if ($this->getRole() == ROLE_ACCOUNT) {
            return '<i class="fa-solid fa-scale-balanced"></i>&ensp;Trésorier';
        }

        return '<i class="fa-solid fa-circle-user"></i>&ensp;Utilisateur';
    }

    public function getUserAndIcon(): ?string
    {
        if ($this->getRole() == ROLE_ADMIN) {
            return '<i class="fa-solid fa-user-gear"></i>&ensp;'.$this->getFirstname();
        }
        if ($this->getRole() == ROLE_ACCOUNT) {
            return '<i class="fa-solid fa-scale-balanced"></i>&ensp;'.$this->getFirstname();
        }

        return '<i class="fa-solid fa-circle-user"></i>&ensp;'.$this->getFirstname();
    }
    
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucfirst($firstname);
    }

   
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function setLastname(?string $lastname): void
    {
        $this->lastname = mb_strtoupper($lastname);
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): void
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
//*************************************************/
    public function __toString()
    {
        return ucfirst($this->firstname);
    }
    
    public function fullName(): ?string
    {
        return $this->firstname ." ". $this->lastname;
    }
}