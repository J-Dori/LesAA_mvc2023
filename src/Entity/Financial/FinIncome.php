<?php

namespace App\Entity\Financial;

use AllowDynamicProperties;
use App\Repository\FinSeasonRepository;
use App\Service\AbstractEntity;

#[AllowDynamicProperties] class FinIncome extends AbstractEntity
{
    private ?int $id = null;
    private ?string $finSeason = null;
    private ?string $finCategory = null;

    private ?string $date = null;
    private ?int $finNumber = null;
    private ?string $description = null;

    private ?float $amount = 0;
    private ?string $mop = null;
    private ?string $docRef = null;

    private ?string $file = null;
    private ?string $createdBy = null;
    private ?string $updatedBy = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    // SQL properties
    private ?float $totalByCategory = 0;
    private ?int $countByCategory = 0;
    private ?float $totalByMop = 0;
    private ?int $countByMop = 0;

    public function __construct($data)
    {
        $this->seasonRepo = new FinSeasonRepository();
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

    public function getFinSeason(): ?string
    {
        return $this->finSeason;
    }
    public function setFinSeason($finSeason): void
    {
        $this->finSeason = $finSeason;
    }

    public function getFinCategory(): ?string
    {
        return $this->finCategory;
    }
    public function setFinCategory($finCategory): void
    {
        $this->finCategory = $finCategory;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    public function getFinNumber(): ?int
    {
        return $this->finNumber;
    }
    public function setFinNumber(?int $finNumber): void
    {
        $this->finNumber = $finNumber;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    public function getMop(): ?string
    {
        return $this->mop;
    }
    public function setMop(?string $mop): void
    {
        $this->mop = $mop;
    }

    public function getDocRef(): ?string
    {
        return $this->docRef;
    }
    public function setDocRef(?string $docRef): void
    {
        $this->docRef = $docRef;
    }


    public function getFile(): ?string
    {
        return $this->file;
    }
    public function setFile(?string $file): void
    {
        $this->file = $file;
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

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function __toString(): string
    {
        return $this->getFinNumber() . ' : ' . $this->getFinCategory();
    }

    public function getTotalByCategory(): ?float
    {
        return $this->totalByCategory;
    }
    public function setTotalByCategory(?float $totalByCategory): void
    {
        $this->totalByCategory = $totalByCategory;
    }

    public function getCountByCategory(): ?int
    {
        return $this->countByCategory;
    }
    public function setCountByCategory(?int $countByCategory): void
    {
        $this->countByCategory = $countByCategory;
    }

    public function getTotalByMop(): ?float
    {
        return $this->totalByMop;
    }
    public function setTotalByMop(?float $totalByMop): void
    {
        $this->totalByMop = $totalByMop;
    }

    public function getCountByMop(): ?int
    {
        return $this->countByMop;
    }
    public function setCountByMop(?int $countByMop): void
    {
        $this->countByMop = $countByMop;
    }
}