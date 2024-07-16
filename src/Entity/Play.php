<?php
namespace App\Entity;

use App\Repository\PlayRolesRepository;
use App\Service\AbstractEntity;
use Doctrine\Common\Collections\Collection;

class Play extends AbstractEntity
{

    private ?int $id = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?int $year = null;
    private ?string $imgPath = null;
    private ?string $videoPath = null;
    private bool $active = false;
    private ?string $activeText = null;
    private string|null|\DateTimeInterface $dateStart = null;
    private string|null|\DateTimeInterface $dateEnd = null;

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
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

   
    public function getYear(): ?int
    {
        return $this->year;
    }
    public function setYear(?int $year)
    {
        $this->year = $year;
    }

    
    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }
    public function setImgPath(?string $imgPath)
    {
        $this->imgPath = $imgPath;
    }


    public function getVideoPath(): ?string
    {
        return $this->videoPath;
    }
    public function setVideoPath(?string $videoPath)
    {
        $this->videoPath = $videoPath;
    }


    public function getActive(): bool
    {
        return $this->active;
    }
    public function setActive(bool $active)
    {
        $this->active = !empty($active) ? 1 : 0;
    }

    public function getActiveText(): ?string
    {
        return $this->activeText;
    }
    public function setActiveText(?string $activeText)
    {
        $this->activeText = $activeText;
    }


    public function smallURL(): string
    {
        if (strpos($this->videoPath, '.com')) {
            $url = substr($this->videoPath, 0, strpos($this->videoPath, '.com/', 0) + 10) . "...";
        } else {
            $url = $this->videoPath;
        }
        return $url ?: "Aucune URL enregistrée";
    }

    public function smallDescription(): ?string
    {
        $strlen = strlen($this->description);
        if ($strlen > 75) {
            //cut the Description at length=75 or before if it has a "space" (last full word)
            $desc = substr($this->description, 0, strrpos(substr($this->description, 0, 75), ' '));
            return $desc . " [...]";
        } else
            return $this->description;
    }

    public function __toString()
    {
        return strval($this->id);
    }

    public function getTitleYear(): string
    {
        return $this->title . " (". $this->year . ")";
    }

    public function getYearTitle(): string
    {
        return $this->year . " - ". $this->title;
    }


    public function getDateStart(): \DateTimeInterface|string|null
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface|string|null $dateStart)
    {
        $date = $dateStart;
        if (is_string($dateStart)) {
            $date = new \DateTime($dateStart);
        }
        $this->dateStart = $date;
    }

    public function getDateEnd(): \DateTimeInterface|string|null
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface|string|null $dateEnd)
    {
        $date = $dateEnd;
        if (is_string($dateEnd)) {
            $date = new \DateTime($dateEnd);
        }
        $this->dateEnd = $date;
    }

    /**
     * Text changes on fonction of actual date
     * < today : Prochainement
     * between dates : En Scène
     * > today : Dernière Pièce
     */
    public function getPlayStatusTitle(): ?string
    {
        $text = "Prochainement";
        $today = new \DateTime();
        $dateStart = $this->getDateStart();
        $dateEnd = $this->getDateEnd();
        if (!empty($dateStart) && !empty($today)) {
            if ($today >= $dateStart && $today <= $dateEnd) {
                $text = "En Scène";
            } elseif ($today >= $dateEnd) {
                $text = "Dernière Pièce";
            }
        }
        return $text;
    }

    /**
     * If dateStart is less than 1 month (30 days) it shows BookingButton
     */
    public function getDateStartMinus30Days(): bool
    {
        $today = new \DateTime();
        $dateStart = $this->getDateStart();
        if (!empty($dateStart) && !empty($today)) {
            if ($today->diff($dateStart)->days < 30) {
                return true;
            }
        }
        return false;
    }

    public function getInlineDates(): ?string
    {
        $dates = null;

        if (!empty($this->getDateStart()) && !empty($this->getDateEnd())) {
            $yearStart = date_format($this->getDateStart(), 'Y');
            $yearEnd = date_format($this->getDateStart(), 'Y');
            if ($yearStart === $yearEnd) {
                $dates = date_format($this->getDateStart(), 'd-m') . ' au ' . date_format($this->getDateEnd(), 'd-m-Y');
            } else {
                $dates = date_format($this->getDateStart(), 'd-m-Y') . ' au ' . date_format($this->getDateEnd(), 'd-m-Y');
            }
            return $dates;
        }
        return null;
    }
}
