<?php
namespace App\Entity;

use App\Service\AbstractEntity;

class Headers extends AbstractEntity
{
    private ?int $id = null;
    private ?string $bannerTitle = null;
    private ?string $bannerSubtitle = null;
    private ?string $headlightTitle = null;
    private ?string $headlightSubtitle = null;
    private ?string $aboutSubtitle = null;
    private ?string $aboutFooter = null;
    private ?string $teamSubtitle = null;
    private ?string $blogSubtitle = null;
    private ?string $partnersSubtitle = null;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }

    public function __toString()
    {
        return strval($this->getId());
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getBannerTitle(): ?string
    {
        return $this->bannerTitle;
    }

    /**
     * @param string|null $bannerTitle
     */
    public function setBannerTitle(?string $bannerTitle): void
    {
        $this->bannerTitle = $bannerTitle;
    }

    /**
     * @return string|null
     */
    public function getBannerSubtitle(): ?string
    {
        return $this->bannerSubtitle;
    }

    /**
     * @param string|null $bannerSubtitle
     */
    public function setBannerSubtitle(?string $bannerSubtitle): void
    {
        $this->bannerSubtitle = $bannerSubtitle;
    }

    /**
     * @return string|null
     */
    public function getHeadlightTitle(): ?string
    {
        return $this->headlightTitle;
    }

    /**
     * @param string|null $headlightTitle
     */
    public function setHeadlightTitle(?string $headlightTitle): void
    {
        $this->headlightTitle = $headlightTitle;
    }

    /**
     * @return string|null
     */
    public function getHeadlightSubtitle(): ?string
    {
        return $this->headlightSubtitle;
    }

    /**
     * @param string|null $headlightSubtitle
     */
    public function setHeadlightSubtitle(?string $headlightSubtitle): void
    {
        $this->headlightSubtitle = $headlightSubtitle;
    }

    /**
     * @return string|null
     */
    public function getAboutSubtitle(): ?string
    {
        return $this->aboutSubtitle;
    }

    /**
     * @param string|null $aboutSubtitle
     */
    public function setAboutSubtitle(?string $aboutSubtitle): void
    {
        $this->aboutSubtitle = $aboutSubtitle;
    }

    /**
     * @return string|null
     */
    public function getAboutFooter(): ?string
    {
        return $this->aboutFooter;
    }

    /**
     * @param string|null $aboutFooter
     */
    public function setAboutFooter(?string $aboutFooter): void
    {
        $this->aboutFooter = $aboutFooter;
    }

    /**
     * @return string|null
     */
    public function getTeamSubtitle(): ?string
    {
        return $this->teamSubtitle;
    }

    /**
     * @param string|null $teamSubtitle
     */
    public function setTeamSubtitle(?string $teamSubtitle): void
    {
        $this->teamSubtitle = $teamSubtitle;
    }

    /**
     * @return string|null
     */
    public function getBlogSubtitle(): ?string
    {
        return $this->blogSubtitle;
    }

    /**
     * @param string|null $blogSubtitle
     */
    public function setBlogSubtitle(?string $blogSubtitle): void
    {
        $this->blogSubtitle = $blogSubtitle;
    }

    /**
     * @return string|null
     */
    public function getPartnersSubtitle(): ?string
    {
        return $this->partnersSubtitle;
    }

    /**
     * @param string|null $partnersSubtitle
     */
    public function setPartnersSubtitle(?string $partnersSubtitle): void
    {
        $this->partnersSubtitle = $partnersSubtitle;
    }


}
