<?php

namespace App\Entity;

use App\Service\AbstractEntity;

class Partners extends AbstractEntity
{
    private ?int $id = null;
    private ?string $imgPath = null;
    private ?string $name = null;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }
    public function setImgPath(?string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
