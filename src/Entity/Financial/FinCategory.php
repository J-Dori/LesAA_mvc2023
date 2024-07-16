<?php

namespace App\Entity\Financial;

use AllowDynamicProperties;
use App\Service\AbstractEntity;

class FinCategory extends AbstractEntity
{
    private ?int $id = null;
    private ?string $title = null;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }


    public function __toString(): string
    {
        return $this->getTitle();
    }

}