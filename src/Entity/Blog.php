<?php

namespace App\Entity;

use App\Service\AbstractEntity;

class Blog extends AbstractEntity
{
    private ?int $id = null;
    private ?int $timeOrder = null;
    private ?string $date;
    private ?string $title;
    private ?string $text;
    private ?string $imgPath = '';
    private bool $active = false;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function __toString()
    {
        return strval($this->id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTimeOrder(): ?int
    {
        return $this->timeOrder;
    }

    public function setTimeOrder(?int $timeOrder): void
    {
        $this->timeOrder = $timeOrder;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }

    public function setImgPath(?string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }


    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = !empty($active);
    }

}
