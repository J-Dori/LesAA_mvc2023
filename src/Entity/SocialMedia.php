<?php
namespace App\Entity;

use App\Service\AbstractEntity;

class SocialMedia extends AbstractEntity
{
    private ?int $id = null;
    private ?string $facebook = null;
    private ?string $youtube = null;
    private ?string $instagram = null;
    private ?string $tiktok = null;
    private ?string $snapchat = null;
    private ?string $twitter = null;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function __toString()
    {
        return 'Social Media';
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }
    public function setFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }
    
    public function getYoutube(): ?string
    {
        return $this->youtube;
    }
    public function setYoutube(?string $youtube): void
    {
        $this->youtube = $youtube;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }
    public function setInstagram(?string $instagram): void
    {
        $this->instagram = $instagram;
    }

    public function getTiktok(): ?string
    {
        return $this->tiktok;
    }
    public function setTiktok(?string $tiktok): void
    {
        $this->tiktok = $tiktok;
    }

    public function getSnapchat(): ?string
    {
        return $this->snapchat;
    }
    public function setSnapchat(?string $snapchat): void
    {
        $this->snapchat = $snapchat;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }
    public function setTwitter(?string $twitter): void
    {
        $this->twitter = $twitter;
    }
}
