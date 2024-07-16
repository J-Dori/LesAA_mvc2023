<?php
namespace App\Entity;

use App\Service\AbstractEntity;

class Team extends AbstractEntity 
{
    private $id;
    private $name;
    private $description;
    private $role;
    private $roleOrder;
    private $imgPath;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

   
    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }


    public function getRoleOrder()
    {
        return $this->roleOrder;
    }
    public function setRoleOrder($roleOrder)
    {
        $this->roleOrder = $roleOrder;
        return $this;
    }

    
    public function getImgPath()
    {
        return $this->imgPath;
    }
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}