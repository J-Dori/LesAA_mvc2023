<?php

namespace App\Entity\Financial;

use AllowDynamicProperties;
use App\Repository\PlayRepository;
use App\Service\AbstractEntity;

#[AllowDynamicProperties] class FinSeason extends AbstractEntity
{
    private ?int $id = null;
    private ?string $play = null;
    private ?string $year = null;
    private ?float $budgetStart = null;
    private ?float $budgetEnd = null;
    private bool $active = false;
    private ?string $createdBy = null;
    private ?string $updatedBy = null;


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

    public function getPlay()
    {
        return $this->play;
    }
    public function setPlay($play): void
    {
        $this->play = $play;
    }
    public function getPlayTitle(): ?string
    {
        $playRepo = new PlayRepository();
        return $playRepo->findOneById($this->getPlay())->getTitle();
    }

    public function getYear(): ?string
    {
        return $this->year;
    }
    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function getBudgetStart(): ?float
    {
        return $this->budgetStart;
    }
    public function setBudgetStart(?float $budgetStart): void
    {
        $this->budgetStart = $budgetStart;
    }

    public function getBudgetEnd(): ?float
    {
        return $this->budgetEnd;
    }
    public function setBudgetEnd(?float $budgetEnd): void
    {
        $this->budgetEnd = $budgetEnd;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }
    public function setCreatedBy(?string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }
    public function setUpdatedBy(?string $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

}