<?php
namespace App\Entity;

use AllowDynamicProperties;
use App\Service\AbstractEntity;
use App\Repository\PlayRepository;

#[AllowDynamicProperties] class PlayRoles extends AbstractEntity
{
    private ?int $id = null;
    private ?string $play = null;
    private ?string $actor = null;
    private ?string $roleName = null;


    public function __construct($data)
    {
        parent::hydrate($data, $this);
        $this->playRepo = new PlayRepository();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id): void
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

    
    public function getActor()
    {
        return $this->actor;
    }
    public function setActor($actor): void
    {
        $this->actor = $actor;
    }

    
    public function getRoleName()
    {
        return $this->roleName;
    }
    public function setRoleName($roleName): void
    {
        $this->roleName = $roleName;
    }

    public function __toString()
    {
        return $this->getRoleName() ?: ' ';
    }

    public function getPlayInfo(): ?array
    {
        return $this->playRepo->findOneById($this->getPlay());
    }
}