<?php
namespace App\Entity;

use App\Service\AbstractEntity;

class Contact extends AbstractEntity 
{
    private ?int $id = null;
    private ?string $responsableName = null;
    private ?string $postAddress = null;
    private ?string $postPhone = null;
    private ?string $email = null;
    private ?string $theaterName = null;
    private ?string $theaterAddress = null;
    private ?string $theaterMapLink = null;
    private ?string $onlineBooking = null;
    private bool $active = false;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function __toString()
    {
        return $this->theaterName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getResponsableName(): ?string
    {
        return $this->responsableName;
    }
    public function setResponsableName(?string $responsableName): void
    {
        $this->responsableName = $responsableName;
    }
    
    public function getPostAddress(): ?string
    {
        return $this->postAddress;
    }
    public function setPostAddress(?string $postAddress): void
    {
        $this->postAddress = $postAddress;
    }
    
    public function getPostPhone(): ?string
    {
        return $this->postPhone;
    }
    public function setPostPhone(?string $postPhone): void
    {
        $this->postPhone = $postPhone;
    }

    public function getPostPhoneLink(): ?string
    {
        return str_replace(' ', '', $this->postPhone);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getTheaterName(): ?string
    {
        return $this->theaterName;
    }
    public function setTheaterName(?string $theaterName): void
    {
        $this->theaterName = $theaterName;
    }
    
    public function getTheaterAddress(): ?string
    {
        return $this->theaterAddress;
    }
    public function setTheaterAddress(?string $theaterAddress): void
    {
        $this->theaterAddress = $theaterAddress;
    }

    public function getTheaterMapLink(): ?string
    {
        return $this->theaterMapLink;
    }
    public function setTheaterMapLink(?string $theaterMapLink): void
    {
        $this->theaterMapLink = $theaterMapLink;
    }

    public function getOnlineBooking(): ?string
    {
        return $this->onlineBooking;
    }
    public function setOnlineBooking(?string $onlineBooking): void
    {
        $this->onlineBooking = $onlineBooking;
    }


}
